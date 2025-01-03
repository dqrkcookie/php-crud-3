<?php

session_start();
include("./db_connect.php");

if(isset($_GET['delete'])){
  $user = $_SESSION['email'];
  $name = $_GET['name'];

  $query = $pdo->query("DELETE FROM cart WHERE product_name = '$name' AND user = '$user'");

}

header("Location: ./cart.php?deleted=yes");

?>