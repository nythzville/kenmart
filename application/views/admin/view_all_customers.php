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
                    Customers
                    <small>
                        Listing of all customers
                    </small>
                </h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Shop customers<small></small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php 
                                if($this->session->flashdata('customer_added') ==true){ ?>

                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        new PNotify({
                                            title: 'Adding Customer Success',
                                            text: 'The customer is added!',
                                            type: 'success'
                                        });
                                    });
                                    
                                </script>
                                <?php } ?>

                                 <?php 
                                //$this->session->flashdata('item');
                                if($this->session->flashdata('customer_deleted') ==true){ ?>

                                <script type="text/javascript">
                                
                                    $(document).ready(function(){
                                        new PNotify({
                                            title: 'Adding Success',
                                            text: 'The Customer has been Deleted!',
                                            type: 'success'
                                        });
                                    });
                                    
                                </script>
                                <?php } ?>
                                    <table class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                
                                                <th>Username </th>
                                                <th>Customer Name </th>
                                                <th>Email</th>
                                                <th>Address</th>
                                               <!--  <th class=" no-link last"><span class="nobr">Action</span>
                                                </th> -->
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $row_count = 0;
                                        $row_class = "even";
                                        foreach ($customers as $customer) {
                                        $row_count++;
                                        if(($row_count%2)==0){
                                            $row_class = "even";

                                        }else{
                                            $row_class = "odd";
                                        }
                                        ?>
                                            <tr id="<?php echo $customer->user_id; ?>" class="<?php echo $row_class; ?> pointer">
                                                
                                                <td><?=$customer->username ?></td>
                                                <td class=" ">
                                                <?php $customer_data = json_decode($customer->meta_data);
                                                if (!empty($customer_data)): ?>
                                                <?php echo $customer_data->firstname? $customer_data->firstname.' '.$customer_data->lastname : ''; ?></td>
                                                
                                                <?php endif; ?>
                                                </td>
                                                
                                                <td><?=$customer->email ?></td>
                                                <td>
                                                <?=isset($customer->full_address)? $customer->full_address: ''  ?></td>
                                                <td class=" last">
                                                     <!-- <a href="<?php echo base_url("admin/customer/$customer->user_id/edit/"); ?>"><button title="Edit" class="btn">
                                                    <i class="fa fa-edit"></i></button></a>
 -->

                                                    <button data-toggle="modal" data-target="#delete-modal" title="Detele" class="btn delete-customer"><i class="fa fa-trash"></i></button> 
                                                </td>
                                                
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />
                        <script type="text/javascript">
                        $(document).ready(function(){
                           $('.delete-customer').click(function(){
                                
                                

                                var userid = $(this).closest('tr').attr('id');
                                console.log(userid);
                                $('input#user_id').val(userid);
                            });
                        });
                            
                        </script>

                        <!-- Deleting modal -->
                        <div class="modal fade" id="delete-modal" aria-hidden="true" aria-labelledby="delete-modal-label" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-xs ">

                                <div class="modal-content" style="margin-top: 200px;">
                                    <!-- Modal content-->
                                    <div class="modal-body" >
                                        <form class="form-horizontal form-label-left" action="<?php echo base_url('admin/customers/delete')?>" method="post">
                                        <input type="hidden" name="user_id" id="user_id">
                                        <p style="text-align: center; ">Are you Really want to Delete this customer?<br/>
                                        <br/>
                                        <br/>
                                        <br/>
                                        <button type="submit" class="btn btn-success"> Yes </button>
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