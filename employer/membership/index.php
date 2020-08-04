<?php
require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

require_once '../../partials/head-employer.php'
?>

<div class="container">
    <h1>
        Membership
    </h1>
    <div class="row mb-4">
        <div class="col-4">
            <div class="card bg-warning">
                <div class="card-header">
                    <strong>
                        Gold Membership
                    </strong>

                </div>
                <div class="card-body">
                    <h5 class="card-title">100$ / Month</h5>
                    <p class="card-text">
                        <ul>
                            <li>Post unlimited amount of jobs</li>

                        </ul>
                    </p>
                    <?php if ($_SESSION["employer_category"] != "Gold") { ?>
                        <a href="./gold.php" class="btn btn-success">Upgrade to Gold</a>
                    <?php } else if ($_SESSION["employer_category"] == "Gold") { ?>
                        <hr>
                        <h5 class="text-center">
                            <strong>Gold membership is ACTIVE</strong>
                        </h5>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-info text-light">
                <div class="card-header">
                    <strong>
                        Prime Membership
                    </strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">50$ / Month</h5>
                    <p class="card-text">

                        <ul>
                            <li>Post upto 5 Jobs</li>
                        </ul>
                    </p>
                    <?php if ($_SESSION["employer_category"] == "Gold") { ?>
                        <a href="./prime.php" class="btn btn-danger">Downgrade to Prime</a>
                    <?php } else if ($_SESSION["employer_category"] == "Basic") { ?>
                        <a href="./prime.php" class="btn btn-success">Upgrade to Prime</a>
                    <?php } else if ($_SESSION["employer_category"] == "Prime") { ?>
                        <hr>
                        <h5 class="text-center">
                            <strong>Prime membership is ACTIVE</strong>
                        </h5>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-primary text-light">
                <div class="card-header">
                    <strong>
                        Basic Membership
                    </strong>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Free</h5>
                    <p class="card-text">

                        <ul>
                            <li>You will not be able to post a job</li>
                        </ul>
                    </p>
                    <?php if ($_SESSION["employer_category"] != "Basic") { ?>
                        <a href="./basic.php" class="btn btn-danger">Downgrade to Basic</a>
                    <?php } else if ($_SESSION["employer_category"] == "Basic") { ?>
                        <hr>
                        <h5 class="text-center">
                            <strong>Basic membership is ACTIVE</strong>
                        </h5>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">


    </div>

</div>


<?php require_once '../../partials/foot.php' ?>