<?php require_once '../../partials/database.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: ../../login.php');
}

$message = '';

if(!empty($_POST['id'])){
    $sql = $conn->prepare("DELETE FROM gxc55311.z_payment_methods WHERE payment_method_id = :payment_method_id");
    $payment_method_id = $_POST['id'];
    $sql->bindParam(':payment_method_id', $payment_method_id);


    if ($sql->execute()) {
      $message = "Record deleted successfully";
      header("Location: .");
    } else {
      $message = "Error deleting record: ";
    }
}
?>