<?php 

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$customer_fname = $row_customer['customer_fname'];

$customer_lname = $row_customer['customer_lname'];

$customer_email = $row_customer['customer_email'];


?>

<h1 align="center"> Edit Your Account </h1>

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        
        <label> first Name: </label>
        
        <input type="text" name="c_fname" class="form-control" value="<?php echo $customer_fname; ?>" required>
        
    </div>

    <div class="form-group">
        
        <label> first Name: </label>
        
        <input type="text" name="c_lname" class="form-control" value="<?php echo $customer_lname; ?>" required>
        
    </div>
    
    <div class="form-group">
        
        <label> Customer Email: </label>
        
        <input type="text" name="c_email" class="form-control" value="<?php echo $customer_email; ?>" required>
        
    </div>
    


    
    <div class="text-center">
        
        <button name="update" class="btn btn-primary">
            
            <i class="fa fa-user-md"></i> Update Now
            
        </button>
        
    </div>
    
</form>

<?php 

if(isset($_POST['update'])){
    
    $update_id = $customer_id;
    
    $c_fname = $_POST['c_fname'];
    
    $c_email = $_POST['c_email'];
    
    $c_lname = $_POST['c_lname'];
    
    
    $update_customer = "update customers set customer_fname='$c_fname',customer_lname='$c_lname',customer_email='$c_email' where customer_id='$update_id' ";
    
    $run_customer = mysqli_query($con,$update_customer);
    
    if($run_customer){
        
        echo "<script>alert('Your account has been edited, to complete the process, please Relogin')</script>";
        
        echo "<script>window.open('logout.php','_self')</script>";
        
    }
    
}

?>
