<?php require_once '../../partials/database.php' ?>

<?php
$category = "";
$stmt_category = $conn->prepare('SELECT employer_category
                                FROM gxc55311.z_employers
                                WHERE employer_id = :employer_id');
    $stmt_category->bindParam(':employer_id', $_SESSION['user_id']);

    $stmt_category->execute();
    $category = $stmt_category->fetchColumn();
?>


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
<nav class="navbar navbar-expand-lg navbar-dark bg-info mb-4">
  <a class="navbar-brand" href="#">Employer Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item">
        <a class="nav-link" href="../jobs/new.php">New</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="../jobs">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../categories">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../membership">Membership</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../payment">Payment</a>
      </li>
    </ul>

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../profile">Profile</a>
        </li>
        <?php
          if($category == "Gold"){
        ?>
          <li class="nav-item">
            <a class="nav-link disabled text-warning" href="#" tabindex="-1" aria-disabled="true"><?= $category ?> Member</a>
          </li>
        <?php
          }else if($category == "Prime"){
        ?>
          <li class="nav-item">
            <a class="nav-link disabled text-white" href="#" tabindex="-1" aria-disabled="true"><?= $category ?> Member</a>
          </li>
        <?php
          }
        ?>
      </ul>
      <form method="POST" class="form-inline my-2 my-lg-0">

        <a class="btn btn-outline-light my-2 my-sm-0" type="submit" href="../../logout.php">Logout</a>
      </form>
    </div>


  </div>
</nav>
