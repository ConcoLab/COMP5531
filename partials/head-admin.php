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
  <a class="navbar-brand" href="/admin/.">Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./candidates.php">Candidates</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./employers.php">Employers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./jobs.php">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./payments.php">Payments</a>
      </li>
    </ul>

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0">

        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Logout</button>
      </form>
    </div>


  </div>
</nav>