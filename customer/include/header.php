
<?php 

    session_start();
    include("../include/db.php");
    include("../function/functions.php");
?>

<?php

if(isset($_GET['pro_id'])){
    
    $product_id = $_GET['pro_id'];
    $get_product = "select * from products where product_id='$product_id'";
    $run_product = mysqli_query($con,$get_product);
    $row_product= mysqli_fetch_array($run_product);
    $p_cat_id = $row_product['p_cat_id'];
    $pro_title = $row_product['product_title'];
    $pro_price = $row_product['product_price'];
    $pro_des = $row_product['product_des'];
    $pro_img = $row_product['product_img'];
    $pro_owner = $row_product['product_owner'];

    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
    $run_p_cat = mysqli_query($con,$get_p_cat);
    $row_p_cat = mysqli_fetch_array($run_p_cat);
    $p_cat_title = $row_p_cat['p_cat_title'];

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/index.js"></script>
    <title>Artiful Aisle</title>
</head>

<body> 
    <!--Top area-->
    <div id="top">    
       <div class="container-fluid">      
           <div class="col-md-6 offer">             
               <a href="" class="btn btn-info btn-sm">
               <?php 
                
                if(isset($_SESSION['customer_email'])){

                    echo "Welcome: " . $_SESSION['customer_email'] . "";
                }else{

                    echo "Welcome Guest";
                }

                ?>
               </a> &nbsp
               <a href="../cart.php"><?php items(); ?> Items In Your Cart | Total Price: <?php total_price(); ?> </a>              
           </div>
           
           <div class="col-md-6">             
               <ul class="menu">                  
                   <li><a href="../customer_register.php">Register</a></li>
                   <li><a href="./my_acc.php?my_orders">My Account</a></li>
                   <li><a href="../cart.php">Go To Cart</a></li>
                   <li><a href="../checkout.php">
                   <?php 
                    
                    if(!isset($_SESSION['customer_email'])){
                        echo "<a href='../checkout.php'> Login </a>";
                    }else{
                        echo "<a href='../logout.php'> Log Out </a>";
                    }

                    ?>
                   </a></li>  
               </ul>              
           </div>      
       </div>
    </div>

    <!--navigation-->
   <div id="navbar" class="navbar navbar-default">
       <div class="container">  
           <div class="navbar-header">            
               <a href="../index.php" class="navbar-brand home">             
                   <h3>Book master</h3>    
               </a>         
               <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                   <span class="sr-only">Toggle Navigation</span>
                   <i class="fa fa-align-justify"></i>  
               </button>
               <button class="navbar-toggle" data-toggle="collapse" data-target="#search">  
                   <span class="sr-only">Toggle Search</span> 
                   <i class="fa fa-search"></i>   
               </button> 
           </div>
           
           <div class="navbar-collapse collapse" id="navigation">

               <div class="padding-nav">   
                   <ul class="nav navbar-nav left">
                       <li class="<?php if($active=='Home') echo"active"; ?>"><a href="../index.php">Home</a></li>
                       <li class="<?php if($active=='Shop') echo"active"; ?>"><a href="../shop.php">Shop</a></li>
                       <li class="<?php if($active=='Account') echo"active"; ?>">
                    
                       <?php 
                        
                        if(!isset($_SESSION['customer_email'])){
                            echo "<a href='../checkout.php'>My Account</a>";
                        }else{
                            echo "<a href='./my_acc.php?my_orders'>My Account</a>";
                        }

                        ?>
                    
                       </li>
                       <li class="<?php if($active=='Cart') echo"active"; ?>"><a href="../cart.php">Shopping Cart</a></li>
                       <li class="<?php if($active=='Contact') echo"active"; ?>"><a href="../contact.php">Contact Us</a></li>
                   </ul>   
               </div> 

               <a href="../cart.php" class="btn navbar-btn btn-info right">  
                   <i class="fa fa-cart-plus"></i>      
                   <span><?php items(); ?> Items In Your Cart</span>  
               </a>
               <div class="navbar-collapse collapse right">        
                   <button class="btn btn-info navbar-btn" type="button" data-toggle="collapse" data-target="#search">
                       <span class="sr-only">Toggle Search</span>          
                       <i class="fa fa-search"></i>          
                   </button> 
               </div>
               <div class="collapse clearfix" id="search">
                   <form method="get" action="results.php" class="navbar-form">
                       <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search" name="user_query" required>
                           <span class="input-group-btn">
                           <button type="submit" name="search" value="Search" class="btn btn-info">  
                               <i class="fa fa-search"></i> 
                           </button>
                           </span> 
                       </div>                      
                   </form>                  
               </div>           
           </div>          
       </div>
   </div>