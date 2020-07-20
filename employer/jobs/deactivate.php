<?php require '../partials/head.php' ?>
<?php require '../partials/layout.php' ?>
<?php require '../partials/database.php' ?>

<?php
$job_status = 'Deactive';
if (!empty($_POST['id'])) {
    $stmt = $conn->prepare('UPDATE jobs SET job_status = :job_status
                            WHERE job_id = :job_id');
    $stmt->bindParam(':job_id', $_POST['id']);
    $stmt->bindParam(':job_status', $job_status);

    if ($stmt->execute()) {
        header("Location: .");
    } else {
        $message = 'Sorry, entered values are not correct.';
    }
}
?>

<?php require '../partials/foot.php' ?>