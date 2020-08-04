<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

if (!empty($_GET['candidateId']) && !empty($_GET['jobId'])) {



    $application_record = $conn->prepare('SELECT *
    FROM gxc55311.z_applications
    JOIN gxc55311.z_candidates ON application_candidate_id = candidate_id
    WHERE application_job_id = :application_job_id AND application_candidate_id = :application_candidate_id
    ');
    $job_id = $_GET['jobId'];
    $candidate_id = $_GET['candidateId'];
    $application_record->bindParam(':application_candidate_id', $candidate_id);
    $application_record->bindParam(':application_job_id', $job_id);

    if ($application_record->execute()) {
        $result = $application_record->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: .");
    }
}
?>
<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <?= $result['candidate_first_name'] ?> <?= $result['candidate_last_name'] ?>
                    </h3>
                </div>
                <div class="card-body">
                    <h3>
                        Candidate This Job Relative CV
                    </h3>
                    <p>
                        <?= $result['application_cv'] ?>
                    </p>
                    <hr>
                    <h3>
                        Candidate Public CV
                    </h3>
                    <p>
                        <?= $result['candidate_default_cv'] ?>
                    </p>
                    <div class="row">
                        <div class="col-4">
                            <form method="POST" action="./accept.php">
                                <input name="jobId" type="hidden" value="<?= $result['application_job_id'] ?>">
                                <input name="candidateId" type="hidden" value="<?= $result['application_candidate_id'] ?>">
                                <button class="btn btn-outline-success btn-block" type="submit">Accept</button>
                            </form>
                        </div>
                        <div class="col-4">
                            <form method="POST" action="./reject.php">
                                <input name="jobId" type="hidden" value="<?= $result['application_job_id'] ?>">
                                <input name="candidateId" type="hidden" value="<?= $result['application_candidate_id'] ?>">
                                <button class="btn btn-outline-danger btn-block" type="submit">Reject</button>
                            </form>
                        </div>
                        <div class="col-4">
                            <form method="POST" action="./processing.php">
                                <input name="jobId" type="hidden" value="<?= $result['application_job_id'] ?>">
                                <input name="candidateId" type="hidden" value="<?= $result['application_candidate_id'] ?>">
                                <button class="btn btn-outline-warning btn-block" type="submit">In Process</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../../partials/foot.php' ?>