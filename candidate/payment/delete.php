<?php require_once '../../partials/database.php' ?>

<?php
if (!isset($_COOKIE['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_COOKIE['is_candidate']) && !$_COOKIE['is_candidate']) {
  header('Location: /gxc55311/.');
}
?>

<?php
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
