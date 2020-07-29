<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: /gxc55311/.');
}

$stmt = $conn->prepare('DELETE FROM gxc55311.z_users
                        WHERE user_id = :employer_id');
$user_id = $_SESSION['user_id'];
$stmt->bindParam(':employer_id', $user_id);

if ($stmt->execute()) {
    header("Location: ../../");
} else {
    $message = 'Sorry, entered values are not correct.';
}
session_destroy();
