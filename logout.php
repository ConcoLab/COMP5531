<?php
require_once './partials/database.php';

if (isset($_SESSION['user_id'])) {
    session_destroy();
}
header("Location: ./login.php");

?>
