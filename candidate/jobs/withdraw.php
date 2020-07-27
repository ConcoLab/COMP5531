<?php require_once '../../partials/database.php' ?>
<?php
if (!isset($_COOKIE['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_COOKIE['is_candidate']) && !$_COOKIE['is_candidate']) {
  header('Location: /gxc55311/.');
}
?>

<?php
if (!empty($_POST['candidateId']) && !empty($_POST['jobId'])) {
    $stmt = $conn->prepare('DELETE FROM gxc55311.z_applications
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
<?php require_once '../../partials/head-candidate.php' ?>

<?php require_once '../../partials/foot.php' ?>