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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Users
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../users">All Users</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../users/admins.php">Admins</a>
            <a class="dropdown-item" href="../users/candidates.php">Candidates</a>
            <a class="dropdown-item" href="../users/employers.php">Employers</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../users/debtor-candidates.php">Debtor Candidates</a>
            <a class="dropdown-item" href="../users/debtor-employers.php">Debtor Employers</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Jobs
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../jobs">All</a>
            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="../jobs/active-jobs.php">Active</a>
            <a class="dropdown-item" href="../jobs/deactive-jobs.php">Deactive</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Memberships
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../membership/gold-employers.php">Gold Employers</a>
            <a class="dropdown-item" href="../membership/prime-employers.php">Prime Employers</a>
            <a class="dropdown-item" href="../membership/basic-employers.php">Basic Employers</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../membership/gold-candidates.php">Gold Candidates</a>
            <a class="dropdown-item" href="../membership/prime-candidates.php">Prime Candidates</a>
            <a class="dropdown-item" href="../membership/basic-candidates.php">Basic Candidates</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./payments.php">Payments</a>
        </li>
      </ul>

      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
        </ul>
        <form class="form-inline my-2 my-lg-0">

          <a class="btn btn-outline-light my-2 my-sm-0" type="submit" href="../../logout.php">Logout</a>
        </form>
      </div>


    </div>
  </nav>