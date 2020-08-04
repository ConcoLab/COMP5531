<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
    header('Location: ../../login.php');
}

$stmt_status = $conn->prepare('SELECT user_status
                                FROM gxc55311.z_users
                                WHERE user_id = :user_id ;');
$stmt_status->bindParam(':user_id', $_SESSION['user_id']);
$stmt_status->execute();
$status = $stmt_status->fetchColumn();

$applied_count = $conn->prepare('SELECT COUNT(*)
FROM gxc55311.z_applications
WHERE application_candidate_id = :application_candidate_id
');

$applied_count->bindParam(':application_candidate_id', $_SESSION["user_id"]);
$applied_count->execute();
$can_apply = False;

if($_SESSION["candidate_category"] == "Gold"){
    $can_apply = True;
} else if($_SESSION["candidate_category"] == "Prime" && $applied_count->fetchColumn() < 1){
    $can_apply = True;
} else {
    $can_apply = False;
}


$job_categories = $conn->prepare('SELECT *
FROM gxc55311.z_job_categories left join
gxc55311.z_employers
on job_category_employer_id=employer_id
ORDER BY job_category_employer_id');
$job_categories->execute();
$jobs_records = null;
if(!empty($_GET['category_searched'])){
    $jobs_records = $conn->prepare('SELECT *
                FROM gxc55311.z_jobs
                JOIN gxc55311.z_employers ON job_employer_id = employer_id
                WHERE job_status = :job_status
                AND job_title LIKE :job_title
                AND job_id IN (SELECT job_id FROM gxc55311.z_jobs_job_categories WHERE job_category_id = :job_category_id)
                AND job_id NOT IN (
                    SELECT application_job_id
                    FROM gxc55311.z_applications
                    WHERE application_candidate_id = :application_candidate_id
                )
                ORDER BY job_date_posted DESC
                ');
    $jobs_records->bindParam(':job_category_id', $_GET['category_searched']);
}
else{
    $jobs_records = $conn->prepare('SELECT *
                FROM gxc55311.z_jobs
                JOIN gxc55311.z_employers ON job_employer_id = employer_id
                WHERE job_status = :job_status
                AND job_title LIKE :job_title
                AND job_id NOT IN (
                    SELECT application_job_id
                    FROM gxc55311.z_applications
                    WHERE application_candidate_id = :application_candidate_id
                )
                ORDER BY job_date_posted DESC
                ');
}
$job_status = 'Active';
$jobs_records->bindParam(':job_status', $job_status);
$jobs_records->bindParam(':application_candidate_id', $_SESSION["user_id"]);
if (isset($_GET["jobTitle"])) {
    $job_title = '%' . $_GET["jobTitle"] . '%';
} else {
    $job_title = '%%';
}
$jobs_records->bindParam(':job_title', $job_title);
$jobs_records->execute();




require_once '../../partials/head-candidate.php' ?>


<div class="container">
    <h1>
        Jobs
    </h1>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title">Search</h5>
            <form method="GET" action=".">
                <div class="form-row align-items-center">
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Title Search</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Title Search</div>
                            </div>
                            <input value="<?php  isset($_GET["jobTitle"]) ? $_GET["jobTitle"] : "" ?>" type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Category</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Category</div>
                            </div>
                            <select id="category" name="category_searched" class="form-control">
                                <option selected disabled>Search by category</option>
                                <?php
                                    $current_emp = null;
                                    echo '<optgroup label="General Categories">';
                                    while ($row = $job_categories->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                                        if($row['employer_name'] == $current_emp){
                                            $current_emp = $row['employer_name'];
                                        }
                                        else{
                                            echo "</optgroup>";
                                            $current_emp = $row['employer_name'];
                                            echo '<optgroup label='.$row['employer_name'].'>';
                                        }
                                ?>
                                    <option value=<?= $row['job_category_id'] ?>><?= $row['job_category_name'] ?></option>;
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    $row_count = 1;
    while ($row = $jobs_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
    ?>
        <div class="card mb-5">
            <div class="card-header">
                <h2>
                    <strong>
                        <td><div title="<?= substr($row['job_description'],0,49) ?>"><?= $row['job_title'] ?></div></td>
                    </strong>
                    at
                    <strong>
                        <?= $row['employer_name'] ?>
                    </strong>
                </h2>

            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $row['job_type'] ?></h5>
                <h5 class="card-title">Number of Available Positions: <?= $row['job_number_of_positions'] ?></h5>
                <p class="card-text"><?= $row['job_description'] ?></p>
                <?php if ($can_apply) { ?>
                    <form method="POST" action="./apply.php">
                        <input name="jobId" type="hidden" value="<?= $row['job_id'] ?>" >
                        <button class="btn btn-primary btn-block" type="submit" <?php if($status != "Active"){ ?> disabled <?php }?>>Apply</button>
                    </form>
                <?php } else { ?>
                    <hr>
                    <h5 class="text-primary text-center">Upgrade you membership to apply!</h5>
                <?php } ?>

            </div>
        </div>

    <?php } ?>

</div>


<?php require_once '../../partials/foot.php' ?>
