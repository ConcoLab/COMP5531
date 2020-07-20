<?php require '../partials/head.php' ?>
<?php require '../partials/layout.php' ?>
<?php require '../partials/database.php' ?>

<?php

if (!empty($_GET['jobId'])) {
    $jobs_records = $conn->prepare('SELECT *
    FROM jobs
    JOIN employers ON job_employer_id = employer_id
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


<?php require '../partials/foot.php' ?>