<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['admin_email'])){
  header("Location: ./login.php");
}

$block = $_GET['block'];
$email = $_GET['email'];

if($block == 'yes'){
  $query = $pdo->query("UPDATE customers SET status = 'Blocked' WHERE email = '$email'");
} else {
  $query = $pdo->query("UPDATE customers SET status = 'Active' WHERE email = '$email'");
}

header("Location: ./user_management.php");

?>