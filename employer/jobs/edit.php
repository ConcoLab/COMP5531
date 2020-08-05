<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

$message = (isset($_GET['msg'])) ? $_GET['msg'] : "";
$job_id = (isset($_POST['id'])) ? $_POST['id'] : $_GET['id'];
$job_stmt = $conn->prepare('SELECT *
                            FROM gxc55311.z_jobs
                            WHERE job_id = :job_id');
    $job_stmt->bindParam(':job_id', $job_id);

$job_stmt->execute();
$job = $job_stmt->fetch(PDO::FETCH_ASSOC);

$categories_stmt = $conn->prepare('SELECT job_category_id
                            FROM gxc55311.z_jobs_job_categories
                            WHERE job_id = :job_id');
$categories_stmt->bindParam(':job_id', $job_id);

$categories_stmt->execute();

$selected_categories = array();
while ($cat = $categories_stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
    array_push($selected_categories, $cat['job_category_id']);
?>

<?php
$employer_id = $_SESSION['user_id'];
/*    $categories = $conn->prepare('SELECT job_category_id, job_category_name
                            FROM gxc55311.z_job_categories
                            WHERE job_category_employer_id = :employer_id OR job_category_employer_id IS NULL');
    $categories->bindParam(':employer_id', $employer_id);
    $categories->execute();*/

    $general_categories = $conn->prepare('SELECT *
                            FROM gxc55311.z_job_categories
                            WHERE job_category_employer_id IS NULL');
    $general_categories->execute();

    $specific_categories = $conn->prepare('SELECT *
                            FROM gxc55311.z_job_categories
                            WHERE job_category_employer_id = :employer_id');
    $specific_categories->bindParam(':employer_id', $employer_id);
    $specific_categories->execute();

?>

<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Edit Job
    </h1>
    <?php
        // display message
        if(substr($message, 0, strlen("Success")) === "Success") {
    ?>
        <div class="alert alert-success" role="alert">
            <?php echo $message ?>
        </div>
    <?php
        }else if (substr($message, 0, strlen("Error")) === "Error"){
    ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $message ?>
        </div>
    <?php
        }
    ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Job Post</h5>
                    <form method="POST" action="./edit-job.php">
                        <input name="job_id" type="hidden" value="<?= $job_id ?>">
                        <div class="form-group">
                            <label for="title">Job Title</label>
                            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp" value="<?= $job['job_title'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="location">Job Location</label>
                            <input type="text" name="location" class="form-control" id="location" aria-describedby="locationHelp" value="<?= $job['job_location'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Job Type</label>
                            <select class="form-control" name="type" id="type" value=<?= $job['job_type'] ?>>
                                <?php
                                    if($job['job_type'] == "Full-Time") {
                                ?>
                                <option value="Full-Time" selected>Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                                <?php
                                    }else{
                                ?>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time" selected>Part-Time</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Job Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4"><?= $job['job_description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categories">Job Categories</label>

                            <select name="job_categories[]" class="custom-select" multiple>
                                <?php
                                    echo '<optgroup label="General Categories">';
                                    while ($category = $general_categories->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
                                        if(in_array($category['job_category_id'], $selected_categories)){
                                ?>
                                    <option value=<?= $category['job_category_id'] ?> selected><?= $category['job_category_name'] ?></option>
                                <?php
                                    }else{
                                ?>
                                    <option value=<?= $category['job_category_id'] ?>><?= $category['job_category_name'] ?></option>
                                    <?php
                                    }
                                }
                                    echo '</optgroup>';
                                    echo '<optgroup label="Your Categories">';
                                    while ($category = $specific_categories->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
                                if(in_array($category['job_category_id'], $selected_categories)){
                                ?>
                                    <option value=<?= $category['job_category_id'] ?> selected><?= $category['job_category_name'] ?></option>
                                <?php
                                    }else{
                                ?>
                                    <option value=<?= $category['job_category_id'] ?>><?= $category['job_category_name'] ?></option>
                                <?php
                                    }
                                }
                                    echo '</optgroup>';
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="positionNumbsers">Number of Positions</label>
                            <input type="number" name="positionNumbsers" class="form-control" id="positionNumbsers" aria-describedby="positionNumbsersHelp" min=1 max=1000 value=<?= $job['job_number_of_positions'] ?>>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
