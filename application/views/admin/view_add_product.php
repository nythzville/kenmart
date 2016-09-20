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
                            <h3><?php echo ($action=='edit')? 'Edit' : 'Add New' ?> Product</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#birthday').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>


                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><?php echo ($action=='edit')? 'Edit' : 'New' ?> Product Form <small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    
                                    <form class="form-horizontal form-label-left" method="post" action="<?php echo ($action=='edit')? base_url('admin/products/update') : base_url('admin/products/create') ?>">
                                        
                                        <div class="form-group">
                                            <input type="hidden" name="product_id" value="<?php echo isset($product->product_id)? $product->product_id : '' ?>">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">SKU</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" name="product_sku" value="<?php echo isset($product->sku)? $product->sku : '' ?>" class="form-control" placeholder="SKU">
                                            </div>
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12">Category</label>
                                            <div class="col-md-6 col-sm-9 col-xs-12">
                                                <select class="form-control" name="product_category">

                                                <?php
                                                foreach($categories as $category){
                                                    $product_cat = isset($product->cat_id)? $product->cat_id : '';
                                                    $cat_id = $category->cat_id;
                                                ?>
                                                    <option <?php echo ($cat_id == $product_cat)? 'selected' : '';?> value="<?php echo $category->cat_id; ?>"><?php echo $category->cat_name; ?></option>
                                                    
                                                <?php } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Product Name</label>
                                            <div class="col-md-10 col-sm-9 col-xs-12">
                                                <input type="text" name="product_name" class="form-control" value="<?php echo isset($product->product_name)? $product->product_name : '' ?>" placeholder="Product Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Quantity</label>
                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                <input type="text" name="product_quantity" value="<?php echo isset($product->quantity)? $product->quantity : '' ?>" class="form-control" placeholder="">
                                            </div>
                                            
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Minimum Quantity</label>
                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                <input type="text" name="min_quantity" value="<?php echo isset($product->min_quantity)? $product->min_quantity : '' ?>" class="form-control" placeholder="">
                                            </div>

                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Maximum Quantity</label>
                                            <div class="col-md-2 col-sm-9 col-xs-12">
                                                <input type="text" name="max_quantity" value="<?php echo isset($product->max_quantity)? $product->max_quantity : '' ?>" class="form-control" placeholder="">
                                            </div>

                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">Price</label>
                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                <input type="text" name="product_price" value="<?php echo isset($product->price)? $product->price : '' ?>" class="form-control" placeholder="Price in Peso">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12">Description 
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-9 col-xs-12">
                                                <textarea class="form-control" name="product_description" rows="4" placeholder='Description...'><?php echo isset($product->description)? $product->description : '' ?></textarea>
                                            </div>
                                        </div>
                                        

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <a href="<?php echo base_url('admin/products');?>"><button type="button" class="btn btn-primary">Cancel</button></a>
                                                <button type="submit" class="btn btn-success"><?php echo ($action=='edit')? 'Update' : 'Submit' ?></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /page content -->

<?php
include 'includes/footer.php';
?>