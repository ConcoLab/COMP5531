<?php require_once '../../partials/database.php' ?>

<?php
$message = '';
$payment_method_id = $_GET['id'];
$cc_def_remove = $conn->prepare('UPDATE gxc55311.z_payment_methods
                            SET payment_method_default = false
                            where payment_method_id = :payment_method_id
                            ');

$cc_def_remove->bindParam(':payment_method_id', $payment_method_id);

if ($cc_def_remove->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }

?>
