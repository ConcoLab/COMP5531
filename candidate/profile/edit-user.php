<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: ../../login.php');
}

?>
<?php
$message = "";
if (!empty($_POST['user_phone']) && !empty($_POST['user_address'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_users
    SET user_phone = :user_phone, user_address = :user_address
    WHERE user_id = :user_id');
    $stmt->bindParam(':user_phone', $_POST['user_phone']);
    $stmt->bindParam(':user_address', $_POST['user_address']);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);

    $stmt->execute();
    $message = "Success: Profile has been updated!";
}
else{
    $message = "Error: Phone or Address cannot be empty!";
}


header("Location: .?msg=$message");

?>
