<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);
}

$stmt = $pdo->query("SELECT orders.*, users.username FROM orders JOIN users ON orders.user_id = users.id");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
</head>
<body>
    <h1>Order Management</h1>

    <a href="dashboard.html" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#007bff; color:white; text-decoration:none; border-radius:5px;">Go Back</a>

    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['username'] ?></td>
                    <td>$<?= $order['total_amount'] ?></td>
                    <td><?= ucfirst($order['status']) ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                            <select name="status">
                                <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="shipped" <?= $order['status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="delivered" <?= $order['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Canceled</option>
                            </select>
                            <button type="submit" name="update_status">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
