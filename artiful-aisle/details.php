<?php 
    $active='Shop';
    include("./include/header.php");
?>

   <div id="content">
       <div class="container-fluid">
           <div class="col-md-12">
               <ul class="breadcrumb">
                   <li><a href="index.php">Home</a></li>
                   <li>Shop</li>
                   <li><a href="./shop.php?p_cat<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a></li>
                   <li><?php echo $pro_title ?></li>
               </ul>
           </div>

           <!--Including sidebar-->
            <div class="col-md-3">
               <?php 
               include("./include/sidebar.php"); 
               ?>   
            </div>

            <div class="col-md-9">
                <div id="productMain" class="row">
                    <div class="col-sm-6">
                        <div id="mainImage">
                            <img src="./admin_area/product_images/<?php echo $pro_img; ?>" class="img-responsive" alt="product1">
                        </div>
                    </div>
                    <div class="col-sm-6" id="details">
                        <div class="box">
                            <h1 class="text-center"><?php echo $pro_title; ?></h1>
                            <p class="text-center"><i class="fa fa-tag"></i>&nbspAuthor - <?php echo $pro_owner; ?></p>

                            <?php add_cart(); ?>

                            <form action="details.php?add_cart=<?php echo $product_id; ?>&pro_id=<?php echo $product_id; ?>" class="form-horizontal" method="post">
                            <div class="form-group">
                                    <label for="" class="col-md-5 control-label">Quantity</label>
                                    <div class="col-md-7">
                                        <input type="number" name="product_qty" id="" class="form-control">
                                        <p class="price">LKR <?php echo $pro_price; ?>/=</p>
                                <p class="text-center buttons">
                                    <button class="btn btn-primary i fa fa-cart-plus">&nbspAdd to cart</button></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><br>
                <div class="box" id="product-details">
                    <h4><u>Product details</u></h4>
                    <?php echo $pro_des ?>
                </div>
            </div>

       </div>
   </div>

   <?php 
    
    include("./include/footer.php");
    
    ?>
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    
</body>

</html>