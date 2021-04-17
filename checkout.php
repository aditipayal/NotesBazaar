<?php
require('top.php');
if(isset($_SESSION['cart']['0']) || count($_SESSION['cart'])==0){
 ?>
 <script>
     window.location.href = "index.php";
 </script>
 <?php
}
$cart_total = 0;
foreach($_SESSION['cart'] as $key=>$val){
    $productArr = get_product($con,'','',$key);
    $sellingprice = $productArr[0]['sellingprice'];
    $qty = $val['qty'];
    $cart_total = $cart_total+($sellingprice*$qty);
}
if(isset($_POST['submit'])){
   $address = get_safe_value($con,$_POST['address']);
   $city = get_safe_value($con,$_POST['city']);
   $pincode = get_safe_value($con,$_POST['pincode']);
   $payment_type = get_safe_value($con,$_POST['payment_type']);
   $user_id = $_SESSION['USER_ID'];
   $total_price = $cart_total;
   $payment_status = 'pending';
   if($payment_type=="COD"){
   $payment_status='success';
   }
   $order_status ='1';
   $added_on = date('Y-m-d h:i:s');
   $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
   mysqli_query($con,"insert into user_order(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on,txnid)
    values('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on','$txnid')");

   $order_id = mysqli_insert_id($con);
   foreach($_SESSION['cart'] as $key=>$val){
    $productArr = get_product($con,'','',$key);
    $sellingprice = $productArr[0]['sellingprice'];
    $qty = $val['qty'];
    mysqli_query($con,"insert into user_order_detail(order_id,product_id,quantity,sellingprice) values('$order_id','$key','$qty','$sellingprice')");
   }
    unset($_SESSION['cart']);
    if($payment_type=="payonline"){
        $MERCHANT_KEY = "gtKFFx"; 
        $SALT = "eCwWELxi";
        $hash_string = '';
        //$PAYU_BASE_URL = "https://secure.payu.in";
        $PAYU_BASE_URL = "https://test.payu.in";
        $action = '';
        $posted = array();
        if(!empty($_POST)) {
          foreach($_POST as $key => $value) {    
            $posted[$key] = $value; 
          }
        }
        $userArr = mysqli_fetch_assoc(mysqli_query($con,"select * from user where id = '$user_id'"));
        $formError = 0;
        $posted['txnid']=$txnid;
        $posted['amount']=$total_price;
        $posted['firstname']=$userArr['username'];
        $posted['email']=$userArr['email'];
        $posted['phone']=$userArr['mobile'];
        $posted['productinfo']="productinfo";
        $posted['key']=$MERCHANT_KEY ;
        $hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if(empty($posted['hash']) && sizeof($posted) > 0) {
          if(
                  empty($posted['key'])
                  || empty($posted['txnid'])
                  || empty($posted['amount'])
                  || empty($posted['firstname'])
                  || empty($posted['email'])
                  || empty($posted['phone'])
                  || empty($posted['productinfo'])
                 
          ) {
            $formError = 1;
          } else {    
            $hashVarsSeq = explode('|', $hashSequence);
            foreach($hashVarsSeq as $hash_var) {
              $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
              $hash_string .= '|';
            }
            $hash_string .= $SALT;
            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
          }
        } elseif(!empty($posted['hash'])) {
          $hash = $posted['hash'];
          $action = $PAYU_BASE_URL . '/_payment';
        }
        
        
        $formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'">
        <input type="hidden" name="key" value="'.$MERCHANT_KEY.'" />
        <input type="hidden" name="hash" value="'.$hash.'"/>
        <input type="hidden" name="txnid" value="'.$posted['txnid'].'" />
        <input name="amount" type="hidden" value="'.$posted['amount'].'" />
        <input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" />
        <input type="hidden" name="email" id="email" value="'.$posted['email'].'" />
        <input type="hidden" name="phone" value="'.$posted['phone'].'" />
        <textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea>
        <input type="hidden" name="surl" value="http://127.0.0.1/php/Notes%20app/payment_complete.php" />
        <input type="hidden" name="furl" value="http://127.0.0.1/php/Notes%20app/payment_fail.php"/>
        <input type="submit" style="display:none;"/></form>';
        echo $formHtml;
        echo '<script>document.getElementById("payuForm").submit();</script>';
        }else{
    ?>
    <script>
        window.location.href = 'thankyou.php';
    </script>
    <?php   
        }
}
?>
<div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popup -->
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
            <!-- End Search Popup -->
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
                                  <span class="breadcrumb-item active">Checkout</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="checkout-wrap ptb--100">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                <?php 
                                 $accordian_class = 'accordion__title';
                                  if(!isset($_SESSION['USER_LOGIN'])){
                                    $accordian_class = 'accordion__hide';
                                      ?>
                                    <div class="accordion__title">
                                        Checkout Method
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form" method="post">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email</label>
                                                                <input type="email" name="login_name" id="login_name" placeholder="Your Email" style="width:100%">
                                                            </div>
                                                            <span class="field_error" id="login_email_error"></span>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" name="login_password" id="login_password" placeholder="Your Password" style="width:100%">
                                                            </div>
                                                            <span class="field_error" id="login_password_error"></span>
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                               <button type="button" class="fv-btn" onclick="user_login()">Login</button>
                                                            </div>
                                                        </form>
                                                        <div class="form-output login_msg">
                                                            <p class="form_message field_error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-method__login">
                                                        <form id="register-form" method="post">
                                                            <h5 class="checkout-method__title">Register</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Name</label>
                                                                <input type="name" id="name" name="name" placeholder="Your Name" style="width:100%">
                                                                <span class="field_error" id="name_error"></span>
                                                            </div>
															<div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="email" name="email" placeholder="Your email" style = "width:100%">
                                                                <span class="field_error" id="email_error"></span>
                                                            </div>
															<div class="single-input">
                                                                <label for="user-email">Mobile</label>
                                                                <input type="number" id="mobile" name="mobile" placeholder="Your Mobile" style = "width:100%">
                                                                <span class="field_error" id="mobile_error"></span>
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="password" name="password" placeholder="Your Password" style="width:100%">
                                                                <span class="field_error" id="password_error"></span>
                                                            </div>
                                                            <div class="contact-btn">
										                        <button type="button" onclick="user_register()" class="fv-btn">Register</button>
								                        	</div>
                                                        </form>
                                                        <div class="form-output register_msg">
								                        	<p class="form-message field_error"></p>
								                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                     }
                                     ?>
                                    <div class="<?php echo $accordian_class?>">
                                        Address Information
                                    </div>
                                    <form method="post">
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="single-input">
                                                            <input type="text" name="address" placeholder="Street Address" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name="city" placeholder="City/State" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="single-input">
                                                            <input type="text" name = "pincode" placeholder="Pincode/zip" required>
                                                        </div>
                                                      </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="<?php echo $accordian_class?>">
                                        Payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                              <input type="radio" name="payment_type" value="COD" required/>&nbspCash On Delievery
                                            </div>
                                            <div class="single-method">
                                              <input type="radio" name="payment_type" value="payonline" required/>&nbspOnline Payemnt </br>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
										 <input type="submit" name="submit" class="fv-btn">
								    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-details">
                            <h5 class="order-details__title">Your Order</h5>
                            <div class="order-details__item">
                            <?php 
                                        $cart_total = 0;
                                        foreach($_SESSION['cart'] as $key=>$val){
                                            $productArr = get_product($con,'','',$key);
                                            $pname = $productArr[0]['product_name'];
                                            $mrp = $productArr[0]['mrp'];
                                            $sellingprice = $productArr[0]['sellingprice'];
                                            $img = $productArr[0]['img'];
                                            $qty = $val['qty'];
                                            $cart_total = $cart_total+($sellingprice*$qty);
                                        ?>
                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$img?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname ?></a>
                                        <span class="price"><?php echo $qty*$sellingprice ?></span>
                                    </div>
                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="zmdi zmdi-delete"></i></a>
                                    </div>
                                </div>
                                        <?php } ?>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price"><?php echo $cart_total?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
<?php 
require('footer.php');
?>