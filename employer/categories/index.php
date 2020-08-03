<?php require_once '../../partials/database.php' ?>


<?php
$message = !empty($_GET['msg']) ? $_GET['msg'] : "";

$category_records = $conn->prepare('SELECT *
FROM gxc55311.z_job_categories
where job_category_employer_id = :job_category_employer_id
');

$user_id = $_SESSION['user_id'];
$category_records->bindParam(':job_category_employer_id', $user_id);
$category_records->execute();

$stmt_status = $conn->prepare('SELECT user_status
                                FROM gxc55311.z_users
                                WHERE user_id = :user_id ;');
$stmt_status->bindParam(':user_id', $_SESSION['user_id']);
$stmt_status->execute();
$status = $stmt_status->fetchColumn();

?>

<?php require_once '../../partials/head-employer.php' ?>

<div class="container">

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>
                    Your Categories
                </h1>
            </div>
            <div class="col-auto">
                <form method="POST" action="./new.php">
                    <button class="btn btn-success" type="submit" <?php if($status != "Active"){ ?> disabled <?php }?>>New Category</button>
                </form>
            </div>
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

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_count = 1;
                    while ($row = $category_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>

                        <tr>
                            <td><?= $row_count ?></td>
                            <td><?= $row['job_category_name'] ?></td>
                            <td>
                                <form method="POST" action="./edit.php">
                                    <input name="id" type="hidden" value="<?= $row['job_category_id'] ?>">
                                    <input name="job_category_name" type="hidden" value="<?= $row['job_category_name'] ?>">
                                    <button class="btn btn-outline-warning btn-block" type="submit">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="./delete.php">
                                    <input name="id" type="hidden" value="<?= $row['job_category_id'] ?>">
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
