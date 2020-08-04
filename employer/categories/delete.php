<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: ../../login.php');
}

?>
<?php
$message = "";
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('DELETE FROM gxc55311.z_job_categories
                            WHERE job_category_id = :job_category_id');
    $stmt->bindParam(':job_category_id', $_POST['id']);

    if ($stmt->execute()) {
        $message = "Success: Category has been deteled!";
        header("Location: .?msg=$message");
    } else {
        $message = 'Error: Could not delete category!';
    }
}
