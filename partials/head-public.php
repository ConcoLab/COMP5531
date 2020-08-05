<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Welcome to you WebApp</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
    <a class="navbar-brand" href=".">Employer Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

        <?php if (isset($_SESSION['user_id'])) { ?>
          <?php if (isset($_SESSION['is_candidate']) && $_SESSION['is_candidate']) { ?>
            <li class="nav-item">
              <a class="nav-link" href="./candidate/login.php">Candidate</a>
            </li>
          <?php } ?>

          <?php if (isset($_SESSION['is_employer']) && $_SESSION['is_employer']) { ?>

            <li class="nav-item">
              <a class="nav-link" href="./candidate/login.php">Employer</a>
            </li>
          <?php } ?>

          <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) { ?>

            <li class="nav-item">
              <a class="nav-link" href="../../candidate/login.php">Admin</a>
            </li>
          <?php } ?>

        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="./login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./register.php">Register</a>
          </li>
        <?php } ?>
      </ul>

      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">

        </ul>
        <?php if (isset($_SESSION["user_id"])) { ?>
          <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-outline-light my-2 my-sm-0" type="submit" href="./logout.php">Logout</a>
          </form>
        <?php } ?>
      </div>
    </div>
  </nav>
