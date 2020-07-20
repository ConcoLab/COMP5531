<?php
require '../partials/head.php';
require '../partials/layout.php';
require '../partials/database.php';
$message = '';

if (!empty($_GET['id']) || !empty($_POST['id'])) {
    $pap_records = $conn->prepare('SELECT *
                            FROM paps
                            where pap_payment_method_id = :pap_payment_method_id
                            ');

    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    $pap_records->bindParam(':pap_payment_method_id', $id);

    if ($pap_records->execute()) {
        $result = $pap_records->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: .");
    }
}

if (
    !empty($_POST['transit'])
    && !empty($_POST['institution'])
    && !empty($_POST['account'])
    && !empty($_POST['id'])
) {
    $stmt = $conn->prepare('UPDATE paps SET pap_transit_number = :pap_transit_number
                                , pap_institution_number = :pap_institution_number
                                , pap_account_number = :pap_account_number
                            WHERE pap_payment_method_id = :pap_payment_method_id');
    $stmt->bindParam(':pap_payment_method_id', $_POST['id']);
    $stmt->bindParam(':pap_transit_number', $_POST['transit']);
    $stmt->bindParam(':pap_institution_number', $_POST['institution']);
    $stmt->bindParam(':pap_account_number', $_POST['account']);

    if ($stmt->execute()) {
        header("Location: .");
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
                    <h5 class="card-title">Edit Payment Method</h5>
                    <form method="POST" action="./edit-pap.php">
                        <div class="form-group">
                            <label for="transit">Transit Number</label>
                            <input type="text" name="transit" class="form-control" id="transit" aria-describedby="transitHelp" value="<?= $result['pap_transit_number'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="institution">Institution Number</label>
                            <input type="text" name="institution" class="form-control" id="institution" aria-describedby="institutionHelp" value="<?= $result['pap_institution_number'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="account">Account Number</label>
                            <input type="text" name="account" class="form-control" id="account" aria-describedby="accountHelp" value="<?= $result['pap_account_number'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" id="id" value="<?= $id ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require '../partials/foot.php' ?>