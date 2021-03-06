<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

$message = '';
$user_id = $_SESSION['user_id'];
$cc_def_remove = $conn->prepare('UPDATE gxc55311.z_payment_methods
                            SET payment_method_default = false
                            where payment_method_user_id = :payment_method_user_id
                            ');

$cc_def_remove->bindParam(':payment_method_user_id', $user_id);

if ($cc_def_remove->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }

?>
