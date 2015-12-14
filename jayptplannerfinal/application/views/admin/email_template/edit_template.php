<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  madhurima.chatterjee@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for add country.
|-->

<!--script to be used for populating droip down list incase of city-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            if($(this).attr("value")=="custom"){
                $("#email").show();
	    }
	    if($(this).attr("value")=="all"){
                $("#email").hide();
	    }
        });
    });
    
//    function chk_field()
//		{
//		    var frm = document.edit_template;
//		    
//		    
//		  if (frm.email_content.value.search(/\S/) == '-1')
//		    {
//			alert('Please enter email');
//			document.getElementById('error_cat').innerHTML="*Please Enter Content";
//			document.getElementById('error_cat').style.color='red';
//			frm.email_content.focus();
//			return false;
//		    }
//		    else{
//			document.getElementById('error_cat').innerHTML="";
//		    }
//		}
</script>
<section id="main-content">
        <section class="wrapper">
		<?php
		$flash_message=$this->session->flashdata('flash_message');
		if(isset($flash_message))
		{
	
		    if($flash_message =='TRUE')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Email has been successfully sent.';
			echo '</div>';
		  
		    }
		    if($flash_message == 'FALSE'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in Sending Email. Please try again.';        
			echo'</div>';
	    
		    }
		}
		    ?>
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Add Email Template
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="edit_template" method="post" action="<?php echo site_url("control").'/email_template_management/update/'.$template[0]['id']; ?>" >
				
				<div class="form-group ">
                                        <label for="slider_text" class="control-label col-lg-3">Templete Name:</label>
                                        <div class="col-lg-6">
					   <input class=" form-control" id="template" name="template" type="text" value="<?php echo $template[0]['category']?>" readonly>
                                        </div>
                                    </div>
				
				<div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Email Subject:</label>
                                        <div class="col-lg-4">
                                            <textarea class="form-control " id="email_subject" name="email_subject"><?php echo $template[0]['subject']?></textarea>
                                        </div>
                                    </div>
				<div id="error_cat">
				    </div>
				    
				    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Email Content:</label>
                                        <div class="col-lg-4" style="width: 63%;">
                                            <textarea class="form-control" rows="9" id="email_content" name="email_content"><?php echo $template[0]['email_body']?></textarea>
                                        </div>
                                        <script>
							CKEDITOR.replace('email_content');
					 </script>
                                        
                                    </div>
			    
				   
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Status:</label>
                                        <div class="col-lg-4">
                                            	<select class="form-control" id="status1" name="status1" >
							
								<option value="Y" <?php if($template[0]['status']=='Y'){?> selected="selected"<?php } ?>>Active</option>
								<option value="N" <?php if($template[0]['status']=='N'){?> selected="selected"<?php } ?>>Block</option>
							
                                        	</select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/email_template_management';">Cancel</button>
                                        </div>
                                    </div>
				    
				    <input type="hidden" name="user_type" id="user_type" value="1"/ >
				    
                                </form>

				
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section> 
    

    