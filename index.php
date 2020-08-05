<?php
require_once './partials/database.php';
// require_once './partials/head-public.php';
if (isset($_SESSION["is_candidate"]) && $_SESSION["is_candidate"]) {
  header("Location: ./candidate/jobs");
} else if (isset($_SESSION["is_employer"]) && $_SESSION["is_employer"]) {
  header("Location: ./employer/jobs");
} else if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]) {
  header("Location: ./admin");
}
?>

<?php if (!isset($_SESSION['user_id'])) { ?>
  <?php require_once './partials/head-public.php' ?>
  <div class="container">
    <div class="row">
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
    </div>



  </div>
  <?php require_once './partials/foot.php' ?>
<?php } ?>
