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
                    Product Categories
                    <small>
                        Listing of all product categories
                    </small>
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    Category List
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <?php 
                                    //$this->session->flashdata('item');
                                    if($this->session->flashdata('category_added') ==true){ ?>

                                    <script type="text/javascript">
                                    
                                        $(document).ready(function(){
                                            new PNotify({
                                                title: 'Adding Category Success',
                                                text: 'The product category is added!',
                                                type: 'success'
                                            });
                                        });
                                        
                                    </script>
                                    <?php }elseif(($this->session->flashdata('category_added')!=null)&($this->session->flashdata('category_added') ==false)){ ?>

                                    <script type="text/javascript">
                                    
                                        $(document).ready(function(){
                                            new PNotify({
                                                title: 'Adding Category Failed',
                                                text: 'The product category not added!',
                                                type: 'error'
                                            });
                                        });
                                        
                                    </script>
                                    <?php }elseif($this->session->flashdata('category_deleted')==true){ ?>

                                    <script type="text/javascript">
                                    
                                        $(document).ready(function(){
                                            new PNotify({
                                                title: 'Deleting Category Success',
                                                text: 'The product category is deleted!',
                                                type: 'success'
                                            });
                                        });
                                        
                                    </script>
                                    <?php } ?>
                                    <table class="table table-striped responsive-utilities">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                   ID
                                                </th>
                                                <th>Category Name</th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php 
                                        foreach ($categories as $category) {
                            
                                        ?>
                                            <tr class="even pointer">
                                               
                                                <td class=" "><?php echo $category->cat_id; ?></td>
                                                <td class=" "><?php echo $category->cat_name; ?></td>
                                                
                                                <td class=" last">
                                                    <a href="<?php echo base_url('admin/products/delete_category/'.$category->cat_id); ?>"><button class="btn"><i class="fa fa-trash"></i></button></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    Add Category
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url('admin/products/create_category'); ?>">
                                        
                                        <div class="form-group">
                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" name="cat_name" class="form-control" required="" placeholder="Category Name">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                
                                                <button type="submit" name="add_category" class="btn btn-success">Add Category</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

<?php
include 'includes/footer.php';
?>