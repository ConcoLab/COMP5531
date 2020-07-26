<?php
require '../partials/database.php';

$message = '';


if (!empty($_POST['holderName'])
&& !empty($_POST['expireDate'])
&& !empty($_POST['cardNumber'])
&& !empty($_POST['cvv'])
&& !empty($_POST['type'])) {
    $stmt = $conn->prepare('INSERT INTO gxc55311.z_payment_methods (payment_method_user_id) VALUE (:payment_method_user_id)');
    $user_id = $_SESSION["user_id"];
    $stmt->bindParam(':payment_method_user_id', $user_id);

    if ($stmt->execute()) {
        $last_id = $conn->lastInsertId();
        echo $last_id;
        $stmt = $conn->prepare('INSERT INTO gxc55311.z_credit_cards
        (cc_payment_method_id, cc_number, cc_type, cc_holder_name, cc_expiration_date, cc_cvv)
        VALUES(:cc_payment_method_id, :cc_number, :cc_type, :cc_holder_name, :cc_expiration_date, :cc_cvv)');
        $stmt->bindParam(':cc_payment_method_id', $last_id);
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

<?php
require '../partials/head.php';
?>

<div class="container">
    <h1>
        Add New Credit Card
    </h1>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Payment Method</h5>
                    <form method="POST" action="./new-credit.php">
                        <div class="form-group">
                            <label for="holderName">Holder Name</label>
                            <input type="text" name="holderName" class="form-control" id="holderName" aria-describedby="holderNameHelp">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" name="cardNumber" class="form-control" id="cardNumber" aria-describedby="cardNumberHelp">
                        </div>
                        <div class="form-group">
                            <label for="expireDate">Expiration Date</label>
                            <input type="date" name="expireDate" class="form-control" id="expireDate" aria-describedby="expireDateHelp">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" name="cvv" class="form-control" id="cvv" aria-describedby="cvvHelp">
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" name="type" id="type">
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


<?php require '../partials/foot.php' ?>