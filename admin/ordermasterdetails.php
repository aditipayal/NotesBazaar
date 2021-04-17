<?php
require('top.inc.php');
$order_id = get_safe_value($con,$_GET['id']);
if(isset($_POST['update_order_status'])){
    $update_order_status = $_POST['update_order_status'];
    mysqli_query($con,"update user_order set order_status = '$update_order_status' where id='$order_id'");
}
?>
<div class="content pb-0">
<div class="orders">
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<h4 class="box-title">Order Master Details</h4>
</div>
<div class="card-body--">
<div class="table-stats order-table ov-h">
<table class = "table">
                            <thead>
                                <th class = "product-name">Product Name</th>
                                <th class = "product-thumbnail">Product Image</th>
                                <th class = "product-quantity">Quantity</th>
                                <th class = "product-price">Price</th>
                                <th class = "product-price">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $uid = $_SESSION['USER_ID'];
                                $res = mysqli_query($con,"select distinct(user_order_detail.id),user_order_detail.*,product.product_name,
                                product.img,user_order.address,user_order.city,user_order.pincode from user_order_detail,user_order,product where user_order_detail.order_id = '$order_id' and user_order.user_id='$uid'
                                and user_order_detail.product_id = product.id");
                                $total_price = 0;
                                while($row = mysqli_fetch_assoc($res)){
                                $address = $row['address'];
                                $city = $row['city'];
                                $pincode = $row['pincode'];
                                $total_price = $total_price + ($row['quantity']*$row['sellingprice']);
                                ?>
                                <tr>
                                     <td class="product-name"><?php echo $row['product_name'];?></td>
                                    <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['img'];?>"/></td>
                                    <td class="product-name"><?php echo $row['quantity'];?></td>
                                    <td class="product-name"><?php echo $row['sellingprice'];?></td>
                                    <td class="product-name"><?php echo $row['quantity']*$row['sellingprice'];?></a></td>
                                </tr>
                                <?php
                                }
                                ?>
                                 <tr>
                                    <td colspan ="3"></td>
                                    <td class="product-name">Total Price</td>
                                    <td class="product-name"><?php echo $total_price;?></a></td>
                                </tr>
                            </tbody>
                        </table>
<div id = "address-details">
    <strong>Address:</strong>
    &nbsp<?php echo $address?>,<br>
    <strong>City:</strong>&nbsp<?php echo $city?>,<br>
    <strong>Pincode:</strong>&nbsp<?php echo $pincode?><br>
    <strong>Order Status</strong>
    <?php
    $order_status_arr  = mysqli_fetch_assoc(mysqli_query($con,"select user_order_status.name from user_order_status,user_order where user_order.id = '$order_id' and user_order.order_status = user_order_status.id"));
    echo $order_status_arr['name'];
    ?>
    <div>
        <form method="post">
        <select class="form-control" name="update_order_status">
            <option>Select Status</option>
            <?php
                $res = mysqli_query($con,"select * from user_order_status");
                while($row = mysqli_fetch_assoc($res)){
                    if($row['id']==$categories_id){
                        echo "<option selected value = ".$row['id'].">".$row['name']."</option>";
                    }else{
                    echo "<option value = ".$row['id'].">".$row['name']."</option>";
                    }
                }
            ?>
        </select>
        <input type = "submit" class = 'form-control'>
        </form>
    </div>
</div>
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
