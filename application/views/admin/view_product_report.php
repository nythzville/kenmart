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
                    Products
                    <small>
                        Listing of all products
                    </small>
                </h3>
                        </div>

                        <div class="title_right">
                           
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Inventory Products<small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                
                                <?php 
                                //$this->session->flashdata('item');
                                if($this->session->flashdata('item_added') ==true){ ?>

                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        new PNotify({
                                            title: 'Adding Success',
                                            text: 'The product is added to your Inventory!',
                                            type: 'success'
                                        });
                                    });
                                    
                                </script>
                                <?php }elseif($this->session->flashdata('item_updated') ==true){ ?>
                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        new PNotify({
                                            title: 'Updating Success',
                                            text: 'The product is updated in your Inventory!',
                                            type: 'success'
                                        });
                                    });
                                    
                                </script>
                                <?php }elseif($this->session->flashdata('item_deleted') ==true){ ?>
                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        new PNotify({
                                            title: 'Deleting Product Success',
                                            text: 'The product is removed in your Inventory!',
                                            type: 'success'
                                        });
                                    });
                                    
                                </script>
                                <?php  } ?>

                                <?php //var_dump($products); ?>
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                
                                                <th>SKU</th>
                                                <th>Product Name </th>
                                                <th>Category</th>
                                                <th>Min-Max</th>
                                                <th>Quantity</th>
                                                <th>Percentage</th>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $row_count = 0;
                                        $row_class = "even";

                                        // load the list of erdered items

                                        if($products!=null){

                                            foreach ($products as $product) {
                                            $row_count++;
                                            if(($row_count%2)==0){
                                                $row_class = "even";

                                            }else{
                                                $row_class = "odd";
                                            }
                                            ?>
                                                <tr class="<?php echo $row_class; ?> pointer">
                                                    
                                                    <td class=""><?php echo $product->sku; ?></td>
                                                    <td class=""><?php echo $product->product_name; ?></td>
                                                    <td class=""><?php echo $product->cat_name; ?></td>
                                                    <td class=""><?php echo $product->min_quantity.' - '.$product->max_quantity; ?></td>
                                                    <td class=""><?php echo $product->quantity; ?></td>
                                                    <td class=""><?php
                                                    $val1 = $product->quantity;
                                                    $val2 = $product->max_quantity;
                                                    if($val1>0){
                                                       $percentage = 0;
                                                        $percentage = (floatval($val1) / floatval($val2)) * 100;
                                                        echo sprintf('%0.2f',$percentage); 
                                                    }else{
                                                        echo '0';
                                                    }
                                                    
                                                    ?></td>
                                                 
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

                </div>

<?php
include 'includes/footer.php';
?>