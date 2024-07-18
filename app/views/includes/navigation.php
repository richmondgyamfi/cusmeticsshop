<?php
require APPROOT . '/views/includes/head.php';


$userid = $_SESSION['user_id'];
$username = $_SESSION['username'];
$name = $_SESSION['name'];
$grpid = $_SESSION['group_id'];
$gpname = $_SESSION['gname'];

switch ($data['page']) {
    case 'stocks':
        # code...
        $stocks = 'btn btn-sm btn-danger';
        break;
    case 'admin':
        # code...
        $admin = 'btn btn-sm btn-danger';
        break;
    case 'brands':
        # code...
        $brands = 'btn btn-sm btn-danger';
        break;
    case 'customers':
        # code...
        $customers = 'btn btn-sm btn-danger';
        break;
    case 'expenses':
        # code...
        $expenses = 'btn btn-sm btn-danger';
        break;
    case 'cashst':
        # code...
        $cashst = 'btn btn-sm btn-danger';
        break;
    case 'report':
        # code...
        $report = 'btn btn-sm btn-danger';
        break;
    case 'print_item':
        $printitem = 'btn btn-sm btn-danger';
        break;
    case 'check_attendance':
        # code...
        $attendance = 'btn btn-sm btn-danger';
        break;
    case 'allstocks':
        # code...
        $allstocks = 'btn btn-sm btn-danger';
        break;
    case 'stocks_stat':
        # code...
        $stocks_stat = 'btn btn-sm btn-danger';
        break;
    case 'sales':
        # code...
        $sales = 'btn btn-sm btn-danger';
        break;
    case 'suppliers':
        # code...
        $suppliers = 'btn btn-sm btn-danger';
        break;
    case 'barpage':
        # code...
        $barsell = 'btn btn-sm btn-danger';
        break;
    case 'users':
        # code...
        $users = 'btn btn-sm btn-danger';
        break;
    case 'delivery':
        # code...
        $delivery = 'btn btn-sm btn-danger';
        break;

    default:
        # code...
        break;
}
//die();
?>

<body class="blue lighten-5">

    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container-fluid">

                <a class="navbar-brand waves-effect" href="admin.php" style="font-size: 14px;" target="_blank">
                    <strong class="dark-text">A.K SONIA VENTURES</strong>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php if ($grpid == 1) : ?>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" 
                                data-target="#add_stock">Add Stock</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_supplier">Add Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_customer">Add Customer</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_user">Add User</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_expenditure">Add Expenditure</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#genStock">Generate Stock</a>
                            </li> -->
                        <?php elseif ($grpid == 2) : ?>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_supplier">Add Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_customer">Add Customer</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#add_expenditure">Add Expenditure</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-danger waves-effect" data-toggle="modal" data-target="#addpt">Add
                                Cattegory/Product</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <a type="button" class="nav-link btn btn-outline-danger btn-sm waves-effect" data-toggle="modal" data-target="#change_password">Reset Password</a>
                        <!-- <li class="nav-item dropdown">
              <a class="nav-link btn btn-outline-danger dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown" style="font-size: 12px;" aria-haspopup="true" aria-expanded="false">
                Welcome! <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <div class="dropdown-menu dropdown-danger text-center wow fadeIn" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" style="font-size: 12px;">Richmond Gyamfi Nketia</a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-key" aria-hidden="true"></i>
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-lock" aria-hidden="true"></i>
                </a>
              </div>
            </li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- # ************************************************************
# Developer Richmond Gyamfi Nketia 
# Year 2019
# Version 1.0
#
# https://www.comedigitalize.com
# https://github.com/richmondgyamfi
#
#
# ************************************************************ -->

        <div class="sidebar-fixed position-fixed overflow-auto">
            <hr>
            <div class="row waves-effect">
                <div class="col-md-4">
                    <img src="/public/img/avatar3.png" class="img-fluid float-left rounded" style="width: auto; height: 50px;" alt="">
                </div>
                <div class="col-md-8" style="font-size: 12px;">
                    <a><?php echo $name; ?></a><br>
                    <a><?php echo $gpname; ?></a><br>
                    <a><i class="fa fa-circle text-success text-center mr-2"></i>Online</a>
                </div>
            </div>

            <br>

            <div class="list-group list-group-flush">
                <?php if ($grpid == 1) : ?>
                    <a href="index.php" class="list-group-item <?php echo $admin; ?> list-group-item-action waves-effect">
                        <i class="fa fa-line-chart mr-3"></i>Dashboard
                    </a>
                    <a href="stock_statement.php" class="list-group-item <?php echo $stocks_stat; ?> list-group-item-action waves-effect">
                        <i class="fa fa-list mr-3"></i>Stock Statement
                    </a>
                    <a href="barcode.php" class="list-group-item <?php echo $barsell; ?> list-group-item-action waves-effect"><i class="fa fa-suitcase mr-3"></i>Sell Page Barcode
                    </a>
                    <a href="checkst.php" class="list-group-item <?php echo $stocks; ?> list-group-item-action waves-effect"><i class="fa fa-suitcase mr-3"></i>Stock Page
                    </a>
                    <a href="print_item.php" class="list-group-item <?php echo $printitem; ?> list-group-item-action waves-effect"><i class="fa fa-suitcase mr-3"></i>Print Page
                    </a>
                    <a href="checksale.php" class="list-group-item <?php echo $sales; ?> list-group-item-action waves-effect"><i class="fa fa-table mr-3"></i>View Sale List
                    </a>
                    <a href="delivery.php" class="list-group-item <?php echo $delivery; ?> list-group-item-action waves-effect"><i class="fa fa-truck mr-3"></i>View Due Deliveries</a>
                    <a href="checkbrand.php" class="list-group-item <?php echo $brands; ?> list-group-item-action waves-effect">
                        <i class="fa fa-list mr-3"></i>View Products List</a>
                    <a href="checksuppliers.php" class="list-group-item <?php echo $suppliers; ?> list-group-item-action waves-effect">
                        <i class="fa fa-cart-plus mr-3"></i>View Suppliers List</a>
                    <a href="checkusers.php" class="list-group-item <?php echo $users; ?> list-group-item-action waves-effect">
                        <i class="fa fa-users mr-3"></i>View Users List</a>
                    <a href="checkcustomers.php" class="list-group-item <?php echo $customers; ?> list-group-item-action waves-effect">
                        <i class="fa fa-shopping-cart mr-3"></i>View Customer List
                    </a>
                    <a href="checkexpenses.php" class="list-group-item <?php echo $expenses; ?> list-group-item-action waves-effect">
                        <i class="fa fa-shopping-cart mr-3"></i>Expenses Page
                    </a>
                    <a href="report_page.php" class="list-group-item <?php echo $report; ?> list-group-item-action waves-effect">
                        <i class="fa fa-list mr-3"></i>Report Page
                    </a>
                    <a href="check_attendance.php" class="list-group-item <?php echo $attendance; ?> list-group-item-action waves-effect">
                        <i class="fa fa-list mr-3"></i>Check Attendance
                    </a>
                    <a href="allstocks.php" class="list-group-item <?php echo $allstocks; ?> list-group-item-action waves-effect">
                        <i class="fa fa-list mr-3"></i>All Stocks
                    </a>
                <?php elseif ($grpid == 2) : ?>
                    <a href="barcode.php" class="list-group-item <?php echo $barsell; ?> list-group-item-action waves-effect"><i class="fa fa-suitcase mr-3"></i>Sell Page Barcode
                    </a>
                    <a href="index.php" class="list-group-item <?php echo $stocks; ?> list-group-item-action waves-effect"><i class="fa fa-suitcase mr-3"></i>Sell Page
                    </a>
                    <!-- <a href="stock_statement.php"
                    class="list-group-item <?php echo $stocks_stat; ?> list-group-item-action waves-effect">
                    <i class="fa fa-list mr-3"></i>Stock Statement
                </a> -->
                    <a href="print_item.php" class="list-group-item <?php echo $printitem; ?> list-group-item-action waves-effect"><i class="fa fa-suitcase mr-3"></i>Print Page
                    </a>
                    <a href="checksale.php" class="list-group-item <?php echo $sales; ?> list-group-item-action waves-effect"><i class="fa fa-table mr-3"></i>View Sale List
                    </a>
                    <a href="delivery.php" class="list-group-item <?php echo $delivery; ?> list-group-item-action waves-effect"><i class="fa fa-truck mr-3"></i>View Due Deliveries</a>
                    <a href="checkbrand.php" class="list-group-item <?php echo $brands; ?> list-group-item-action waves-effect">
                        <i class="fa fa-list mr-3"></i>View Product List</a>
                    <a href="checksuppliers.php" class="list-group-item <?php echo $suppliers; ?> list-group-item-action waves-effect">
                        <i class="fa fa-cart-plus mr-3"></i>View Suppliers List</a>
                    <a href="checkcustomers.php" class="list-group-item <?php echo $customers; ?> list-group-item-action waves-effect">
                        <i class="fa fa-shopping-cart mr-3"></i>View Customer List
                    </a>
                    <a href="checkexpenses.php" class="list-group-item <?php echo $expenses; ?> list-group-item-action waves-effect">
                        <i class="fa fa-shopping-cart mr-3"></i>Expenses Page
                    </a>
                <?php endif; ?>


                <a href="/users/logout.php" class="list-group-item list-group-item-action waves-effect"><i class="fa fa-lock mr-3"></i>Logout</a>
            </div>
        </div>

    </header>