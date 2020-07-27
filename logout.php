
<?php
require_once './partials/database.php';

if (isset($_COOKIE['user_id'])) {
    session_destroy();
}
header("Location: ./login.php");

?>
