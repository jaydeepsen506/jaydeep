
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            ADD HOME PAGE
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/homepage/add/'.$this->uri->segment(4) ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">App booking text</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="app_booking_text" name="app_booking_text" value="" type="text" />
                                        </div>
                                    </div>
				    
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">App trainaway text</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="app_trainaway_text" name="app_trainaway_text" value="" type="text" />
                                        </div>
                                    </div>
                                    
					<div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">App diets text</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="app_diets_text" name="app_diets_text" value="" type="text" />
                                        </div>
					</div>
					
					<div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Diary text</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="diary_text" name="diary_text" value="" type="text" />
                                        </div>
					</div>
					   
					<div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Program text</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="program_text" name="program_text" value="" type="text" />
                                        </div>
					</div>
					
					<div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Messages text</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="messages_text" name="messages_text" value="" type="text" />
                                        </div>
					
					</div>
					
				     <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Booking content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="app_booking_content" name="app_booking_content"></textarea>
                                        </div>
                                    </div>
				     
				      <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Trainaway content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="app_trainaway_content" name="app_trainaway_content"></textarea>
                                        </div>
                                    </div>
				      
				       <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Diets content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="app_diets_content" name="app_diets_content"></textarea>
                                        </div>
					</div>
				       
				        <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Diary content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="diary_content" name="diary_content"></textarea>
                                        </div>
                                    </div>
					 <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Program content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="program_content" name="program_content"></textarea>
                                        </div>
                                    </div>
					 
					  <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Message content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="messages_content" name="messages_content"></textarea>
                                        </div>
                                    </div>
				     
                                    
				    
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Web Content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="web_content" name="web_content"></textarea>
                                                <script>
							CKEDITOR.replace('web_content');
						</script>
					
					</div>
                                    </div>
				    
				  

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/homepage';">Cancel</button>
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