<?php
require_once './partials/head.php';
require_once './partials/layout.php';
require_once './partials/database.php';

if (isset($_SESSION['is_employer']) && $_SESSION['is_employer']) {
  header('Location: .');
}
?>

<?php require_once '../partials/foot.php' ?>