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
$job_status = 'Active';
if (!empty($_POST['jobId'])) {
    $stmt = $conn->prepare('INSERT INTO gxc55311.z_applications
    (application_candidate_id, application_job_id, application_date, application_cv, application_status)
    VALUES(:application_candidate_id, :application_job_id, :application_date, :application_cv, :application_status);');
    $stmt->bindParam(':application_candidate_id', $_SESSION['user_id']);
    $stmt->bindParam(':application_job_id', $_POST['jobId']);
    $date = date('Y-m-d');
    $stmt->bindParam(':application_date', $date);
    $cv = 'Test';
    $stmt->bindParam(':application_cv', $cv);
    $application_status = 'Processing';
    $stmt->bindParam(':application_status', $application_status);

    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}

echo $message = 'Sorry, entered values are not correct.';
echo $_SESSION['user_id'];
echo date('Y-m-d');
echo $_POST['jobId'];

?>
<?php require_once '../../partials/head-candidate.php' ?>

<?php require_once '../../partials/foot.php' ?>
