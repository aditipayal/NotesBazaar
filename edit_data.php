<?php 
require('connection.inc.php');
require('function.inc.php');
$username = get_safe_value($con,$_POST['name']);
$password = get_safe_value($con,$_POST['password']);
$email = get_safe_value($con,$_POST['email']);
$mobile = get_safe_value($con,$_POST['mobile']);
 $added_on = date('Y-m-d h:i:s');
 mysqli_query($con,"update user
 SET username = $username, password = $password, email = $email, mobile = $mobile, added_on = $added_on where id = ;)");
echo "update";

 ?>


