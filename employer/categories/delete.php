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
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('DELETE FROM gxc55311.z_job_categories
                            WHERE job_category_id = :job_category_id');
    $stmt->bindParam(':job_category_id', $_POST['id']);

    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
