<?php require_once '../../partials/database.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: /gxc55311/.');
}
?>

<?php

if (!empty($_GET['jobId'])) {
    $jobs_records = $conn->prepare('SELECT *
    FROM gxc55311.z_jobs
    JOIN gxc55311.z_employers ON job_employer_id = employer_id
    where job_status = :job_status AND job_id = :job_id
    ');

    $job_status = 'Active';
    $jobs_records->bindParam(':job_status', $job_status);
    $job_id = $_GET['jobId'];
    $jobs_records->bindParam(':job_id', $job_id);
    $jobs_records->execute();
    $result = $jobs_records->fetch(PDO::FETCH_ASSOC);
}

?>
<?php require_once '../../partials/head-candidate.php' ?>

<div class="container">
    <div class="card mb-5">
        <div class="card-header">
            <h2>
                <strong>
                    <?= $result['job_title'] ?>
                </strong>
                at
                <strong>
                    <?= $result['employer_name'] ?>
                </strong>
            </h2>

        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $result['job_type'] ?></h5>
            <h5 class="card-title">Number of Available Positions: <?= $result['job_number_of_positions'] ?></h5>
            <p class="card-text"><?= $result['job_description'] ?></p>
            <form method="POST" action="./apply.php">
                <input name="jobId" type="hidden" value="<?= $result['job_id'] ?>">
                <button class="btn btn-primary btn-block" type="submit">Apply</button>
            </form>
        </div>
    </div>



</div>


<?php require_once '../../partials/foot.php' ?>