<?php require '../partials/database.php' ?>
<?php
if (!empty($_POST['candidateId']) && !empty($_POST['jobId'])) {
    $stmt = $conn->prepare('DELETE FROM z_applications
                            WHERE application_job_id = :application_job_id
                            AND application_candidate_id = :application_candidate_id');
    $stmt->bindParam(':application_job_id', $_POST['jobId']);
    $stmt->bindParam(':application_candidate_id', $_POST['candidateId']);

    if ($stmt->execute()) {
        header("Location: ./applied.php");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
?>
<?php require '../partials/head.php' ?>

<?php require '../partials/foot.php' ?>