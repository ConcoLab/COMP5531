<?php require '../../partials/database.php' ?>

<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: ../../.');
}
?>

<?php
$application_status = 'CandidateAccepted';
if (!empty($_POST['candidateId']) && !empty($_POST['jobId'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_applications SET application_status = :application_status
                            WHERE application_job_id = :application_job_id
                            AND application_candidate_id = :application_candidate_id');
    $stmt->bindParam(':application_job_id', $_POST['jobId']);
    $stmt->bindParam(':application_candidate_id', $_POST['candidateId']);
    $stmt->bindParam(':application_status', $application_status);

    if ($stmt->execute()) {
        header("Location: ./applied.php");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
