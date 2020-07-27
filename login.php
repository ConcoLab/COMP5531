<?php
require_once './partials/database.php';

if (isset($_COOKIE['user_id'])) {
  header("Location: .");
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
    // $_COOKIE['user_id'] = $results['user_id'];
    // $_COOKIE['username'] = $results['user_username'];
    setcookie("user_id", $results['user_id'], time() + (900), "/");
    setcookie("username", $results['user_username'], time() + (900), "/");

    $employer = $conn->prepare('SELECT COUNT(*) FROM gxc55311.z_employers WHERE employer_id = :employer_id');
    $employer->bindParam(':employer_id', $_COOKIE['user_id']);
    if ($employer->execute() && $employer->fetchColumn() > 0) {
      // $_COOKIE['is_employer'] = true;
      setcookie("is_employer", $results['is_employer'], time() + (900), "/");
    }

    $candidate = $conn->prepare('SELECT COUNT(*) FROM gxc55311.z_candidates WHERE candidate_id = :candidate_id');
    $candidate->bindParam(':candidate_id', $_COOKIE['user_id']);
    if ($candidate->execute() && $candidate->fetchColumn() > 0) {
      // $_COOKIE['is_candidate'] = true;
      setcookie("is_candidate", $results['is_candidate'], time() + (900), "/");
    }


    $admin = $conn->prepare('SELECT COUNT(*) FROM gxc55311.z_admins WHERE admin_id = :admin_id');
    $admin->bindParam(':admin_id', $_COOKIE['user_id']);
    if ($admin->execute() && $admin->fetchColumn() > 0) {
      // $_COOKIE['is_admin'] = true;
      setcookie("is_admin", $results['is_admin'], time() + (900), "/");

    }
    header("Location: .");
  } else {
    $message = 'Sorry, those credentials do not match';
  }

}

?>

<?php
require_once './partials/head-public.php';
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


<?php require_once './partials/foot.php' ?>