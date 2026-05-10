<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
    
    <div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / Insert Admins
            </li>
        </ol>
    </div>
</div>
       
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
           <div class="panel-heading">
               <h3 class="panel-title">
                   <i class="fa fa-money fa-fw"></i> Insert Admins
               </h3>
           </div>
           <div class="panel-body">
               <form method="post" class="form-horizontal" enctype="multipart/form-data">
                   <div class="form-group">
                      <label class="col-md-3 control-label"> Username </label> 
                      <div class="col-md-6">
                          <input name="admin_name" type="text" class="form-control" required>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-3 control-label"> E-mail </label> 
                      <div class="col-md-6">
                          <input name="admin_email" type="text" class="form-control" required>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-3 control-label"> Password </label> 
                      <div class="col-md-6">
                          <input name="admin_pass" type="password" class="form-control" required>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-3 control-label"> Contact </label> 
                      <div class="col-md-6">
                          <input name="admin_contact" type="text" class="form-control" required>
                      </div>
                   </div>

                   <div class="form-group">
                      <label class="col-md-3 control-label"> Image </label> 
                      <div class="col-md-6">
                          <input name="admin_image" type="file" class="form-control" required>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-3 control-label"> About </label> 
                      <div class="col-md-6">
                          <textarea name="admin_about" class="form-control" rows="3"></textarea>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-3 control-label"></label> 
                      <div class="col-md-6">
                          <input name="submit" value="Insert Admin" type="submit" class="btn btn-primary form-control">
                      </div>
                   </div>
               </form>
           </div>
        </div>
    </div>
</div>



<?php 

if(isset($_POST['submit'])){
    
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];
    $admin_contact = $_POST['admin_contact'];
    $admin_about = $_POST['admin_about'];
    
    $admin_image = $_FILES['admin_image']['name'];
    $temp_admin_image = $_FILES['admin_image']['tmp_name'];
    
    move_uploaded_file($temp_admin_image,"admin_images/$admin_image");
    
    $insert_admin = "insert into admins (admin_name,admin_email,admin_pass,admin_contact,admin_image,admin_about) values ('$admin_name','$admin_email','$admin_pass','$admin_contact','$admin_image','$admin_about')";
    
    $run_admin = mysqli_query($con,$insert_admin);
    
    if($run_admin){
        
        echo "<script>alert('New admin has been inserted to your admin sucessfully')</script>";
        echo "<script>window.open('index.php?view_admin','_self')</script>";
        
    }
    
}

?>


<?php } ?>