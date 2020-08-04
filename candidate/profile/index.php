
<?php
require_once '../../partials/database.php';
require_once '../../partials/head-candidate.php';
?>

<?php
$message = !empty($_GET['msg']) ? $_GET['msg'] : "";
$candidate_data = $conn->prepare('SELECT *
FROM gxc55311.z_users, gxc55311.z_candidates
where candidate_id = user_id AND candidate_id = :candidate_id
');

$user_id = $_SESSION['user_id'];
$candidate_data->bindParam(':candidate_id', $user_id);
$candidate_data->execute();

$candidate = $candidate_data->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
?>

<div class="container">


    <div class="row">
        <div class="col-12">
            <h1>
                Candidate Profile
            </h1>
            <?php
                    if(substr($message, 0, strlen("Success")) === "Success") {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message ?>
                    </div>
                <?php
                    }else if (substr($message, 0, strlen("Error")) === "Error"){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $message ?>
                    </div>
                <?php
                    }
                ?>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="./edit-user.php">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="<?= $candidate['user_email']?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?= $candidate['user_username']?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input type="text" name="user_phone" class="form-control" id="exampleFormControlInput1" placeholder="555-111 2233" value="<?= $candidate['user_phone']?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Address</label>
                            <input type="text" name="user_address" class="form-control" id="exampleFormControlInput1" placeholder="Address" value="<?= $candidate['user_address']?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                    <hr>
                    <form method="POST" action="./edit-candidate.php">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="exampleFormControlInput1" placeholder="First Name" value="<?= $candidate['candidate_first_name']?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="exampleFormControlInput1" placeholder="Last Name" value="<?= $candidate['candidate_last_name']?>">
                        </div>


                        <div class="form-group">
                            <label for="inputCV">CV</label>
                            <textarea class="form-control" name="cv" id="inputCV" rows="3"><?= $candidate['candidate_default_cv']?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Information</button>
                    </form>
                    <hr>
                    <form method="POST" action="./edit-password.php">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="exampleFormControlInput1" placeholder="Old Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">New Password</label>
                            <input type="password" name="new_password1" class="form-control" id="exampleFormControlInput1" placeholder="New Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Repeat New Password</label>
                            <input type="password" name="new_password2" class="form-control" id="exampleFormControlInput1" placeholder="Repeat New Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                    <hr>
                    <a class="btn btn-primary" href="../payment">Payment Methods</a>
                    <hr>
                    <a class="btn btn-danger" href="./delete.php">Invoke Account</a>
                </div>
            </div>
        </div>
    </div>

</div>


<?php require_once '../../partials/foot.php' ?>
