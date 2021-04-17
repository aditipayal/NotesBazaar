<?php 
require('top.php');
$order_id = get_safe_value($con,$_GET['id']);
?>

<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
<!-- Start Search Popap -->
<div class="search__area">
    <div class="container" >
        <div class="row" >
            <div class="col-md-12" >
                <div class="search__inner">
                    <form action="#" method="get">
                        <input placeholder="Search here... " type="text">
                        <button type="submit"></button>
                    </form>
                    <div class="search__close__btn">
                        <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Search Popap -->
</div>
<!-- End Offset Wrapper -->
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/photo1.jpg) no-repeat scroll center center / cover ;">
<div class="ht__bradcaump__wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="bradcaump__inner">
                    <nav class="bradcaump-inner">
                        <a class="breadcrumb-item" href="index.php">Home</a>
                        <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                        <span class="breadcrumb-item active">Wishlist</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End Bradcaump area -->
<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="wishlist-content">
                <form action="#">
                    <div class="wishlist-table table-responsive">
                        <table>
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
                                product.img from user_order_detail,user_order,product where user_order_detail.order_id = '$order_id' and user_order.user_id='$uid'
                                and user_order_detail.product_id = product.id");
                                $total_price = 0;
                                while($row = mysqli_fetch_assoc($res)){
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
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- wishlist-area end -->
<?php 
require('footer.php');
?>