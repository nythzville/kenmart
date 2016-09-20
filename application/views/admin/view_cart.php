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

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Ordered Products<small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php //var_dump($products); ?>
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
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
                                                <tr class="<?php echo $row_class; ?> pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="tableflat">
                                                    </td>
                                                    <td class=" "><?php echo $product->sku; ?></td>
                                                    <td class=" "><?php echo $product->product_name; ?></td>
                                                    <td class=" "><?php echo $product->description; ?></td>
                                                    <td class=" ">Php <?php echo sprintf('%0.2f',$product->price); ?></i>
                                                    </td>
                                                    <td class=" "><?php echo $product->quantity; ?></td>
                                                    <td class=" last"><a href="#">View</a>
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