<?php
session_start();
include("./db_connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: ./login.php");
    exit();
}

$user = $_SESSION['email'];

$stmt = $pdo->prepare("SELECT * FROM history WHERE name = :name");
$stmt->execute(['name' => $user]);
$query = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cofi - Order History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: oldlace;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    table {
      width: 100%;
      max-width: 800px;
      margin: auto;
      border-collapse: collapse;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      margin-top: 4rem;
    }
    thead {
      background-color: #98fb98;
      color: #333;
      text-transform: uppercase;
    }
    th, td {
      padding: 16px;
      text-align: left;
    }
    tbody tr {
      border-bottom: 1px solid #ddd;
      transition: background-color 0.3s;
    }
    tbody tr:hover {
      background-color: #f1f1f1;
    }
    .back a {
      text-decoration: none;
      color: #444;
      font-size: 0.9rem;
    }
    .back a:hover {
      text-decoration: underline;
    }
    h1 {
      text-align: center;
      margin: 2rem 0;
      font-size: 2.5rem;
      font-weight: 700;
      color: #2c3e50;
      position: relative;
      display: inline-block;
      left: 50%;
      transform: translateX(-50%);
    }

    h1::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 100%;
      height: 3px;
      background: linear-gradient(to right, palegreen, #90ee90);
      border-radius: 2px;
    }
  </style>
</head>
<body>
  <div class="back"><a href="./product_browsing.php">⬅ Browse Products</a></div>
  <div><h1>Order History</h1></div>
  <div class="history">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Products</th>
          <th>Payment</th>
          <th>Date</th>
          <th>Transaction</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($query): ?>
          <?php foreach ($query as $q): ?>
            <tr>
              <td><?php echo $q->name ?></td>
              <td>
                <?php 
                $products = json_decode($q->products, true);
                echo $products ? implode(', ', $products) : "Invalid data"; 
                ?>
              </td>
              <td><?php echo $q->total ?></td>
              <td><?php echo $q->date ?></td>
              <td><?php echo $q->transaction ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No order history found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
