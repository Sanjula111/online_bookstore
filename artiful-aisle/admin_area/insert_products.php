<?php 
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <title>Admin | Insert Products</title>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i>&nbspInsert Produt
                    </h3>
                </div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Title</label>
                            <div class="col-md-6">
                                <input name="product_title" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Category</label>
                            <div class="col-md-6">
                                <select name="product_cat" class="form-control">
                                    <option>Select Category</option>
                                    <?php
                                        $get_p_cats = "SELECT * from product_categories";
                                        $run_p_cats = mysqli_query($con, $get_p_cats);

                                        while($row_p_cats = mysqli_fetch_array($run_p_cats)){
                                            $p_cat_id = $row_p_cats['p_cat_id'];
                                            $p_cat_title = $row_p_cats['p_cat_title'];

                                            echo "
                                                <option value = '$p_cat_id'>$p_cat_title</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Image</label>
                            <div class="col-md-6">
                                <input name="product_img" type="file" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Owner</label>
                            <div class="col-md-6">
                                <input name="product_owner" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Price</label>
                            <div class="col-md-6">
                                <input name="product_price" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Keywords</label>
                            <div class="col-md-6">
                                <input name="product_keywords" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Description</label>
                            <div class="col-md-6">
                                <textarea name="product_des" cols="19" rows="8" class="form-control"></textarea>      
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input name="submit" value="Insert Product" type="submit" class="btn btn-primary form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
</body>
</html>

<?php
    
    if(isset($_POST['submit'])){

        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $product_price = $_POST['product_price'];
        $product_keywords = $_POST['product_keywords'];
        $product_des = $_POST['product_des'];
        $product_owner = $_POST['product_owner'];

        $product_img = $_FILES['product_img']['name'];
        $temp_name = $_FILES['product_img']['tmp_name'];

        move_uploaded_file($temp_name,"product_images/$product_img");
        move_uploaded_file($temp_name,"admin_product_images/$product_img");
        
        $insert_product = "insert into products (p_cat_id,date,product_title,product_img,product_owner,product_price,product_keywords,product_des) values ('$product_cat',NOW(),'$product_title','$product_img','$product_owner','$product_price','$product_keywords','$product_des')";
        $run_product = mysqli_query($con,$insert_product);

        if ($run_product) {
            
            echo "<script>alert('Product has been inserted successfully')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";

        }

    }

?>

<?php } ?>