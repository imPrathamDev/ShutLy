<?php
//connecting database
$hostname = 'YOUR_HOSTNAME';
$username = 'YOUR_USERNAME';
$password = 'YOUR_PASSWORD';
$database = 'YOUR_DATABASE_NAME';
/*
Use below code if you are using live server but in this tutorial I use localhost

''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
*Another important thing we use .htassecc file for creating our link too short if we didn't used .htassecc file code our link will be ShutLy.cf?l=SHORT-LINK-NAME
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
$con=mysqli_connect('$hostname','$username','$password','$database');
*/
$con=mysqli_connect('localhost','root','','crud');
?>