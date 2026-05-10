<h1 align="center"> Edit your Account </h1>

<form action="" method="post" enctype="mutipart/formdata">

    <div class="form-group">
        <label> Old Password </label>
        <input type="text" name="old_pass" class="form-control" required >
    </div>

    <div class="form-group">
        <label> New Password </label>
        <input type="text" name="new_pass" class="form-control" required>
    </div>

    <div class="form-group">
        <label> Confirm Password </label>
        <input type="text" name="confirm_pass" class="form-control" required>
    </div>

    <div class="text-center">
        <button name="submit" class="btn btn-primary"> <i class="fa fa-user-md"></i> Update Password</button>
    </div>

</form>

<?php 

if(isset($_POST['submit'])){
    
    $c_email = $_SESSION['customer_email'];
    
    $c_old_pass = $_POST['old_pass'];
    
    $c_new_pass = $_POST['new_pass'];
    
    $c_new_pass_again = $_POST['confirm_pass'];
    
    $sel_c_old_pass = "select * from customers where customer_pass='$c_old_pass'";
    
    $run_c_old_pass = mysqli_query($con,$sel_c_old_pass);
    
    $check_c_old_pass = mysqli_fetch_array($run_c_old_pass);
    
    if($check_c_old_pass==0){
        
        echo "<script>alert('Sorry, your current password did not valid. Please try again')</script>";
        
        exit();
        
    }
    
    if($c_new_pass!=$c_new_pass_again){
        
        echo "<script>alert('Sorry, your new password did not match')</script>";
        
        exit();
        
    }
    
    $update_c_pass = "update customers set customer_pass='$c_new_pass' where customer_email='$c_email'";
    
    $run_c_pass = mysqli_query($con,$update_c_pass);
    
    if($run_c_pass){
        
        echo "<script>alert('Your password has been updated')</script>";
        
        echo "<script>window.open('my_acc.php?my_orders','_self')</script>";
        
    }
    
}

?>