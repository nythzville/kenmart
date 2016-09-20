<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Get the header
include 'includes/header.php';
?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                            orders
                            <small>
                            Listing of all Pending orders
                            </small>
                        </h3>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2> Orders<small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="<?=base_url('admin/locations') ?>" class="btn btn-success"><i class="fa fa-map-marker"></i> View Order Locations</a>
                                        </li>
                                        
                                        
                                    </ul>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php
                                if(($this->session->flashdata('not_enough_stock')!=null) & $this->session->flashdata('not_enough_stock') ==true){ ?>

                                    <script type="text/javascript">
                                    
                                        $(document).ready(function(){
                                            new PNotify({
                                                title:'Not Enough Stocks',
                                                text: 'Number of items in stock is not enough!',
                                                type: 'error'
                                            });
                                        });
                                        
                                    </script> 
                                <?php } ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php //var_dump($orders); ?>
                                        <table id="ordertable" class="table table-striped">
                                            <thead>
                                                <tr class="headings">
                                                    
                                                    <th>Order Code</th>
                                                    <th>Date ordered</th>
                                                    <th>Customer Name</th>
                                                    <th>STATUS</th>
                                                    <th class=" no-link last"><span class="nobr">Distance</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            
                                                  <?php
                                            $row_count = 0;
                                            $row_class = "even";

                                            if($pending_orders!=null){

                                                foreach ($pending_orders as $order) {
                                                $row_count++;
                                                if(($row_count%2)==0){
                                                    $row_class = "even";

                                                }else{
                                                    $row_class = "odd";
                                                }
                                                $meta  = json_decode($order->meta_data);
                                                ?>
                                                    
                                                    <tr id="<?php echo $order->order_id; ?>" class="<?php echo $row_class; ?> pointer pending-order-row" style="cursor: pointer;">
                                                        
                                                        <td class=" "><?php echo $order->code; ?></td>
                                                        <td class=" "><?php echo date("F j, Y ",strtotime($order->date_ordered)); ?></td>
                                                        <td class=" "><?php echo isset($meta->firstname) ? $meta->firstname.' '.$meta->lastname : $order->username; ?></td>
                                                        <td class=" "><?php echo strtoupper($order->status); ?></td>
                                                        <td>
                                                        <!-- <a href="http://localhost/online-selling/admin/orders/todelivery/<?php echo $order->order_id; ?>" title="Approve" class="btn btn-sm plus-item"><span class="fa fa-truck"></span></a> -->
                                                        <?php echo $order->distance; ?>
                                                       
                                                        </td>
                                                    </tr>


                                                <?php } 
                                                }
                                                ?>

                                            </tbody>

                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">

                                    <div id="order-info" class="col-md-12 col-sm-12 col-xs-12">

                                        
                                        <br>

                                    
                                    </div>
                                </div>
                            </div>

                            <div class="x_panel">
                                <div class="x_content">

                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        
                                       <table id="product-list" class="table table-striped">
                                            <thead>
                                                <tr class="headings">
                                                    
                                                    <th>Item Code</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>

                                            </tbody>

                                        </table>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

<?php
include 'includes/footer.php';
?>