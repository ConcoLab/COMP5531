<?php
require_once '../partials/database.php';
require_once '../partials/head-public.php';

$jobs_records = $conn->prepare('SELECT *
FROM gxc55311.z_emails
JOIN gxc55311.z_users on user_id = email_user_id;
');

$jobs_records->execute();
?>
<div class="container">
    <h1>
        Simulated Inbox For All Users
    </h1>

    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Body</th>
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
                            <td><?= $row['email_subject'] ?></td>
                            <td><?= $row['email_body'] ?></td>
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

<?php
require_once '../partials/foot.php';
?>

