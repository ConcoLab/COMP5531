<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
  header('Location: ../../login.php');
}

$jobs_records = $conn->prepare('SELECT *
FROM gxc55311.z_employers
JOIN gxc55311.z_users on user_id = employer_id
WHERE employer_id = NULL
');

$jobs_records->execute();
?>
<?php require_once '../../partials/head-admin.php' ?>

<div class="container">
    <h1>
        Basic Employers
    </h1>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Balance</th>
                        <th colspan="1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_count = 1;
                    while ($row = $jobs_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>

                        <tr>
                            <td><?= $row_count ?></td>
                            <td><?= $row['user_username'] ?></td>
                            <td><?= $row['user_email'] ?></td>
                            <td><?= $row['user_phone'] ?></td>
                            <td><?= $row['user_status'] ?></td>
                            <td><?= $row['user_balance'] ?></td>

                            <td>
                                <?php
                                if ($row['user_status'] == 'Active') { ?>

                                    <form method="POST" action="./deactivate.php">
                                        <input name="id" type="hidden" value="<?= $row['user_id'] ?>">
                                        <button class="btn btn-outline-danger btn-block" type="submit">Deactivate</button>
                                    </form>
                                <?php
                                } else if($row['user_status'] == 'Deactive') {
                                ?>
                                    <form method="POST" action="./activate.php">
                                        <input name="id" type="hidden" value="<?= $row['user_id'] ?>">
                                        <button class="btn btn-outline-success btn-block" type="submit">Activate</button>
                                    </form>
                                <?php
                                }
                                ?>

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