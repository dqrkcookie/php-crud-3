<?php

session_start();
include("./db_connect.php");

$user = $_SESSION['email'];

$query = $pdo->query("SELECT * FROM history WHERE name = '$user'")->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cofi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: oldlace;
      margin: 0;
      padding: 20px;
    }

    table {
      width: 100%;
      max-width: 800px;
      margin: auto;
      border-collapse: collapse;
      background-color: oldlace;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-top: 6rem;
    }

    thead {
      background-color: palegreen;
      color: #333;
      text-transform: uppercase;
    }

    th {
      text-align: left;
      padding: 15px;
      font-size: 16px;
    }

    tr {
      border-bottom: 1px solid #ddd;
    }

    tbody tr {
      background-color: #f0f0f0;
    }

    td {
      padding: 15px;
      font-size: 14px;
      color: #333;
    }

    .back a {
      text-decoration: none;
      color: #333;
      font-size: 0.9rem;
    }

    .back a:hover {
      text-decoration: underline;
    }

    h1{
      text-align: center;
      margin-top: 2rem;
      font-size: 3rem;
      font-weight: 600;
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
        <?php foreach($query as $q) { ?>
          <tr>
            <td><?php echo $q->name ?></td>
            <td><?php echo implode(', ', json_decode($q->products)) ?></td>
            <td><?php echo $q->total ?></td>
            <td><?php echo $q->date ?></td>
            <td><?php echo $q->transaction ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
