<?php
session_start();
include 'db_connect.php';

if(empty($_SESSION['email'])){
    header("Location: ./login.php");
  }

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['status'] ?></td>
                <td><?= $order['total_price'] ?></td>
                <td><a href="order_details.php?id=<?= $order['id'] ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
