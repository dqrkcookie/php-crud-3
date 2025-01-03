<?php

session_start();
include("./db_connect.php");

if(empty($_SESSION['email'])){
  header("Location: ../index.php");
}

$user = $_SESSION['email'];

$query = $pdo->query("SELECT * FROM placed_orders WHERE user = '$user'")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cofi</title>
  <link rel="stylesheet" href="./css/placed.css">
</head>
<body>
  <div class="back"><a href="./product_browsing.php">⬅ Browse Products</a></div>
  <div><h1>Placed Orders</h1></div>
  <table>
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Address</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($query as $placed) { ?>
      <tr>
        <td><?php $arr = json_decode($placed->product_name); echo implode(', ', $arr); ?></td>
        <td><?php echo $placed->price ?></td>
        <td><?php echo $placed->address ?></td>
        <td>
          <?php echo $placed->status ?>
          <?php if($placed->status == 'Out for delivery') { ?>
            <div class="status-container">
              <a href="./response.php?res=yes&user=<?php echo $user ?>&price=<?php echo $placed->price ?>&products=<?php echo urlencode($placed->product_name) ?>">Received</a>
              <a href="./response.php?res=no&user=<?php echo $user ?>&price=<?php echo $placed->price ?>&products=<?php echo urlencode($placed->product_name) ?>">Return</a>
            </div>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>