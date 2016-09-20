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
                    Shop
                    <small>
                        Listing of all products
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
                                
                                <div class="x_content">
                                <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                                            <ul class="pagination pagination-split">
                                                <li><a href="#">A</a>
                                                </li>
                                                <li><a href="#">B</a>
                                                </li>
                                                <li><a href="#">C</a>
                                                </li>
                                                <li><a href="#">D</a>
                                                </li>
                                                <li><a href="#">E</a>
                                                </li>
                                                <li>...</li>
                                                <li><a href="#">W</a>
                                                </li>
                                                <li><a href="#">X</a>
                                                </li>
                                                <li><a href="#">Y</a>
                                                </li>
                                                <li><a href="#">Z</a>
                                                </li>
                                            </ul>
                                        </div>
                                <?php  foreach ($products as $product) {
                                ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                                        <div class="well profile_view">
                                            <div class="col-sm-12">
                                                <h4 class="brief"><i><?=$product->cat_name ?></i></h4>
                                                <div class="left col-xs-7">
                                                    <h2><?=$product->product_name ?></h2>
                                                    <p><strong>Description: </strong><?=$product->description ?></p>
                                                    <ul class="list-unstyled">
                                                        <li><i class="fa check-square-o"></i>In Stock </li>

                                                    </ul>
                                                </div>
                                                <div class="right col-xs-5 text-center">
                                                    <i class="img-circle img-responsive fa fa-cube">
                                                        </i>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 bottom text-center">
                                                <div class="col-xs-12 col-sm-6 emphasis">
                                                    <button id="<?=$product->product_id ?>" type="button" class="add_to_cart btn btn-success btn-xs"> <i class="fa fa-shopping-cart">
                                                        </i> Add to Cart </button>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 emphasis">
                                                    
                                                    <button id="<?=$product->product_id ?>" type="button" class="btn btn-primary btn-xs"> <i class="fa fa-eye">
                                                        </i> View Product </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php } ?>
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