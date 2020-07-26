<?php

require './partials/database.php';

if (isset($_SESSION['user_id'])) {
  header('Location: ./index.php');
}


$message = '';

if (empty($_POST['password']) != empty($_POST['confirmPassword'])) {
  $message = 'The entered passwords are not identical';
}

if (
  !empty($_POST['email']) &&
  !empty($_POST['username']) &&
  !empty($_POST['password']) &&
  !empty($_POST['confirmPassword']) &&
  !empty($_POST['phone']) &&
  !empty($_POST['address'])
) {
  $sql = "INSERT INTO z_users (user_username, user_email, user_password, user_phone, user_address) VALUES (:user_username, :user_email, :user_password, :user_phone, :user_address)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_username', $_POST['username']);
  $stmt->bindParam(':user_email', $_POST['email']);
  $stmt->bindParam(':user_phone', $_POST['phone']);
  $stmt->bindParam(':user_address', $_POST['address']);
  // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $password = $_POST['password'];
  $stmt->bindParam(':user_password', $password);

  if ($stmt->execute()) {
    $message = 'Successfully created new user';
    header('Location: /login.php');
  } else {
    $message = 'Sorry there must have been an issue creating your account';
  }
  echo  $_POST['username'];
  echo  $_POST['email'];
  echo  $_POST['phone'];
  echo  $_POST['address'];
  echo  $_POST['password'];
}
?>


<?php require 'partials/head.php' ?>

<div class="container">
  <h1>
    Register
  </h1>
  <div class="alert alert-danger" role="alert">
    <?php echo $message ?>
  </div>
  <form action="register.php" method="post">
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="form-group">
      <label for="passwordConfirm">Confirm Password</label>
      <input type="password" name="confirmPassword" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" class="form-control" id="phone" aria-describedby="phoneHelp">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" name="address" class="form-control" id="address" aria-describedby="addressHelp">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<?php require 'candidate/partials/foot.php' ?>