<?php 
    $active='Account';
    include("./include/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Calibri:wght@400;700&display=swap" rel="stylesheet">
<script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            // Validate email format
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                Swal.fire({
                    title: 'Invalid Email Format',
                    text: 'Please enter a valid email address.',
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
<body style = "background-image: url('images/back.jpg');background-repeat: no-repeat;
  background-position: center center;background-size: 300vh;">
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

            <div class="col-md-4" id="customer_register" style = "margin: 0;position: absolute;left: 50%;
  -ms-transform: translate(50%, 50%);
  transform: translate(-50%, 50%);">
                <div class="box" >
                    <div class="box-header">
                        <center>
                            <h2>Register to a new Account</h2>
                        </center>
                        <form action="customer_register.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>
                                    First Name
                                </label>
                                <input type="text" name="r_fname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    Last Name
                                </label>
                                <input type="text" name="r_lname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    Your Email
                                </label>
                                <input type="email" name="r_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>
                                    Password
                                </label>
                                <input type="password" name="r_password" class="form-control" required>
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


    <!--including footer-->
    </br></br>
   

 
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

    $insert_customer="insert into customers (customer_fname,customer_lname,customer_email,customer_pass,customer_ip) values ('$c_fname', '$c_lname','$c_email','$c_pass','$c_ip')";

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