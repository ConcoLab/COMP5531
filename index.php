<?php
require_once './partials/database.php';
require_once './partials/head-public.php';
echo $_SESSION['user_id'];
echo isset($_SESSION['user_id']);
echo (!isset($_SESSION['is_admin']) && !$_SESSION['is_admin']);
?>

<div class="container">
  <div class="row">
    <?php if (isset($_SESSION['user_id'])) { ?>
      <?php if (isset($_SESSION['is_candidate']) && $_SESSION['is_candidate']) { ?>
        <div class="col-12 alert alert-success">
          <h2>
            Candidate
          </h2>
          <p>
            Click more to search for the jobs in our job bank:
          </p>
          <a class="btn btn-success" href="./candidate/jobs">Candidate Panel</a>
        </div>
      <?php } else { ?>
        <div class="col-12 alert alert-success">
          <h2>
            Candidate
          </h2>
          <p>
            Click register to to be able to see the listed jobs.
          </p>
          <a class="btn btn-success" href="./candidate/jobs">Register as Job Candidate</a>
        </div>
      <?php } ?>

      <?php if (isset($_SESSION['is_employer']) && $_SESSION['is_employer']) { ?>
        <div class="col-12 alert alert-info">
          <h2>
            Employer
          </h2>
          <p>
            Click more to go to the employer panel and post new jobs.
          </p>
          <a class="btn btn-info" href="./employer/jobs">Employer Panel</a>
        </div>
      <?php } else { ?>
        <div class="col-12 alert alert-info">
          <h2>
            Employer
          </h2>
          <p>
            Click register to to be able to see the listed jobs.
          </p>
          <a class="btn btn-info" href="./candidate/jobs">Register as Employer</a>
        </div>
      <?php } ?>

      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) { ?>

        <div class="col-12 alert alert-dark">
          <h2>
            Admin
          </h2>
          <p>
            If you are an admin then you would be able to see the admin panel.
          </p>
          <a class="btn btn-dark" href="./admin/">Admin Panel</a>
        </div>
      <?php } ?>

    <?php } else { ?>
      <div class="col-12 alert alert-dark">
        <h2>
          Welcome
        </h2>
        <p>
          If you want to use our services, firstly, you have to register or login to our website.
        </p>
        <div class="row">
          <div class="col-6">
            <a class="btn btn-success btn-block" href="./login.php">Login</a>
          </div>
          <div class="col-6">
            <a class="btn btn-info btn-block" href="./register.php">Register</a>
          </div>

        </div>

      </div>
    <?php } ?>

  </div>
</div>


<?php require_once './partials/foot.php' ?>