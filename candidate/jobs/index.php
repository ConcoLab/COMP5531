<?php require '../../partials/database.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: /gxc55311/.');
}
?>

<?php
$jobs_records = $conn->prepare('SELECT *
FROM gxc55311.z_jobs
JOIN gxc55311.z_employers ON job_employer_id = employer_id
where job_status = :job_status
');

$job_status = 'Active';
$jobs_records->bindParam(':job_status', $job_status);
$jobs_records->execute();
?>

<?php require '../../partials/head-candidate.php' ?>


<div class="container">
    <h1>
        Jobs
    </h1>

    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title">Search</h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Title Search</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Title Search</div>
                            </div>
                            <input type="text" class="form-control" id="inputTitle" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Category</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Category</div>
                            </div>
                            <select id="category" class="form-control">
                                <option selected>Choose...</option>
                                <option>Cat 1</option>
                                <option>Cat 2</option>
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
                        <?= $row['job_title'] ?>
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
                <form method="POST" action="./apply.php">
                    <input name="jobId" type="hidden" value="<?= $row['job_id'] ?>">
                    <button class="btn btn-primary btn-block" type="submit">Apply</button>
                </form>
            </div>
        </div>

    <?php } ?>

</div>


<?php require '../../partials/foot.php' ?>