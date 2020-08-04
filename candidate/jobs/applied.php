<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: /gxc55311/.');
}

$job_records = $conn->prepare('SELECT *
    FROM gxc55311.z_applications
    JOIN gxc55311.z_jobs ON job_id = application_job_id
    JOIN gxc55311.z_employers ON job_employer_id = employer_id
    where application_candidate_id = :application_candidate_id
    ');
$user_id = $_SESSION['user_id'];
$job_records->bindParam(':application_candidate_id', $user_id);
$job_records->execute();



?>

<?php require_once '../../partials/head-candidate.php' ?>

<div class="container">
    <h1>
        Jobs You Applied
    </h1>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Company Name</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th colspan="4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_count = 1;
                    while ($row = $job_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>

                        <tr>
                            <td><?= $row_count ?></td>
                            <td><div title="<?= substr($row['job_description'],0,49) ?>"><?= $row['job_title'] ?></div></td>
                            <td><?= $row['employer_name'] ?></td>
                            <td><?= $row['application_date'] ?></td>
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
                                } else if ($row['application_status'] == 'CandidateAccepted') {
                                    echo '<strong class="text-info">You Accepted the Offer</strong>';
                                } else if ($row['application_status'] == 'CandidateRejected') {
                                    echo '<strong class="text-info">You Rejected the Offer</strong>';
                                }
                                ?>


                            </td>
                            <td>
                                <form method="GET" action="./job-detail.php">
                                    <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                    <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                    <button class="btn btn-outline-primary btn-block" type="submit">Details</button>
                                </form>
                            </td>
                            <?php if ($row['application_status'] == 'Accepted') { ?>
                                <td>
                                    <form method="POST" action="./accept.php">
                                        <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                        <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                        <button class="btn btn-outline-success btn-block" type="submit">Accept Offer</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="./reject.php">
                                        <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                        <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                        <button class="btn btn-outline-danger btn-block" type="submit">Reject Offer</button>
                                    </form>
                                </td>
                            <?php } else if ($row['application_status'] == 'Processing') { ?>
                                <td>
                                    <form method="POST" action="./withdraw.php">
                                        <input name="jobId" type="hidden" value="<?= $row['application_job_id'] ?>">
                                        <input name="candidateId" type="hidden" value="<?= $row['application_candidate_id'] ?>">
                                        <button class="btn btn-danger btn-block" type="submit">Withdraw</button>
                                    </form>
                                </td>
                            <?php } ?>



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
