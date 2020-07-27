<?php
require_once '../../partials/database.php';
require_once '../../partials/head-employer.php'
?>

<div class="container">
    <h1>
        Membership
    </h1>
    <div class="row mb-4">
        <div class="col-6">
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
                    <?php } else { ?>
                        <a href="./cancel.php" class="btn btn-danger">Cancel</a>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-6">
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
                    <?php } else if ($_SESSION["employer_category"] == "Prime") { ?>
                        <a href="./cancel.php" class="btn btn-danger">Cancel</a>
                    <?php } else { ?>
                        <a href="./prime.php" class="btn btn-success">Upgrade to Prime</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">


    </div>

</div>


<?php require_once $_SERVER["DOCUMENT_ROOT"] . '/comp5531/partials/foot.php' ?>