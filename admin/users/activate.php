<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
  header('Location: ../../login.php');
}

$user_status = 'Active';
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_users SET user_status = :user_status
                            WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $_POST['id']);
    $stmt->bindParam(':user_status', $user_status);

    if ($stmt->execute()) {
        header("Location: ./admins.php");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
