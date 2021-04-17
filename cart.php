<?php
require('top.php');
if(isset($_SESSION['cart']['0']) || count($_SESSION['cart'])==0){
    ?>
    <script>
        alert('Your Cart is Empty');
        window.location.href = "index.php";
    </script>
    <?php
} elseif (!isset($_SESSION['USER_LOGIN'])) {
    echo '<center>Login to kro.</center>';
    die;
}
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
                                  <span class="breadcrumb-item active">Shopping cart</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Products</th>
                                            <th class="product-name">Name of Products</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($_SESSION['cart'] as $key=>$val){
                                            $productArr = get_product($con,'','',$key);
                                            $pname = $productArr[0]['product_name'];
                                            $mrp = $productArr[0]['mrp'];
                                            $sellingprice = $productArr[0]['sellingprice'];
                                            $img = $productArr[0]['img'];
                                            $qty = $val['qty'];
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$img?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo $pname ?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"><?php echo $mrp ?></li>
                                                    <li><?php echo $sellingprice?></li>
                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount"><?php echo $sellingprice?></span></td>
                                            <td class="product-quantity"><input type="number" id="<?php echo $key?>qty" value ="<?php echo $qty ?>"></br>
                                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','update')">Update</a></td>
                                            <td class="product-subtotal"><?php echo $qty*$sellingprice?></td>
                                            <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="<?php echo SITE_PATH?>index.php">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="<?php echo SITE_PATH?>checkout.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
        <!-- End Banner Area -->
<?php 
require('footer.php');
?>