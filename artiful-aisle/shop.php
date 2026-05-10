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
               </ul>
           </div>

           <!--Including sidebar-->
            <div class="col-md-3">
               <?php include("./include/sidebar.php"); ?>   
            </div>

           <div class="col-md-9">
                    <?php 
                        getpcatpro();
                    ?>
                <?php 
                    if (!isset($_GET['p_cat'])) {
                        echo"
                        <div class='box'>
                            <h1 id='h1-shop'>Shop</h1>
                            <p>Shop any poster, pencil art, painting, framed or original for best lowest prices. We deliver the items as soon as possible aand all the items are 100 % guaranteed.</p>
                        </div>
                        ";
                    }
                ?>
                   <div class="row">
                        
                       <?php 
                       
                        if (!isset($_GET['p_cat'])) {

                            $per_page = 6;
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }

                            $start_from = (($page - 1) * $per_page);
                            $get_products = "select * from products order by 1 DESC LIMIT $start_from, $per_page";
                            $run_products = mysqli_query($con,$get_products);

                            while ($row_products=mysqli_fetch_array($run_products)) {
                                $pro_id = $row_products['product_id'];
                                $pro_title = $row_products['product_title'];
                                $pro_price = $row_products['product_price'];
                                $pro_img = $row_products['product_img'];

                                echo "<div class='col-md-4 col-sm-6 center-responsive'>
                                        <div class='product'>
                                            <a href='./details.php?pro_id=$pro_id'>
                                            <img src='./admin_area/product_images/$pro_img' id='image-product' class='img-responsive' alt='product'>
                                            </a>
                                        <div class='text'>
                                            <h3><a href='./details.php?pro_id=$pro_id'> $pro_title </a></h3>
                                                <p class='price'>Rs. $pro_price</p>
                                                <p class='button'>
                                                <a href='./details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                                                
                                                </p>
                                            </div>
                                        </div>
                                    </div>";
                            }

                            }

                       ?>
                   </div>
                   <center>
                    <ul class="pagination">
                        <?php
                            $query = "select * from products";
                            $result = mysqli_query($con,$query);
                            $total_records = mysqli_num_rows($result);
                            $total_pages = ceil($total_records / 6);

                            echo "
                            
                                <li><a href = './shop.php?page=1'> ".'First Page'."</a></li>

                            ";
                            for ($i=1; $i<=$total_pages ; $i++) { 
                                echo "
                            
                                <li> <a href = './shop.php?page=".$i."'> ".$i."</a> </li>

                                ";
                            }
                            echo "
                            
                                <li><a href = './shop.php?page=$total_pages'> ".'Last Page'."</a></li>

                            ";


                        ?>
                    </ul>
                   </center>
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