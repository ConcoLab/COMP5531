<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: ../../login.php');
}

if(!empty($_POST['id'])){
    $sql = $conn->prepare("DELETE FROM gxc55311.z_payment_methods WHERE payment_method_id = :payment_method_id");
    $payment_method_id = $_POST['id'];
    $sql->bindParam(':payment_method_id', $payment_method_id);


    if ($sql->execute()) {
      echo "Record deleted successfully";
      header("Location: .");
    } else {
      echo "Error deleting record: ";
    }
}
