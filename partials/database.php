<?php
session_start();
$server = 'localhost:3306';
$username = 'root';
$password = 'root';
$database = 'gxc55311';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}



?>
