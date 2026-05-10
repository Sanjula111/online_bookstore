<?php 
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
?> 
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-exl-collapse">
            <span class="sr-only">Toggle Navigation
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </button>
        <a href="index.php?dashboard" class="navbar-brand">Admin Area</a>
    </div>

    <ul class="nav navbar-right top-nav">
        <li class="dropdown">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> <?php echo $admin_name ?> <b class="caret"></b>
            </a>

            <ul class="dropdown-menu">
                <li>
                    <a href="index.php?admin_profile=<?php echo $admin_id; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="index.php?view_products"><i class="fa fa-fw fa-envelope"></i> Products</a>
                </li>
                <li>
                    <a href="index.php?view_customers"><i class="fa fa-fw fa-user"></i> Customers</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-exl-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php?dashboard">
                <i class="fa fa-fw fa-dashboard"></i>Dashboard</a>
            </li>

            <li>
                <a href="#" data-toggle="collapse" data-target="#products">
                <i class="fa fa-fw fa-tag"></i>Products
                <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="products" class="collapse">
                    <li><a href="index.php?insert_products">Insert Product</a></li>
                    <li><a href="index.php?view_products">View Products</a></li>
                </ul>
            </li>

            <li>
                <a href="index.php?view_customers"><i class="fa fa-fw fa-users"></i> View Customers</a>
            </li>
            <li>
                <a href="index.php?view_orders"><i class="fa fa-fw fa-pencil"></i>View all Orders</a>
            </li>
            <li>
                <a href="index.php?view_payments"><i class="fa fa-fw fa-pencil"></i>View Confirmed Orders</a>
            </li>
            <li>
                <a href="index.php?customer_messages"><i class="fa fa-fw fa-envelope"></i> Customer Messages</a>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#users">
                        <i class="fa fa-fw fa-users"></i> Admins
                        <i class="fa fa-fw fa-caret-down"></i>
                        
                </a>
                <ul id="users" class="collapse">
                    <li>
                        <a href="index.php?insert_admin"> Insert Admins </a>
                    </li>
                    <li>
                        <a href="index.php?view_admin"> View Admins </a>
                    </li>
                    <li>
                        <a href="index.php?admin_profile=<?php echo $admin_id; ?>"> Edit Admin Profile </a>
                    </li>
                </ul>  
            </li>
            <li>
                <a href="./logout.php"><i class="fa fa-fw fa-power-off"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<?php }  ?>