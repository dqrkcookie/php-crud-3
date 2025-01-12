<?php

session_start();

unset($_SESSION['email']);

echo "<script>window.open('./login.php','_self')</script>";

?>