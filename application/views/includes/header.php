<?php $the_url = base_url();
$userdata = $this->session->get_userdata();
$user_id = 0;
if(isset($userdata['logged_in'])){
    $this->load->model('customers_model');
   $user_id = $userdata['logged_in']['id']; 
   $location = $this->customers_model->get_location($user_id);
   $ordered_items = $this->orders_model->get_ongoing_order($user_id);
}
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
    <link rel="stylesheet" type="text/css" href="<?php echo  $the_url; ?>/css/maps/jquery-jvectormap-2.0.1.css" />
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
        NProgress.start();
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
                    $role = $userdata['logged_in']['role'];

                    if($role=='Admin'){
                    ?>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    
                                </li>
                                <li><a><i class="fa fa-edit"></i> Products <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>products/add">Add New Product</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>products/">All Products</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>products/category/">Category</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-user"></i> Customer <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>customers/create">Add New Customer</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>customers/">All Customer</a>
                                        </li>
                                    </ul>
                                </li>
                               
                                <li><a><i class="fa fa-shopping-cart"></i> Orders <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url()?>orders/create/">Add Order</a>
                                        </li>
                                        <li><a href="<?php echo base_url()?>orders/">All Orders</a>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="menu_section">
                            <h3>Inventory</h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-barcode"></i> Stocks <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart"></i> Reports <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        

                                    </ul>
                                </li>
                                
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                    <?php }else{ ?>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    
                                </li>
                                <li><a href="<?php echo base_url('/products'); ?>">
                                    <i class="fa fa-cube"></i> Products </a>
                                    
                                </li>
                                <li><a href="<?php echo base_url()?>customers/profile/">
                                <i class="fa fa-user"></i> My Profile</a>
                                    
                                </li>
                                
                                <li><a><i class="fa fa-shopping-cart"></i> My Orders <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('orders/cart'); ?>"> My Cart</a>
                                        </li>
                                        <li><a href="<?php echo base_url('/orders'); ?>"> All Orders</a>
                                        </li>
                                    </ul>
                                
                                </li>
                                <li><a href="<?php echo base_url('/location'); ?>"><i class="fa fa-map-marker"></i> My Location</a>
                                    
                                </li>
                                
                            </ul>
                        </div>
                        

                    </div>
                    <!-- /sidebar menu -->

                    <?php } ?>

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a href="<?php echo base_url('customers/profile'); ?>" data-toggle="tooltip" data-placement="top" title="Profile">
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

                        <?php 
                        if(isset($user->meta_data)){
                            $meta = json_decode($user->meta_data);   
                        }
                        
                        ?>
                            <li class="">
                            
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    
                                    <img src="<?= isset($meta->avatar) ? base_url('uploads/'.$meta->avatar) : '' ; ?>" alt="">
                                    <?php

                                    echo $_SESSION['logged_in']['username']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo base_url('customers/profile'); ?>">  Profile</a>
                                    </li>
                                    
                                   
                                    <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            <?php if((!isset($location))||($location==false)){ ?>
                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-map-marker"></i>
                                    <span id="order-item-count" class="badge bg-red">1</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                                <i class="fa fa-map"></i>
                                            </span>
                                            <span>
                                                <span>Location Needed!</span>
                                            
                                            </span>
                                            <span class="message">
                                                We Need your location for order delivery
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>
                            <li role="presentation" class="dropdown">
                         
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span id="order-item-count" class="badge bg-green"><?php echo $ordered_items!=false? count($ordered_items): '0' ; ?></span>
                                </a>

                                
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                <?php
                                if($ordered_items){ 
                                foreach ($ordered_items as $product) {
                                ?>
                                    <li>
                                        <a>
                                            <span class="image">
                                                <i class="fa fa-cube"></i>
                                            </span>
                                            <span>
                                                <span><?=$product->product_name ?></span>
                                            
                                            </span>
                                            <span class="message">
                                             <?=$product->description ?>
                                            </span>
                                        </a>
                                    </li>

                                    <?php } }else{
                                        echo '<li>No Ordered Item</li>';
                                        } ?>
                                
                                        <div class="text-center">
                                            <a href="<?php echo base_url('orders/cart'); ?>">
                                                <strong>Go to Cart</strong>
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