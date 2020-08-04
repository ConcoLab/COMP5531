<?php require_once '../partials/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
    header('Location: ../index.php');
}

header('Location: ./jobs');