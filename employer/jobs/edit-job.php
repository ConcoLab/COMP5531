<?php require_once '../../partials/database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
}

if (!isset($_SESSION['is_employer']) && !$_SESSION['is_employer']) {
    header('Location: ../../login.php');
}

$message = '';
$job_id = $_POST['job_id'];
$job_success = False;
$categ_success = False;

if (!empty($_POST['title'])
    && !empty($_POST['location'])
    && !empty($_POST['type'])
    && !empty($_POST['description'])
    && !empty($_POST['job_categories'])
    && !empty($_POST['positionNumbsers'])) {
    $stmt = $conn->prepare('UPDATE gxc55311.z_jobs
                            SET job_title = :job_title,
                            job_location = :job_location,
                            job_type = :job_type,
                            job_description = :job_description,
                            job_number_of_positions = :job_number_of_positions,
                            job_date_posted = :job_date_posted
                            WHERE job_id = :job_id;');
    $stmt->bindParam(':job_title', $_POST['title']);
    $stmt->bindParam(':job_location', $_POST['location']);
    $stmt->bindParam(':job_type', $_POST['type']);
    $stmt->bindParam(':job_description', $_POST['description']);
    $stmt->bindParam(':job_number_of_positions', $_POST['positionNumbsers']);
    $stmt->bindParam(':job_id', $job_id);
    $date = date('Y-m-d');
    $stmt->bindParam(':job_date_posted', $date);

    $job_success = $stmt->execute();

    $delete_stmt = $conn->prepare('DELETE FROM gxc55311.z_jobs_job_categories
                                        WHERE job_id = :job_id;');
    $delete_stmt->bindParam(':job_id', $job_id);

    if ($delete_stmt->execute()){
        foreach ($_POST['job_categories'] as $categ_id){
            $categ = $conn->prepare('INSERT INTO gxc55311.z_jobs_job_categories
            (job_id, job_category_id)
            VALUES(:job_id, :job_category_id);');
            $categ->bindParam(':job_id', $job_id);
            $categ->bindParam(':job_category_id', $categ_id);
            $categ_success = $categ->execute();
        }
    }

    }else{
        $message = "Error: All fields are required!";
        header("Location: ./edit.php?id=$job_id&msg=$message");
    }
    if ($job_success && $categ_success) {
        $message = "Success: Job has been modified!";
        header("Location: .?msg=$message");
    }

?>
