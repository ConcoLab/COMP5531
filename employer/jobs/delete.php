<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: ../../login.php');
}
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('DELETE FROM gxc55311.z_jobs
                            WHERE job_id = :job_id');
    $stmt->bindParam(':job_id', $_POST['id']);

    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
