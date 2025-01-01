<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_status'])) {
    $user_id = $_POST['user_id'];
    $is_active = $_POST['is_active'] ? 0 : 1;

    $stmt = $pdo->prepare("UPDATE users SET is_active = ? WHERE id = ?");
    $stmt->execute([$is_active, $user_id]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign_role'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->execute([$role, $user_id]);
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>

    <a href="dashboard.html" style="display:inline-block; margin-bottom:20px; padding:10px 20px; background-color:#007bff; color:white; text-decoration:none; border-radius:5px;">Go Back</a>

    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['username'] ?></td>
                    <td><?= ucfirst($user['role']) ?></td>
                    <td><?= $user['is_active'] ? 'Active' : 'Blocked' ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="is_active" value="<?= $user['is_active'] ?>">
                            <button type="submit" name="toggle_status">
                                <?= $user['is_active'] ? 'Block' : 'Unblock' ?>
                            </button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="role">
                                <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
                                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <button type="submit" name="assign_role">Assign Role</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
