<?php
require_once '../../partials/database.php';
$today = new DateTime(date('Y-m-d'));
$end = new DateTime(date('Y-m-t'));
$diff = date_diff($today, $end);
$days_left = $diff->d;
$days_passed = 30 - $days_left;
if ($_SESSION["candidate_category"] == "Gold") {
    $stmt = $conn->prepare('SELECT * FROM gxc55311.z_users
                            WHERE user_id = :user_id LIMIT 1');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $current_balance = $result['user_balance'];
        echo $current_balance;
        $balance = $current_balance /* + (20 / 30) * $days_left */;

        $stmt_user = $conn->prepare('UPDATE gxc55311.z_users SET user_balance = :user_balance
                            WHERE user_id = :user_id');
        $stmt_user->bindParam(':user_id', $_SESSION['user_id']);
        $stmt_user->bindParam(':user_balance', $balance);
        if ($stmt->execute()) {
            $stmt_employer = $conn->prepare('UPDATE gxc55311.z_candidates SET candidate_category = ""
                            WHERE candidate_id = :candidate_id');
            $stmt_employer->bindParam(':candidate_id', $_SESSION['user_id']);
            if ($stmt_employer->execute()) {
                $_SESSION["candidate_category"] = "Basic";
                header("Location: .");
            } else {
                $message = 'Sorry, entered values are not correct.';
            }
        } else {
            $message = 'Sorry, entered values are not correct.';
        }
    }
} else if ($_SESSION["candidate_category"] == "Prime") {
    $stmt = $conn->prepare('SELECT * FROM gxc55311.z_users
                            WHERE user_id = :user_id LIMIT 1');
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $current_balance = $result['user_balance'];
        echo $current_balance;
        $balance = $current_balance /* + (10 / 30) * $days_left*/;
        echo $balance;
        $stmt_user = $conn->prepare('UPDATE gxc55311.z_users SET user_balance = :user_balance
                            WHERE user_id = :user_id');
        $stmt_user->bindParam(':user_id', $_SESSION['user_id']);
        $stmt_user->bindParam(':user_balance', $balance);
        if ($stmt_user->execute()) {
            $stmt_employer = $conn->prepare('UPDATE gxc55311.z_candidates SET candidate_category = ""
                            WHERE candidate_id = :candidate_id');
            $stmt_employer->bindParam(':candidate_id', $_SESSION['user_id']);
            if ($stmt_employer->execute()) {
                $_SESSION["candidate_category"] = "Basic";
                header("Location: .");
            } else {
                $message = 'Sorry, entered values are not correct.';
            }
        } else {
            $message = 'Sorry, entered values are not correct.';
        }
    }
}
?>