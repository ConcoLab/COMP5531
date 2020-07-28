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
// check if employer is a Prime Member
$stmt_prime = $conn->prepare('SELECT COUNT(job_id) >= 5
                                FROM gxc55311.z_jobs, gxc55311.z_employers
                                WHERE job_employer_id = :employer_id AND
                                employer_category = "Prime" AND
                                employer_id = job_employer_id;');
    $stmt_prime->bindParam(':employer_id', $_SESSION['user_id']);

    $stmt_prime->execute();
    if($stmt_prime->fetchColumn()){
        $message = "Error: Prime members can post up to 5 jobs!";
        header("Location: .?msg=$message");
    }

?>

<?php
$message = '';
$job_status = 'Active';
$job_success = False;
$categ_success = False;

if (!empty($_POST['title'])
&& !empty($_POST['location'])
&& !empty($_POST['type'])
&& !empty($_POST['description'])
&& !empty($_POST['job_categories'])
&& !empty($_POST['positionNumbsers'])) {
    $stmt = $conn->prepare('INSERT INTO gxc55311.z_jobs
    (job_title, job_location, job_type, job_description, job_status, job_number_of_positions, job_employer_id, job_date_posted)
    VALUES(:job_title, :job_location, :job_type, :job_description, :job_status, :job_number_of_positions, :job_employer_id, :job_date_posted)');
    $stmt->bindParam(':job_title', $_POST['title']);
    $stmt->bindParam(':job_location', $_POST['location']);
    $stmt->bindParam(':job_type', $_POST['type']);
    $stmt->bindParam(':job_description', $_POST['description']);
    $stmt->bindParam(':job_status', $job_status);
    $stmt->bindParam(':job_number_of_positions', $_POST['positionNumbsers']);
    $stmt->bindParam(':job_employer_id', $_SESSION['user_id']);
    $date = date('Y-m-d');
    $stmt->bindParam(':job_date_posted', $date);

    $job_success = $stmt->execute();

    $job_id = $conn->lastInsertId();



    foreach ($_POST['job_categories'] as $categ_id){
        $categ = $conn->prepare('INSERT INTO gxc55311.z_jobs_job_categories
        (job_id, job_category_id)
        VALUES(:job_id, :job_category_id)');
        $categ->bindParam(':job_id', $job_id);
        $categ->bindParam(':job_category_id', $categ_id);
        $categ_success = $categ->execute();
    }

    }
    if ($job_success && $categ_success) {
        $message = "Success: Job has been posted!";
        header("Location: .?msg=$message");
    }else {
        if (isset($_POST['submit']))
            $message = 'Error: All fields are required!';
    }

?>

<?php
$employer_id = $_SESSION['user_id'];
    $categories = $conn->prepare('SELECT job_category_id, job_category_name
                            FROM gxc55311.z_job_categories
                            WHERE job_category_employer_id = :employer_id OR job_category_employer_id IS NULL');
    $categories->bindParam(':employer_id', $employer_id);
    $categories->execute();

?>


<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Post Job
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
                    <h5 class="card-title">New Job Post</h5>
                    <form method="POST" action="./new.php">
                        <div class="form-group">
                            <label for="title">Job Title</label>
                            <input type="text" name="title" class="form-control" id="title" aria-describedby="titleHelp">
                        </div>
                        <div class="form-group">
                            <label for="location">Job Location</label>
                            <input type="text" name="location" class="form-control" id="location" aria-describedby="locationHelp">
                        </div>
                        <div class="form-group">
                            <label for="type">Job Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Job Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categories">Job Categories</label>

                            <select name="job_categories[]" class="custom-select" multiple>
                                <?php
                                    while ($category = $categories->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
                                ?>

                                <option value=<?= $category['job_category_id'] ?>><?= $category['job_category_name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>



                        </div>
                        <div class="form-group">
                            <label for="positionNumbsers">Number of Positions</label>
                            <input type="number" name="positionNumbsers" class="form-control" id="positionNumbsers" aria-describedby="positionNumbsersHelp">
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
