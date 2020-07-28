<?php require_once '../../partials/database.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: /gxc55311/.');
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
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}

?>


<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Create Job Category
    </h1>
<!--     <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div> -->
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
