<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                
                <i class="fa fa-dashboard"></i> Dashboard / View Admins
                
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">
               
                   <i class="fa fa-tags"></i>  View Admins
                
               </h3> 
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        
                        <thead>
                            <tr>
                                <th> No: </th>
                                <th> Admin Name: </th>
                                <th> Admin Image: </th>
                                <th> Admin E-Mail: </th>
                                <th> Admin Contact: </th>
                                <th> Edit: </th>
                                <th> Delete: </th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php 
          
                                $i=0;
                            
                                $get_admins = "select * from admins";
                                
                                $run_admins = mysqli_query($con,$get_admins);
          
                                while($row_admins=mysqli_fetch_array($run_admins)){
                                    
                                    $admin_id = $row_admins['admin_id'];
                                    
                                    $admin_name = $row_admins['admin_name'];
                                    
                                    $admin_img = $row_admins['admin_image'];
                                    
                                    $admin_email = $row_admins['admin_email'];
                                    
                                    $admin_contact = $row_admins['admin_contact'];
                                    
                                    $i++;
                            
                            ?>
                            
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $admin_name; ?> </td>
                                <td> <img src="../admin_area/admin_images/<?php echo $admin_img; ?>" width="60" height="60"></td>
                                <td> <?php echo $admin_email; ?> </td>
                                <td> <?php echo $admin_contact ?> </td>
                                <td>    
                                     
                                     <a href="index.php?admin_profile=<?php echo $admin_id; ?>">
                                     
                                        <i class="fa fa-pencil"></i> Edit
                                    
                                     </a> 
                                     
                                </td>
                                <td> 
                                     
                                     <a href="index.php?delete_admin=<?php echo $admin_id; ?>">
                                     
                                        <i class="fa fa-trash-o"></i> Delete
                                    
                                     </a> 
                                     
                                </td>
                            </tr>
                            
                            <?php } ?>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</div>

<?php } ?>