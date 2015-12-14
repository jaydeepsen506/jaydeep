
<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/ckeditor/ckeditor.js"></script>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Updating 
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/homepage/update/'.$this->uri->segment(4) ; ?>">
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">App booking text</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="app_booking_text" name="app_booking_text" value="<?php echo $all_data[0]['app_booking_text']; ?>" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">App trainaway text</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="app_trainaway_text" name="app_trainaway_text" value="<?php echo $all_data[0]['app_trainaway_text']; ?>" type="text" />
                                        </div>
                                    </div>
                                    
                              
                                  
				    
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Web Content:</label>
                                        <div class="col-lg-6">
						<textarea class="" rows="9" name="web_content" id="web_content"><?php echo $all_data[0]['web_content']; ?></textarea>
						<script>
							CKEDITOR.replace('web_content');
						</script>
                                         </div>
                                    </div>
				    
				

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/pages';">Cancel</button>
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