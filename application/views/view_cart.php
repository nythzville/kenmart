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
                    Cart
                    <small>
                        Listing of all ordered products
                    </small>
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Ordered Products <?=isset($ordered_items[0]->code)? '| Order Code [ '.$ordered_items[0]->code.' ]': ''; ?><small></small></h2>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                        <form action="<?=base_url('/orders/to_pending') ?>" method="post">
                                            <input type="hidden" name="order_id" value="<?=isset($ordered_items[0]->order_id)? $ordered_items[0]->order_id: ''; ?>">
                                            <?php if(isset($ordered_items[0]->order_id)){ ?>
                                            <button type="submit" name="checkout" id="checkout" class="btn btn-success">Checkout Order</button>
                                            <?php } ?>
                                        </form>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>    
                                </div>
                                <div class="x_content">
                                <?php //var_dump($products); ?>
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    Item ID
                                                </th>
                                                <th>SKU</th>
                                                <th>Product Name </th>
                                                <th>Decription</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $row_count = 0;
                                        $row_class = "even";

                                        if($products!=null){

                                            foreach ($products as $product) {
                                            $row_count++;
                                            if(($row_count%2)==0){
                                                $row_class = "even";

                                            }else{
                                                $row_class = "odd";
                                            }
                                            ?>
                                                <tr id="<?php echo $product->ID; ?>" class="<?php echo $row_class; ?> pointer">
                                                    <td class="a-center ">
                                                        <?php echo $product->product_id; ?>
                                                    </td>
                                                    <td class=" "><?php echo $product->sku; ?></td>
                                                    <td class=" "><?php echo $product->product_name; ?></td>
                                                    <td class=" "><?php echo $product->description; ?></td>
                                                    <td class=" ">
                                                    <input type="hidden" id="price-<?php echo $product->ID; ?>" value="<?=$product->price ?>">
                                                    <span id="price-view-<?php echo $product->ID; ?>">
                                                    <?php echo sprintf('%0.2f',($product->price)*$product->ordered_quantity); ?>
                                                    </span>
                                                    </td>
                                                    <td class=" ">
                                                    <input type="number" id="quantity-<?php echo $product->ID; ?>" class="quantity-input form-control col-md-1" value="<?php echo $product->ordered_quantity; ?>">
                                                    </td>
                                                    <td class=" last">
                                                    <button class="btn btn-sm minus-item">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                    <button class="btn btn-sm plus-item">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                    <button class="btn btn-sm remove-item">
                                                        <span class="fa fa-trash"></span>
                                                    </button>
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

                        <br />
                        <br />
                        <br />

                    </div>

                </div>

<?php
include 'includes/footer.php';
?>