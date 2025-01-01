<?php
session_start();
include 'db_connect.php';

$user_id = $_SESSION['user_id'];

if ($_POST['action'] == 'add') {
    $product_id = $_POST['product_id'];
    $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $product_id]);
}

$stmt = $pdo->prepare("SELECT cart.*, products.name, products.price FROM cart JOIN products ON cart.product_id = products.id WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart_items as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['quantity'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
