<?php require_once '../../partials/database.php' ?>

<?php
$message = '';
$message = '';
$payment_method_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$cc_def_set = $conn->prepare('UPDATE gxc55311.z_payment_methods
                            SET payment_method_default = CASE
                            WHEN payment_method_id = :payment_method_id THEN true
                            ELSE false
                            END
                            where payment_method_user_id = :payment_method_user_id
                            ');

$cc_def_set->bindParam(':payment_method_user_id', $user_id);
$cc_def_set->bindParam(':payment_method_id', $payment_method_id);

if ($cc_def_set->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
        echo 'aaaa';
    }

?>
