<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['admin_email'])){
  header("Location: ./login.php");
}

$queryRevenue = $pdo->query("SELECT SUM(total) AS total_revenue FROM history WHERE transaction = 'Success'");
$revenueData = $queryRevenue->fetch();
$totalRevenue = $revenueData->total_revenue;

$queryProducts = $pdo->query("SELECT COUNT(*) AS total_products FROM products");
$productsData = $queryProducts->fetch();
$totalProducts = $productsData->total_products;

$queryUsers = $pdo->query("SELECT COUNT(*) AS total_users FROM customers");
$usersData = $queryUsers->fetch();
$totalUsers = $usersData->total_users;

$queryTransactions = $pdo->query("SELECT COUNT(*) AS total_transactions FROM history");
$transactionsData = $queryTransactions->fetch();
$totalTransactions = $transactionsData->total_transactions;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <header>
      <h1>Admin Dashboard</h1>
    </header>
    <nav>
      <ul>
        <li><a href="dashboard.php">Overview</a></li>
        <li><a href="product_management.php">Product Management</a></li>
        <li><a href="order_management.php">Order Management</a></li>
        <li><a href="history.php">Transaction History</a></li>
        <li><a href="user_management.php">User Management</a></li>
        <li>
          <a href="logout.php">Logout</a>
        </li>
      </ul>
    </nav>

    <section>
      <div class="overview">
        <div class="card">
          <h3>Total Revenue</h3>
          <p><?php echo $totalRevenue ?></p>
        </div>
        <div class="card">
          <h3>Total Products</h3>
          <p><?php echo $totalProducts ?></p>
        </div>
        <div class="card">
          <h3>Total Users</h3>
          <p><?php echo $totalUsers ?></p>
        </div>
        <div class="card">
          <h3>Total Transactions</h3>
          <p><?php echo $totalTransactions ?></p>
        </div>
      </div>
    </section>
    <img src="../photos/icon/rb_3051.png" alt="Coffee Photo">
  </body>
</html>
