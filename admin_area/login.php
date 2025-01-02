<?php
session_start();
include("db_connect.php");

if (isset($_POST['admin_login'])) {
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE admin_email = :email AND admin_pass = :password");
    $stmt->execute(['email' => $admin_email, 'password' => $admin_pass]);

    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['admin_email'] = $admin_email;
        echo "<script>alert('Admin Log in Success!')</script>";
        echo "<script>window.open('dashboard.php?dashboard', '_self')</script>";
    } else {
        echo "<script>alert('Invalid Credentials!')</script>";
    }
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <form class="form-login" action="" method="post">
            <h2 class="form-login-heading">Admin Login</h2>
            <input type="text" class="form-control" name="admin_email" placeholder="Email Address" required>
            <input type="password" class="form-control" name="admin_pass" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login">
                Log in
            </button>
        </form>
    </div>
</body>
</html>
