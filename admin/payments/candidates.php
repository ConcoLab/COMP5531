<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']) {
  header('Location: ../../login.php');
}

$payment_records = $conn->prepare('SELECT *
FROM gxc55311.z_payments as p
JOIN gxc55311.z_payment_methods as pm ON p.payment_method_id = pm.payment_method_id
JOIN gxc55311.z_candidates ON candidate_id = payment_method_user_id
JOIN gxc55311.z_users on user_id = candidate_id;
');

$payment_records->execute();
?>
<?php require_once '../../partials/head-admin.php' ?>

<div class="container">
    <h1>
        Candidates Payments
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
                        <th>Current Balance</th>
                        <th>Payment Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_count = 1;
                    while ($row = $payment_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    ?>

                        <tr>
                            <td><?= $row_count ?></td>
                            <td><?= $row['user_username'] ?></td>
                            <td><?= $row['user_email'] ?></td>
                            <td><?= $row['user_phone'] ?></td>
                            <td><?= $row['user_status'] ?></td>
                            <td><?= $row['user_balance'] ?></td>
                            <td class="text-success"><?= $row['payment_amount'] ?></td>
                            <td><?= $row['payment_date'] ?></td>
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