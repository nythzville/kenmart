<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Get the header
include 'includes/header.php';
?>
            <!-- page content -->
            <div class="right_col" role="main">

                <!-- top tiles -->
                <div class="row tile_count">
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-user"></i> Total Customers</span>
                            <div class="count green"><?=$total_customers ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-shopping-cart"></i> Pending Orders</span>
                            <div class="count red"><?=$total_pending_orders ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-shopping-cart"></i> Order On Delivery</span>
                            <div class="count"><?=$total_ondelivery_orders ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-shopping-cart"></i> Delivered Orders</span>
                            <div class="count"><?=$total_delivered_orders ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-shopping-cart"></i> Total Items</span>
                            <div class="count"><?=$total_products ?></div>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-shopping-cart"></i> Total Items Ordered</span>
                            <div class="count green"><?=$total_ordered_items ?></div>
                        </div>
                    </div>
                    

                </div>
                <!-- /top tiles -->

               
                <br />

                <div class="row">


                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="x_panel tile fixed_height_320">
                            <div class="x_title">
                                <h2>Low Quantity Stocks</h2>
                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <h4>Product Names</h4>
                                <?php
                                $count = 0;
                                foreach ($product_quantities as $quantity) {
                                    $actual_quantity = $quantity->quantity;
                                    $maximum = $quantity->max_quantity;
                                    $percentage = ($actual_quantity/$maximum)*100;

                                    $color = 'bg-green';
                                    if($percentage<10){
                                        $color = 'progress-bar-danger';
                                    }elseif($percentage<20){
                                        $color = 'progress-bar-warning';
                                    }elseif($percentage<70){
                                        $color = 'progress-bar-info';
                                    }


                                    if($count >=5){
                                        break;
                                    }
                                    
                                    $count++;
                                ?>
                                <div class="widget_summary">
                                    <div class="w_left w_25">
                                        <span><?=$quantity->product_name ?></span>
                                    </div>
                                    <div class="w_center w_55">
                                        <div class="progress">
                                            <div class="progress-bar <?=$color ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage ?>%;">
                                                <span class="sr-only">1% Stocks</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w_right w_20">
                                        <span><?=$quantity->quantity ?></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h2> Stock Categories </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <table class="" style="width:100%">
                                    <tr>
                                        <th style="width:37%;">
                                            <p>Top 5</p>
                                        </th>
                                        <th>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <p class="">Categories</p>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <p class="">Progress</p>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                        </td>
                                        <td>
                                            <table class="tile_info">
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square blue"></i>Cosmetics </p>
                                                    </td>
                                                    <td>30%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square green"></i>Food </p>
                                                    </td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square purple"></i>Health Care </p>
                                                    </td>
                                                    <td>20%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square aero"></i>Gadget </p>
                                                    </td>
                                                    <td>15%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square red"></i>Others </p>
                                                    </td>
                                                    <td>30%</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

<?php
include 'includes/footer.php';

?>