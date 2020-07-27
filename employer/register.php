<?php
require_once './partials/head.php';
require_once './partials/layout.php';
require_once './partials/database.php';

if (isset($_COOKIE['is_employer']) && $_COOKIE['is_employer']) {
  header('Location: .');
}
?>

<?php require_once '../partials/foot.php' ?>