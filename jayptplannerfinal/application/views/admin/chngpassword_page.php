<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for change passwords.
|--> 
<section id="main-content">
        <section class="wrapper">

		<?php
			//flash messages
			$flash_message=$this->session->flashdata('flash_message');
			if(isset($flash_message)){
		
			if($flash_message == 'pwd_updated')
			{
				echo '<div class="alert alert-success">';
				echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Password has been successfully updated.';
				echo '</div>';
			
			}
			if($flash_message == 'pwd_not_updated'){
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
                            Change Password
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="chngPass" method="post" action="<?php echo base_url(); ?>control/chngpassword/updt">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">New Password:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" type="password" name="npass" id="npass" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Confirm password:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" type="password" name="cpass" id="cpass" value="" />
                                        </div>
                                    </div>
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