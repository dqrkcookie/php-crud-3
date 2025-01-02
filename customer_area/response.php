<?php

session_start();
include("./db_connect.php");

$response = $_GET['res'];
$user = $_GET['user'];
$price = $_GET['price'];
$products = $_GET['products'];

if($response == 'yes'){
  $query = $pdo->query("UPDATE placed_orders SET status = 'Received' WHERE product_name = '$products'");
  $query2 = $pdo->query("UPDATE order_management SET status = 'Delivery Success' WHERE product_name = '$products'");
  $query3 = $pdo->query("INSERT INTO history(name,products,total,transaction)VALUES('$user', '$products', '$price', 'Success')");
} else {
  $query = $pdo->query("UPDATE placed_orders SET status = 'Returned' WHERE product_name = '$products'");
  $query2 = $pdo->query("UPDATE order_management SET status = 'Delivery Failed' WHERE product_name = '$products'");
  $query3 = $pdo->query("INSERT INTO history(name,products,total,transaction)VALUES('$user', '$products', '$price', 'Failed')");
}

header("Location: ./placed_orders.php?responded=yes");

?>