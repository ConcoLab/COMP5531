<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
    header('Location: ../../login.php');
}

$stmt = $conn->prepare('DELETE FROM gxc55311.z_users
                        WHERE user_id = :user_id');
$user_id = $_SESSION['user_id'];
$stmt->bindParam(':user_id', $user_id);

if ($stmt->execute()) {
    header("Location: ../../login.php");
} else {
    $message = 'Sorry, entered values are not correct.';
}
session_destroy();
