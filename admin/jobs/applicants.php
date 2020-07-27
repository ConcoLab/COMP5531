<?php require_once '../../partials/database.php' ?>


<?php



if (!empty($_GET['id'])) {

    $job_record = $conn->prepare('SELECT *
    FROM gxc55311.z_jobs
    where job_id = :job_id
    ');
    $job_id = $_GET['id'];
    $job_record->bindParam(':job_id', $job_id);
    if (!$job_record->execute() && $job_record['job_employer_id'] != $_SESSION['user_id']) {
        header("Location: .");
    }


    $application_records = $conn->prepare('SELECT *
    FROM gxc55311.z_applications
    JOIN gxc55311.z_candidates ON application_candidate_id = candidate_id
    where application_job_id = :job_id
    ');
    $job_id = $_GET['id'];
    $application_records->bindParam(':job_id', $job_id);
    if (!$application_records->execute()) {
        header("Location: .");
    }
}


?>

<?php require_once '../../partials/head-admin.php' ?>


<div class="container">
    <h1>
        Applicants for <?= $job_record->fetch(PDO::FETCH_ASSOC)['job_title'] ?>
    </h1>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Status</th>
                        <!-- <th colspan="4">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_count = 1;
                    while ($row = $application_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>

                        <tr>
                            <td><?= $row_count ?></td>
                            <td><?= $row['candidate_first_name'] ?></td>
                            <td><?= $row['candidate_last_name'] ?></td>
                            <td>
                                <?php
                                if ($row['application_status'] == 'Processing') {
                                    echo '<strong class="text-warning">Processing</strong>';
                                } else if ($row['application_status'] == 'Rejected') {
                                    echo '<strong class="text-danger">Rejected</strong>';
                                } else if ($row['application_status'] == 'Accepted') {
                                    echo '<strong class="text-success">Accepted</strong>';
                                } else if ($row['application_status'] == 'Finalized') {
                                    echo '<strong class="text-info">Finalized</strong>';
                                }
                                ?>


                            </td>
                            <!-- <td>
                                <form method="GET" action="./applicant-detail.php">
                                    <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                    <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                    <button class="btn btn-outline-primary btn-block" type="submit">Details</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="./accept.php">
                                    <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                    <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                    <button class="btn btn-outline-success btn-block" type="submit">Accept</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="./reject.php">
                                    <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                    <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                    <button class="btn btn-outline-danger btn-block" type="submit">Reject</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="./processing.php">
                                    <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                    <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                    <button class="btn btn-outline-warning btn-block" type="submit">In Process</button>
                                </form>
                            </td> -->

                        </tr>
                    <?php
                        $row_count++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>