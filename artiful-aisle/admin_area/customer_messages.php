<?php 
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
?> 


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / View Products
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title">
                   <i class="fa fa-tags"></i>  View Products
               </h3>
            </div>
            
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">  
                        <thead>
                            <tr>
                                <th> Message ID: </th>
                                <th> Name: </th>
                                <th> Email: </th>
                                <th> Messaage: </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $get_msg = "select * from customer_messages";
                                $run_msg = mysqli_query($con,$get_msg);
                                while($row_msg=mysqli_fetch_array($run_msg)){
                                    $msg_id = $row_msg['message_id'];
                                    $msg_name = $row_msg['name'];
                                    $msg_email = $row_msg['email'];
                                    $msg = $row_msg['message'];
                            ?>
                            <tr>
                                <td> <?php echo $msg_id; ?> </td>
                                <td> <?php echo $msg_name; ?> </td>
                                <td> <?php echo $msg_email; ?> </td>
                                <td> <?php echo $msg; ?> </td>
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