<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$meta = json_decode($user->meta_data);
// Get the header
include 'includes/header.php';
?>
<!-- page content -->
            <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Customer Profile</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>User Report <small>Activity report</small></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                                        <div class="profile_img">

                                            <!-- end of image cropping -->
                                            <div id="crop-avatar">
                                                <!-- Current avatar -->
                                                <div class="avatar-view" data-toggle="modal" data-target="#avatar-modal" title="Change the avatar">
                                                    <img src="<?php echo isset($meta->avatar)? base_url('uploads/'.$meta->avatar) : ''; ?>" alt="Avatar">
                                                </div>

                                                <!-- Cropping modal -->
                                                <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">

                                                            <?php echo isset($error) ? $error : '';?>

                                                            <?php echo form_open_multipart('customers/do_upload');?>
                                                            
                                                            <div class="modal-header">
                                                                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                                                                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="avatar-body">

                                                                        <!-- Upload image and data -->
                                                                        <div class="avatar-upload">
                                                                            <input class="avatar-src" name="avatar_src" type="hidden">
                                                                            <input class="avatar-data" name="avatar_data" type="hidden">
                                                                            <label for="avatarInput">Local upload</label>
                                                                            <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                                                        </div>

                                                                        <!-- Crop and preview -->
                                                                        <div class="row">
                                                                            <div class="col-md-23">
                                                                                <!-- <div class="avatar-wrapper"></div> -->
                                                                            </div>
                                                                            <!-- <div class="col-md-3">
                                                                                <div class="avatar-preview preview-lg"></div>
                                                                                <div class="avatar-preview preview-md"></div>
                                                                                <div class="avatar-preview preview-sm"></div>
                                                                            </div> -->
                                                                        </div>

                                                                        <div class="row avatar-btns">
                                                                            <!-- <div class="col-md-9">
                                                                                <div class="btn-group">
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                                                                </div>
                                                                                <div class="btn-group">
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                                                                    <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                                                                </div>
                                                                            </div> -->
                                                                            <div class="col-md-3">
                                                                                <input type="submit" class="btn btn-primary" type="submit" value="upload">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                  <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal -->

                                                <!-- Loading state -->
                                                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                                            </div>
                                            <!-- end of image cropping -->

                                        </div>
                                        <?php 

                                            
                                           
                                            ?>
                                        <h3><?php  
                                        if(isset($meta->firstname)&isset($meta->lastname)){
                                              echo   $meta->firstname.' '.$meta->lastname;
                                        }else{
                                            echo $_SESSION['logged_in']['username'];
                                        }?></h3>

                                        <ul class="list-unstyled user_data">
                                            
                                            <li><i class="fa fa-map-marker user-profile-icon"></i> <?=isset($location->full_address)? $location->full_address : ' No Address ' ?>
                                            </li>

                                            <li>
                                                <i class="fa fa-phone user-profile-icon"></i> <?=isset($meta->contact) ? $meta->contact : 'No contact' ; ?>
                                            </li>

                                            <li class="m-top-xs">
                                                <i class="fa fa-external-link user-profile-icon"></i>
                                                <a href="http://www.kimlabs.com/profile/" target="_blank"><?=$user->email? $user->email: ' None ' ?></a>
                                            </li>
                                        </ul>

                                        <a class="btn btn-success" data-toggle="modal" data-target="#profile-modal" ><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                        <br />

                                        

                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-12">

                                    
                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                                                </li>
                                                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">My Orders</a>
                                                </li>
                                                
                                            </ul>
                                            <div id="myTabContent" class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                                    <!-- start recent activity -->
                                                    <ul class="messages">
                                                        <?php
                                                        if($activity_logs){ 
                                                            foreach ($activity_logs as $log) {
                                                            
                                                                ?>
                                                            <li>
                                                                <img src="<?php echo isset($meta->avatar)? base_url('uploads/'.$meta->avatar) : ''; ?>" class="avatar" alt="Avatar">
                                                                <div class="message_date">
                                                                    <h3 class="date text-info"><?=date("j",strtotime($log->date_time)) ?></h3>
                                                                    <p class="month"><?=date("F",strtotime($log->date_time)) ?></p>
                                                                </div>
                                                                <div class="message_wrapper">
                                                                    <h4 class="heading"> <?=$log->activity ?></h4>
                                                                    <blockquote class="message"><?=$log->description ?>.</blockquote>
                                                                    <br />
                                                                    <p class="url">
                                                                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                                    </p>
                                                                </div>
                                                            </li>
                                                      
                                                        <?php   }
                                                            }
                                                        ?>
                                                    </ul>
                                                    <!-- end recent activity -->

                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                                    <!-- start user projects -->
                                                    <table class="data table table-striped no-margin">
                                                        <thead>
                                                            <tr>
                                                                <th>Code</th>
                                                                <th>Date Ordered</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            if($orders){
                                                                foreach ($orders as $order) {
                                                            ?>    
                                                            <tr>
                                                                <td><?=$order->code ?></td>
                                                                <td><?=date("F j, Y",strtotime($order->date_ordered)); ?></td>
                                                                <td><?=$order->status ?></td>
                                                                <td class="hidden-phone"></td>
                                                                <td class="vertical-align-mid">
                                                                    <div class="progress">
                                                                        <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php   }
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <!-- end user projects -->

                                                </div>
                                              
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Profile modal -->
                                    <div class="modal fade" id="profile-modal" aria-hidden="true" aria-labelledby="profile-modal-label" role="dialog" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form id="profile-form" action="<?=base_url('customers/save_profile'); ?>" method="post" class="form-horizontal form-label-left">
                                                    <div class="modal-header">
                                                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                                                        <h4 class="modal-title" id="avatar-modal-label">Edit Profile</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="firstname" id="firstname" value="<?=isset($meta->firstname)? $meta->firstname : ''; ?>" required="required" class="form-control col-md-7 col-xs-12" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="lastname" id="lastname" value="<?=isset($meta->lastname)? $meta->lastname : ''; ?>" name="lastname" required="required" class="form-control col-md-7 col-xs-12">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="middlename" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input name="middlename" id="middlename" value="<?=isset($meta->middlename)? $meta->middlename : ''; ?>" class="form-control col-md-7 col-xs-12" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <input id="contact" class="form-control col-md-7 col-xs-12" value="<?=isset($meta->contact)? $meta->contact : ''; ?>" type="text" name="contact">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                                                        <button type="submit" name="save-profile" class="btn btn-success" type="button">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
include 'includes/footer.php';
?>