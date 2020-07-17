<?php

session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: candidate/jobs');
}
$message = '';

require 'database.php';

if (!empty($_POST['emailOrUsername']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT user_id, user_email, user_password, user_username FROM users WHERE user_email = :user_email OR user_username = :user_username');
  $records->bindParam(':user_email', $_POST['emailOrUsername']);
  $records->bindParam(':user_username', $_POST['emailOrUsername']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (count($results) > 0 && $_POST['password'] == $results['user_password']) {
    $_SESSION['user_id'] = $results['user_id'];
    $_SESSION['username'] = $results['user_username'];
    header("Location: candidate/jobs");
  } else {
    $message = 'Sorry, those credentials do not match';
  }
}

?>


<?php require 'candidate/partials/head.php' ?>
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