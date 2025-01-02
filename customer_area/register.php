<?php

include("./db_connect.php");

if(isset($_POST['register'])){
    $user = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO customers(username, email, password)VALUES(?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $params = [$user, $email, $password];
    $stmt->execute($params);
    
    echo "<script> 
        alert('Registration success!');
        window.location.href = '../index.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cofi</title>
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>
    <form method="post">
        <a href="../index.php">Return</a>
        <h2>Register</h2>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>

