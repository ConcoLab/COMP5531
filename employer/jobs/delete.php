<?php require '../partials/database.php' ?>

<?php
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('DELETE FROM gxc55311.z_jobs
                            WHERE job_id = :job_id');
    $stmt->bindParam(':job_id', $_POST['id']);

    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
?>
<?php require '../partials/head.php' ?>

<?php require '../partials/foot.php' ?>