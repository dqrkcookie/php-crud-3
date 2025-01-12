<?php

session_start();

include("./db_connect.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];  

    $get_customers = "SELECT * FROM customers WHERE email = ?";
    $stmt = $pdo->prepare($get_customers);
    $params = [$email];
    $stmt->execute($params);

    if($data = $stmt->fetch()){
      if(password_verify($pass, $data->password) && $data->status == 'Active'){
        $_SESSION['email'] = $email;
        echo "<script>alert('Login Success!');
          window.location.href = './product_browsing.php';
        </script>";
      }else if(password_verify($pass, $data->password) &&$data->status == 'Blocked'){
        echo "<script>window.location.href='./blocked.php';</script>";
      }else{
        echo "<script>alert('Invalid Credentials!')</script>";
      }
    }
  }
  
  

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Customer Login</title>

    <link rel="stylesheet" href="./css/login.css" />
  </head>

  <body>
    <div class="admin"><a href="../admin_area/login.php">Continue as Admin</a></div>
    <div class="container">
      <form class="form-login" action="./login.php" method="POST">

        <h2 class="form-login-heading">Customer Login</h2>

        <input
          type="text"
          class="form-control"
          name="email"
          placeholder="Email Address"
          required
        />

        <input
          type="password"
          class="form-control"
          name="password"
          placeholder="Password"
          required
        />

        <button
          class="btn btn-lg btn-primary btn-block"
          type="submit"
          name="login"
        >
          Log In
        </button>
        <br> <br>
        <a href="./register.php">Register here..</a>
      </form>
    </div>
  </body>
</html>
