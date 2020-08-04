<?php
require_once './partials/database.php';

if (!empty($_POST['email'])) {
  $records = $conn->prepare('SELECT user_id, user_email, user_password FROM gxc55311.z_users WHERE user_email = :user_email');
  $records->bindParam(':user_email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = '';

  if (is_array($results) && count($results) > 0) {
    $email = $conn->prepare('INSERT INTO gxc55311.z_emails
                              (email_user_id, email_subject, email_body)
                              VALUES (:email_user_id, "Forget Password Email", :email_body)');
    $email_body = "Your password is: ".$results['user_password'];
    $email->bindParam(':email_user_id', $results['user_id']);
    $email->bindParam(':email_body', $email_body);
    $email->execute();

  }
  header("Location: ./login.php");
}

?>

<?php require_once './partials/head-public.php'; ?>

<div class="container">
  <h1>
    Forget Password
  </h1>
  <div class="alert alert-warning">
  <p>
    Enter your email which you registered with and we will send you the credentials directly to
    get access to your panel.
    <br>
    Please do not forget to change your password after you log in.
  </p>
  </div>

  <form action="forget-password.php" method="POST">
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


<?php require_once './partials/foot.php' ?>