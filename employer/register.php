<?php
require './partials/head.php';
require './partials/layout.php';
require './partials/database.php';

if (isset($_SESSION['is_employer']) && $_SESSION['is_employer']) {
  header('Location: .');
}
?>

<?php require '../partials/foot.php' ?>