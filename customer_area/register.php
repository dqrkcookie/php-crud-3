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
        window.location.href = './login.php';
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
        <a href="./login.php">Return</a>
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>

