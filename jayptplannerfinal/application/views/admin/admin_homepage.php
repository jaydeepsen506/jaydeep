<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/ckeditor/ckeditor.js"></script>
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
                            Homepage Settings
                        </header>
                        <div class="panel-body">
                            <div class="form">
                            <form class="cmxform form-horizontal " id="siteSettings" method="post" action="<?php echo base_url(); ?>control/homepage/updt">
                                  
				    
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">App Booking Text</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="app_booking_text" value="<?php echo $home[0]['app_booking_text']; ?>" type="text" />
                                        </div>
                                    </div>
				    
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">App Trainaway Text</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="app_trainaway_text" value="<?php echo $home[0]['app_trainaway_text']; ?>" type="text" />
                                        </div>
                                    </div>
				    
				    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">App Diets Text</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="app_diets_text" value="<?php echo $home[0]['app_diets_text']; ?>" type="text" />
                                        </div>
                                    </div>
				    
				     <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Diary Text</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="diary_text" value="<?php echo $home[0]['diary_text']; ?>" type="text" />
                                        </div>
                                    </div>
				     
				      <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Program Text</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="program_text" value="<?php echo $home[0]['program_text']; ?>" type="text" />
                                        </div>
				      </div>
				      
				       <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Message</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="messages_text" value="<?php echo $home[0]['messages_text']; ?>" type="text" />
                                        </div>
				      </div>
				        
					
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">App booking content</label>
                                        <div class="col-lg-4">
                                            <textarea class="form-control " id="app_booking_content" name="app_booking_content"><?php echo $home[0]['app_booking_content']; ?></textarea>
                                        </div>
                                    </div>
				  
				   <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">App Trainaway content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="app_trainaway_content" name="app_trainaway_content"><?php echo $home[0]['app_trainaway_content']; ?></textarea>
                                                
					</div>
                                    </div>
				   
				     <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">App Diet Content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="app_diets_content" name="app_diets_content"><?php echo $home[0]['app_diets_content']; ?></textarea>
                                                
					</div>
                                    </div>
				     
				       <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Diary content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="diary_content" name="diary_content"><?php echo $home[0]['diary_content']; ?></textarea>
                                                
					</div>
                                    </div>
				       
				         <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Program content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="program_content" name="program_content"><?php echo $home[0]['program_content']; ?></textarea>
                                                
					</div>
                                    </div>
					 
					   <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Messege content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="messages_content" name="messages_content"><?php echo $home[0]['messages_content']; ?></textarea>
                                                
					</div>
                                    </div>
					    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Web content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="web_content" name="web_content"><?php echo $home[0]['web_content']; ?></textarea>
                                                <script>
							CKEDITOR.replace('web_content');
						</script>
					</div>
                                    </div>
					    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Header content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="header_content" name="header_content"><?php echo $home[0]['header_content']; ?></textarea>
                                                
					</div>
                                    </div>
					    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Trial content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="trial_content" name="trial_content"><?php echo $home[0]['trial_content']; ?></textarea>
                                                
					</div>
                                    </div>
					    
					    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Price Text</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" name="price_text" value="<?php echo $home[0]['price_text']; ?>" type="text" />
                                        </div>
				      </div>
					    
					      <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Price content</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="price_content" name="price_content"><?php echo $home[0]['price_content']; ?></textarea>
                                                
					</div>
                                    </div>
					      
				<div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Plan 1</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="plan1" name="plan1"><?php echo $home[0]['plan1']; ?></textarea>
                                                <script>
							CKEDITOR.replace('plan1');
						</script>
					</div>
                                    </div>
				<div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Plan 2</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="plan2" name="plan2"><?php echo $home[0]['plan2']; ?></textarea>
                                                <script>
							CKEDITOR.replace('plan2');
						</script>
					</div>
                                    </div>
				<div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Plan 3</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="plan3" name="plan3"><?php echo $home[0]['plan3']; ?></textarea>
                                                <script>
							CKEDITOR.replace('plan3');
						</script>
					</div>
                                    </div>
				<div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Plan 4</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="plan4" name="plan4"><?php echo $home[0]['plan4']; ?></textarea>
                                                <script>
							CKEDITOR.replace('plan4');
						</script>
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