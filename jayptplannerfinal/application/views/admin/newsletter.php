<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  static pages.
|-->

<script>

function toggle(source)
{
	//alert('hi');
  checkboxes = document.getElementsByName('reciver[]');
 
  for(var i=0, n=checkboxes.length;i<n;i++)
  {
    checkboxes[i].checked = source.checked;
  }
}

</script>

 
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
	    <?php
$flash_message=$this->session->flashdata('flash_message');
		if(isset($flash_message))
		{
	
		    if($flash_message == 'email_sent')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong>You have Successfully Sent Email.';
			echo '</div>';
		  
		    }
		}
		print_r($country);
		print_r($state);
?>
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Send Mail
                        </header>
                        <div class="panel-body">
                            <div class="form">
                                <form class="cmxform form-horizontal " id="editPage" method="post" action="<?php echo site_url("control").'/newsletter/sentmail/'.$this->uri->segment(4) ; ?>">
				<div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Subject:</label>
                                        <div class="col-lg-4">
                                           <input class=" form-control" id="subject" name="subject" value="" type="text">
                                        </div>
                                    </div>
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Content:</label>
                                        <div class="col-lg-6">
                                            <textarea class="wysihtml5 form-control" rows="9" name="page_content"></textarea>
                                        </div>
                                    </div>
				    
				    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3">Select users</label>
                                        <div class="col-lg-6">
					<input type="radio" name="sent_all" value="2" id="sent_all2" checked onclick="hide_div();">Selected	
                                           <input type="radio" name="sent_all" value="1" id="sent_all1"  onclick="show_div();"> Send to All
					   
                                        </div>
                                    </div>
				    
				    <div class="form-group " id="byname" >
                                        <label for="ccomment" class="control-label col-lg-3">Add User By Username</label>
                                        <div class="col-lg-4">
                                        <select data-placeholder="Choose a user..." class="chosen-select" multiple style="width:350px;" tabindex="4" name="type_id[]" id="type_id">
						<option value=""></option>
						
						<?php foreach($user as $lead){
							?>
						
						   <option value="<?php echo $lead['type'];?>"><?php echo $lead['user_name'];?></option>
						<?php } ?>
					</select>
					</div>
				    </div>
				    
				    <div id="alluser"  style="display: none">
				      
				       <div class="form-group " >
                                        <label for="ccomment" class="control-label col-lg-3">Select By Location</label>
                                        <div class="col-lg-8">
                                            	<table>
							<tr>
								
								<td style=" padding-left: 48px;">
									
								</td>
							<?php foreach($user_type as $row)
								{?>
							<tr>
								
								<td style=" padding-left: 48px;">
									<input  class="all"type="checkbox" value="<?php echo $row['id']; ?>" name="reciver[]" id="reciver"/><?php echo $row['name']  ?>
								</td>
								
								
							</tr>
							<?php } ?>
						</table>
                                        </div>
                                    </div>
				      
				      
				      
				      
				      
				      
				      
				      
				      
				      
				      
				      
				      
				      
				      
				    <div class="form-group " >
                                        <label for="ccomment" class="control-label col-lg-3">Select Users</label>
                                        <div class="col-lg-8">
                                            	<table>
							<tr>
								
								<td style=" padding-left: 48px;">
									<input type="checkbox" onclick="toggle(this);" value="all" name="select-all" id="select-all"/>Select all
								</td>
							<?php foreach($user_type as $row)
								{?>
							<tr>
								
								<td style=" padding-left: 48px;">
									<input  class="all"type="checkbox" value="<?php echo $row['id']; ?>" name="reciver[]" id="reciver"/><?php echo $row['name']  ?>
								</td>
								
								
							</tr>
							<?php } ?>
						</table>
                                        </div>
                                    </div>
				    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit"> Send Mail</button>
                                            <button class="btn btn-default" type="button" onclick="location.href='<?php echo base_url();?>control/newsletter';">Cancel</button>
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
<!------------------- choosen ------------------->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery-1.7.2.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/choosen/css/chosen.css">
  <script src="<?php echo base_url(); ?>assets/admin/choosen/js/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
     var j = jQuery.noConflict();
      j(selector).chosen(config[selector]);
    }
 
 function show_div() {
	//code
	$('#alluser').show();
	$('#byname').hide();
	
 }
 function hide_div() {
	$('#byname').show();
	$('#alluser').hide();
	
 }
 
//    $(document).ready(function(){
//        $('#sent_all1').change(function(){
//		alert('hi');
//                //$("#byname").hide();
//                //$("#alluser").show();
//	});
//	$('#sent_all2').click(function(){
//                $("#alluser").hide();
//                $("#byname").show();
//        });
//    });
</script>