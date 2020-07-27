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
$job_status = 'Active';


if (!empty($_POST['title'])
&& !empty($_POST['location'])
&& !empty($_POST['type'])
&& !empty($_POST['description'])
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
    echo $date;
    $stmt->bindParam(':job_date_posted', $date);

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
        Post Job
    </h1>
    <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div>
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
                            <label for="positionNumbsers">Number of Positions</label>
                            <input type="number" name="positionNumbsers" class="form-control" id="positionNumbsers" aria-describedby="positionNumbsersHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>