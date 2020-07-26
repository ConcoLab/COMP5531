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

<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
  <a class="navbar-brand" href="#">Candidates Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../jobs">Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../jobs/applied.php">Applied</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../membership">Membership</a>
      </li>
    </ul>

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../profile">Profile</a>
        </li>
        <li class="nav-item">
        <a class="nav-link disabled text-warning" href="#" tabindex="-1" aria-disabled="true">Gold Member</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">

        <a class="btn btn-outline-light my-2 my-sm-0" type="submit" href="../../logout.php">Logout</a>
      </form>
    </div>


  </div>
</nav>
