<?php 

    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<?php 

    if(isset($_GET['admin_profile'])){
        
        $edit_admin = $_GET['admin_profile'];
        
        $get_admin = "select * from admins where admin_id='$edit_admin'";
        
        $run_admin = mysqli_query($con,$get_admin);
        
        $row_admin = mysqli_fetch_array($run_admin);
        
        $admin_id = $row_admin['admin_id'];
        
        $admin_name = $row_admin['admin_name'];
        
        $admin_pass = $row_admin['admin_pass'];
        
        $admin_email = $row_admin['admin_email'];
        
        $admin_image = $row_admin['admin_image'];
        
        $admin_about = $row_admin['admin_about'];
        
        $admin_contact = $row_admin['admin_contact'];
        
        
    }

?>

<div class="row">
    
    <div class="col-lg-12">
        
        <ol class="breadcrumb">
            
            <li class="active">
                
                <i class="fa fa-dashboard"></i> Dashboard / Edit Admins
                
            </li>
            
        </ol>
        
    </div>
    
</div>
       
<div class="row">
    
    <div class="col-lg-12">
        
        <div class="panel panel-default">
            
           <div class="panel-heading">
               
               <h3 class="panel-title">
                   
                   <i class="fa fa-money fa-fw"></i> Edit admin Admin
                   
               </h3>
               
           </div>
           
           <div class="panel-body">
               
               <form method="post" class="form-horizontal" enctype="multipart/form-data">
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"> Name </label> 
                      
                      <div class="col-md-6">
                          
                          <input value="<?php echo $admin_name; ?>" name="admin_name" type="text" class="form-control" required>
                          
                      </div>
                       
                   </div>
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"> E-mail </label> 
                      
                      <div class="col-md-6">
                          
                          <input value="<?php echo $admin_email; ?>"  name="admin_email" type="text" class="form-control" required>
                          
                      </div>
                       
                   </div>
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"> Password </label> 
                      
                      <div class="col-md-6">
                          
                          <input value="<?php echo $admin_pass; ?>"  name="admin_pass" type="text" class="form-control" required>
                          
                      </div>
                       
                   </div>
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"> Contact </label> 
                      
                      <div class="col-md-6">
                          
                          <input value="<?php echo $admin_contact; ?>"  name="admin_contact" type="text" class="form-control" required>
                          
                      </div>
                       
                   </div>
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"> Image </label> 
                      
                      <div class="col-md-6">
                          
                          <input name="admin_image" type="file" class="form-control" required>
                          
                          <img src="admin_images/<?php echo $admin_image; ?>" alt="<?php echo $admin_name; ?>" width="70" height="70">
                          
                      </div>
                       
                   </div>
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"> About </label> 
                      
                      <div class="col-md-6">
                          
                          <textarea  name="admin_about" class="form-control" rows="3"> <?php echo $admin_about; ?></textarea>
                          
                      </div>
                       
                   </div>
                   
                   <div class="form-group">
                       
                      <label class="col-md-3 control-label"></label> 
                      
                      <div class="col-md-6">
                          
                          <input name="update" value="Update admin" type="submit" class="btn btn-primary form-control">
                          
                      </div>
                       
                   </div>
                   
               </form>
               
           </div>
            
        </div>
        
    </div>
    
</div>



<?php 

if(isset($_POST['update'])){
    
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_pass = $_POST['admin_pass'];
    $admin_contact = $_POST['admin_contact'];
    $admin_about = $_POST['admin_about'];
    
    $admin_image = $_FILES['admin_image']['name'];
    $temp_admin_image = $_FILES['admin_image']['tmp_name'];
    
    move_uploaded_file($temp_admin_image,"admin_images/$admin_image");
    
    $update_admin = "update admins set admin_name='$admin_name',admin_email='$admin_email',admin_pass='$admin_pass',admin_contact='$admin_contact',admin_about='$admin_about',admin_image='$admin_image' where admin_id='$admin_id'";
    
    $run_admin = mysqli_query($con,$update_admin);
    
    if($run_admin){
        
        echo "<script>alert('admin has been updated sucessfully')</script>";
        echo "<script>window.open('login.php','_self')</script>";
        
        session_destroy();
        
    }
    
}

?>


<?php } ?>