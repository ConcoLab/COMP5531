<?php
require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

$today = new DateTime(date('Y-m-d'));
$end = new DateTime(date('Y-m-t'));
$diff = date_diff($today, $end);
$days_left = $diff->d;
$days_passed = 30 - $days_left;
if ($_SESSION["employer_category"] == "Gold") {
    $stmt = $conn->prepare('SELECT user_balance FROM gxc55311.z_users
                            WHERE user_id = :user_id LIMIT 1');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $current_balance = $result['user_balance'];
        $balance = $current_balance + (100 / 30) * $days_left;

        $stmt_user = $conn->prepare('UPDATE gxc55311.z_users SET user_balance = :user_balance
                            WHERE user_id = :user_id');
        $stmt_user->bindParam(':user_id', $_SESSION['user_id']);
        $stmt_user->bindParam(':user_balance', $balance);
        if ($stmt->execute()) {
            $stmt_employer = $conn->prepare('UPDATE gxc55311.z_employers SET employer_category = "Basic"
                            WHERE employer_id = :employer_id');
            $stmt_employer->bindParam(':employer_id', $_SESSION['user_id']);
            if ($stmt_employer->execute()) {
                $_SESSION["employer_category"] = "Basic";
                header("Location: .");
            } else {
                $message = 'Sorry, entered values are not correct.';
            }
        } else {
            $message = 'Sorry, entered values are not correct.';
        }
    }
} else if ($_SESSION["employer_category"] == "Prime") {
    $stmt = $conn->prepare('SELECT * FROM gxc55311.z_users
                            WHERE user_id = :user_id LIMIT 1');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $current_balance = $result['user_balance'];
        $balance = $current_balance + (50 / 30) * $days_left;
        $stmt_user = $conn->prepare('UPDATE gxc55311.z_users SET user_balance = :user_balance
                            WHERE user_id = :user_id');
        $stmt_user->bindParam(':user_id', $_SESSION['user_id']);
        $stmt_user->bindParam(':user_balance', $balance);
        if ($stmt_user->execute()) {
            $stmt_employer = $conn->prepare('UPDATE gxc55311.z_employers SET employer_category = "Basic"
                            WHERE employer_id = :employer_id');
            $stmt_employer->bindParam(':employer_id', $_SESSION['user_id']);
            if ($stmt_employer->execute()) {
                $_SESSION["employer_category"] = "Basic";
                header("Location: .");
            } else {
                $message = 'Sorry, entered values are not correct.';
            }
        } else {
            $message = 'Sorry, entered values are not correct.';
        }
    }
}
