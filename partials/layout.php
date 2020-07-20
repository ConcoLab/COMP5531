<?php
session_start();

?>
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
            <a class="nav-link" href="./candidate/login.php">Admin</a>
          </li>
        <?php } ?>

      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./regsiter.php">Register</a>
        </li>
      <?php } ?>
    </ul>

    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <ul class="navbar-nav ml-auto">

      </ul>
      <form class="form-inline my-2 my-lg-0">

        <a class="btn btn-outline-light my-2 my-sm-0" type="submit" href="./logout.php">Logout</a>
      </form>
    </div>


  </div>
</nav>