<?php require_once '../../partials/database.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: /gxc55311/.');
}
$stmt_status = $conn->prepare('SELECT user_status
                                FROM gxc55311.z_users
                                WHERE user_id = :user_id ;');
$stmt_status->bindParam(':user_id', $_SESSION['user_id']);
$stmt_status->execute();
$status = $stmt_status->fetchColumn();
if($status != "Active"){
    $message = $message = "Error: Only active users can create categories!";
    header("Location: .?msg=$message");
}

?>
<?php
$message = '';

if (!empty($_POST['name'])) {
    $stmt = $conn->prepare('INSERT INTO gxc55311.z_job_categories
    (job_category_name, job_category_employer_id)
    VALUES(:job_category_name, :job_category_employer_id)');
    $stmt->bindParam(':job_category_name', $_POST['name']);
    $stmt->bindParam(':job_category_employer_id', $_SESSION['user_id']);

    if ($stmt->execute()) {
        $message = "Success: Category has been added!";
    } else {
        $message = 'Error: Category hasn\'t been added!';
    }
    header("Location: .?msg=$message");
}
else {
        if (isset($_POST['submit']))
            $message = 'Error: Name cannot be empty!';
    }
?>


<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Create Job Category
    </h1>
    <?php
        // display message
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
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Job Category</h5>
                    <form method="POST" action="./new.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
