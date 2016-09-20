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
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>SKU</th>
                                                <th>Product Name </th>
                                                <th>Category</th>
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

                                        // load the list of erdered items
                                        $ordered_items = isset($_SESSION['order']['items'])? $_SESSION['order']['items']: false;

                                        if($products!=null){

                                            foreach ($products as $product) {
                                            $row_count++;
                                            if(($row_count%2)==0){
                                                $row_class = "even";

                                            }else{
                                                $row_class = "odd";
                                            }
                                            ?>
                                                <tr id="<?php echo $product->product_id; ?>" class="<?php echo $row_class; ?> pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="tableflat">
                                                    </td>
                                                    <td class=" "><?php echo $product->sku; ?></td>
                                                    <td class=" "><?php echo $product->product_name; ?></td>
                                                    <td class=" "><?php echo $product->cat_name; ?></td>
                                                    <td class=" "><?php echo $product->description; ?></td>
                                                    <td class=" ">Php <?php echo sprintf('%0.2f',$product->price); ?></i>
                                                    </td>
                                                    <td class=" ">
                                                    <span id="quantity-<?php echo $product->product_id; ?>"><?php echo $product->quantity; ?></span>
                                                    <input type="text" name="item-quantity-<?php echo $product->product_id; ?>" id="item-quantity-<?php echo $product->product_id; ?>" value="<?php echo $product->quantity; ?>" style="display: none; width: 50px; text-indent: 2px;">

                                                    </td>
                                                    <td class=" last">

                                                    <a href="<?php echo base_url("admin/products/$product->product_id/edit/"); ?>"><button title="Edit" class="btn">
                                                    <i class="fa fa-edit"></i></button></a>

                                                    <button title="Change Quantity" class="btn product-quanity-change"><i class="fa fa-arrows-v"></i></button>

                                                    <button data-toggle="modal" data-target="#delete-modal" title="Detele" class="btn product-delete"><i class="fa fa-trash"></i></button>
                                                    
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

                        <!-- Cropping modal -->
                        <div class="modal fade" id="edit-modal" aria-hidden="true" aria-labelledby="edit-modal-label" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2 class="modal-title">Edit Product</h2>
                                    </div>


                                    <!-- Modal content-->
                                    <div class="modal-body">
                                        <form class="form-horizontal form-label-left" action="" method="post">
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->

                        <!-- Deleting modal -->
                        <div class="modal fade" id="delete-modal" aria-hidden="true" aria-labelledby="delete-modal-label" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-xs ">

                                <div class="modal-content" style="margin-top: 200px;">
                                    <!-- Modal content-->
                                    <div class="modal-body" >
                                        <form class="form-horizontal form-label-left" action="<?php echo base_url('admin/products/delete')?>" method="post">
                                        <input type="hidden" name="product_id" id="product_id">
                                        <p style="text-align: center; ">This is a pop-up from solidgold.<br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <button type="submit" class="btn btn-default"> Connect with Us </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" > No </button>
                                        </p>
                                        

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->

                    </div>

                </div>

<?php
include 'includes/footer.php';
?>