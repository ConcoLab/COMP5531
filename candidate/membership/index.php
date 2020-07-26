<?php

?>
<?php require $_SERVER["DOCUMENT_ROOT"].'/comp5531/partials/head-candidate.php' ?>

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
                    <h5 class="card-title">20$ / Month</h5>
                    <p class="card-text">
                        <ul>
                            <li>See all jobs</li>
                            <li>Apply as many jobs as you want</li>
                        </ul>
                    </p>
                    <a href="./payment.php?membership=gold" class="btn btn-success">Proceed Payment</a>
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
                    <h5 class="card-title">10$ / Month</h5>
                    <p class="card-text">
                    <ul>
                            <li>See all jobs</li>
                            <li>Apply up to five jobs</li>
                        </ul>
                    </p>
                    <a href="./payment.php?membership=prime" class="btn btn-success">Proceed Payment</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">


    </div>

</div>


<?php require $_SERVER["DOCUMENT_ROOT"].'/comp5531/partials/foot.php' ?>