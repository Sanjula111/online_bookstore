<?php 

if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                <i class="fa fa-dashboard"></i> Dashboard / View Confirmed Orders
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
                   <i class="fa fa-tags"></i> View Confirmed Orders
               </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> No: </th>
                                <th> Invoice No: </th>
                                <th> Name: </th>
                                <th> Email: </th>
                                <th> Mobile No: </th>
                                <th> Address: </th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
                            
                            <?php 
          
                                $i = 0;
                            
                                $get_c_orders = "SELECT * FROM order_confirm";
                                
                                $run_c_orders = mysqli_query($con, $get_c_orders);
          
                                while ($row_c_orders = mysqli_fetch_array($run_c_orders)) {
                                    
                                    // Check if the 'invoice_no' key exists
                                    $invoice_no = isset($row_c_orders['invoice_no']) ? $row_c_orders['invoice_no'] : 'N/A';
                                    $o_name = isset($row_c_orders['name']) ? $row_c_orders['name'] : 'N/A';
                                    $o_email = isset($row_c_orders['email']) ? $row_c_orders['email'] : 'N/A';
                                    $o_phoneno = isset($row_c_orders['phone_no']) ? $row_c_orders['phone_no'] : 'N/A';
                                    $o_address = isset($row_c_orders['address']) ? $row_c_orders['address'] : 'N/A';
                                    
                                    $i++;
                            ?>
                            
                            <tr><!-- tr begin -->
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $invoice_no; ?> </td>
                                <td> <?php echo $o_name; ?></td>
                                <td> <?php echo $o_email; ?> </td>
                                <td> <?php echo $o_phoneno; ?></td>
                                <td> <?php echo $o_address; ?> </td>
                            </tr><!-- tr finish -->
                            
                            <?php } ?>
                            
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

<?php } ?>
