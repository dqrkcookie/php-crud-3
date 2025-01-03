<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['email'])){
  header("Location: ../index.php");
}

if(isset($_POST['add'])){
  $name = $_POST['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];
  $user = $_POST['user'];

  $query = "INSERT INTO cart(user,product_name,price,qty)VALUES(?,?,?,?)";
  $stmt = $pdo->prepare($query);
  $params = [$user, $name, $price, $qty];
  $stmt->execute($params);
}

header("Location: ./product_browsing.php?added=yes");

?>