<?php $the_url = base_url();
//session_start();
$this->load->model('orders_model');
$this->load->model('reports_model');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kenmart | </title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo  $the_url; ?>/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo  $the_url; ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo  $the_url; ?>/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo  $the_url; ?>/css/custom.css" rel="stylesheet">
   <!--  <link rel="stylesheet" type="text/css" href="<?php echo  $the_url; ?>/css/maps/jquery-jvectormap-2.0.1.css" /> -->
    <link href="<?php echo  $the_url; ?>/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo  $the_url; ?>/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  $the_url; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

    <script src="<?php echo  $the_url; ?>js/jquery.min.js"></script>
    <script src="<?php echo  $the_url; ?>js/nprogress.js"></script>
    <script src="http://www.google.com/jsapi"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3"></script>

     <!-- PNotify -->
    <script type="text/javascript" src="<?php echo  $the_url; ?>js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo  $the_url; ?>js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?php echo  $the_url; ?>js/notify/pnotify.nonblock.js"></script>
    
    <script>
        //NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<?php $userdata = $this->session->userdata();
?>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-shopping-cart"></i> <span>Kenmart</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $userdata['logged_in']['username'];
                            ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />
                    <?php
                    $role = $userdata['logged_in']['role']; ?>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a id="home-link" href="<?=base_url(); ?>admin/dashboard"><i class="fa fa-home"></i> Home </a>
                                    
                                </li>
                                <li><a><i class="fa fa-edit"></i> Products <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>admin/products/add">Add New Product</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>admin/products/">All Products</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>admin/products/category/">Category</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-user"></i> Customer <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>admin/customers/create">Add New Customer</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>admin/customers/">All Customer</a>
                                        </li>
                                    </ul>
                                </li>
                               
                                <li><a><i class="fa fa-shopping-cart"></i> Orders <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        
                                        <li><a href="<?php echo base_url()?>admin/orders/">All Orders</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>admin/orders/pending/">Pending Orders</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>admin/orders/ondelivery/">On Delivery Orders</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url()?>admin/locations"><i class="fa fa-map-marker"></i> Locations </a>
                                    
                                </li>
                                
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Inventory</h3>
                            <ul class="nav side-menu">
                                
                                <li><a><i class="fa fa-bar-chart"></i> Reports <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>admin/reports/products">Product Reports</a>
                                        </li>

                                    </ul>
                                </li>
                                
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                   
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Profile">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                      
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('auth/logout'); ?>">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">


                            <li class="">
                            
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <?php

                                    echo $_SESSION['logged_in']['username']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                   
                                    <li>
                                        <a href="<?php echo base_url('admin/orders/'); ?>" id="empty-cart">See All orders</a>
                                    </li>
                                    
                                    <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <?php $pending_orders = $this->orders_model->get_all_pending(5);

                                    //var_dump($ordered_items);

                                 ?>
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span id="order-item-count" class="badge bg-green"><?=$this->reports_model->get_num_pending_orders() ?></span>
                                </a>

                                
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                <?php
                                $count = 0;
                                if($pending_orders !=false){ 
                                foreach ($pending_orders as $order) {
                                    if($count>=5){
                                        break;

                                    }
                                    $count++;
                                ?>
                                    <li>
                                        <a>
                                            <span class="image">
                                                <i class="fa fa-cube"></i>
                                            </span>
                                            <span>
                                                <span><?=$order->username ?></span>
                                            
                                            </span>
                                            <span class="message">
                                             <?=date("F j, Y",strtotime($order->date_ordered)) ?>
                                            </span>
                                        </a>
                                    </li>

                                    <?php } }else{
                                        echo '<li>No Pending</li>';
                                        } ?>
                                
                                        <div class="text-center">
                                            <a href="<?php echo base_url('admin/orders/pending'); ?>">
                                                <strong>View All Pending Orders</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->