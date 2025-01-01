<?php
include 'db_connect.php';

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$sort = $_GET['sort'] ?? 'name ASC';

$query = "SELECT * FROM products WHERE name LIKE ? ";
$params = ["%$search%"];

if ($category) {
    $query .= "AND category_id = ? ";
    $params[] = $category;
}

$query .= "ORDER BY $sort";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<form method="get">
    <input type="text" name="search" placeholder="Search products..." value="<?= $search ?>">
    <select name="category">
        <option value="">All Categories</option>
        
        <?php
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
        foreach ($categories as $cat) {
            echo "<option value='{$cat['id']}'" . ($cat['id'] == $category ? 'selected' : '') . ">{$cat['name']}</option>";
        }
        ?>
    </select>
    <select name="sort">
        <option value="name ASC" <?= $sort == 'name ASC' ? 'selected' : '' ?>>Name (A-Z)</option>
        <option value="price ASC" <?= $sort == 'price ASC' ? 'selected' : '' ?>>Price (Low-High)</option>
        <option value="price DESC" <?= $sort == 'price DESC' ? 'selected' : '' ?>>Price (High-Low)</option>
    </select>
    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><a href="product_details.php?id=<?= $product['id'] ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
