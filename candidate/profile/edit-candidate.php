<?php require_once '../../partials/database.php' ?>
<?php
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php');
}

if (!isset($_SESSION['is_candidate']) && !$_SESSION['is_candidate']) {
  header('Location: /gxc55311/.');
}

?>
<?php
$message = "";
if (!empty($_POST['first_name']) && !empty($_POST['last_name'] && !empty($_POST['cv']))) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_candidates
    SET candidate_first_name = :first_name, candidate_last_name = :last_name, candidate_default_cv = :cv
    WHERE candidate_id = :candidate_id');
    $stmt->bindParam(':first_name', $_POST['first_name']);
    $stmt->bindParam(':last_name', $_POST['last_name']);
    $stmt->bindParam(':cv', $_POST['cv']);
    $stmt->bindParam(':candidate_id', $_SESSION['user_id']);

    $stmt->execute();
    $message = "Success: Profile has been updated!";
}
else{
    $message = "Error: Name or Representative cannot be empty!";
}

header("Location: .?msg=$message");

?>
