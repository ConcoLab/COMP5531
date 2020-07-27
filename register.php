<?php

require_once './partials/database.php';

if (isset($_SESSION['user_id'])) {
  header('Location: .');
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
  !empty($_POST['firstName']) &&
  !empty($_POST['lastName']) &&
  !empty($_POST['address'])
) {
  $sql = "INSERT INTO gxc55311.z_users (user_username, user_email, user_password, user_phone, user_address) VALUES (:user_username, :user_email, :user_password, :user_phone, :user_address)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_username', $_POST['username']);
  $stmt->bindParam(':user_email', $_POST['email']);
  $stmt->bindParam(':user_phone', $_POST['phone']);
  $stmt->bindParam(':user_address', $_POST['address']);
  // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $password = $_POST['password'];
  $stmt->bindParam(':user_password', $password);

  if ($stmt->execute()) {
    $last_id = $conn->lastInsertId();
    $sql = "INSERT INTO gxc55311.z_candidates (candidate_id, candidate_first_name, candidate_last_name) VALUES (:candidate_id, :candidate_first_name, :candidate_last_name)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':candidate_id', $last_id);
    $stmt->bindParam(':candidate_first_name', $_POST['firstName']);
    $stmt->bindParam(':candidate_last_name', $_POST['lastName']);
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
      header('Location: ./login.php');
    }
  } else {
    $message = 'Sorry there must have been an issue creating your account';
  }
}

if (
  !empty($_POST['email']) &&
  !empty($_POST['username']) &&
  !empty($_POST['password']) &&
  !empty($_POST['confirmPassword']) &&
  !empty($_POST['phone']) &&
  !empty($_POST['employerName']) &&
  !empty($_POST['representative']) &&
  !empty($_POST['address'])
) {
  $sql = "INSERT INTO gxc55311.z_users (user_username, user_email, user_password, user_phone, user_address) VALUES (:user_username, :user_email, :user_password, :user_phone, :user_address)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_username', $_POST['username']);
  $stmt->bindParam(':user_email', $_POST['email']);
  $stmt->bindParam(':user_phone', $_POST['phone']);
  $stmt->bindParam(':user_address', $_POST['address']);
  $password = $_POST['password'];
  $stmt->bindParam(':user_password', $password);

  if ($stmt->execute()) {
    $last_id = $conn->lastInsertId();
    $sql = "INSERT INTO gxc55311.z_employers (employer_id, employer_name, employer_representative) VALUES (:employer_id, :employer_name, :employer_representative)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':employer_id', $last_id);
    $stmt->bindParam(':employer_name', $_POST['employerName']);
    $stmt->bindParam(':employer_representative', $_POST['representative']);
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
      header('Location: ./login.php');
    }
  } else {
    $message = 'Sorry there must have been an issue creating your account';
  }
}
?>


<?php require_once './partials/head-public.php' ?>



<div class="container">
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active mr-3 p-4 bg-success text-light" id="pills-candidate-tab" data-toggle="pill" href="#pills-candidate" role="tab" aria-controls="pills-candidate" aria-selected="true">Register as Candidate</a>
        </li>
        <li class="nav-item">
          <a class="nav-link bg-info ml-3 p-4 text-light" id="pills-employer-tab" data-toggle="pill" href="#pills-employer" role="tab" aria-controls="pills-employer" aria-selected="false">Register as Employer</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane bg-success text-light p-5 fade show active" style="border-radius:10px;" id="pills-candidate" role="tabpanel" aria-labelledby="pills-candidate-tab">
          <div class="container">
            <h1>
              Register as a Candidate
            </h1>
            <div class="alert alert-danger" role="alert">
              <?php echo $message ?>
            </div>
            <form action="register.php" method="post">
              <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="firstName" name="firstName" class="form-control" id="firstName" aria-describedby="firstNameHelp">
              </div>
              <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="lastName" name="lastName" class="form-control" id="lastName" aria-describedby="lastNameHelp">
              </div>
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
              <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
            </form>
          </div>
        </div>
        <div class="tab-pane p-5 bg-info text-light fade" style="border-radius:10px;" id="pills-employer" role="tabpanel" aria-labelledby="pills-employer-tab">
          <div class="container">
            <h1>
              Register as an Employer
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
              <div class="form-group">
                <label for="employerName">Employer Name (<small>Company name i.e.</small>)</label>
                <input type="employerName" name="employerName" class="form-control" id="employerName" aria-describedby="employerNameHelp">
              </div>
              <div class="form-group">
                <label for="representative">Representative Name</label>
                <input type="representative" name="representative" class="form-control" id="representative" aria-describedby="representativeHelp">
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- <div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card text-white bg-success mb-3">
        <div class="card-body">
          <h5 class="card-title">Register as Candidate</h5>
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
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card text-white bg-info mb-3">
        <div class="card-body">
          <h5 class="card-title">Register as Employer</h5>
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
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
        </div>
      </div>
    </div>

    </div>
  </div>
</div> -->


<?php require_once './partials/foot.php' ?>