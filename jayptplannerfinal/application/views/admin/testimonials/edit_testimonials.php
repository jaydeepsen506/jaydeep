<!--|
| Copyright ? 2015 by Esolz Technologies
| Author :  amit.kumar.shaw@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  Testimonials.
|-->

<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                         Edit Testimonials
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="edittestimonials" name="edittestimonials"  method="post" action="<?php echo site_url("control").'/managetestimonials/update/'.$this->uri->segment(4) ;?>" enctype="multipart/form-data">
                                    <div class="form-group ">
                                        <label for="name" class="control-label col-lg-3">Name</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="name" name="name" value="<?php echo $userdata[0]->name;?>" type="text" />
                                        </div>
                                    </div>
                                    
                                    
                                   <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">:</label>
                                        <div class="col-lg-6">
                                            <?php if($userdata[0]->image!='') {?>
						<a href="<?php echo site_url()?>testimonial_images/<?php echo $userdata[0]->image; ?>" target="_blank">
							<img src="<?php echo base_url().'testimonial_images/'.$userdata[0]->image;?>" height="50" width="50">
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
				    
				   
				    
				    <div class="form-group ">
                                        <label for="status" class="control-label col-lg-3">Status:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 300px" id="status" name="status">
							
								<option <?php if($userdata[0]->status=="Y"){echo "selected";}?> value="Y"  >Active</option>
								<option <?php if($userdata[0]->status=="N"){echo "selected";}?> value="N"  >Block</option>
							
                                        	</select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/managetestimonials';">Cancel</button>
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