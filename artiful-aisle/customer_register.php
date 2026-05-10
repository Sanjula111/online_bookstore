<?php 
$active = 'Account';
include("./include/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Master.lk - Register</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Validate Gmail format
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            Swal.fire({
                title: 'Invalid Email',
                text: 'Please enter a valid Gmail address.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false; // Prevent form submission
        }

        // Validate password strength
        var passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
        if (!passwordPattern.test(password)) {
            Swal.fire({
                title: 'Invalid Password',
                text: 'Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return false; // Prevent form submission
        }

        return true; // Proceed with form submission
    }
</script>
</head>
<body>



<!--register form-->
<div id="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Register</li>
            </ul>
        </div>
        <div class="col-md-2">   
            <!--empty box-->
        </div>

        <div class="col-md-8" id="customer_register">
            <div class="box">
                <div class="box-header">
                    <center>
                        <h2>Register to a new Account</h2>
                    </center>
                    <form action="customer_register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="r_fname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="r_lname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="r_email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="r_password" id="password" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>

<?php 

if (isset($_POST['register'])){
    $c_fname=$_POST['r_fname'];
    $c_lname=$_POST['r_lname'];
    $c_email=$_POST['r_email'];
    $c_pass=$_POST['r_password'];
    $c_ip=getRealIpUser();

     // Validate email (only Gmail)
     if (!filter_var($c_email, FILTER_VALIDATE_EMAIL) || !preg_match("/@gmail\.com$/", $c_email)) {
        echo "<script>Swal.fire('Invalid Email', 'Please enter a valid Gmail address.', 'error');</script>";
        exit();
    }

    // Validate password (strength check)
    if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/", $c_pass)) {
        echo "<script>Swal.fire('Invalid Password', 'Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.', 'error');</script>";
        exit();
    }

    // Hash the password before storing
    $passwordHash = password_hash($c_pass, PASSWORD_DEFAULT);

    $insert_customer="insert into customers (customer_fname,customer_lname,customer_email,customer_pass,customer_ip) values ('$c_fname', '$c_lname','$c_email','$passwordHash','$c_ip')";

    $run_customers = mysqli_query($con,$insert_customer);
    $sel_cart = "select * from cart where ip_add='$c_ip'";
    $run_cart = mysqli_query($con,$sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if($check_cart>0){
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('You have been registered successfully')</script>";
        echo "<script>window.open('./checkout.php','_self')</script>";
    }else{
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('You have been registered successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}







?>
</body>
</html>
