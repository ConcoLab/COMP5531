<?php require_once '../partials/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../index.php');
}

header('Location: jobs/');


