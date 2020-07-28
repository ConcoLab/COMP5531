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
$message = !empty($_GET['msg']) ? $_GET['msg'] : "";

$date_start = (empty($_POST['date_start'])) ? date('0-0-0') : $_POST['date_start'];
$date_end = (empty($_POST['date_end'])) ? date('Y-m-d') : $_POST['date_end'];

$jobs_records = $conn->prepare('SELECT *
                            FROM gxc55311.z_jobs
                            where job_employer_id = :job_employer_id AND
                            job_date_posted >= :date_start AND
                            job_date_posted <= :date_end');

$user_id = $_SESSION['user_id'];
$jobs_records->bindParam(':date_start', $date_start);
$jobs_records->bindParam(':date_end', $date_end);
$jobs_records->bindParam(':job_employer_id', $user_id);
$jobs_records->execute();
?>

<?php require_once '../../partials/head-employer.php' ?>

<div class="container">

    <div class="container" >
        <div class="row">
            <div class="col">
                <h1>
                Your Posted Jobs
                </h1>
            </div>
            <div class="col-md-2 offset-md-2">

                <form method="POST" action="./new.php">
                    <button class="btn btn-success btn-block" type="submit">Post a Job</button>
                </form>
            </div>
        </div>
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
        <form method="POST" action="." class="form-group">
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <label for="date_start"><strong>From:</strong></label>
                    <input type="date" style="height:100%;" id="date_start" name="date_start">
                </div>
                <div class="col-md-3">
                    <label for="date_end"><strong>To:</strong></label>
                    <input type="date" style="height:100%" id="date_end" name="date_end">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-block" type="submit">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title">Search</h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Title Search</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Title Search</div>
                            </div>
                            <input type="text" class="form-control" id="inputTitle" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Category</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Category</div>
                            </div>
                            <select id="category" class="form-control">
                                <option selected>Choose...</option>
                                <option>Cat 1</option>
                                <option>Cat 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
    <!-- <div class="card">
        <div class="card-header">
            <h2>
                <strong>
                    Company Name
                </strong>
            </h2>

        </div>
        <div class="card-body">
            <h5 class="card-title">Job Title</h5>
            <p class="card-text">Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet eos, quia, delectus unde est rerum hic iure dicta soluta cumque veniam voluptatum, tenetur dignissimos. Reprehenderit veritatis distinctio sit a tenetur!</p>
            <a href="#" class="btn btn-primary">Apply</a>
        </div>
    </div> -->

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th colspan="4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_count = 1;
                    while ($row = $jobs_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>

                        <tr>
                            <td><?= $row_count ?></td>
                            <td><?= $row['job_title'] ?></td>
                            <td><?= $row['job_location'] ?></td>
                            <td><?= $row['job_type'] ?></td>
                            <td><?= $row['job_date_posted'] ?></td>
                            <td>
                                <?php
                                if ($row['job_status'] == 'Active') {
                                    echo '<strong class="text-success">Active</strong>';
                                } else {
                                    echo '<strong class="text-danger">Deactive</strong>';
                                }
                                ?>


                            </td>
                            <td>
                                <form method="GET" action="./applicants.php">
                                    <input name="id" type="hidden" value="<?= $row['job_id'] ?>">
                                    <button class="btn btn-outline-primary btn-block" type="submit">Show Applicants</button>
                                </form>
                            </td>
                            <td>
                                <?php
                                if ($row['job_status'] == 'Active') { ?>

                                    <form method="POST" action="./deactivate.php">
                                        <input name="id" type="hidden" value="<?= $row['job_id'] ?>">
                                        <button class="btn btn-outline-danger btn-block" type="submit">Deactivate</button>
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <form method="POST" action="./activate.php">
                                        <input name="id" type="hidden" value="<?= $row['job_id'] ?>">
                                        <button class="btn btn-outline-success btn-block" type="submit">Activate</button>
                                    </form>
                                <?php
                                }
                                ?>

                            </td>

                            <td>
                                <form method="POST" action="./edit.php">
                                    <input name="id" type="hidden" value="<?= $row['job_id'] ?>">
                                    <button class="btn btn-outline-warning btn-block" type="submit">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="./delete.php">
                                    <input name="id" type="hidden" value="<?= $row['job_id'] ?>">
                                    <button class="btn btn-danger btn-block" type="submit">Delete</button>
                                </form>
                            </td>

                        </tr>
                    <?php
                        $row_count++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
