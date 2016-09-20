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
                        Listing of all orders
                    </small>
                </h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2> Orders<small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                <?php 

                                if($this->session->flashdata('order_checkedout') ==true){ ?>

                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        new PNotify({
                                            title: 'Checkout Success',
                                            text: 'Your order is on Pending status!',
                                            type: 'success'
                                        });
                                    });
                                    
                                </script>
                                <?php } ?>
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>Order ID</th>
                                                <th>Code</th>
                                                <th>Date Ordered</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                              <?php
                                        $row_count = 0;
                                        $row_class = "even";

                                        if($orders!=null){

                                            foreach ($orders as $order) {
                                            $row_count++;
                                            if(($row_count%2)==0){
                                                $row_class = "even";

                                            }else{
                                                $row_class = "odd";
                                            }
                                            ?>
                                                <tr id="<?php echo $order->order_id; ?>" class="<?php echo $row_class; ?> pointer order-row <?=($order->status=='ongoing')? 'selected':''; ?>">
                                                    
                                                    <td class=" "><?php echo $order->order_id; ?></td>
                                                    <td class=" "><?php echo $order->code; ?></td>
                                                    <td class=" "><?php echo date("F j, Y",strtotime($order->date_ordered)); ?></td>
                                                    <td class=" "><?php echo strtoupper($order->status); ?></td>
                                                    
                                                </tr>


                                            <?php } 
                                            }
                                            ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-4 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">

                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        
                                       <table id="product-list" class="table table-striped">
                                            <thead>
                                                <tr class="headings">
                                                    
                                                    <th>Item Code</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody>

                                            </tbody>

                                        </table>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />








                    </div>

                </div>

<?php
include 'includes/footer.php';
?>