<!--|
| Copyright ? 2015 by Esolz Technologies
| Author :  amit.kumar.shaw@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  Testimonials.
|-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!--
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
-->
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
                                    
                                     <div class="form-group ">
                                        <label for="image" class="control-label col-lg-3">Image</label>
                                        <div class="col-lg-6">
											 <div id="filediv"><input name="file[]" type="file" id="file" accept="image/*"/></div>
                                            <input type="button" id="add_more" class="upload" value="Add More Files"/>   
                                            <input class=" form-control" id="image" name="image" value="" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                   
				    
				  
				    
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
<!---script for multipleupload -->
<script>
   var abc = 0;      // Declaring and defining global increment variable.
   $(document).ready(function()
        {
     //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
           $('#add_more').click(function()
                                {
                                  $(this).before($("<div/>", { id: 'filediv' }).fadeIn('slow').append($("<input/>",
                                    {
                                       name: 'file[]',
                                       type: 'file',
                                        id: 'file'
                                    }), $("<br/><br/>")));
                                 });
// Following function will executes on change event of file input to select different file.
          $('body').on('change', '#file', function() {
                                                    if (this.files && this.files[0])
                                                           {
                                                                abc += 1; // Incrementing global variable by 1.
                                                                var z = abc - 1;
                                                                var x = $(this).parent().find('#previewimg' + z).remove();
                                                                $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
                                                                var reader = new FileReader();
                                                                reader.onload = imageIsLoaded;
                                                                reader.readAsDataURL(this.files[0]);
                                                                $(this).hide();
                                                               $("#abcd" + abc).append($("<img/>",{
                                                                     id: 'img',
                                                                     src: 'x.png',
                                                                     alt: 'delete'
                                                                      }).click(function() {
                                                                                            $(this).parent().parent().remove();
                                                                                          }));
                                                             }
                                                   });
// To Preview Image
                                            function imageIsLoaded(e) {
                                                                         $('#previewimg' + abc).attr('src', e.target.result);
                                                                       };
                                             $('#upload').click(function(e){
                                                                              var name = $(":file").val();
                                                                          if (!name)
                                                                              {
                                                                               alert("First Image Must Be Selected");
                                                                               e.preventDefault();
                                                                               }
                                                                           });
         });
</script>