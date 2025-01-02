<?php

session_start();
include("./db_connect.php");

$user = $_GET['user'];
$products = $_GET['products'];

$query = $pdo->query("UPDATE order_management SET status = 'Out for delivery' WHERE product_name = '$products'");

$query = $pdo->query("UPDATE placed_orders SET status = 'Out for delivery' WHERE product_name = '$products'");

header("Location: ./order_management.php?accepted=yes");

?>