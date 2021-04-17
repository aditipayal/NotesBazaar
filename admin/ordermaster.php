<?php
require('top.inc.php');

?>
<div class="content pb-0">
<div class="orders">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<h4 class="box-title">Users</h4>
</div>
<div class="card-body--">
<div class="table-stats order-table ov-h">
<table class="table">
<thead>
<th class="product-name"><span class="nobr">Order ID</span></th>
<th class="product-name"><span class="nobr">Order Date</span></th>
<th class="product-price"><span class="nobr"> Address </span></th>
<th class="product-stock-stauts"><span class="nobr"> Payment type</span></th>
<th class="product-add-to-cart"><span class="nobr">Payment Status</span></th>
<th class="product-name"><span class="nobr">Order Status</span></th>
</tr>
</thead>
<tbody>
<?php
$res = mysqli_query($con,"select user_order.*,user_order_status.name as order_status_str from user_order,user_order_status where user_order_status.id = user_order.order_status");
while($row = mysqli_fetch_assoc($res)){
?>
<tr>
<td class="product-add-to-cart"><a href="ordermasterdetails.php?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
<td class="product-name"><a href="#"><?php echo $row['added_on'];?></a></td>
<td class="product-name">
<a href="#"><?php echo $row['address'];?></a><br>
<a href="#"><?php echo $row['city'];?></a><br>
<a href="#"><?php echo $row['pincode'];?></a><br>
</td>
<td class="product-name"><a href="#"><?php echo $row['payment_type'];?></a></td>
<td class="product-name"><a href="#"><?php echo $row['payment_status'];?></a></td>
<td class="product-name"><a href="#"><?php echo $row['order_status_str'];?></a></td>
</tr>
<?php
}
?>
</tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
require('footer.inc.php');
?>
