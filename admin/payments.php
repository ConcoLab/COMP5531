<?php require '../partials/database.php' ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}
if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
    header('Location: ../index.php');
}
?>


<?php require '../partials/database.php' ?>
<?php require '../partials/head-admin.php' ?>

<div class="container">
    <h1>
        Payments
    </h1>

</div>


<?php require '../partials/foot.php' ?>