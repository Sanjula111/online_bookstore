<div class="box">
    <div class="box-header">
        <center>
            <h1>Login</h1>
            <p class="lead">Already have an account?</p>
        </center>
    </div>
    <form method="post" action="checkout.php">
        <div class="form-group">
            <label>Email: </label>
            <input type="text" name="c_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password: </label>
            <input type="password" name="c_pass" class="form-control" required>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" value="Login" name="login">
                <i class="fa fa-sign-in"></i> Login
            </button>
        </div>
    </form>
    <center>
        <a href="./customer_register.php">
            <h4>Don't have an account? Register here...</h4>
        </a>
    </center>
</div> 

<?php 

if(isset($_POST['login'])){
    
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];
    $select_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";
    $run_customer = mysqli_query($con,$select_customer);
    $get_ip = getRealIpUser();
    $check_customer = mysqli_num_rows($run_customer);
    $select_cart = "select * from cart where ip_add='$get_ip'";
    $run_cart = mysqli_query($con,$select_cart);
    $check_cart = mysqli_num_rows($run_cart);
    
    if($check_customer==0){
        
        echo "<script>alert('Your email or password is wrong')</script>";
        
        exit();
        
    }
    
    if($check_customer==1 AND $check_cart==0){
        $_SESSION['customer_email']=$customer_email;
        echo "<script>alert('You are Logged in')</script>"; 
        echo "<script>window.open('customer/my_acc.php?my_orders','_self')</script>";
    } else {
        $_SESSION['customer_email']=$customer_email;
        echo "<script>alert('You are Logged in')</script>"; 
        echo "<script>window.open('./checkout.php','_self')</script>";
    }
    
}

?>