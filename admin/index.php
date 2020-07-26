<?php require_once '../partials/database.php' ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
    header('Location: ../index.php');
}
?>


<?php require_once '../partials/head-admin.php' ?>

<div class="container">
    <h1>
        Index
    </h1>

</div>


<?php require_once '../partials/foot.php' ?>