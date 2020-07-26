<?php

$server = 'gxc5531.encs.concordia.ca';
$username = 'gxc55311';
$password = '';
$database = 'gxc55311';

try {
  $conn = new PDO("mysql:host=$server;port=3306;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}



?>