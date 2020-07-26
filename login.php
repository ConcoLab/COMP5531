<?php
require './partials/database.php';

if (isset($_SESSION['user_id'])) {
  header('Location: candidate/jobs');
}
$message = '';



if (!empty($_POST['emailOrUsername']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT user_id, user_email, user_password, user_username FROM gxc55311.z_users WHERE user_email = :user_email OR user_username = :user_username');
  $records->bindParam(':user_email', $_POST['emailOrUsername']);
  $records->bindParam(':user_username', $_POST['emailOrUsername']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && $_POST['password'] == $results['user_password']) {
    $_SESSION['user_id'] = $results['user_id'];
    $_SESSION['username'] = $results['user_username'];

    $employer = $conn->prepare('SELECT COUNT(*) FROM gxc55311.z_employers WHERE employer_id = :employer_id');
    $employer->bindParam(':employer_id', $_SESSION['user_id']);
    if ($employer->execute() && $employer->fetchColumn() > 0) {
      $_SESSION['is_employer'] = true;
    }

    $candidate = $conn->prepare('SELECT COUNT(*) FROM gxc55311.z_candidates WHERE candidate_id = :candidate_id');
    $candidate->bindParam(':candidate_id', $_SESSION['user_id']);
    if ($candidate->execute() && $candidate->fetchColumn() > 0) {
      $_SESSION['is_candidate'] = true;
    }


    $admin = $conn->prepare('SELECT COUNT(*) FROM gxc55311.z_admins WHERE admin_id = :admin_id');
    $admin->bindParam(':admin_id', $_SESSION['user_id']);
    if ($admin->execute() && $admin->fetchColumn() > 0) {
      $_SESSION['is_admin'] = true;
    }

    header("Location: candidate/jobs");
  } else {
    $message = 'Sorry, those credentials do not match';
  }
}

?>

<?php
require './partials/head.php';
?>

<div class="container">
  <h1>
    Login
  </h1>
  <div class="alert alert-danger" role="alert">
    <?php echo $message ?>
  </div>
  <form action="login.php" method="POST">
    <div class="form-group">
      <label for="emailOrUsername">Email address / Username</label>
      <input type="text" class="form-control" name="emailOrUsername" id="emailOrUsername" aria-describedby="emailOrUsernameHelp">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


<?php require 'candidate/partials/foot.php' ?>