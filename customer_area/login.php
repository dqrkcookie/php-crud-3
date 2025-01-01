<?php

session_start();

include("db_connect.php");

?>
<!DOCTYPE HTML>
<html>

<head>

<title>Customer Login</title>

<link rel="stylesheet" href="css/login.css" >

</head>

<body>

<div class="container" >

<form class="form-login" action="" method="post" ><!-- form-login Starts -->

<h2 class="form-login-heading" >Customer Login</h2>

<input type="text" class="form-control" name="email" placeholder="Email Address" required >

<input type="password" class="form-control" name="password" placeholder="Password" required >

<button class="btn btn-lg btn-primary btn-block" type="submit" name="login" >

Log In

</button>


</form>

</div>



</body>

</html>

<?php

if(isset($_POST['customers'])){

$email = mysqli_real_escape_string($con,$_POST['email']);

$pass = mysqli_real_escape_string($con,$_POST['pass']);

$get_customers = "select * from customers where email='$email' AND pass='$pass'";

$run_customers = mysqli_query($con,$get_customers);

$count = mysqli_num_rows($run_customers);

if($count==1){

$_SESSION['email']=$email;

echo "<script>alert('Login Successfully')</script>";

echo "<script>window.open('dashboard.php.php?dashboard','_self')</script>";

}
else {

echo "<script>alert('Email or Password is Wrong')</script>";

}

}

?>