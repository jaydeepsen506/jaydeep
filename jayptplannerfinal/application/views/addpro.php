<!--|
| Copyright ? 2015 by Esolz Technologies
| Author :  amit.kumar.shaw@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  Testimonials.
|-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script>
$(document).ready(function () {
$('input[type=file]').change(function () {
var val = $(this).val().toLowerCase();
var val = $(this).val();
//var regex = new RegExp("(.*?)\.(docx|doc|pdf|xml|bmp|ppt|xls)$");
var regex = new RegExp("(.*?)\.(jpg|jpeg)$");
 if(!(regex.test(val))) {
		
				$(this).val('');

				alert('Please select correct file format');
						}
				
		});
});

</script>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Product
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="addtestimonials" name="addtestimonials"  method="post" action="<?php echo site_url("control").'/manageproduct/insert' ;?>" enctype="multipart/form-data">
                                   <div class="form-group ">
                                        <label for="status" class="control-label col-lg-3">Store Name:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 300px" id="status" name="store">
												<?php
									
				                                 if((!empty($userdata)) &&(count($userdata)>0))
												 {
    
					                                 foreach($userdata as $row)
					                                    {
					
				                                              ?>		
								                                 <option value="<?php echo $row['s_id'] ?>"><?php echo $row['s_name'] ?></option>
												     <?php
                                
                                                        }			      
			                                         
											     }
                                                  else
                                                     {
                                                        //echo "No Result Found";
                                                     }
                                                  ?>
								                  							
                                        	   </select>
                                        </div>
                                    </div>
								   
								    <div class="form-group ">
                                        <label for="name" class="control-label col-lg-3">Product Name</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="name" name="name" value="" type="text" />
                                        </div>
                                    </div>
                                <!--    
                                     <div class="form-group ">
                                        <label for="image" class="control-label col-lg-3">Image</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="image" name="image" value="" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                   
				                  -->
				  
				    
				    <div class="form-group ">
                                        <label for="status" class="control-label col-lg-3">Status:</label>
                                        <div class="col-lg-6">
                                            	<select class="form-control" style="width: 300px" id="status" name="status">							
								<option value="0"  >Active</option>
								<option value="1"  >Block</option>							
                                        	</select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Add</button>
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