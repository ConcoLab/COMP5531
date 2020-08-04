<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
  header('Location: ../../login.php');
}

$message = "";
if (!empty($_POST['employer_name']) && !empty($_POST['employer_representative'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_employers
    SET employer_name = :employer_name, employer_representative = :employer_representative
    WHERE employer_id = :employer_id');
    $stmt->bindParam(':employer_name', $_POST['employer_name']);
    $stmt->bindParam(':employer_representative', $_POST['employer_representative']);
    $stmt->bindParam(':employer_id', $_SESSION['user_id']);

    $stmt->execute();
    $message = "Success: Profile has been updated!";
}
else{
    $message = "Error: Name or Representative cannot be empty!";
}

header("Location: .?msg=$message");

?>
