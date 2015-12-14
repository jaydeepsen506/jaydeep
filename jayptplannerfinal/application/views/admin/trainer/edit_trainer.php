<!--|
| Copyright @ 2015 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  trainer details.
|-->
<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/ckeditor/ckeditor.js"></script>
<?php
$ci=&get_instance();
$ci->load->model('common_model');
$id=$this->uri->segment(4);
?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Updating Trainer Details
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="edittrainer" name="edittrainer"  method="post" action="<?php echo site_url("control").'/managetrainer/edit/'.$this->uri->segment(4) ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Name:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="trainer_name" name="trainer_name" value="<?php echo $page[0]['name']; ?>" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Email:</label>
                                           <div class="col-lg-6">
                                            <input onkeyup="username_check();" class=" form-control" id="trainer_email" name="trainer_email" value="<?php echo $page[0]['email']; ?>" type="text" />
                                            <div id="username_error"></div>
                                             <input type="hidden" id="u_hdn" name="u_hdn" value=''>
                                        </div>
                                     </div>
                                    <input type="hidden" name="h_user_name"  id="h_user_name" value="<?php echo $page[0]['email']; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Company:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="trainer_com" name="trainer_com" value="<?php echo $page[0]['company']; ?>" type="text" />
                                        </div>
                                    </div>
                                     <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Phone:</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="trainer_phn" name="trainer_phn" value="<?php echo $page[0]['phone']; ?>" type="text" />
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Billing Address:</label>
                                        <div class="col-lg-6">
						<textarea class="form-control" name="bil_address" id="bil_address"><?php echo $page[0]['billing_address']; ?></textarea>
                                         </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Number of Active Clients:</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                     <?php echo $page[0]['active_client']; ?>
                                                </p>
                                           </div>
                                     </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Number of Inactive Clients:</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                     <?php echo $page[0]['inactive_client']; ?>
                                                </p>
                                           </div>
                                     </div>
				    <?php
				    $network_arr=array();
				    foreach($network_list as $network)
				    {
					$where=array(
						'id' => $network['network_id']
						     );
					 $network_details= $ci->common_model->get('network',array('*'),$where);
					 array_push($network_arr,$network_details[0]['network_name']);
				    }
				    ?>
				   <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">List Of Networks:</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                     <?php echo implode(",",$network_arr); ?>
                                                </p>
                                           </div>
                                     </div>
                                     <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Work Address:</label>
                                        <div class="col-lg-6">
						<textarea class="form-control" name="work_address" id="work_address"><?php echo $page[0]['work_address']; ?></textarea>
                                         </div>
                                    </div>
				     
				      <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">User Mode</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                     
						      <?php if($page[0]['user_mode']=='T')
                                                                     {
                                                                        echo "Trial";
                                                                     }elseif ($page[0]['user_mode']=='P'){
                                                                          echo "Paid";
                                                                     }
                                                             ?>
                                                </p>
                                           </div>
                                     </div>
				      
				      <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Registred Date</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                     
						    <?php echo $page[0]['created_date']; ?>
                                                </p>
                                           </div>
                                     </div>
					
				       
                                            <input class=" form-control" type= "hidden" id="expiry_date" name="expiry_date" value="<?php echo $page[0]['expiry_date']; ?>" type="text" />
                                        
					
					  <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Exp Date:</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                     
						    <?php echo $page[0]['expiry_date']; ?>
                                                </p>
                                           </div>
                                     </div>
				      
                                     
                                     <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Image:</label>
                                           <div class="col-lg-5">
                                                <p class="form-control-static pull-left"> 
                                                    <?php if($page[0]['image']!='') { ?>
							<img src="<?php echo base_url().'user_images/'.$page[0]['image'];?>" width="100px" height="90px;" >
						    <?php }else{
							echo "No Image";
							}  ?>
                                                </p>
                                           </div>
                                     </div>
				     
				     
                                     
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Status:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 300px" id="status" name="status">
								<option value="Y" <?php if($page[0]['status'] == "Y"){ echo 'selected'; } ?> >Active</option>
								<option value="N" <?php if($page[0]['status'] == "N"){ echo 'selected'; } ?> >Block</option>
							
                                        	</select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
						<button class="btn btn-primary" type="submit">Save</button>
						<button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/managetrainer';">Cancel</button>
												
				<button class="btn btn-default" type="button" onclick="document.getElementById('upgrade').submit();">Upgrade</button>

					</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
	     <form class="cmxform form-horizontal " id="upgrade" name="upgrade"  method="post" action="<?php echo site_url("control").'/managetrainer/upgradetrainer/'.$this->uri->segment(4) ; ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<input type="hidden" name="expiry_date" value="<?php echo $page[0]['expiry_date']; ?>"/>
			
			
										
										
				
				</form>
            <!-- page end-->
        </section>
    </section>

<script>
	function username_check(){
			var new_user_name= $("#trainer_email").val();
			var h_user_name=$("#h_user_name").val();
			
			if(new_user_name!='')
			{
				var dataString = "new_user_name=" + new_user_name+'&h_user_name='+h_user_name;
			$.ajax({
				type: "POST",
				url: '<?php echo $this->config->base_url(); ?>ajax/traineremail_check.php',
				data: dataString,
				cache: false,
				success: function(data){
				//alert(data);	
				if (data=='yes') {
					
					document.getElementById("u_hdn").value='no';
					}if(data=='no'){
				
				document.getElementById("u_hdn").value='yes';
				}
				}
			});
	}
}
</script>
                               