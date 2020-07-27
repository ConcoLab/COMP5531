<?php require_once '../../partials/database.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: /gxc55311/.');
}

?>
<?php
$job_status = 'Active';
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_jobs SET job_status = :job_status
                            WHERE job_id = :job_id');
    $stmt->bindParam(':job_id', $_POST['id']);
    $stmt->bindParam(':job_status', $job_status);

    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
