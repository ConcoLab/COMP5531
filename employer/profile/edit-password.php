<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

$message = "";
$user_id = $_SESSION['user_id'];
if (!empty($_POST['old_password']) && !empty($_POST['new_password1']) && !empty($_POST['new_password2'])) {
    $new_password1 = $_POST['new_password1'];
    $new_password2 = $_POST['new_password2'];
    if ($new_password1 == $new_password2){
        $pass_check = $conn->prepare('SELECT *
                                FROM gxc55311.z_users
                                WHERE user_id = :user_id AND user_password = :user_password');

        $pass_check->bindParam(':user_id', $user_id);
        $pass_check->bindParam(':user_password', $_POST['old_password']);
        $pass_check->execute();
        if($pass_check->rowCount() > 0){
            $pass_check = $conn->prepare('UPDATE gxc55311.z_users
                                SET user_password = :user_password
                                WHERE user_id = :user_id');

            $pass_check->bindParam(':user_id', $user_id);
            $pass_check->bindParam(':user_password', $new_password1);
            $pass_check->execute();
            $message = "Success: Password Has Been Updated!";
        }else{
            $message = "Error: Incorrect Old Password!";
        }

    }else{
        $message = "Error: New Passwords Do Not Match!";
    }
}
else{
    $message = "Error: Enter the Old Password and a New Password Twice!";
}

header("Location: .?msg=$message");

?>
