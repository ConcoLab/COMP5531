<?php require_once '../../partials/database.php' ?>

<?php
$cc_records = $conn->prepare('SELECT *
                            FROM gxc55311.z_payment_methods
                            join gxc55311.z_credit_cards on cc_payment_method_id = payment_method_id
                            where payment_method_user_id = :payment_method_user_id
                            ');

$user_id = $_SESSION['user_id'];
$cc_records->bindParam(':payment_method_user_id', $user_id);
$cc_records->execute();

$pap_records = $conn->prepare('SELECT *
                            FROM gxc55311.z_payment_methods
                            join gxc55311.z_paps on pap_payment_method_id = payment_method_id
                            where payment_method_user_id = :payment_method_user_id
                            ');

$user_id = $_SESSION['user_id'];
$pap_records->bindParam(':payment_method_user_id', $user_id);
$pap_records->execute();
?>

<?php require_once '../../partials/head-employer.php' ?>


<div class="container">
    <h1>
        Payment
    </h1>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Authorization</h5>
                    <p class="card-text">You can authorize us to charge you monthly on your membership plan</p>
                    <a href="#" class="btn btn-success">Authorize</a>
                    <a href="#" class="btn btn-danger">Withdraw Authorization</a>
                </div>
            </div>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col-4">
            <a href="./new-pap.php" class="btn btn-info btn-block">Pre-authorized Payment</a>
        </div>
        <div class="col-4">
            <a href="./new-credit.php" class="btn btn-primary btn-block">Credit Payment</a>
        </div>
        <div class="col-4">
            <a href="./manual.php" class="btn btn-dark btn-block">Manual Payment</a>
        </div>
    </div>
    <h3>Credit Cards</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Holder Name</th>
                <th scope="col">Card Number</th>
                <th scope="col">Type</th>
                <th scope="col" colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $row_count = 1;
            while ($row = $cc_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            ?>
                <tr>
                    <th scope="row"> <?= $row_count ?> </th>
                    <td><?= $row['cc_holder_name'] ?></td>
                    <td><?= $row['cc_number'] ?></td>
                    <td><?= $row['cc_type'] ?></td>
                    <td>
                        <?php
                        if($row['payment_method_default']){
                        ?>
                            <a class="btn btn-primary btn-block" href="./remove-default.php?id=<?= $row['payment_method_id'] ?>">Remove Default</a>
                        <?php
                        } else{
                        ?>
                            <a class="btn btn-outline-primary btn-block" href="./set-default.php?id=<?= $row['payment_method_id'] ?>">Set Default</a>
                        <?php
                        }
                        ?>
                    </td>
                    <td>
                        <a href="./edit-credit.php?id=<?= $row['payment_method_id'] ?>" class="btn btn-outline-warning btn-block">Edit</a>
                    </td>
                    <td>
                        <form action="./delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['payment_method_id'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
                $row_count++;
            } ?>
        </tbody>
    </table>
    <h3>Pre-Authorized Payments</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Account</th>
                <th scope="col" colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $row_count = 1;
            while ($row = $pap_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            ?>
                <tr>
                    <th scope="row"> <?= $row_count ?> </th>
                    <td><?= $row['pap_transit_number'] . '-' . $row['pap_institution_number'] . '-' . $row['pap_account_number'] ?></td>
                    <td>
                    <?php
                        if($row['payment_method_default']){
                    ?>
                            <a class="btn btn-primary btn-block" href="./remove-default.php?id=<?= $row['payment_method_id'] ?>">Remove Default</a>
                    <?php
                        } else{
                    ?>
                            <a class="btn btn-outline-primary btn-block" href="./set-default.php?id=<?= $row['payment_method_id'] ?>">Set Default</a>
                    <?php
                        }
                    ?>
<!--
                    <button class="btn btn-outline-primary btn-block">Set Default</button> -->

                    </td>
                    <td>
                    <a href="./edit-pap.php?id=<?= $row['payment_method_id'] ?>" class="btn btn-outline-warning btn-block">Edit</a>

                    </td>
                    <td>
                        <form action="./delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['payment_method_id'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
                $row_count++;
            } ?>
        </tbody>
    </table>

</div>


<?php require_once '../../partials/foot.php' ?>
