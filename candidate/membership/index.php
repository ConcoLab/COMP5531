<?php
require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
    header('Location: ../../login.php');
}


require_once '../../partials/head-candidate.php'
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
                    <h5 class="card-title">20$ / Month</h5>
                    <p class="card-text">
                        <ul>
                            <li>Apply for unlimited amount of jobs</li>

                        </ul>
                    </p>
                    <?php if ($_SESSION["candidate_category"] != "Gold") { ?>
                        <a href="./gold.php" class="btn btn-success">Upgrade to Gold</a>
                    <?php } else if ($_SESSION["candidate_category"] == "Gold") { ?>
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
                    <h5 class="card-title">10$ / Month</h5>
                    <p class="card-text">

                        <ul>
                            <li>Apply for upto 5 Jobs</li>
                        </ul>
                    </p>
                    <?php if ($_SESSION["candidate_category"] == "Gold") { ?>
                        <a href="./prime.php" class="btn btn-danger">Downgrade to Prime</a>
                    <?php } else if ($_SESSION["candidate_category"] == "Basic") { ?>
                        <a href="./prime.php" class="btn btn-success">Upgrade to Prime</a>
                    <?php } else if ($_SESSION["candidate_category"] == "Prime") { ?>
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
                            <li>You are only able to see the jobs</li>
                        </ul>
                    </p>
                    <?php if ($_SESSION["candidate_category"] != "Basic") { ?>
                        <a href="./basic.php" class="btn btn-danger">Downgrade to Basic</a>
                    <?php } else if ($_SESSION["candidate_category"] == "Basic") { ?>
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