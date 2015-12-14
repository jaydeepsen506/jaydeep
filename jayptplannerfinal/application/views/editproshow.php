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
<script>
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
			var b='blah'+id;
            //alert(id);
            reader.onload = function (e) {
                $('#'+b).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function(){
      $(".imgInp").change(function(){
		var id=$(this).attr('id');
        readURL(this, id);
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
                         Edit PRODUCT
                        </header>
                        <div class="panel-body">
                            <div class="form">
<form class="cmxform form-horizontal " id="edittestimonials" name="edittestimonials"  method="post" 
	  action="<?php echo site_url("control").'/manageproduct/update/'.$result['pid'] ;?>" enctype="multipart/form-data">
                                 
								    <div class="form-group ">
                                        <label for="name" class="control-label col-lg-3">Name</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="name" name="name" value="<?php echo $result['pname'];?>" type="text" />
                                        </div>
                                    </div>
                                    
                                    
                                   <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">:</label>
                                        <div class="col-lg-6">
                                            <?php
											     $c=1;
															if(!empty($result['image'])){
																		   foreach($result['image'] as $each_image){
																						  ?>
																						<!-- <div>
																						  <img src="<?php// echo base_url('uploads/'.$each_image); ?>" />
																						  <input type="file" name="file[]" id="id">
																						  <div> -->
                                        <div class="form-group ">
												<label for="p" class="control-label col-lg-3"></label>
												<div class="col-lg-6">
												<img class="bi" id="blah<?php echo $c;?>" src="<?php echo base_url('uploads/'.$each_image); ?>" width="200px" height="200px">
												&nbsp;
												
												
												</div>
										</div>		
							            <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Picture <?php echo $c;?>:</label>
										 
                                        <div class="col-lg-6">
                                            <input type="file" name="file[]" class="imgInp" id="<?php echo $c; $c++;?>"/>
                                        </div>
                                </div>
																						  <?php
																		   }
															}
											?>
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
								<option <?php if($result['status']=="0"){echo "selected";}?> value="0"  >Active</option>
								<option <?php if($result['status']=="1"){echo "selected";}?> value="1"  >Block</option>
							
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
