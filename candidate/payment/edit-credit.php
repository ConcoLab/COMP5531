<?php require_once '../../partials/database.php' ?>

<?php
if (!isset($_COOKIE['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_COOKIE['is_candidate']) && !$_COOKIE['is_candidate']) {
  header('Location: /gxc55311/.');
}
?>


<?php
$message = '';
if (!empty($_GET['id']) || !empty($_POST['id'])) {
    $pap_records = $conn->prepare('SELECT *
                            FROM gxc55311.z_credit_cards
                            where cc_payment_method_id = :cc_payment_method_id
                            ');

    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    $pap_records->bindParam(':cc_payment_method_id', $id);

    if ($pap_records->execute()) {
        $result = $pap_records->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: .");
    }
}

if (!empty($_POST['holderName'])
&& !empty($_POST['expireDate'])
&& !empty($_POST['cardNumber'])
&& !empty($_POST['cvv'])
&& !empty($_POST['id'])
&& !empty($_POST['type'])) {
    $stmt = $conn->prepare('INSERT INTO gxc55311.z_payment_methods (payment_method_user_id) VALUE (:payment_method_user_id)');
    $user_id = $_COOKIE["user_id"];
    $stmt->bindParam(':payment_method_user_id', $user_id);

    if ($stmt->execute()) {
        $last_id = $conn->lastInsertId();
        $stmt = $conn->prepare('UPDATE gxc55311.z_credit_cards SET
        cc_number = :cc_number,
        cc_type = :cc_type,
        cc_holder_name = :cc_holder_name,
        cc_expiration_date = :cc_expiration_date,
        cc_cvv = :cc_cvv
        WHERE cc_payment_method_id = :cc_payment_method_id');
        $stmt->bindParam(':cc_payment_method_id', $_POST['id']);
        $stmt->bindParam(':cc_holder_name', $_POST['holderName']);
        $stmt->bindParam(':cc_number', $_POST['cardNumber']);
        $stmt->bindParam(':cc_expiration_date', $_POST['expireDate']);
        $stmt->bindParam(':cc_cvv', $_POST['cvv']);
        $stmt->bindParam(':cc_type', $_POST['type']);

        if ($stmt->execute()) {
            header("Location: .");
        } else {
            $message = 'Sorry, entered values are not correct.';
        }
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}

?>


<?php require_once '../../partials/head-candidate.php' ?>

<div class="container">
    <h1>
        Add New Credit Card
    </h1>
    <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Payment Method</h5>
                    <form method="POST" action="./edit-credit.php">
                        <div class="form-group">
                            <label for="holderName">Holder Name</label>
                            <input type="text" name="holderName" class="form-control" id="holderName" aria-describedby="holderNameHelp"  value="<?= $result['cc_holder_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" name="cardNumber" class="form-control" id="cardNumber" aria-describedby="cardNumberHelp" value="<?= $result['cc_number']?>">
                        </div>
                        <div class="form-group">
                            <label for="expireDate">Expiration Date</label>
                            <input type="date" name="expireDate" class="form-control" id="expireDate" aria-describedby="expireDateHelp" value="<?= $result['cc_expiration_date']?>">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" name="cvv" class="form-control" id="cvv" aria-describedby="cvvHelp" value="<?= $result['cc_cvv']?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id" value="<?= $result['cc_payment_method_id']?>">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type"  value="<?= $result['cc_type']?>">
                                <option value="Visa">Visa</option>
                                <option value="Master">Master</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once '../../partials/foot.php' ?>