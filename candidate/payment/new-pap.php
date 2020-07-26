<?php
require '../partials/head.php';
require '../partials/layout.php';
require '../partials/database.php';
$message = '';

if (!empty($_POST['transit']) && !empty($_POST['institution']) && !empty($_POST['account'])) {
    $stmt = $conn->prepare('INSERT INTO z_payment_methods (payment_method_user_id) VALUE (:payment_method_user_id)');
    $user_id = $_SESSION["user_id"];
    $stmt->bindParam(':payment_method_user_id', $user_id);

    if ($stmt->execute()) {
        $last_id = $conn->lastInsertId();
        $stmt = $conn->prepare('INSERT INTO z_paps (pap_payment_method_id, pap_transit_number, pap_institution_number, pap_account_number) VALUES (:pap_payment_method_id, :pap_transit_number, :pap_institution_number, :pap_account_number)');
        $stmt->bindParam(':pap_payment_method_id', $last_id);
        $stmt->bindParam(':pap_transit_number', $_POST['transit']);
        $stmt->bindParam(':pap_institution_number', $_POST['institution']);
        $stmt->bindParam(':pap_account_number', $_POST['account']);

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




<div class="container">
    <h1>
        Add New Pre-authorized Payment Method
    </h1>
    <div class="alert alert-danger" role="alert">
        <?php echo $message ?>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Payment Method</h5>
                    <form method="POST" action="./new-pap.php">
                        <div class="form-group">
                            <label for="transit">Transit Number</label>
                            <input type="text" name="transit" class="form-control" id="transit" aria-describedby="transitHelp">
                        </div>
                        <div class="form-group">
                            <label for="institution">Institution Number</label>
                            <input type="text" name="institution" class="form-control" id="institution" aria-describedby="institutionHelp">
                        </div>
                        <div class="form-group">
                            <label for="account">Account Number</label>
                            <input type="text" name="account" class="form-control" id="account" aria-describedby="accountHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require '../partials/foot.php' ?>