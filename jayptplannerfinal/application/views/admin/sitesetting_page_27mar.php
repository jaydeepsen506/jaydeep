<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  site settings.
|-->
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<section id="main-content">
        <section class="wrapper">

		<?php
			//flash messages
			$flash_message=$this->session->flashdata('flash_message');
			if(isset($flash_message)){
		
			if($flash_message == 'site_updated')
			{
				echo '<div class="alert alert-success">';
				echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Site Settings has been successfully updated.';
				echo '</div>';
			
			}
			if($flash_message == 'site_not_updated'){
				echo'<div class="alert alert-error">';
				echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in updation. Please try again.';        
				echo'</div>';
		
			}
		
			if($flash_message == 'error'){
				echo'<div class="alert alert-error">';
				echo'<i class="icon-remove-sign"></i><strong>Error!</strong> . Please try again.';        
				echo'</div>';
		
			}
				
			}
		?>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Site Settings
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="siteSettings" method="post" action="<?php echo base_url(); ?>control/sitesetting/updt">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Site Name:</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="site_name" value="<?php echo $settings[0]['site_name']; ?>" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">System Email:</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="system_email" value="<?php echo $settings[0]['system_email']; ?>" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Records per page of Admin:</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="admin_pagination" value="<?php echo $settings[0]['admin_pagination']; ?>" type="text" />
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Records per page of Site:</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="site_pagination" value="<?php echo $settings[0]['site_pagination']; ?>" type="text" />
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Meta Keywords:</label>
                                        <div class="col-lg-4">
                                            <textarea class="form-control " id="meta_keywords" name="meta_keywords"><?php echo $settings[0]['meta_keywords']; ?></textarea>
                                        </div>
                                    </div>
				  
				   <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Meta Description:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="meta_description" name="meta_description"><?php echo $settings[0]['meta_description']; ?></textarea>
                                                <script>
							CKEDITOR.replace('meta_description');
						</script>
					
					</div>
                                    </div>


				    <!--<div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Trial Period For Commercial User A(In Months):</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control " id="trial_period_comA" name="trial_period_comA" value="<?php echo $settings[0]['trial_period_comA']; ?>" />
                                        </div>
                                    </div>
				    
				    
				   <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Trial Period For Commercial User B(In Months):</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control " id="trial_period_comB" name="trial_period_comB" value="<?php echo $settings[0]['trial_period_comB']; ?>" />
                                        </div>
                                    </div>

				    
				    
				    
				    
				    
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Discount for posting of(trial user)%:</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control " id="posting_fee" name="posting_fee" value="<?php echo $settings[0]['posting_fee']; ?>" />
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Percentage of transaction fee(trial user)%:</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="transaction_fee" name="transaction_fee" value="<?php echo $settings[0]['transaction_fee']; ?>" />
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/dashboard';">Cancel</button>
                                        </div>
                                    </div>
                                </form>

				
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>