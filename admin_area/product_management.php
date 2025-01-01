<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add product
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category_id = $_POST['category_id'];

        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $stock, $category_id]);
    }
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
</head>
<body>
    <h1>Product Management</h1>

    <a href="dashboard.html" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#007bff; color:white; text-decoration:none; border-radius:5px;">Go Back</a>

    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>
        <label>Stock:</label>
        <input type="number" name="stock" required>
        <label>Category:</label>
        <select name="category_id">
            <!-- Populate dynamically -->
            <?php
            $categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $category) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>Products</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $product['id'] ?>">Edit</a>
                        <a href="delete_product.php?id=<?= $product['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
