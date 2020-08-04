<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
    header('Location: ../../login.php');
}


$update_gold = $conn->prepare('UPDATE gxc55311.z_users
SET user_balance = user_balance - 20
WHERE user_id in (SELECT candidate_id FROM gxc55311.z_candidates WHERE candidate_category LIKE "%GOLD%")
');

$update_gold->execute();

$update_prime = $conn->prepare('UPDATE gxc55311.z_users
SET user_balance = user_balance - 10
WHERE user_id in (SELECT candidate_id FROM gxc55311.z_candidates WHERE candidate_category LIKE "%PRIME%")
');

$update_prime->execute();


header('Location: .');
