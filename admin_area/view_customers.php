<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Customers
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">
                   <i class="fa fa-tags"></i>  View Customers
               </h3>
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        
                        <thead>
                            <tr>
                                <th> No: </th>
                                <th> First Name: </th>
                                <th> Last Name: </th>
                                <th> Email: </th>
                                <th> Delete: </th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php 
                                $i=0;
                                $get_c = "select * from customers";
                                $run_c = mysqli_query($con,$get_c);
                                while($row_c=mysqli_fetch_array($run_c)){
                                    $c_id = $row_c['customer_id'];
                                    $c_fname = $row_c['customer_fname'];
                                    $c_lname = $row_c['customer_lname'];
                                    $c_email = $row_c['customer_email'];
                                    $i++;
                            ?>
                            
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $c_fname; ?> </td>
                                <td> <?php echo $c_lname; ?> </td>
                                <td> <?php echo $c_email ?> </td>
                                <td> 
                                     <a href="index.php?delete_customer=<?php echo $c_id; ?>">
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