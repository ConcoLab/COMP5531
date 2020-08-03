<?php require_once '../../partials/database.php' ?>


<?php
$message = "";

if (empty($_POST['paymentMethod']) || empty($_POST['amount'])){
    $message = 'Error: Select payment method and enter the amount!';
}
else
{
    $pay_meth_id = $_POST['paymentMethod'];
    echo $oay_meth_id;
    $amount = $_POST['amount'];
    $stmt = $conn->prepare('INSERT INTO gxc55311.z_payments
                            (payment_amount, payment_date, payment_method_id)
                            VALUES (:payment_amount, :payment_date, :payment_method_id)');
    $stmt->bindParam(':payment_amount', $amount);
    $date = date('Y-m-d');
    $stmt->bindParam(':payment_date', $date);
    $stmt->bindParam(':payment_method_id', $pay_meth_id);
    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}

?>

<?php
$user_id = $_SESSION['user_id'];
$cc_records = $conn->prepare('SELECT *
                            FROM gxc55311.z_payment_methods
                            join gxc55311.z_credit_cards on cc_payment_method_id = payment_method_id
                            where payment_method_user_id = :payment_method_user_id
                            ');
$cc_records->bindParam(':payment_method_user_id', $user_id);

$pap_records = $conn->prepare('SELECT *
                            FROM gxc55311.z_payment_methods
                            join gxc55311.z_paps on pap_payment_method_id = payment_method_id
                            where payment_method_user_id = :payment_method_user_id
                            ');

$pap_records->bindParam(':payment_method_user_id', $user_id);

$cc_records->execute();
$pap_records->execute();

?>


<?php require_once '../../partials/head-employer.php' ?>

<div class="container">
    <h1>
        Make One-Time Payment
    </h1>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manual Payment</h5>
                    <form method="POST">
                        <div class="form-group" >
                            <label for="cardNumber">Credit Cards</label>
                            <?php
                                while ($row = $cc_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                            ?>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="radio" name="paymentMethod" value="<?= $row['payment_method_id'] ?>" <?php if ($row['payment_method_default']){?> checked <?php }?>>
                                    </div>
                                  </div>
                                    <input type="text" disabled class="form-control" value="<?= $row['cc_holder_name'] ?>">
                                    <input type="text" disabled class="form-control" value="<?= $row['cc_number'] ?>">
                                    <input type="text" disabled class="form-control" value="<?= $row['cc_expiration_date'] ?>">
                                </div>
                            <?php
                                }
                            ?>
                            <br>
                            <label for="cardNumber">Pre-Authorized Payments</label>
                            <?php
                                while ($row = $pap_records->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                            ?>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="radio" name="paymentMethod" value="<?= $row['payment_method_id'] ?>" <?php if ($row['payment_method_default']){?> checked <?php }?>>
                                    </div>
                                  </div>
                                    <input type="text" disabled class="form-control" value="<?= $row['pap_transit_number'] ?>">
                                    <input type="text" disabled class="form-control" value="<?= $row['pap_institution_number'] ?>">
                                    <input type="text" disabled class="form-control" value="<?= $row['pap_account_number'] ?>">
                                </div>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="cardNumber">Amount</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step = "0.01" min="0.01" name="amount" class="form-control" id="amount" aria-describedby="amountHelp">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>
