<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
    header('Location: ../../login.php');
}
?>
<?php require_once '../../partials/head-admin.php' ?>

<div class="container">
    <h1>
        Manual Payments
    </h1>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                <h2>Candidates Payments</h2>
                <p>
                    By clicking the following button the you will updated users payment and balance manually.
                </p>
                <a href="./candidate-update.php" class="btn btn-primary">
                    Update Balance
                </a>
                <a href="#" class="btn btn-warning">
                    Make Payment
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h2>Employers Payments</h2>
                <p>
                    By clicking the following button the you will updated users payment and balance manually.
                </p>
                <a href="./employer-update.php" class="btn btn-primary">
                    Update Balance
                </a>
                <a href="#" class="btn btn-warning">
                    Make Payment
                </a>
            </div>
        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>