<?php
require('connection.inc.php');
require('function.inc.php');
echo '<b>Transaction In Process, Please do not reload</b>';
$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
mysqli_query($con,"update user_ order set payment_status='$status', mihpayid='$pay_id' where txnid='$txnid'");
?>
<script>
window.location.href = "payment_fail.php";
</script>
   