<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: /gxc55311/.');
}

$message = !empty($_GET['msg']) ? $_GET['msg'] : "";
$employer_data = $conn->prepare('SELECT *
FROM gxc55311.z_users, gxc55311.z_employers
where employer_id = user_id AND employer_id = :employer_id
');

$user_id = $_SESSION['user_id'];
$employer_data->bindParam(':employer_id', $user_id);
$employer_data->execute();

$employer = $employer_data->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

?>


<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <!-- <h1>
        Employer Profile
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
    ?> -->

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>
                Employer Profile
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

            </div>
            <!-- <div class="col-auto">
                    <h2 for="exampleFormControlInput1">Balance: <?= ($employer['user_balance'] >= 0) ? "$".$employer['user_balance'] : "-$".number_format((float)abs($employer['user_balance']),2, '.', '')?></h2>
            </div> -->
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="./edit-user.php">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="<?= $employer['user_email']?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?= $employer['user_username']?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input name="user_phone" type="text"  class="form-control" id="exampleFormControlInput1" placeholder="555-111 2233" value="<?= $employer['user_phone']?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Address</label>
                            <input name="user_address" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Address" value="<?= $employer['user_address']?>">
                        </div>

                        <button name="update_profile" type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                    <hr>
                    <form method="POST" action="./edit-employer.php">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Company Name</label>
                            <input name="employer_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Company Name" value="<?= $employer['employer_name']?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Company Representative</label>
                            <input name="employer_representative" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Company Representative" value="<?= $employer['employer_representative']?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Information</button>
                    </form>
                    <hr>
                    <form method="POST" action="./edit-password.php">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Old Password</label>
                            <input name="old_password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="Old Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">New Password</label>
                            <input name="new_password1" type="password" class="form-control" id="exampleFormControlInput1" placeholder="New Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Repeat New Password</label>
                            <input name="new_password2" type="password" class="form-control" id="exampleFormControlInput1" placeholder="Repeat New Password">
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
