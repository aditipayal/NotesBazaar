<?php 
require('connection.inc.php');
require('function.inc.php');
$username = get_safe_value($con,$_POST['name']);
$password = get_safe_value($con,$_POST['password']);
$email = get_safe_value($con,$_POST['email']);
$mobile = get_safe_value($con,$_POST['mobile']);
$check_user = mysqli_num_rows(mysqli_query($con,"select * from user where email = '$email'"));
if($check_user>0){
         echo 'Email_present';
}else{
    $added_on = date('Y-m-d h:i:s');
    mysqli_query($con,"insert into user(username,password,email,mobile,added_on) values('$username','$password','$email','$mobile','$added_on')");
    echo 'Insert';
}
 ?>


