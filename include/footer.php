<br>
<br>
<br>
<div id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-3">
                    <h3><b>Pages</b></h3>
                <ul>
                <li><a href="./cart.php">Shopping Cart</a></li>
                <li><a href="./contact.php">Contact Us</a></li>
                <li><a href="./shop.php">Shop</a></li>
                <li><a href="./customer/my_acc.php">My Account</a></li>
                </ul>
            </div>
            <div class="col-sm-3 col md-3">
            <h3><b>User section</b></h3>
                <ul>
                    <li><a href="./customer_register.php">Register</a></li>
                </ul>
                <hr class="hidden-md hidden-lg hidden-sm">
            </div>


            <div class="col-sm-3 col-md-3"> 
                <h3><b>Books Categories</b></h3>                
                    <ul>
                        <?php
                            $con = mysqli_connect("localhost", "root", "", "book_store");
                            $get_p_cats = "select * from product_categories";
                            $run_p_cats = mysqli_query($con,$get_p_cats);
                            while($row_p_cats = mysqli_fetch_array($run_p_cats)){
                                $p_cat_id = $row_p_cats['p_cat_id'];
                                $p_cat_title = $row_p_cats['p_cat_title'];
                                echo "
                                    <li>
                                        <a href='./shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
                                    </li>
                                ";
                            }
                        ?>
                    </ul>
                <hr class="hidden-md hidden-lg">                
            </div>

            <div class="col-sm-6 col-md-3"> 
                <h3><b>Contact Us</b></h3>                
                <p>                    
                    <strong>Book master.lk</strong>
                    <br/>no .458/2,Mihinthale road,Anuradhapura,Sri Lanka
                    <br/>0703256785
                    <br/><a href="#">bookmaster@gmail.com</a>
                </p>                
                <a href="./contact.php">Check Our Contact Page</a>   
                <hr class="hidden-md hidden-lg">                
            </div>
           
               
                              
            </div>
        </div>
    </div>
</div>

