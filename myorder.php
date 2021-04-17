<?php 
require('top.php');
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
                                $uid = $_SESSION['USER_ID'];
                                $res = mysqli_query($con,"select user_order.*,user_order_status.name as order_status_str  from  user_order,user_order_status where user_order.user_id = '$uid' and user_order_status.id = user_order.order_status");
                                while($row = mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td class="product-add-to-cart"><a href="myorder_details.php?id=<?php echo $row['id'];?>"><?php echo $row['id'];?></a></td>
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