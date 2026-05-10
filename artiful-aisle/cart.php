<?php 
    $active='Cart';
    include("./include/header.php");
?>

   <div id="content">
       <div class="container-fluid">
           <div class="col-md-12">
               <ul class="breadcrumb">
                   <li><a href="index.php">Home</a></li>
                   <li>Cart</li>
               </ul>
           </div>
           <div id="cart" class="col-md-9">
               <div class="box">
                   <form action="cart.php" method="post" enctype="multipart/form-data">
                    <?php 
                    
                    $ip_add = getRealIpUser();

                    $select_cart = "select * from cart where ip_add='$ip_add'";
                    $run_cart = mysqli_query($con,$select_cart);
                    $count = mysqli_num_rows($run_cart);

                    ?>
                       <h1>Shopping Cart</h1>
                       <p class="text-muted">You currently have <?php echo $count; ?> items in your cart.</p>
                       <div class="table-responsive">
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th colspan="2" style="text-align: center">Product</th>
                                       <th style="text-align: center">Unit Price</th>
                                       <th style="text-align: center">Quantity</th>
                                       <th colspan="1" style="text-align: center">Delete</th>
                                       <th colspan="1" style="text-align: center">Price</th>
                                   </tr>
                               </thead>
                               
                               <tbody>
                               <?php 
                                   
                                   $total = 0;
                                   $cart_total = 0;
                                   
                                   while($row_cart = mysqli_fetch_array($run_cart)){
                                       
                                     $pro_id = $row_cart['p_id'];
                                       
                                     $pro_qty = $row_cart['qty'];
                                       
                                       $get_products = "select * from products where product_id='$pro_id'";
                                       
                                       $run_products = mysqli_query($con,$get_products);
                                       
                                       while($row_products = mysqli_fetch_array($run_products)){
                                           
                                           $product_title = $row_products['product_title'];
                                           
                                           $product_img = $row_products['product_img'];
                                           
                                           $only_price = $row_products['product_price'];
                                           
                                           $sub_total = $row_products['product_price']*$pro_qty;
                                           
                                           $total += $sub_total;

                                           $cart_total = $total;
                                           
                                   ?>
                                   <tr>
                                       <td>
                                        <center>
                                            <img src="./admin_area/product_images/<?php echo $product_img; ?>" alt="product1" class="img-responsive" id="cart_img">
                                        </center>
                                        </td>

                                       <td>
                                           <a href="details.php?pro_id=<?php echo $pro_id; ?>"><?php echo $product_title; ?></a>
                                       </td>

                                       <td>LKR <?php echo $only_price ?>/=</td>
                                       <td><?php echo $pro_qty ?></td>

                                       <td>
                                           <input type="checkbox" name="remove[]" value= <?php echo $pro_id; ?>>
                                       </td>

                                       <td>LKR <?php echo $sub_total ?>/=</td>
                                   </tr>
                                   <?php  }} ?>
                               </tbody>
                               <tfoot>
                                   <tr>
                                       <th colspan="4" style="text-align: right">Total</th>
                                       <td colspan="2"><b>LKR <?php echo $total; ?>/=</b></td>
                                   </tr>
                                   <tr>
                                   <td colspan="5">
                                           <a href="./shop.php" class="btn btn-warning"><i class="fa fa-chevron-left"></i>&nbspContinue Shopping</a>
                                           <button type="submit" name="update" class="btn btn-default"> <i class="fa fa-refresh"></i>&nbspUpdate Cart</button>
                                           <a href="./checkout.php"><button type="submit" class="btn btn-success" name="checkout"> <i class="fa fa-chevron-right"></i>&nbspCheckout</a></button>
                                       </td>
                                   </tr>
                               </tfoot>
                           </table>
                       </div>
                   </form>
               </div>
               <?php 
               
               function update_cart(){
                   global $con;
                   if(isset($_POST['update'])){
                    foreach($_POST['remove'] as $remove_id){
                        $delete_product = "delete from cart where p_id='$remove_id'";
                        $run_delete = mysqli_query($con,$delete_product);
                        if($run_delete){
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }
                   }
               }
                echo @$up_cart = update_cart();
               ?>       
           </div>
           <div class="col-md-3">
            </div>
           </div>
       </div>
   </div>

    </br></br>   
    <?php 
    
    include("./include/footer.php");
    
    ?>
   
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    
</body>
</html>