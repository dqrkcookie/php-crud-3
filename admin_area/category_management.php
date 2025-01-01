<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_category'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
        $stmt->execute([$name, $description]);
    }

    if (isset($_POST['edit_category'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $description, $id]);
    }
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
    $stmt->execute([$id]);
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
</head>
<body>
    <h1>Category Management</h1>

    <a href="dashboard.html" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#007bff; color:white; border-radius:5px;">Go Back</a>

    <form method="post">
        <h2>Add Category</h2>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <button type="submit" name="add_category">Add Category</button>
    </form>

    <h2>Existing Categories</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['name'] ?></td>
                    <td><?= $category['description'] ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">
                            <input type="text" name="name" value="<?= $category['name'] ?>">
                            <textarea name="description"><?= $category['description'] ?></textarea>
                            <button type="submit" name="edit_category">Update</button>
                        </form>
                        <a href="?delete_id=<?= $category['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
