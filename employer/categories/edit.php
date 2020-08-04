<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

?>
<?php
$message = '';
if (!empty($_POST['name'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_job_categories
    SET job_category_name = :job_category_name
    WHERE job_category_id = :job_category_id');
    $stmt->bindParam(':job_category_id', $_POST['id']);
    $stmt->bindParam(':job_category_name', $_POST['name']);


    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}

?>

<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Edit Job Category
    </h1>
    <!-- <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div> -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Job Category</h5>
                    <form method="POST" action="./edit.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="id" type="hidden" value="<?= $_POST['id'] ?>">
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" value="<?php echo $_POST["job_category_name"]; ?>">

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
