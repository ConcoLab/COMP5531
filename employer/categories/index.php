<?php require_once '../../partials/database.php' ?>


<?php
$category_records = $conn->prepare('SELECT *
FROM gxc55311.z_job_categories
where job_category_employer_id = :job_category_employer_id
');

$user_id = $_COOKIE['user_id'];
$category_records->bindParam(':job_category_employer_id', $user_id);
$category_records->execute();
?>

<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Your Categories
    </h1>
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