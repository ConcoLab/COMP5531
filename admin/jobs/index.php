<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
  }

  if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
    header('Location: ../../login.php');
  }

$jobs_records = $conn->prepare('SELECT *
FROM gxc55311.z_jobs
JOIN gxc55311.z_users on user_id = job_employer_id
');

$jobs_records->execute();
?>
<?php require_once '../../partials/head-admin.php' ?>

<div class="container">
    <h1>
        All Jobs
    </h1>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employer Email</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Number of Positions</th>
                        <th>Posted Date</th>
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
                            <td><?= $row['user_email'] ?></td>
                            <td><?= $row['job_title'] ?></td>
                            <td><?= $row['job_location'] ?></td>
                            <td><?= $row['job_type'] ?></td>
                            <td><?= $row['job_status'] ?></td>
                            <td><?= $row['job_number_of_positions'] ?></td>
                            <td><?= $row['job_date_posted'] ?></td>

                            <td>
                                <form method="GET" action="./applicants.php">
                                    <input name="id" type="hidden" value="<?= $row['job_id'] ?>">
                                    <button class="btn btn-outline-primary btn-block" type="submit">Applicants</button>
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