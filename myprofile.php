<?php
require('top.php');
$username = "";
$password = "";
$email = "";
$mobile = "";
$confirmpassword = "";
$msg = "";
$user_id = get_safe_value($con,$_GET['id']);
$res = mysqli_query($con,"select * from user where id=".$user_id);
$row = mysqli_fetch_assoc($res);
if(isset($_POST['submit'])){
    $username = get_safe_value($con,$_POST['user_name']);
    $password = get_safe_value($con,$_POST['user_password']);
    $email = get_safe_value($con,$_POST['user_email']);
    $mobile = get_safe_value($con,$_POST['user_mobile']);
    $confirmpassword = get_safe_value($con,$_POST['user_confirm_password']);
    if($confirmpassword == $password){
         if(isset($_GET['id']) && $_GET['id']!=''){
             mysqli_query($con,"update user set username ='$username',password='$password',email ='$email',mobile = '$mobile' where id = $user_id");
             $msg  = "Your data updated sucessfully";
        }
    }else{
        $msg = "Your password does not match";
    }
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
                                  <span class="breadcrumb-item active"><?php echo $_SESSION['USER_NAME']?></span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
       <!-- Start PRofile Page -->
<div class="container">
<h1 style="text-align:center;margin-top:10px;"> Your Profile</h1>
<hr>
<div class="row">
<!-- edit form column -->
<div class="col-md-9 personal-info">
<form class="form-horizontal" method="post">
    <div class="form-group">
    <label class="col-lg-3 control-label">Name</label>
    <div class="col-lg-8">
        <input class="form-control" name="user_name" id="name" type="text" value="<?php echo ucfirst($_SESSION['USER_NAME']);?>">
    </div>
    </div>
    <div class="form-group">
    <label class="col-lg-3 control-label">Email:</label>
    <div class="col-lg-8">
        <input class="form-control" name="user_email"  type="text" value="<?php echo $row['email'];?>">
    </div>
</div>  
    <div class="form-group">
    <label class="col-lg-3 control-label">Mobile:</label>
    <div class="col-lg-8">
        <input class="form-control" name="user_mobile"  type="number" value="<?php echo $row['mobile'];?>">
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Password:</label>
    <div class="col-md-8">
        <input class="form-control" name="user_password"  type="password" value="<?php echo $row['password'];?>">
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label">Confirm password:</label>
    <div class="col-md-8">
        <input class="form-control" name="user_confirm_password"  type="password" value="<?php echo $row['password'];?>">
    </div>
    </div>
    <div class="form-group">
    <label class="col-md-3 control-label"></label>
    <div class="col-md-8">
        <button type="submit" name = "submit" value = "Save Changes" class="btn btn-primary">Save Changes</button>
    </div>
    </div>
    <div class="form-output">
   <p class="form-message field_error"><?php echo $msg;?></p>
</div>
</form>
</div>
</div>
</div>
<hr>
<!-- End profile page -->
<?php 
require('footer.php');
?>