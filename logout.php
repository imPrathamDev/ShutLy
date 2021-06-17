<?php
//In logout.php we will destroy session i use unset(); but you also use session_destroy(); fuction
session_start();
//session_destroy();
unset($_SESSION['username']);
header('location:home.php');
die();
?>