<!--|
| Copyright ? 2015 by Esolz Technologies
| Author :  amit.kumar.shaw@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  User.
|-->

<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                         Edit User
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="edit_user" name="edit_user"  method="post" action="<?php echo site_url("control").'/user/update/'.$this->uri->segment(4) ;?>" enctype="multipart/form-data">
                                    <div class="form-group ">
                                        <label for="name" class="control-label col-lg-3">Name</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="name" name="name" value="<?php echo $userdata[0]->name;?>" type="text" />
                                        </div>
                                    </div>
				    
				     <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="email" name="email" value="<?php echo $userdata[0]->email;?>" type="text" />
					     <div class="error_fname" id="error_email" style="color: #B94A48;"></div>
                                        </div>
                                    </div>

                                    
                                    
                                   <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">:</label>
                                        <div class="col-lg-6">
                                            <?php if($userdata[0]->picture!='') {?>
						<a href="<?php echo site_url()?>user_images/<?php echo $userdata[0]->picture; ?>" target="_blank">
							<img src="<?php echo base_url().'user_images/'.$userdata[0]->picture;?>" height="50" width="50">
						</a>
		                         <?php } ?>
					 
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="image" class="control-label col-lg-3">Image</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="image" name="image" value="" type="file" accept="image/*" />
					    
                                        </div>
                                    </div>
				    
				<div class="form-group">
                                        <label for="address" class="control-label col-lg-3">Address</label>
                                        <div class="col-lg-6">
                                           <textarea class="form-control " id="address" name="address"><?php echo $userdata[0]->address;?></textarea>
				    </div>
				</div>

				    
				    <div class="form-group">
                                        <label for="company" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                              <input class=" form-control" id="company" name="company" value="<?php echo $userdata[0]->company;?>" type="text" />
                                        </div></div>
				    
				    <div class="form-group">
                                        <label for="work_address" class="control-label col-lg-3">Work Address</label>
                                        <div class="col-lg-6">
                                           <textarea class="form-control " id="work_address" name="work_address"><?php echo $userdata[0]->work_address;?></textarea>
				    </div></div>
				 <div class="form-group">
                                        <label for="billing_address" class="control-label col-lg-3">Billing Address</label>
                                        <div class="col-lg-6">
                                           <textarea class="form-control " id="billing_address" name="billing_address"><?php echo $userdata[0]->billing_address;?></textarea>
				    </div></div>
				    <div class="form-group">
                                        <label for="phone" class="control-label col-lg-3">Phone</label>
                                        <div class="col-lg-6">
                                              <input class=" form-control" id="phone" name="phone" value="<?php echo $userdata[0]->phone;?>" type="text" />
                                        </div></div>

				    
				    <div class="form-group ">
                                        <label for="status" class="control-label col-lg-3">Status:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 300px" id="status" name="status">
							
								<option <?php if($userdata[0]->status=="Y"){echo "selected";}?> value="Y"  >Active</option>
								<option <?php if($userdata[0]->status=="N"){echo "selected";}?> value="N"  >Inactive</option>
							
                                        	</select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/user';">Cancel</button>
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
<script>
$(document).ready(function(){
    $("#email").blur(function(){
    var a=$("#email").val();
	//alert(a);
        $.ajax({
		type: "POST",
		data: {'b':a},
		url: "ajax/emailaction.php",
		success: function(result){
			//alert(result);
            		$("#error_email").html(result);
        	}
	});
    });
});
</script>
