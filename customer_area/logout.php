<?php

session_start();

unset($_SESSION['email']);

echo "<script>window.open('../index.php','_self')</script>";

?>