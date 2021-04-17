<?php
require('top.inc.php');
$categories_id= '';
$product_name = '';
$mrp = '';
$sellingprice = '';
$quantity = '';
$image = '';
$shortdescription = '';
$description = '';
$meta_title = '';
$meta_description = '';
$metakeyword = '';
$msg = '';
$image_required = 'required';
if(isset($_GET['id']) && $_GET['id']!=''){
   $image_required = '';
   $id = get_safe_value($con,$_GET['id']);
   $res = mysqli_query($con, "select * from product where id = '$id'");
   $check= mysqli_num_rows($res);
   if($check > 0){
   $row = mysqli_fetch_assoc($res);
   $categories_id = $row['categories_id'];
   $product_name = $row['product_name'];
   $mrp = $row['mrp'];
   $sellingprice = $row['sellingprice'];
   $quantity = $row['quantity'];
   $shortdescription = $row['shortdescription'];
   $description = $row['description'];
   $meta_title = $row['meta_title'];
   $meta_description = $row['meta_description'];
   $metakeyword = $row['metakeyword'];
   }
   else{
      header('location:product.php');
      die();
   }

}
if(isset($_POST['submit'])){

      $categories_id = get_safe_value($con,$_POST['categories_id']);
      $product_name = get_safe_value($con,$_POST['product_name']);
      $mrp = get_safe_value($con,$_POST['mrp']);
      $sellingprice = get_safe_value($con,$_POST['sellingprice']);
      $quantity = get_safe_value($con,$_POST['quantity']);
      $shortdescription = get_safe_value($con,$_POST['shortdescription']);
      $description = get_safe_value($con,$_POST['description']);
      $meta_title = get_safe_value($con,$_POST['meta_title']);
      $meta_description = get_safe_value($con,$_POST['meta_description']);
      $metakeyword = get_safe_value($con,$_POST['metakeyword']);
      $res = mysqli_query($con, "select * from product where product_name = '$product_name'");
      $check= mysqli_num_rows($res);
      if($check>0){
      if(isset($_GET['id']) && $_GET['id']!=''){
         $getData = mysqli_fetch_assoc($res);
         if($id == $getData['id']){
            
         }else{
            $msg = "Product Already Exit";
         }
      }else{
      $msg = "Product Already Exit";
      }
      }
      if(($_FILES['img']['type']!= 'image/png' && $_FILES['img']['type']!= 'image/jpg' && $_FILES['img']['type']!= 'image/jpeg')){
            $msg = "Please Select Only jpg, png or jpeg format image file";
      }
      if($msg == ''){
      if(isset($_GET['id']) && $_GET['id']!=''){
         if($_FILES['img']['name']!= ''){
            $img = rand(111111111,999999999).'_'. $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$img);
            $update_sql = "update product set categories_id = '$categories_id',product_name = '$product_name',mrp = '$mrp',
            sellingprice = '$sellingprice',quantity = '$quantity',shortdescription = '$shortdescription',description = '$description',meta_title = '$meta_title',meta_description = '$meta_description',
            metakeyword = '$metakeyword',img = '$img' where id = '$id'";
         }else{
            $update_sql = "update product set categories_id = '$categories_id',product_name = '$product_name',mrp = '$mrp',
            sellingprice = '$sellingprice',quantity = '$quantity',shortdescription = '$shortdescription',description = '$description',meta_title = '$meta_title',meta_description = '$meta_description',
            metakeyword = '$metakeyword' where id = '$id'";
         
         }
         mysqli_query($con,$update_sql);
      }
      else{
         $img = rand(111111111,999999999).'_'. $_FILES['img']['name'];
         move_uploaded_file($_FILES['img']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$img);
         mysqli_query($con,"Insert into product(categories_id,product_name,mrp,sellingprice,quantity,img,shortdescription,description,meta_title,meta_description,metakeyword,status) 
         values('$categories_id','$product_name','$mrp','$sellingprice','$quantity','$img','$shortdescription','$description','$meta_title','$meta_description','$metakeyword','1')");
      }
      header('location:product.php');
      die();
   }
      
}
?>
<div class="content pb-0">
         <div class="animated fadeIn">
            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-header"><strong>Product Form</strong></div>
                     <form method="post" enctype="multipart/form-data">
                     <div class="card-body card-block">
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Category Name</label>
                        <select class="form-control" name="categories_id">
                        <option>Select Categories</option>
                        <?php
                           $res = mysqli_query($con,"select id,categories from category order by categories asc");
                           while($row = mysqli_fetch_assoc($res)){
                              if($row['id']==$categories_id){
                                 echo "<option selected value = ".$row['id'].">".$row['categories']."</option>";
                              }else{
                              echo "<option value = ".$row['id'].">".$row['categories']."</option>";
                              }
                           }
                        ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Name</label>
                        <input type="text" name="product_name" placeholder="Enter Product Name" class="form-control" required value="<?php echo $product_name ?>">
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product MRP</label>
                        <input type="text" name="mrp" placeholder="Enter Product MRP" class="form-control" required value="<?php echo $mrp ?>">
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Price</label>
                        <input type="text" name="sellingprice" placeholder="Enter Product Price" class="form-control" required value="<?php echo $sellingprice ?>">
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Quantity</label>
                        <input type="text" name="quantity" placeholder="Enter Product Quantity" class="form-control" required value="<?php echo $quantity ?>">
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Image</label>
                        <input type="file" name="img" class="form-control" <?php echo $image_required?>>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Short Description</label>
                        <textarea name="shortdescription" placeholder="Enter Product ShortDescription" class="form-control"><?php echo $shortdescription ?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Description</label>
                        <textarea name="description" placeholder="Enter Product Description" class="form-control"><?php echo $description ?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Meta Title</label>
                        <textarea name="meta_title" placeholder="Enter Product Meta Title" class="form-control"><?php echo $meta_title ?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Meta Description</label>
                        <textarea name="meta_description" placeholder="Enter Product MetaDescription" class="form-control"><?php echo $meta_description ?></textarea>
                        </div>
                        <div class="form-group">
                        <label for="categories" class=" form-control-label">Product Meta Keyword</label>
                        <textarea name="metakeyword" placeholder="Enter Product Meta Keyword" class="form-control"><?php echo $metakeyword ?></textarea>
                        </div>
                        <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                        <span id="payment-button-amount">Submit</span>
                        </button>
                        <div class = "field_error"><?php echo $msg ?>
                        </div>
               </div>
                  </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
<?php
   require('footer.inc.php');
?>
         