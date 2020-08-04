<?php
require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
    header('Location: ../../.');
}

require_once '../../partials/head-candidate.php';
?>

<div class="container">
    <h1>
        Contact Us
    </h1>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Write to Us</h5>
                    <form method="POST" action="#">
                        <div class="form-group">
                            <label for="name">Our email</label>
                            <input type="text" disabled value="admin@main_project.ca" name="description" class="form-control" id="name" aria-describedby="nameHelp">
                        </div>
                        <div class="form-group">
                            <label for="name">Our address</label>
                            <input type="text" disabled value="1455 De Maisonneuve Blvd. W. Montreal, Quebec, Canada H3G 1M8" name="description" class="form-control" id="name" aria-describedby="nameHelp">
                        </div>
                        <div class="form-group">
                            <label for="name">Our phone</label>
                            <input type="text" disabled value="(514) 123-45-67)" name="description" class="form-control" id="name" aria-describedby="nameHelp">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php require_once '../../partials/foot.php' ?>