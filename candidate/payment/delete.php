<?php
require '../partials/head.php';
require '../partials/layout.php';
require '../partials/database.php';

if(!empty($_POST['id'])){
    $sql = $conn->prepare("DELETE FROM z_payment_methods WHERE payment_method_id = :payment_method_id");
    $payment_method_id = $_POST['id'];
    $sql->bindParam(':payment_method_id', $payment_method_id);


    if ($sql->execute()) {
      echo "Record deleted successfully";
      header("Location: .");
    } else {
      echo "Error deleting record: ";
    }
}
