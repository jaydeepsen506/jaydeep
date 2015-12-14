
<?php
if($this->session->userdata('site_user_id')=='')
{
    redirect('');
}else
{
if($user_details[0]['deleted_status']=='Y')
{
  redirect('');
}
}
include 'calendar.php';
include 'calendar_diet.php';
include 'calendar_diary.php';
  $ci=&get_instance();
  $ci->load->model('toolbox_model');
  $ci->load->model('common_model');
  $ci->load->model('network_model');
  $ci->load->model('progress_model');
?>

 <script type="text/javascript" src="<?php echo base_url();?>assets/site/after_login/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/site/after_login/js/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo base_url();?>assets/site/after_login/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/site/after_login/css/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/site/after_login/css/jquery.fancybox-buttons.css?v=1.0.5" />

 <script>
    function account_activation()
    {
	var status=0;
	if (document.getElementById('custom-switch-01').checked==true){
	    var status = 1;
	    ///ON
	}
	else
	{
	    var status= 0;
	    ///OFF
	}
	var frm=document.acc_form;
	frm.acc_status.value=status;
	frm.submit();
	//alert(status);
    }
    function show_graph()
    {
	var client_id='<?php echo $user_details[0]['id']; ?>';
	var dataString ="client_id="+client_id;
	$.ajax
	({
	type: "POST",
	url: "<?php echo base_url();?>client_progress/load_chart",
	data: dataString,
	cache: false,
	success: function(data)
	{
	       //alert(data);
	   $("#graph_div").html(data);
	}
	});
    }
 </script>
 <script>
    function get_edit_graph_popup(graph_id){
        var client_id='<?php echo $user_details[0]['id']; ?>';
	var dataString ="client_id="+client_id+"&graph_id="+graph_id;
	$.ajax
	({
	type: "POST",
	url: "<?php echo base_url();?>client_progress/edit_graph",
	data: dataString,
	cache: false,
	success: function(data)
	{
	       //alert(data);
	       $("#edit_graph_body").html(data);
	       $("#displayEditGraph").click();
	        $('.date-class').datepicker({
		       changeMonth: true,
		       changeYear: true,
		       dateFormat: 'yy-m-d'
		    });
	}
	});
    }
    
    function get_add_graph_popup() {
	 var client_id='<?php echo $user_details[0]['id']; ?>';
	 var dataString ="client_id="+client_id;
	$.ajax
	({
	type: "POST",
	url: "<?php echo base_url();?>client_progress/add_graph_popup",
	data: dataString,
	cache: false,
	success: function(data)
	{
	       //alert(data);
	       $("#edit_graph_body").html(data);
	       $("#displayEditGraph").click();
	        $('.date-class').datepicker({
		       changeMonth: true,
		       changeYear: true,
		    });
	}
	});
    }
    function get_measurement_popup(graph_id){
	var client_id='<?php echo $user_details[0]['id']; ?>';
	var dataString ="client_id="+client_id+"&graph_id="+graph_id;
	$.ajax
	({
	type: "POST",
	url: "<?php echo base_url();?>client_progress/measure_popup",
	data: dataString,
	cache: false,
	success: function(data)
	{
	       //alert(data);
	       $("#measurement_div").html(data);
	       $("#showMeasure").click();
	        $('.date-class').datepicker({
		       changeMonth: true,
		       changeYear: true
		    });
	}
	});
    }
    function show_calender(e)
    {
	//alert('check');
	$(e).parents('.singleorga').find('.date-class').focus();
    }
 </script>
<form name="acc_form" method="POST" action="<?php echo base_url();?>dashboard/change_client_status">
<input type="hidden" name="acc_status" value="">
<input type="hidden" name="client_id" value="<?php echo $user_details[0]['id']?>">
</form>
<div id="page-wrapper">

            <div class="container-fluid tabouterdiv">
 <?php
            $flash_message=$this->session->flashdata('flash_message');
	    
             ?>
                <!-- Page Heading -->
                <div class="row rowcustomblog">
                <div class="tabbut">
                            	<ul class="nav nav-tabs" role="tablist" id="myTab">
                                     <li role="presentation" <?php if(isset($flash_message) && $flash_message == '') {  ?>class="active" <?php  }else{ ?> class=""<?php } ?>><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><span class="profile"></span>PROFILE</a></li>
                                        <li role="presentation" <?php if(isset($flash_message) && $flash_message == 'progress_tab') {  ?>class="active" <?php  }else{ ?> class=""<?php } ?>><a href="#progress" aria-controls="progress" role="tab" data-toggle="tab" onclick="show_graph();"><span class="progresstab"></span>PROGRESS</a></li>
                                      <li role="presentation" <?php if(isset($flash_message) && $flash_message == 'training_tab') {  ?>class="active" <?php  }else{ ?> class=""<?php } ?>><a href="#tramnning" aria-controls="tramnning" role="tab" data-toggle="tab"><span class="tramnning"></span>TRAINING</a></li>
                                      <li role="presentation" <?php if(isset($flash_message) && $flash_message == 'meal_tab') {  ?>class="active" <?php  }else{ ?> class=""<?php } ?>><a href="#diet" aria-controls="diet" role="tab" data-toggle="tab"><span class="diet"></span>DIET</a></li>
                                      <li role="presentation"><a href="#dairy" aria-controls="dairy" role="tab" data-toggle="tab"><span class="dairy"></span>DIARY</a></li>
                                    </ul>
                            </div>
                    <div class="tab-content">
                        <div class="row customwidth tab-pane <?php if(isset($flash_message) && $flash_message == '') {  ?>active<?php  }else{ ?><?php } ?>" role="tabpanel" id="profile">
                              <div class="col-md-7 col-xs-12 leftsidetab">
                                <div class="innerblog clearfix">
                                	<a href="javascript:void(0)" class="edit" data-toggle="modal" data-target="#client_edit_modal">Edit</a>
                                         <?php
					       if($user_details[0]['image'] != '')
						{
						    $img_src = base_url()."user_images/".$user_details[0]['image'];
						}
					       else
						{
						    $img_src = base_url()."assets/site/after_login/images/no-photo.png";
						}
	                                 ?>
                                	<div class="account-profile clearfix">
                                		<div class="profile-name">
                                			<img src="<?php echo $img_src; ?>" alt="" style="width:192px; height:200px;"/>
                                		</div>
                                                 <?php
                                                    $name_array=explode(" ",$user_details[0]['name']);
                                                    ?>
                                		<div class="profile-txt">
                                			<h2> <span><?php echo $name_array[0]." "; ?></span><?php echo end($name_array); ?></h2>
                                			<a href="#"><i class="fa fa-envelope-o"></i> <?php echo $user_details[0]['email']; ?></a>
                                			<a href="#"><i class="fa fa-phone"></i> <?php echo $user_details[0]['phone']; ?></a>
                                		</div>
                                	</div>
					
                                	<div class="address">
                                		<div class="row">
	                            			<div class="col-sm-12">
	                            				<h2><i class="fa fa-map-marker"></i> Address</h2>
	                            				<p><?php echo $user_details[0]['work_address'];?></p>
	                            			</div>
                            			</div>
                            		</div>
                            		<div class="address">
                            			<p class="acnt-p"><?php echo $user_details[0]['about']; ?></p>
                            		</div>
                            		<div class="address">
                            			<div class="row">
	                            			<div class="col-xs-6">
	                            				  <div class="switch-wrapper">
								     <input type="checkbox" data-toggle="switch" id="custom-switch-01" onchange="account_activation()" name="account_act" <?php if($user_details[0]['status']=='Y'){ echo "checked"; } ?>/>
									</div>
								  <?php
								  if($user_details[0]['status']=='Y')
								  {
								   ?>
								    <span class="switch">Deactivate account</span>
								   <?php
								  }
								  else
								  {
								    ?>
								    <span>Activate account</span>
								    <?php
								  }
								  ?>
	                            			</div>
	                            			<div class="col-xs-6 text-right">
	                            				<a href="<?php echo base_url();?>delete-client/<?php echo $user_details[0]['id'] ?>"><i class="fa fa-trash-o"></i> Delete account</a>
	                            			</div>
	                            		</div>
                            		</div>
                                </div>
                        		<div class="innerblog pass-area">
                        			<div class="appoin_txt">
                        				<i class="fa fa-unlock-alt"></i> Username  and PASSWORD SETTINGS
                        				<span class="paswrd">Send username and password to the client's registered e-mail</span>
                        				<a class="btn btn-default pass-btn" href="<?php echo base_url();?>change-client-pass/<?php echo $user_details[0]['id'];?>">Send</a>
                        			</div>
                        		</div>
                            </div>
			      <script>
				function submit_message(){
				
				var frm=document.msg_send_form;
				var txt=frm.msg_text_box.value;
				var receiver=frm.sent_to.value;
				var start=parseInt(document.getElementById('start_val').value);
				var start_prog=parseInt(document.getElementById('start_val_prog').value);
				var start_trai=parseInt(document.getElementById('start_val_trai').value);
				var start_diet=parseInt(document.getElementById('start_val_diet').value);
				var start_dia=parseInt(document.getElementById('start_val_dia').value);
				var dataString ="sent_to="+receiver+"&msg_text="+txt;
				$.ajax
				({
				type: "POST",
				url: "<?php echo base_url();?>dashboard/enter_message_from_client_profile_page",
				data: dataString,
				cache: false,
				success: function(data)
				{
				       //alert(data);
				    if (data !='error') {
					$('#new_msg_div_prog').append(data);
					$('#new_msg_div').append(data);
					$('#new_msg_div_trai').append(data);
					$('#new_msg_div_diet').append(data);
					$('#new_msg_div_diary').append(data);
					$('#start_val').val(start+1);
					$('#start_val_prog').val(start_prog+1);
					$('#start_val_trai').val(start_trai+1);
					$('#start_val_diet').val(start_diet+1);
					$('#start_val_dia').val(start_dia+1);
					$('#msg_text_box').val('');
				       }
				}
				});
				}
			      </script>
			      	<script>
				    function load_more_message(per_load,user_id,logged_in_user)
				    {
					var start_val=document.getElementById('start_val').value;
					var start=parseInt(start_val);
					var dataString ="per_load="+per_load+"&start="+start+"&user_id="+user_id+"&logged_in_user="+logged_in_user;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>dashboard/get_more_messages',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$('#new_msg_div').prepend(data);
						$('#start_val').val(start+per_load);
					    }
					    });
				    }
			    </script>
                            <div class="col-md-5 col-xs-12">
                            	<div class="innerblogtool  clearfix">
                            	<div class="Notificationblog">
				    <?php
				        $per_laod = 5;
					$start = 0;
				    ?>
				    <div id="msg_list">
					<?php
					$all_messages=$ci->network_model->get_latest_user_messages($user_details[0]['id']);
					$chat_messages=$ci->network_model->get_latest_user_chat($user_details[0]['id'],$per_laod,$start);
					?>
                                	<div class="notohead">MESSAGES <?php if(count($all_messages) > $per_laod) { ?><a href="javascript:void(0)" class="Earlier" onclick="load_more_message(<?php echo $per_laod; ?>,<?php echo $user_details[0]['id']; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Earlier</a> <?php } ?></div>
					<div id="new_msg_div">
					<?php
					foreach($chat_messages as $msg)
					{
					     $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
					?>
                                    <div class="massagebox" style="overflow:hidden;">
                                        <div class="daytim"><?php
					    if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d'))
					    {
						echo "Today";
					    }
					    else if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
					    {
						echo "Yesterday";
					    }
					    else
					    {
						echo date('Y-m-d',strtotime($msg['send_time']));
						//echo "Yesterday";
					    }
					    ?><span><?php echo date('H:i',strtotime($msg['send_time']));?></span></div>
                                        <div class="notiimgtxt">
                                            <div class="proimg"><img <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> style="height:38px;width:38px;" alt=""></div>
                                            <div class="notitxt"><span><?php echo $sender_information[0]['name'];?>:</span><?php echo $msg['message']; ?></div>
                                        </div>
                                    </div>
				    <?php
					}
				    ?>
				    </div>
				    </div>
				    <div class="searchbgright">
					<form name="msg_send_form" id="msg_send_form" onsubmit="submit_message();return false;">
                                        <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-pencil"></i></button>
                                        <div class="searchfieldouter">
                                            <input type="text" name="msg_text_box" id="msg_text_box" class="custfield diffcolor diffsize" placeholder="WRITE A MESSAGE" style="text-transform:none;">
						<!--<input type="text" name="msg_text_box" id="msg_text_box" class="custfield diffcolor diffsize" value="WRITE A MESSAGE" onblur=" if(this.value=='') this.value = 'WRITE A MESSAGE';" onclick="if(this.value=='WRITE A MESSAGE') this.value = ''; " style="text-transform:none;">-->
                                        </div>
					<input type="hidden" name="sent_to" id="sent_to" value="<?php echo $user_details[0]['id'];?>">
					<input type="hidden" name="start_val" id="start_val" value="5">
					</form>
                                    </div>
                                </div>
                            </div>
                           </div>
                            </div>
                   	    <div class="row customwidth tab-pane <?php if(isset($flash_message) && $flash_message == 'progress_tab') {  ?>active<?php  }else{ ?><?php } ?>" role="tabpanel" id="progress">
                            <div class="col-md-7 col-xs-12 leftsidetab">
                                <div class="innerblog clearfix">
                                    <div class="clearfix gaplower">
                                        <div class="col-sm-6 col-xs-12">
                                        <div class="appoin_txt"><span><?php echo $name_array[0]." "; ?></span><?php echo end($name_array); ?></div>
                                        <div class="datehead">Progress</div>
                                        </div>
                                        <div class="topwite">
<!--                                        	<input type="text" onClick="if(this.value=='START WEIGHT') this.value = ''; " onBlur=" if(this.value=='') this.value = 'START WEIGHT';" value="START WEIGHT" class="fildprogress" name="">
                                            <input type="text" onClick="if(this.value=='START FAT %') this.value = ''; " onBlur=" if(this.value=='') this.value = 'START FAT %';" value="START FAT %" class="fildprogress" name="">-->
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                    	<div class="buttongeneral_tool"><a class="butsetting" href="#">Settings</a></div>
                                    	<div class="buttongeneral_tool"><a class="butsblue" href="javascript:void(0)" onclick="get_add_graph_popup()">Add Graph</a></div>  </div>
                                    </div>
                                    <div class="clearfix ">
                                    	<div class="col-xs-12">
                                        	<div id="graph_div">
						<?php
						$ci=&get_instance();
						$ci->load->model('common_model');
						$graph_where=array(
						      'client_id' => $user_details[0]['id']
						);
						$all_graphs=$ci->common_model->get('user_graph',array('*'),$graph_where);
						foreach($all_graphs as $graph){
						      $where_points=array(
							      'graph_id' => $graph['id']
									  );
						      $graph_points=$ci->common_model->get('user_graph_points',array('*'),$where_points,null,null,null,null,null,null,'x_axis_val','ASC');
						      $x_val_arr=array();
						      $y_val_arr=array();
						      foreach($graph_points as $point)
						      {
							      $x_val_arr[] = '"'.date("d/m/Y",strtotime($point['x_axis_val'])).'"';
							      $y_val_arr[] = $point['y_axis_val'];
							 
						      }
						      $str_val_x = implode(",",$x_val_arr);
						      $str_val_y = implode(",",$y_val_arr);
						    ?>
						    <?php
							if($graph['graph_type']=='B')
							    {	
						    ?>
						    <div class="Graphouter" id="graph_each_<?php echo $graph['id'];?>">
						     <div class="datehead"><?php echo $graph['graph_for']." ( ".$graph['measure_unit']." )";?><a href="javascript:void(0)" style="float: right;" onclick="get_measurement_popup(<?php echo $graph['id'];?>)"> <i class="fa fa-plus"></i>Add Measurement</a><a href="javascript:void(0)" style="float: right;
						    padding-right: 21px;" onclick="get_edit_graph_popup(<?php echo $graph['id'];?>)"><i class="fa fa-pencil"></i>Edit Graph</a></div>
							   <canvas id="canvas_va<?php echo $graph['id'];?>" height="450" width="600"></canvas>
							    <script>
							    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
						    
							    var barChartData = {
								    labels : [<?php echo $str_val_x;?>],
								    datasets : [
									    {
										    fillColor : "rgba(34, 167, 240, 1)",
										    strokeColor : "rgba(151,187,205,0.8)",
										    highlightFill : "rgba(151,187,205,0.75)",
										    highlightStroke : "rgba(151,187,205,1)",
										    data : [<?php echo $str_val_y;?>]
									    }
								    ]
						    
							    }
							    
								    var ctx = document.getElementById("canvas_va<?php echo $graph['id'];?>").getContext("2d");
								    window.myBar = new Chart(ctx).Bar(barChartData, {
									    responsive : true
								    });
							    
						    
							    </script>
							    </div>
							    <?php
							    }
							    elseif($graph['graph_type']=='L')
							    {
							    ?>
						    <div class="Graphouter" id="graph_each_<?php echo $graph['id'];?>">
						     <div class="datehead"><?php echo $graph['graph_for']." ( ".$graph['measure_unit']." )";?><a href="javascript:void(0)" style="float: right; " onclick="get_measurement_popup(<?php echo $graph['id'];?>)"><i class="fa fa-plus"></i>Add Measurement</a><a href="javascript:void(0)" style="float: right;
						    padding-right: 21px;" onclick="get_edit_graph_popup(<?php echo $graph['id'];?>)"><i class="fa fa-pencil"></i>Edit Graph</a></div>
							    <canvas id="canvas_line<?php echo $graph['id'];?>" height="450" width="600"></canvas>
							    <script>
							    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
						    
							    var barChartData = {
								    labels : [<?php echo $str_val_x;?>],
								    datasets : [
									    {
										    fillColor : "#C6E9FC",
										    strokeColor : "rgba(34, 167, 240, 1)",
										    highlightFill : "rgba(34, 167, 240, 1)",
										    highlightStroke : "rgba(255, 255, 255, 1)",
										    pointColor: "#fff",
										    pointStrokeColor: "rgba(34, 167, 240, 1)",
										    pointHighlightFill: "#fff",
										    pointHighlightStroke: "rgba(220,220,220,1)",
										    data : [<?php echo $str_val_y;?>]
									    }
								    ]
						    
							    }
							    
								    var ctx = document.getElementById("canvas_line<?php echo $graph['id'];?>").getContext("2d");
								    window.myBar = new Chart(ctx).Line(barChartData, {
									    responsive : true,
									    pointDotRadius : 6,
									    pointDotStrokeWidth : 2,
									    datasetStrokeWidth : 3,
								    });
							    
						    
							    </script>
							    </div>
						    <?php
						    }
						    }
						     ?>
						</div>
                                        </div>
                                    </div>
				   
       
                                    </div>
                                </div>
			    <script>
			    function delete_image_client(e,image_name) {
				 var string_val=document.getElementById('uploaded_curr_image_name').value;
				 var dataString="image_name="+image_name+"&string_val="+string_val;
				  $.ajax
				      ({
				      type: "POST",
				      url: "<?php echo base_url();?>client_progress/remove_uploaded_image",
				      data: dataString,
				      cache: false,
				      success: function(data)
				      {
					     if (data != 'error') {
						document.getElementById('uploaded_curr_image_name').value=data;
						$(e).parents('.uploadedsingle').remove();
					     }
				      }
				      });
			    }

			    function delete_goal_image_client(e,image_name) {
				 var string_val=document.getElementById('uploaded_goal_image_name').value;
				 var dataString="image_name="+image_name+"&string_val="+string_val;
				  $.ajax
				      ({
				      type: "POST",
				      url: "<?php echo base_url();?>client_progress/remove_uploaded_goal_image",
				      data: dataString,
				      cache: false,
				      success: function(data)
				      {
					     if (data != 'error') {
						document.getElementById('uploaded_goal_image_name').value=data;
						$(e).parents('.uploadedsingle').remove();
					     }
				      }
				      });
			    }
			  </script>
			     <?php
				$client_current_image=$ci->progress_model->get_client_current_image($user_details[0]['id']);
			    ?>
                            <div class="col-md-5 col-xs-12">
                                <div class="innerblogtool clearfix">
                                        <div class="pictureshap clearfix"><span>PICTURES - SHAPE</span><?php  if(count($client_current_image)){ ?>
					 <a class="fancybox" href="../client_current_images/<?php echo $client_current_image[0]['image_name'];?>" data-fancybox-group="gallery" title="<?php echo date("jS  M Y ",strtotime($client_current_image[0]['upload_date'])); ?>">Show earlier pictures</a>
					
					<?php } ?>
					</div>
					<script>
					    $(document).ready(function(){
					    $("#client_curr_image").change(function()
					     {
						var src=$("#client_curr_image").val();
						if(src!="")
						{
						    formdata= new FormData();
						    var numfiles=this.files.length;
						    var i, file, progress, size;
						    for(i=0;i<numfiles;i++)
						    {
						    file = this.files[i];
						    size = this.files[i].size;
						    name = this.files[i].name;
						    if (file.type.match(/image.*/))
						    {
						    //if((Math.round(size))<=(1024*1024))
						   // {
							    var reader = new FileReader();
							    reader.readAsDataURL(file);
							    reader.onloadend = function(e){
							    var image = $('<img>').attr('src',e.target.result);
							    };
							    formdata.append("file[]", file);
							    if(i==(numfiles-1))
							    {
							        var client_id='<?php echo $user_details[0]['id'] ;?>';
								formdata.append('client_id',client_id);
								$.ajax({
								    url: "<?php echo base_url(); ?>client_progress/client_curr_image_upload",
								    type: "POST",
								    data: formdata,
								    processData: false,
								    contentType: false,
								    success: function(res){
								      var str=res.substring(0, res.length-1);
								      var array=str.split(',');
								      for(var i=0;i < array.length;i++)
								       {
									    if (i==(array.length-1)) {
										var kDiv = document.createElement('img');
										kDiv.className = 'img-responsive';
										kDiv.src= '<?php echo base_url();?>client_current_images/thumb/'+array[i];
										var date_val='Uploaded <span ><?php echo date("jS  M Y ");?></span>';
										$('#client_curr_img_div').html(kDiv);
										$('#photo_taken_date').html(date_val);
									    }
									    
									}
									    if(res=="0")
									    {
									       alert("Error in upload. Retry");
									    }
								    }
								    });
							    }
						    }
						    else
						    {
							    alert(name+"Not a valid file");
							    return false;
						    }
						    }
						}
						else
						{
						alert("Select a valid file");
						return false;
						}
					    });
					    });
					    </script>
					<script>
					    $(document).ready(function(){
					    $("#client_goal_image").change(function()
					     {
						var src=$("#client_goal_image").val();
						if(src!="")
						{
						    formdata= new FormData();
						    var numfiles=this.files.length;
						    var i, file, progress, size;
						    for(i=0;i<numfiles;i++)
						    {
						    file = this.files[i];
						    size = this.files[i].size;
						    name = this.files[i].name;
						    if (file.type.match(/image.*/))
						    {
							    var reader = new FileReader();
							    reader.readAsDataURL(file);
							    reader.onloadend = function(e){
							    var image = $('<img>').attr('src',e.target.result);
							    };
							    formdata.append("file[]", file);
							    if(i==(numfiles-1))
							    {
								var client_id='<?php echo $user_details[0]['id'] ;?>';
								formdata.append('client_id',client_id);
								$.ajax({
								    url: "<?php echo base_url(); ?>client_progress/client_goal_image_upload",
								    type: "POST",
								    data: formdata,
								    processData: false,
								    contentType: false,
								    success: function(res){
								      var str=res.substring(0, res.length-1);
								      var array=str.split(',');
								      for(var i=0;i < array.length;i++)
								       {
									    if (i==(array.length-1)) {
										var kDiv = document.createElement('img');
										kDiv.className = 'img-responsive';
										kDiv.src= '<?php echo base_url();?>client_goal_images/thumb/'+array[i];
										$('#client_goal_image_div').html(kDiv);
									    } 
									}
									    if(res=="0")
									    {
									       alert("Error in upload. Retry");
									    }
								    }
								    });
							    }
						    }
						    else
						    {
							    alert(name+"Not a valid file");
							    return;
						    }
						    }
						}
						else
						{
						alert("Select a valid file");
						return;
						}
						return false;
					    });
					    });
					    </script>
                                        <div class="row">
                                        	<div class="col-xs-6">
                                            	<div class="shapeouter" id="client_curr_img_div"><img <?php if(count($client_current_image)){ ?>src="<?php echo base_url();?>client_current_images/thumb/<?php echo $client_current_image[0]['image_name'];?>" <?php }else{ ?>src="<?php echo base_url();?>assets/site/after_login/images/no-image-available.jpg"<?php } ?>alt="" class="img-responsive"></div>
                                                <div class="currentxt">Current shape</div>
                                                <div class="takendate" id="photo_taken_date"> <?php if(count($client_current_image)){ ?>Uploaded <span ><?php echo date("jS  M Y ",strtotime($client_current_image[0]['upload_date']));?></span><?php }else{ ?>&nbsp;<?php } ?></div>
						<form name="addCurrImageForm" id="addCurrImageForm" method="POST" action="<?php echo base_url();?>client_progress/add_client_current_image" enctype="multipart/form-data">
                                                <div class="rightbutplace"> <input type="file" name="client_curr_image[]" id="client_curr_image" multiple="multiple"><a href="javascript:void(0)" class="butsblue">Upload Image</a></div>
						<input type="hidden" name="count_curr_image" id="count_curr_image" value="0">
						<input type="hidden" name="uploaded_curr_image_name" id="uploaded_curr_image_name" value="">
						<input type="hidden" name="client_id" id="client_id" value="<?php echo $user_details[0]['id'];?>">
						</form>
                                                </div>
                                            <div class="col-xs-6">
						 <?php
						    $client_goal_image=$ci->progress_model->get_client_goal_image($user_details[0]['id']);
						    ?>
                                            	<div class="shapeouter" id="client_goal_image_div"><img <?php if(count($client_goal_image) > 0){ ?>src="<?php echo base_url();?>client_goal_images/thumb/<?php echo $client_goal_image[0]['image_name'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/no-image-available.jpg"<?php } ?> alt="" class="img-responsive"></div>
                                                <div class="currentxt">Goal shape</div>
                                                <div class="takendate">&nbsp;</div>
						 <form name="addGoalImageForm" id="addGoalImageForm" method="POST" enctype="multipart/form-data">
                                                <div class="rightbutplace"> <input type="file" name="client_goal_image[]" id="client_goal_image"><a href="javascript:void(0)" class="butsblue">Upload Image</a></div>
						<input type="hidden" name="client_id" id="client_id" value="<?php echo $user_details[0]['id'];?>">
						</form>
                                            </div>
                                        </div>
					<?php
					   $where_img=array(
					    'client_id' => $user_details[0]['id']
					    );
					$current_images=$ci->common_model->get('client_current_images',array('*'),$where_img);
					?>
					<div style="display:none;">
					<?php
					 foreach($current_images as $image){
					    if($image['id'] !=$client_current_image[0]['id']){
					?>
					 
					     <a class="fancybox" href="../client_current_images/<?php echo $image['image_name'];?>" data-fancybox-group="gallery" title="<?php echo date("jS  M Y ",strtotime($image['upload_date'])); ?>"></a>
					   
					 
					<?php
					    }
					     }
					 ?>
					</div>
                                    </div>
                                    <script>
					 $(document).ready(function() {
							    /*
							     *  Simple image gallery. Uses default settings
							     */
				    
							    $(".fancybox")
								.attr('rel', 'gallery')
								.fancybox({
								    helpers: {
									thumbs: {
									    width  : 40,
									    height : 40,
									    source  : function(current) {
										return $(current.element).data('thumbnail');
									    }
									}
								    },
								    autoPlay: true
								});
					});
					function load_more_message_prog(per_load,user_id,logged_in_user){
					var start_val=document.getElementById('start_val_prog').value;
					var start=parseInt(start_val);
					var dataString ="per_load="+per_load+"&start="+start+"&user_id="+user_id+"&logged_in_user="+logged_in_user;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>dashboard/get_more_messages',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$('#new_msg_div_prog').prepend(data);
						$('#start_val_prog').val(start+per_load);
						
					    }
					    });
					}
				    function submit_message_prog(){
				
					    var frm=document.msg_form_prog;
					    var txt=frm.msg_box_prog.value;
					    var receiver=frm.sent_to_prog.value;
					    var start=parseInt(document.getElementById('start_val').value);
					    var start_prog=parseInt(document.getElementById('start_val_prog').value);
					    var start_trai=parseInt(document.getElementById('start_val_trai').value);
					    var start_diet=parseInt(document.getElementById('start_val_diet').value);
					    var start_dia=parseInt(document.getElementById('start_val_dia').value);
					    var dataString ="sent_to="+receiver+"&msg_text="+txt;
					    $.ajax
					    ({
					    type: "POST",
					    url: "<?php echo base_url();?>dashboard/enter_message_from_client_profile_page",
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						   //alert(data);
						   if (data !='error') {
						    $('#new_msg_div_prog').append(data);
						    $('#new_msg_div').append(data);
						    $('#new_msg_div_trai').append(data);
						    $('#new_msg_div_diet').append(data);
						    $('#new_msg_div_diary').append(data);
						    $('#start_val').val(start+1);
						    $('#start_val_prog').val(start_prog+1);
						    $('#start_val_trai').val(start_trai+1);
						    $('#start_val_diet').val(start_diet+1);
						    $('#start_val_dia').val(start_dia+1);
						    $('#msg_box_prog').val('');
						   }
					    }
					    });
					    }
				    </script>
                            <div class="innerblogtool  clearfix">
                            	<div class="Notificationblog">
				    <?php
				        $per_laod_prog = 5;
					$start_prog = 0;
				    ?>
				    <div id="msg_list_prog">
				    <?php
					$all_messages_prog=$ci->network_model->get_latest_user_messages($user_details[0]['id']);
					$chat_messages_prog=$ci->network_model->get_latest_user_chat($user_details[0]['id'],$per_laod_prog,$start_prog);
				    ?>
                                    <div class="notohead">MESSAGES <?php if(count($all_messages_prog) > $per_laod_prog) { ?><a class="Earlier" href="javascript:void(0)" onclick="load_more_message_prog(<?php echo $per_laod_prog; ?>,<?php echo $user_details[0]['id']; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Earlier</a><?php } ?></div>
				    <div id="new_msg_div_prog">
					<?php
					foreach($chat_messages_prog as $msg)
					{
					     $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
					?>
                                    <div class="massagebox" style="overflow: hidden;">
                                        <div class="daytim"><?php
					    if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d'))
					    {
						echo "Today";
					    }
					    else if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
					    {
						echo "Yesterday";
					    }
					    else
					    {
						echo date('Y-m-d',strtotime($msg['send_time']));
						//echo "Yesterday";
					    }
					    ?><span><?php echo date('H:i',strtotime($msg['send_time']));?></span></div>
                                        <div class="notiimgtxt">
                                            <div class="proimg"><img alt="" <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> style="height:38px; width:38px;"></div>
                                            <div class="notitxt"><span><?php echo $sender_information[0]['name'];?>:</span> <?php echo $msg['message'];?></div>
                                        </div>
                                    </div>
				    <?php
				        }
				    ?>
				    </div>
				  </div>
				  <div class="searchbgright">
					<form name="msg_form_prog" id="msg_form_prog" onsubmit="submit_message_prog();return false;">
                                        <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-pencil"></i></button>
                                        <div class="searchfieldouter">
                                            <input type="text" name="msg_box_prog" id="msg_box_prog" class="custfield diffcolor diffsize" placeholder="WRITE A MESSAGE"  style="text-transform:none;">
                                        </div>
					<input type="hidden" name="sent_to_prog" id="sent_to_prog" value="<?php echo $user_details[0]['id'];?>">
					<input type="hidden" name="start_val_prog" id="start_val_prog" value="5">
					</form>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                    		<div class="row customwidth tab-pane <?php if(isset($flash_message) && $flash_message == 'training_tab') {  ?>active<?php  }else{ ?><?php } ?>" role="tabpanel" id="tramnning">
                            <div class="col-md-8 col-xs-12 leftsidetab">
                                <div class="innerblog clearfix">
                                    <div class="clearfix gaplower">
                                        <div class="col-sm-5 col-xs-12">
                                        <div class="appoin_txt"><span><?php echo $name_array[0]." "; ?></span><?php echo end($name_array); ?></div>
					<?php
					$day_val = date("d");
					$month_val = date("m");
					$year_val = date("Y");
					$monthName = date("F", mktime(0, 0, 0, sprintf('%02d',$month_val), 10));
					$last_month =  date('m', strtotime(date('Y-m')." -1 month"));
					$last_two_month =  date('m', strtotime(date('Y-m')." -2 months"));
					$monthName_last = date("F", mktime(0, 0, 0, sprintf('%02d',$last_month), 10));
					$monthName_last_two = date("F", mktime(0, 0, 0, sprintf('%02d',$last_two_month), 10));
					
					
					 $last_year =  date('Y', strtotime(date('Y')." -1 month"));
					 $last_two_year =  date('Y', strtotime(date('Y')." -2 months"));
					
					$where_last_month=array(
					'client_id' => $user_details[0]['id'],
					'MONTH(workout_date)' => $last_month,
					'YEAR(workout_date)' => $last_year,
					     );
					$user_progrm_last=$ci->common_model->get('user_program_exercises',array('*'),$where_last_month);
					
					$where_last_month_un=array(
					'client_id' => $user_details[0]['id'],
					'MONTH(workout_date)' => $last_month,
					'YEAR(workout_date)' => $last_year,
					'status' => 'UF'
					     );
					$user_progrm_last_un=$ci->common_model->get('user_program_exercises',array('*'),$where_last_month_un);
					
					$where_last2_month=array(
					'client_id' => $user_details[0]['id'],
					'MONTH(workout_date)' => $last_two_month,
					'YEAR(workout_date)' => $last_two_year,
					     );
					$user_progrm_last2=$ci->common_model->get('user_program_exercises',array('*'),$where_last2_month);
					
					$where_last2_month_un=array(
					'client_id' => $user_details[0]['id'],
					'MONTH(workout_date)' => $last_two_month,
					'YEAR(workout_date)' => $last_two_year,
					'status' => 'UF'
					     );
					$user_progrm_last_un2=$ci->common_model->get('user_program_exercises',array('*'),$where_last2_month_un);
					
					?>
                                        <div class="datehead">Program for <span class="datecolor" id="progrm_date"><?php echo $day_val; ?> <?php echo $monthName;?></span><span class="yearfont" id="progrm_year"><?php echo $year_val; ?></span></div>
					<div id="rev_hist_train">
                                        <div class="clearfix Workoutouter">
                                        	<div class="Workoutouter">
                                        		<div class="Workoutdate">Workout <?php echo $monthName_last_two; ?>:</div>
                                                <div class="Workoutright">
                                                	<div class=""><span><?php echo count($user_progrm_last2); ?></span> programs</div>
                                                    <div class=""><span><?php echo count($user_progrm_last_un2); ?></span> unfinished</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix Workoutouter">
                                        	<div class="Workoutouter">
                                        		<div class="Workoutdate">Workout <?php echo $monthName_last; ?>:	</div>
                                                <div class="Workoutright">
                                                	<div class=""><span><?php echo count($user_progrm_last); ?></span> programs</div>
                                                    <div class=""><span><?php echo count($user_progrm_last_un); ?></span> unfinished</div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-12">
                                    		<div class="calendar" id="calendar_training">
						    <?php
						    
						     
						    $calendar = new Calendar();
						    $year = date("Y");
						    $month = date("m");
						    $where_meal=array(
						    'client_id' => $user_details[0]['id'],
						    'MONTH(workout_date)' => $month,
						    'YEAR(workout_date)' => $year,
							 );
						    $user_progrm=$ci->common_model->get('user_program_exercises',array('*'),$where_meal);
						    $all_dates = array();
						    $date_val = array();
						    foreach($user_progrm as $programs)
						    {
							 $date_val['date_work'] = $programs['workout_date'];
							 $date_val['status'] = $programs['status'];
							 $all_dates[] = $date_val;
						    }
						   
						    echo $calendar->show($year,$month,$all_dates);
						    $client_id = $user_details[0]['id'];
						    $where_meal=array(
							    'client_id' => $user_details[0]['id'], 
							    'workout_date' => date("Y-m-d")
								 );
						    $program_info=$ci->common_model->get('user_program_exercises',array('*'),$where_meal);
						    
						    ?>
						</div>
                                    	</div>
                                    </div>
                                    <div class="clearfix ">
                                    	<div class="col-xs-12">
					    <input type="hidden" name="date_val_training" id="date_val_training" value="<?php echo date('Y-m-d'); ?>">
                                        	<div class="panel-group" id="program_value">
						    <?php
						    if(count($program_info) > 0)
						    {
							foreach($program_info as $programs)
							{
							     $where_meal=array(
							    'id' => $programs['program_id']
								 );
							    $program_info_main=$this->common_model->get('user_program',array('*'),$where_meal);
							    
							    $where_meal=array(
							    'id' => $program_info_main[0]['default_program_id']
								 );
							    $program_info_each=$ci->common_model->get('program_list',array('*'),$where_meal);
							    ?>
							    <div class="panel panel-default">
								<div class="panel-heading">
								   <h4 class="panel-title progress_title">
								   <em>Program:</em><span><?php echo $program_info_each[0]['name']; ?></span>
								   <div class="pull-right">
										<a href="javascript:void(0)" onclick="remove_program($(this),<?php echo $programs['id']; ?>)"><i class="fa fa-fw fa fa-remove"></i>Remove</a>
										<?php
										if($program_info_main[0]['repeat_status'] =='N')
										{
										?>
										<a href="#" data-toggle="modal" data-target="#APPOINTMENT6" onclick="get_repeat_pop_prgm(<?php echo $programs['program_id']; ?>,<?php echo $client_id; ?>)"><i class="fa fa-fw fa fa-repeat"></i>
										<?php
										}
										else{
										    ?>
										    <a href="javascript:void(0)"><i class="fa fa-fw fa fa-repeat"></i>
										    <?php
										}
										?>
										
										<?php
										if($program_info_main[0]['repeat_status'] =='N')
										echo "Never";
										elseif($program_info_main[0]['repeat_status'] =='D')
										echo "Every Day";
										elseif($program_info_main[0]['repeat_status'] =='EXD')
										{
										    echo "Every ".$program_info_main[0]['every_x_day']." Day";
										}
										elseif($program_info_main[0]['repeat_status'] =='EW')
										{
										    $dayNames = array(
											0=>'Sunday',
											1=>'Monday', 
											2=>'Tuesday', 
											3=>'Wednesday', 
											4=>'Thursday', 
											5=>'Friday', 
											6=>'Saturday', 
										     );
										    foreach($dayNames as $num=>$val)
										    {
										       if($program_info_main[0]['every_week'] == $num)
										       {
											echo "Every ".$val."";
										       }
										      
										    }
										    
										}
										elseif($program_info_main[0]['repeat_status'] =='EM')
										{
										    echo "Every Month";
										}
										
										?>
										</a>
										</div>
									    </h4>
								 </div>
								<div class="panel-collapse">
								    <ul class="connectedSortable sortable_main" id="sortable<?php echo $programs['program_id']; ?>">
								    <?php
								    $where_meal_list=array(
								    'user_program_id' => $programs['id'],
								    'client_id' => $client_id,
								    'program_id' => $programs['program_id']
									 );
								    $exer_info=$ci->common_model->get('user_program_ex_exercise',array('*'),$where_meal_list);
								    foreach($exer_info as $exer_val)
								    {
									$where_meal_exer=array(
									'id' => $exer_val['exercise_id']
									     );
									$exer_info_det=$ci->common_model->get('exercise_list',array('*'),$where_meal_exer);
									$media = 'https://exorlive.com/media_'.$exer_info_det[0]['image_id'].'@50.50.media'
									?>
									<li id="<?php echo $exer_info_det[0]['id']."##".$exer_info_det[0]['type_id']; ?>">
									    
								       
									<div class="panel-body">
									    <div class="editblog">
									    <div class="workimg"><img alt="" src="<?php echo $media; ?>"></div>
									    <div class="workouttxt"><?php
								
								if(strlen($exer_info_det[0]['title']) > 25)
								{
								    echo substr($exer_info_det[0]['title'],0,25)."..";
								}
								else{
								    echo $exer_info_det[0]['title'];
								}
								    $where_cus_ex=array(
								    'user_program_id' => $programs['id'],
								    'client_id' => $client_id,
								    'program_id' => $programs['program_id'],
								    'exercise_id' => $exer_info_det[0]['id']
									 );
								    $cus_exer_info=$ci->common_model->get('user_custom_exercise',array('*'),$where_cus_ex);
								    $set_val = '';
								    if(count($cus_exer_info) > 0)
								    {
									$set_value = $cus_exer_info[0]['set_value'];
									
									$exp_sets = explode(",",$set_value);
									if(count($exp_sets) > 1)
									{
									    $first_val = current($exp_sets);
									    $last_val = end($exp_sets);
									    $exp_frst = explode("#@#@",$first_val);
									    $exp_last = explode("#@#@",$last_val);
									    $set_val = count($exp_sets)."X".$exp_frst[0]."-".$exp_last[0];
									}
									else{
									    $first_val = current($exp_sets);
									    
									    $exp_frst = explode("#@#@",$first_val);
									    
									    $set_val = count($exp_sets)."X".$exp_frst[0];
									}
									
								    }
								    
								    
								?>  <span id="cust_row<?php echo $exer_info_det[0]['id']; ?>">
								<?php
								if(count($cus_exer_info) > 0)
								{
								    echo "(Customized)";
								}
								else{
								    echo "&nbsp;";
								}
								?>
							       </span></div>
									    <div class="editright">
										<div class="intobox">
										    <?php
										    if($set_val != '')
										    {
											echo $set_val;
										    }
										    else
										    {
											echo "&nbsp;";
										    }
										    ?>
										</div>
										<a href="#" data-toggle="modal" data-target="#EXERCISE-INFORMATION" onclick="custom_exercise(<?php echo $exer_val['exercise_id']; ?>,<?php echo $programs['id']; ?>)"><img alt="" src="<?php echo base_url(); ?>assets/site/after_login/images/edit.png"></a>
										<a href="javascript:void(0)" onclick="remove_exer_frm_prog($(this),<?php echo $exer_val['id']; ?>)">
										    <i class="fa fa-fw fa fa-remove"></i>
										</a>
									    </div>
									</div>
									</div>
									 </li>
									<?php
								    }
								    ?>
								    </ul>
								   
								</div>
												     </div>
							    <?php
							}
							
						    }
						    ?>
						</div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
			    <script>
				function remove_exer_frm_prog(e,ex_id)
				{
				   
				    var date_val = document.getElementById('date_val_training').value;
				    var dataString ="exer_id="+ex_id+"&date_val="+date_val;
				    $.ajax
				    ({
				    type: "POST",
				    url: "<?php echo base_url();?>toolbox/delete_ex_val",
				    data: dataString,
				    cache: false,
				    success: function(data)
				    {
					
				     if (data != '')
				     {
					e.parents("li").remove();
				     }
				    }
				    });
				}
				function get_exercises(type_id,mode)
				{
				  if (type_id == '')
				  {
				    if (mode == 'list')
				      {
					$("#exercise_load").html("");
					$('#search_div').hide();
					$('#category_load').show();
				      }
				      else{
					 $('#sortable2').html("");
					 $('#search_val_div_pop').hide();
					 $('#category_load_pop').show();
				      }
				  }
				  else
				  {
				     var dataString ="type_id="+type_id+"&mode="+mode;
				    $.ajax
				    ({
				    type: "POST",
				    url: "<?php echo base_url();?>toolbox/get_exercise_list_client",
				    data: dataString,
				    cache: false,
				    success: function(data)
				    {
				      if (mode == 'list')
				      {
					   $('#search_type_list').val(type_id);
					   $('#exercise_load').html(data);
					   $('#category_load').hide();
					   $('#search_div').show();
					   $('#show_all_cat').show();
				      }
				      else{
					$('#sortable2').html(data);
					 $('#search_txt_div_pop').val(type_id);
					 $('#search_val_div_pop').show();
					 $('#show_all_cat_pop').show();
					 $('#category_load_pop').hide();
					 
					 //$( "#sortable1, #sortable2" ).sortable({
					 //   connectWith: ".connectedSortable",
					 //   cancel: ".ui-state-disabled",
					 //   
					 // }).disableSelection();
					 
				      }
				    }
				    });
				  }
				}
				 function show_all_pop()
				{
				   $("#sortable2").html("");
				  $('#search_val_div_pop').hide();
				  $('#category_load_pop').show();
				  $('#show_all_cat_pop').hide();
				  $('#search_txt_div_pop').val('');
				  $('#search_txt_pop').val('');
				}
				function add_exer_to_program(exer_id)
				{
				    var added_programs = document.getElementById('program_value').innerHTML;
				    var date_val = document.getElementById('date_val_training').value;
				    
				    if (document.getElementById('program_value').innerHTML == null)
				    {
					alert("Please add atleast one program");
				    }
				    else{
					var client_id = '<?php echo $user_details[0]['id']?>';
					var date_work = document.getElementById('date_val_training').value;
					 var dataString ="date_work="+date_work+"&client_id="+client_id+'&exer_id='+exer_id+'&date_val='+date_val;
						$.ajax
						({
						type: "POST",
						url: "<?php echo base_url();?>toolbox/get_programd_drop",
						data: dataString,
						cache: false,
						success: function(data)
						{
						  $('#program_popup').html(data);
						}
						});
				    }
				}
			    </script>
			    	<script>
					    function  search_program(val,mode)
					    {
						 var dataString ="search_text="+val+"&mode="+mode;
						$.ajax
						({
						type: "POST",
						url: "<?php echo base_url();?>toolbox/get_program_list",
						data: dataString,
						cache: false,
						success: function(data)
						{
						  if (mode == 'drag')
						  {
						       
						    $('#sortable_prgrm').html(data);
						    
						    
						  }
						}
						});
					    }
					    function add_program(program_id)
					    {
						var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
						var client_id = '<?php echo $user_details[0]['id']?>';
						var date_val_training = document.getElementById('date_val_training').value;
						if (date_val_training == '')
						{
						    alert("Please choose a date");
						}
						else
						{
						    var dataString ="program_id="+program_id+"&trainer_id="+trainer_id+"&client_id="+client_id+"&date_val_training="+date_val_training;
						    $.ajax
						    ({
						    type: "POST",
						    url: "<?php echo base_url();?>toolbox/add_program_list",
						    data: dataString,
						    cache: false,
						    success: function(data)
						    {
						      $("#program_value").append(data);
						    }
						    });
						}
						
					    }
					   function search_exercise(exer_val)
					    {
					      var type = $("#search_txt_div_pop").val();
					     
						var dataString ="search_text="+exer_val+"&type_id="+type;
						$.ajax
						({
						type: "POST",
						url: "<?php echo base_url();?>toolbox/get_exercise_list_client",
						data: dataString,
						cache: false,
						success: function(data)
						{
						  $('#sortable2').html(data);
						}
						});
					    }
					     
					  </script>

                            <div class="col-md-4 col-xs-12">
                                <div class="innerblogtool clearfix">
                                	<div class="questionmark"><a href="#"><img src="<?php echo base_url();?>assets/site/after_login/images/questionicon.png" alt="" /></a></div>
                                      <ul class="nav nav-tabs tabhead" role="tablist" id="myTab">
                                      		<li class="tabsingle active"><a href="#Exercises" aria-controls="Exercises" role="tab" data-toggle="tab">Exercises</a></li>
                                            <li class="tabsingle"><a href="#Routines" aria-controls="Routines" role="tab" data-toggle="tab">Programs</a></li>
                                            </ul>
                                       <div class="tab-content">
                                          <div class="tab-pane active" role="tabpanel" id="Exercises">
					     <div class="searchbgright drop_down" id="show_all_cat_pop" style="display: none;">
						<a href="javascript:void(0);" onclick="show_all_pop();">Show All Categories</a>
						
					      </div>
					    
                                            <div class="searchbgright" id="search_val_div_pop" style="display: none;">
						<input type="hidden" id="search_txt_div_pop" value="">
					      <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-search"></i></button>
					      <div class="searchfieldouter" id="search_div_program">
						<input type="text" id="search_txt_pop" name="" class="custfield diffcolor diffsize" value="SEARCH EXERCISE"  onChange="search_exercise(this.value,'drag')" onkeypress="search_exercise(this.value,'drag')" onkeyup="search_exercise(this.value,'drag')" onblur=" if(this.value=='') this.value = 'SEARCH EXERCISE';" onclick="if(this.value=='SEARCH EXERCISE') this.value = ''; ">
					      </div>
					    </div>
					    <div id="category_load_pop" class="load_cats">
						<?php
						      $type_list=$ci->common_model->get('exorlive_type_list',array('*'));
						      foreach($type_list as $type)
						      {
						      ?>
						       <div class="editblog">
							 
							    <div class="workouttxt"><?php echo $type['type_name'];?> </div>
							    <div class="editright">
								<a href="javascript:void(0);" onclick="get_exercises(<?php echo $type['type_id'];?>,'drag');">Browse</a>
							    </div>
							    
							</div>
						      <?php
						      }
						      ?>
					       
					      </div>
					      <ul id="sortable2" class="connectedSortable">
                    
					    </ul>
					    
                                          </div>
                                          <div class="tab-pane" role="tabpanel" id="Routines">
						<div class="searchbgright">
						<button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-search"></i></button>
						<div class="searchfieldouter">
						    <input type="text" name="" class="custfield diffcolor diffsize" value="SEARCH PROGRAM" onBlur=" if(this.value=='') this.value = 'SEARCH PROGRAM';" onChange="search_program(this.value,'drag')" onkeypress="search_program(this.value,'drag')" onkeyup="search_program(this.value,'drag')" onClick="if(this.value=='SEARCH PROGRAM') this.value = ''; ">
						</div>
					    </div>
					     <ul id="sortable_prgrm" class="connectedSortable">
						<?php
						$program_list=$ci->common_model->get('program_list',array('*'));
						foreach($program_list as $program)
						{
						?>
						<li id="<?php echo $program['id']; ?>">
						 <div class="editblog">
						   
						      <div class="workouttxt"><?php echo $program['name'];?> </div>
						      
						      <div class="editright">
							 <a class="butsblue" href="#" onclick="add_program(<?php echo $program['id']; ?>);"> Add</a>
						      </div>
						      
						  </div>
						 </li>
						<?php
						}
						?>
					    </ul>
                                          </div>
                                      </div>
                                </div>
				    <script>
					function load_more_message_trai(per_load,user_id,logged_in_user){
					var start_val=document.getElementById('start_val_trai').value;
					var start=parseInt(start_val);
					var dataString ="per_load="+per_load+"&start="+start+"&user_id="+user_id+"&logged_in_user="+logged_in_user;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>dashboard/get_more_messages',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$('#new_msg_div_trai').prepend(data);
						$('#start_val_trai').val(start+per_load);
						
					    }
					    });
					}
				    function submit_message_trai(){
				
					    var frm=document.msg_form_trai;
					    var txt=frm.msg_box_trai.value;
					    var receiver=frm.sent_to_trai.value;
					    var start=parseInt(document.getElementById('start_val').value);
					    var start_prog=parseInt(document.getElementById('start_val_prog').value);
					    var start_trai=parseInt(document.getElementById('start_val_trai').value);
					    var start_diet=parseInt(document.getElementById('start_val_diet').value);
					    var start_dia=parseInt(document.getElementById('start_val_dia').value);
					    var dataString ="sent_to="+receiver+"&msg_text="+txt;
					    $.ajax
					    ({
					    type: "POST",
					    url: "<?php echo base_url();?>dashboard/enter_message_from_client_profile_page",
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						   //alert(data);
						   if (data !='error') {
						    $('#new_msg_div_prog').append(data);
						    $('#new_msg_div').append(data);
						    $('#new_msg_div_trai').append(data);
						    $('#new_msg_div_diet').append(data);
						    $('#new_msg_div_diary').append(data);
						    $('#start_val').val(start+1);
						    $('#start_val_prog').val(start_prog+1);
						    $('#start_val_trai').val(start_trai+1);
						    $('#start_val_diet').val(start_diet+1);
						    $('#start_val_dia').val(start_dia+1);
						    $('#msg_box_trai').val('');
						   }
					    }
					    });
					    }
				    </script>
                               <div class="innerblogtool clearfix">
                            	<div class="Notificationblog">
				    <?php
				        $per_load_trai = 5;
					$start_trai = 0;
				    ?>
				  <div id="msg_list_trai">
				    <?php
					$all_messages_trai=$ci->network_model->get_latest_user_messages($user_details[0]['id']);
					$chat_messages_trai=$ci->network_model->get_latest_user_chat($user_details[0]['id'],$per_load_trai,$start_trai);
				    ?>
                                    <div class="notohead">MESSAGES<?php if(count($all_messages_trai) > $per_load_trai) { ?><a class="Earlier" href="javascript:void(0)" onclick="load_more_message_trai(<?php echo $per_load_trai; ?>,<?php echo $user_details[0]['id']; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Earlier</a><?php } ?></div>
				    <div id="new_msg_div_trai">
					<?php
					foreach($chat_messages_trai as $msg)
					{
					     $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
					?>
                                    <div class="massagebox" style="overflow: hidden;">
                                        <div class="daytim"><?php
					    if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d'))
					    {
						echo "Today";
					    }
					    else if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
					    {
						echo "Yesterday";
					    }
					    else
					    {
						echo date('Y-m-d',strtotime($msg['send_time']));
					    }
					    ?><span><?php echo date('H:i',strtotime($msg['send_time']));?></span></div>
                                        <div class="notiimgtxt">
                                            <div class="proimg"><img alt="" <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> style="height:38px; width:38px;"></div>
                                            <div class="notitxt"><span><?php echo $sender_information[0]['name'];?>:</span> <?php echo $msg['message'];?></div>
                                        </div>
                                    </div>
				    <?php
					}
				    ?>
				    </div>
				    </div>
				    <div class="searchbgright">
					<form name="msg_form_trai" id="msg_form_trai" onsubmit="submit_message_trai();return false;">
                                        <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-pencil"></i></button>
                                        <div class="searchfieldouter">
                                            <input type="text" name="msg_box_trai" id="msg_box_trai" class="custfield diffcolor diffsize" placeholder="WRITE A MESSAGE"  style="text-transform:none;">
                                        </div>
					<input type="hidden" name="sent_to_trai" id="sent_to_trai" value="<?php echo $user_details[0]['id'];?>">
					<input type="hidden" name="start_val_trai" id="start_val_trai" value="5">
					</form>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                       		<?php
				$day_val = date("d");
				$month_val = date("m");
				$year_val = date("Y");
				$monthName = date("F", mktime(0, 0, 0, sprintf('%02d',$month_val), 10));
				 $last_month =  date('m', strtotime(date('Y-m')." -1 month"));
				 $last_two_month =  date('m', strtotime(date('Y-m')." -2 months"));
				$monthName_last = date("F", mktime(0, 0, 0, sprintf('%02d',$last_month), 10));
				$monthName_last_two = date("F", mktime(0, 0, 0, sprintf('%02d',$last_two_month), 10));
				
				
				 $last_year =  date('Y', strtotime(date('Y')." -1 month"));
				 $last_two_year =  date('Y', strtotime(date('Y')." -2 months"));
				
				$where_last_month=array(
				'client_id' => $user_details[0]['id'],
				'MONTH(workout_date)' => $last_month,
				'YEAR(workout_date)' => $last_year,
				     );
				$user_progrm_last=$ci->common_model->get('user_meal_dates',array('*'),$where_last_month);
				
				$where_last_month_un=array(
				'client_id' => $user_details[0]['id'],
				'MONTH(workout_date)' => $last_month,
				'YEAR(workout_date)' => $last_year,
				'status' => 'UF'
				     );
				$user_progrm_last_un=$ci->common_model->get('user_meal_dates',array('*'),$where_last_month_un);
				
				$where_last2_month=array(
				'client_id' => $user_details[0]['id'],
				'MONTH(workout_date)' => $last_two_month,
				'YEAR(workout_date)' => $last_two_year,
				     );
				$user_progrm_last2=$ci->common_model->get('user_meal_dates',array('*'),$where_last2_month);
				
				$where_last2_month_un=array(
				'client_id' => $user_details[0]['id'],
				'MONTH(workout_date)' => $last_two_month,
				'YEAR(workout_date)' => $last_two_year,
				'status' => 'UF'
				     );
				$user_progrm_last_un2=$ci->common_model->get('user_meal_dates',array('*'),$where_last2_month_un);
				?>
                        <div class="row customwidth tab-pane <?php if(isset($flash_message) && $flash_message == 'meal_tab') {  ?>active<?php  }else{ ?><?php } ?>" role="tabpanel" id="diet">
                            <div class="col-md-8 col-xs-12 leftsidetab">
                                 <div class="innerblog clearfix">
                                    <div class="clearfix gaplower">
                                        <div class="col-sm-5 col-xs-12">
                                        <div class="appoin_txt"><span><?php echo $name_array[0]." "; ?></span><?php echo end($name_array); ?></div>
                                        <div class="datehead">Diet for <span class="datecolor" id="diet_date"><?php echo $day_val; ?> <?php echo $monthName; ?></span><span class="yearfont" id="diet_year"><?php echo $year_val; ?></span></div>
					<div id="prev_die_hist">
					    <div class="clearfix Workoutouter">
						   <div class="Workoutouter">
							   <div class="Workoutdate">Diet <?php echo $monthName_last_two; ?>:</div>
						   <div class="Workoutright">
							   <div class=""><span><?php echo count($user_progrm_last2); ?></span> Meals</div>
						       
						   </div>
					       </div>
					   </div>
					    <div class="clearfix Workoutouter">
						<div class="Workoutouter">
							    <div class="Workoutdate">Diet <?php echo $monthName_last; ?>:	</div>
						    <div class="Workoutright">
							    <div class=""><span><?php echo count($user_progrm_last); ?></span> Meals</div>
							
						    </div>
						</div>
					    </div>
					</div>
                                       
                                        </div>
                                        <div class="col-sm-7 col-xs-12">
                                    		<div class="calendar" id="diet_calendar">
						    <?php
						    
						     
						    $calendar = new Calendar_diet();
						    $year = date("Y");
						    $month = date("m");
						    $where_meal=array(
						    'client_id' => $user_details[0]['id'],
						    'MONTH(workout_date)' => $month,
						    'YEAR(workout_date)' => $year,
							 );
						    $user_progrm=$ci->common_model->get('user_meal_dates',array('*'),$where_meal);
						    $date_val = array();
						    foreach($user_progrm as $programs)
						    {
							 $date_val[] = $programs['workout_date'];
						    }
						   
						    echo $calendar->show($year,$month,$date_val);
						    $client_id = $user_details[0]['id'];
						    $where_meal=array(
							    'client_id' => $user_details[0]['id'],
							    'workout_date' => date("Y-m-d")
								 );
						    $meal_info=$ci->common_model->get('user_meal_dates',array('*'),$where_meal);
						    
						    ?>
						</div>
                                    	</div>
                                    </div>
				    <script>
					function assign_get_meals(e,date_val,month,year)
					{
					    var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
					    var client_id = '<?php echo $user_details[0]['id']?>';
					    var dataString ='date_val='+date_val+'&month='+month+'&year='+year+'&trainer_id='+trainer_id+'&client_id='+client_id;
					    $.ajax
					    ({
					    type: "POST",
					    url: "<?php echo base_url();?>toolbox/get_meal_details",
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						var cont= data.split("@@##@@");
					      $("div#diet_calendar .unit").removeClass("active");
					      $("#diet_value").html(cont[0]);
					      $("#date_val_diet").val(date_val+"-"+month+"-"+year);
					      $("#diet_date").html(date_val+" "+cont[1]);
					       $("#diet_year").html(year);
					       $("#prev_die_hist").html(cont[2]);
					     $(e).parents(".unit").addClass("active");
					     $(e).parents(".unit").addClass("active");
					    }
					    });
					}
					function remove_meal_frm_prog(e,meal_id)
					{
					   
					    var date_val = document.getElementById('date_val_diet').value;
					    var dataString ="meal_id="+meal_id+"&date_val="+date_val;
					    $.ajax
					    ({
					    type: "POST",
					    url: "<?php echo base_url();?>toolbox/delete_meal_val",
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						
					     if (data != '')
					     {
						e.parents(".editblog").remove();
					     }
					    }
					    });
					}
					
					function get_repeat_pop_meal(main_meal_id,client_id) {
					    var date_val = document.getElementById('date_val_diet').value;
					    var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
					     var dataString ="main_meal_id="+main_meal_id+'&client_id='+client_id+'&trainer_id='+trainer_id+'&date_val='+date_val;
					       $.ajax
					       ({
					       type: "POST",
					       url: "<?php echo base_url();?>toolbox/get_repeat_popup_meal",
					       data: dataString,
					       cache: false,
					       success: function(data)
					       {
						 
						 $("#repeat_program").html(data);
						
					       }
					       });
				       }
				       function remove_meal(e,main_meal_id)
				       {
					    var client_id = '<?php echo $user_details[0]['id']?>';
					    var date_val = document.getElementById('date_val_diet').value;
					    var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
					     var dataString ="main_meal_id="+main_meal_id+'&client_id='+client_id+'&trainer_id='+trainer_id+'&date_val='+date_val;
					       $.ajax
					       ({
					       type: "POST",
					       url: "<?php echo base_url();?>toolbox/remove_diet_for_day",
					       data: dataString,
					       cache: false,
					       success: function(data)
					       {
						 if (data != '')
						 {
						    $("#diet_value").html('');
						 }
						 
						
					       }
					       });
				       }
				       
				    </script>
                                    <div class="clearfix ">
                                    	<div class="col-xs-12">
					    <input type="hidden" name="date_val_diet" id="date_val_diet" value="<?php echo date("Y-m-d"); ?>">
                                        	<div class="panel-group" id="diet_value">
						    <?php
						    $day_name = date('l', strtotime(date("Y-m-d")));
						    if(count($meal_info) > 0)
						    {
							foreach($meal_info as $meals)
							{
							    $main_meal_id = $meals['main_meal_id'];
							}
							$where_meal=array(
							    'id' => $main_meal_id
								 );
							$meal_info_main=$ci->common_model->get('user_meal',array('*'),$where_meal);
							?>
							<div class="panel panel-default">
							<div class="panel-heading">
							   <h4 class="panel-title progress_title">
							   <em>Diet:</em><span><?php echo $day_name; ?></span>
							    <div class="pull-right">
								  <a href="javascript:void(0)" onclick="remove_meal($(this),<?php echo $main_meal_id; ?>)"><i class="fa fa-fw fa fa-remove"></i>Remove</a>
								  <?php
								      if($meal_info_main[0]['repeat_status'] =='N')
								      {
								      ?>
								      <a href="#" data-toggle="modal" data-target="#APPOINTMENT6" onclick="get_repeat_pop_meal(<?php echo $main_meal_id; ?>,<?php echo $client_id; ?>)"><i class="fa fa-fw fa fa-repeat"></i>
								      <?php
								      }
								      else{
									  ?>
									  <a href="javascript:void(0)"><i class="fa fa-fw fa fa-repeat"></i>
									  <?php
								      }
								      ?>
								   <?php
							      if($meal_info_main[0]['repeat_status'] =='N')
							      echo "Never";
							      elseif($meal_info_main[0]['repeat_status'] =='D')
							      echo "Every Day";
							      elseif($meal_info_main[0]['repeat_status'] =='EXD')
							      {
								  echo "Every ".$meal_info_main[0]['every_x_day']." Day";
							      }
							      elseif($meal_info_main[0]['repeat_status'] =='EW')
							      {
								  $dayNames = array(
								      0=>'Sunday',
								      1=>'Monday', 
								      2=>'Tuesday', 
								      3=>'Wednesday', 
								      4=>'Thursday', 
								      5=>'Friday', 
								      6=>'Saturday', 
								   );
								  foreach($dayNames as $num=>$val)
								  {
								     if($meal_info_main[0]['every_week'] == $num)
								     {
								      echo "Every ".$val."";
								     }
								    
								  }
								  
							      }
							      elseif($meal_info_main[0]['repeat_status'] =='EM')
							      {
								  echo "Every Month";
							      }
							
							      ?></a>
								  </div>
							
							</h4>
							 </div>
							<div class="panel-collapse">
							    <?php
							    foreach($meal_info as $meals)
							    {
								 $where_meal_exer=array(
								    'id' => $meals['meal_id']
									 );
								    $meal_info_det=$ci->common_model->get('meal',array('*'),$where_meal_exer);
								    $where_meal_exer=array(
								    'meal_id' => $meals['meal_id']
									 );
								    $meal_info_image=$ci->common_model->get('meal_images',array('*'),$where_meal_exer);
								    if(isset($meal_info_image[0]['filename']))
								    {
									$media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
								    }
								    else
								    {
									$media = base_url().'assets/site/after_login/images/no-image.gif';
								    }
								   // $media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
								?>
								<div class="panel-body">
								    <div class="editblog">
								    <div class="workimg"><img alt="" src="<?php echo $media; ?>" style="height: 50px;width: 50px;"></div>
								    <div class="workouttxt">
								    <?php
							
									if(strlen($meal_info_det[0]['title']) > 25)
									{
									    echo substr($meal_info_det[0]['title'],0,25)."..";
									}
									else{
									    echo $meal_info_det[0]['title'];
									}
									$where_meal_list=array(
									'meal_dates_id' => $meals['id'],
									'client_id' => $client_id
									     );
									$meals_info=$ci->common_model->get('user_custom_meal',array('*'),$where_meal_list);
									
									$where_meal_opt=array(
									'meal_id' => $meals['meal_id']
									     );
									$meal_info_det_other=$ci->common_model->get('meal_other_options',array('*'),$where_meal_opt);
								       foreach($meal_info_det_other as $options)
								       {
									$main_opts[] = $options['specifically']."#@#@".$options['amount'];
								       }
									$set_val = '';
									$customized = false;
									if(count($meals_info) > 0)
									{
									    
									    $set_value = $meals_info[0]['set_value'];
									    if($set_value != '')
									    {
										$exp_sets = explode(",",$set_value);
									    }
									    if(count($exp_sets) != count($meal_info_det_other))
									    {
										$customized = true;
									    }
									    else
									    {
										foreach($exp_sets as $sets)
										{
										    if(!in_array($sets,$main_opts))
										    {
											$customized = true;
											break;
										    }
										}
									    }
									    
									}
							
							    
									?>  <span>
									    <?php
									    if($customized == true)
									    {
										echo "(Customized)";
									    }
									    else{
										echo "&nbsp;";
									    }
									    ?>
									   </span></div>
								    <div class="editright">
									
									<a href="#" data-toggle="modal" data-target="#EXERCISE-INFORMATION" onclick="custom_meal(<?php echo $meals['meal_id']; ?>,<?php echo $meals['id']; ?>)"><img alt="" src="<?php echo base_url(); ?>assets/site/after_login/images/edit.png"></a>
									<a href="javascript:void(0)" onclick="remove_meal_frm_prog($(this),<?php echo $meals['id']; ?>)">
									    <i class="fa fa-fw fa fa-remove"></i>
									</a>
								    </div>
								</div>
									</div>
						    
								<?php
							    }
							    ?>
							    
							</div>
						     </div>
							<?php
						    }
						    ?>
                                             </div>
                                        </div>
                                        </div>
                                    </div>
                            </div>
			    <script>
				function custom_meal(meal_org_id,meal_dates_id) {
				   var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
				   var client_id = '<?php echo $user_details[0]['id']?>';
				   var date_work = document.getElementById('date_val_diet').value;
				   var dataString ="date_work="+date_work+"&client_id="+client_id+'&meal_org_id='+meal_org_id+'&trainer_id='+trainer_id+'&meal_dates_id='+meal_dates_id;
				    $.ajax
				    ({
				    type: "POST",
				    url: "<?php echo base_url();?>toolbox/get_meal_custom_pop",
				    data: dataString,
				    cache: false,
				    success: function(data)
				    {
					//alert(data);
				      $('#custom_Exer').html(data);
				    }
				    });
				}
				function add_meal_to_day(meal_id)
				{
				    var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
				   var client_id = '<?php echo $user_details[0]['id']?>';
				   var date_work = document.getElementById('date_val_diet').value;
				   var dataString ="date_work="+date_work+"&client_id="+client_id+'&meal_id='+meal_id+'&trainer_id='+trainer_id;
				    $.ajax
				    ({
				    type: "POST",
				    url: "<?php echo base_url();?>toolbox/add_meal_to_day",
				    data: dataString,
				    cache: false,
				    success: function(data)
				    {
					
				      $('#diet_value').html(data);
				    }
				    });
				}
				function search_meals(srch_txt)
				{
				    var dataString ="search_text="+srch_txt;
				    $.ajax
				    ({
				    type: "POST",
				    url: "<?php echo base_url();?>toolbox/get_meal_list",
				    data: dataString,
				    cache: false,
				    success: function(data)
				    {
				      $('#meal_section').html(data);
				    }
				    });
				}
			    </script>
                            <div class="col-md-4 col-xs-12">
                                <div class="innerblogtool clearfix">
                                        <div class="searchbgright">
                                        <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-search"></i></button>
                                        <div class="searchfieldouter">
                                            <input type="text" name="" class="custfield diffcolor diffsize" value="SEARCH MEALS" onBlur=" if(this.value=='') this.value = 'SEARCH MEALS';" onClick="if(this.value=='SEARCH MEALS') this.value = ''; " onkeyup="search_meals(this.value)">
                                        </div>
                                    </div>
					<div id="meal_section" style="max-height: 300px;overflow-y: scroll;">
					<?php
					$where_meal_trn=array(
					    'trainer_id' => $this->session->userdata('site_user_id')
						 );
					$all_meal=$ci->common_model->get('meal',array('*'),$where_meal_trn);
					foreach($all_meal as $meals)
					{
					    $where_meal_exer=array(
					    'meal_id' => $meals['id']
						 );
					    $meal_info_image=$ci->common_model->get('meal_images',array('*'),$where_meal_exer);
					    if(isset($meal_info_image[0]['filename']))
					    {
						$media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
					    }
					    else
					    {
						$media = base_url().'assets/site/after_login/images/no-image.gif';
					    }
					    
					   ?>
					   <div class="editblog">
						<div class="workimg"><img alt="" src="<?php echo $media; ?>" style="height: 50px;width: 50px;"></div>
						<div class="workouttxt">
						    <?php
						    if(strlen($meals['title']) > 15)
						    {
							echo substr($meals['title'],0,15)."..";
						    }
						    else{
							echo $meals['title'];
						    }
						    ?>
						</div>
						<div class="editright">
						    <a class="butsblue" href="javascript:void(0)" onclick="add_meal_to_day(<?php echo $meals['id']; ?>)">
						    Add
							<!--<i class="fa fa-plus"></i>-->
						    </a>
						</div>
					    </div>
					   <?php
					}
					?>
					</div>
					</div>
				      <script>
					function load_more_message_diet(per_load,user_id,logged_in_user){
					var start_val=document.getElementById('start_val_diet').value;
					var start=parseInt(start_val);
					var dataString ="per_load="+per_load+"&start="+start+"&user_id="+user_id+"&logged_in_user="+logged_in_user;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>dashboard/get_more_messages',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$('#new_msg_div_diet').prepend(data);
						$('#start_val_diet').val(start+per_load);
						
					    }
					    });
					}
				    function submit_message_diet(){
				
					    var frm=document.msg_form_diet;
					    var txt=frm.msg_box_diet.value;
					    var receiver=frm.sent_to_diet.value;
					    var start=parseInt(document.getElementById('start_val').value);
					    var start_prog=parseInt(document.getElementById('start_val_prog').value);
					    var start_trai=parseInt(document.getElementById('start_val_trai').value);
					    var start_diet=parseInt(document.getElementById('start_val_diet').value);
					    var start_dia=parseInt(document.getElementById('start_val_dia').value);
					    var dataString ="sent_to="+receiver+"&msg_text="+txt;
					    $.ajax
					    ({
					    type: "POST",
					    url: "<?php echo base_url();?>dashboard/enter_message_from_client_profile_page",
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						   //alert(data);
						   if (data !='error') {
						    $('#new_msg_div_prog').append(data);
						    $('#new_msg_div').append(data);
						    $('#new_msg_div_trai').append(data);
						    $('#new_msg_div_diet').append(data);
						    $('#new_msg_div_diary').append(data);
						    $('#start_val').val(start+1);
						    $('#start_val_prog').val(start_prog+1);
						    $('#start_val_trai').val(start_trai+1);
						    $('#start_val_diet').val(start_diet+1);
						    $('#start_val_dia').val(start_dia+1);
						    $('#msg_box_diet').val('');
						   }
					    }
					    });
					    }
				    </script>
                               <div class="innerblogtool clearfix">
                            	<div class="Notificationblog">
				     <?php
				        $per_load_diet = 5;
					$start_diet = 0;
				    ?>
				    <div id="msg_list_diet">
				    <?php
					$all_messages_diet=$ci->network_model->get_latest_user_messages($user_details[0]['id']);
					$chat_messages_diet=$ci->network_model->get_latest_user_chat($user_details[0]['id'],$per_load_diet,$start_diet);
				    ?>
                                    <div class="notohead">MESSAGES<?php if(count($all_messages_diet) > $per_load_diet) { ?><a class="Earlier" href="javascript:void(0)" onclick="load_more_message_diet(<?php echo $per_load_diet; ?>,<?php echo $user_details[0]['id']; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Earlier</a><?php } ?></div>
				    <div id="new_msg_div_diet">
				    <?php
				    foreach($chat_messages_diet as $msg)
				    {
					 $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
				    ?>
                                    <div class="massagebox" style="overflow: hidden;">
                                        <div class="daytim"><?php
					    if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d'))
					    {
						echo "Today";
					    }
					    else if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
					    {
						echo "Yesterday";
					    }
					    else
					    {
						echo date('Y-m-d',strtotime($msg['send_time']));
					    }
					    ?><span><?php echo date('H:i',strtotime($msg['send_time']));?></span></div>
                                        <div class="notiimgtxt">
                                            <div class="proimg"><img alt="" <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> style="height:38px; width:38px;"></div>
                                            <div class="notitxt"><span><?php echo $sender_information[0]['name'];?>:</span> <?php echo $msg['message'];?></div>
                                        </div>
                                    </div>
				    <?php
				    }
				    ?>
				    </div>
				    </div>
				    <div class="searchbgright">
					<form name="msg_form_diet" id="msg_form_diet" onsubmit="submit_message_diet();return false;">
                                        <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-pencil"></i></button>
                                        <div class="searchfieldouter">
                                            <input type="text" name="msg_box_diet" id="msg_box_diet" class="custfield diffcolor diffsize" placeholder="WRITE A MESSAGE"  style="text-transform:none;">
                                        </div>
					<input type="hidden" name="sent_to_diet" id="sent_to_diet" value="<?php echo $user_details[0]['id'];?>">
					<input type="hidden" name="start_val_diet" id="start_val_diet" value="5">
					</form>
                                    </div>

                                </div>
                            </div>
                                </div>
                        </div>
			<script>
			    function assign_get_diary(e,date_val,month,year)
			    {
				var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
				var client_id = '<?php echo $user_details[0]['id']?>';
				var dataString ='date_val='+date_val+'&month='+month+'&year='+year+'&trainer_id='+trainer_id+'&client_id='+client_id;
				$.ajax
				({
				type: "POST",
				url: "<?php echo base_url();?>toolbox/get_diary_details",
				data: dataString,
				cache: false,
				success: function(data)
				{
				    var cont= data.split("@@##@@");
				  $("div#diary_calendar .unit").removeClass("active");
				  $("#diary_value").html(cont[0]);
				  $("#date_val_diary").val(date_val+"-"+month+"-"+year);
				  $("#diary_date").html(date_val+" "+cont[1]);
				   $("#diary_year").html(year);
				
				 $(e).parents(".unit").addClass("active");
				 $(e).parents(".unit").addClass("active");
				}
				});
			    }
			  
			</script>
			<?php
			$day_val = date("d");
			$month_val = date("m");
			$year_val = date("Y");
			$monthName = date("F", mktime(0, 0, 0, sprintf('%02d',$month_val), 10));
			?>
                        <div class="row customwidth tab-pane" role="tabpanel" id="dairy">
                            <div class="col-md-8 col-xs-12 leftsidetab">
                                 <div class="innerblog clearfix">
                                    <div class="clearfix gaplower">
                                        <div class="col-sm-5 col-xs-12">
                                        <div class="appoin_txt"><span><?php echo $name_array[0]." "; ?></span><?php echo end($name_array); ?></div>
                                        <div class="datehead">Diary for <span class="datecolor" id="diary_date"><?php echo $day_val; ?> <?php echo $monthName; ?></span><span class="yearfont" id="diary_year"><?php echo $year_val; ?></span></div>
                                       
                                        </div>
                                        <div class="col-sm-7 col-xs-12">
                                    		<div class="calendar" id="diary_calendar">
						    <?php
						    $calendar = new Calendar_diary();
						    $year = date("Y");
						    $month = date("m");
						    $where_meal=array(
						    'client_id' => $user_details[0]['id'],
						    'MONTH(date_val)' => $month,
						    'YEAR(date_val)' => $year,
							 );
						    $user_progrm=$ci->common_model->get('user_diary',array('*'),$where_meal);
						    $date_val = array();
						    foreach($user_progrm as $programs)
						    {
							 $date_val[] = $programs['date_val'];
						    }
						   
						    echo $calendar->show($year,$month,$date_val);
						    $client_id = $user_details[0]['id'];
						    $where_meal=array(
							    'client_id' => $user_details[0]['id'],
							    'date_val' => date("Y-m-d")
								 );
						    $diary_info=$ci->common_model->get('user_diary',array('*'),$where_meal);
						    ?>
                                            </div>
                                    	</div>
                                    </div>
				    <input type="hidden" name="date_val_diary" id="date_val_diary" value="<?php echo date("Y-m-d"); ?>">
                                    <div class="clearfix ">
                                    	<div class="col-xs-12">
                                        	<div class="panel-group" id="diary_value">
						    <?php
						    foreach($diary_info as $diary)
						    {
							?>
							<div class="panel panel-default">
							    <div class="panel-heading panel-border">
							       <h4><?php echo $diary['diary_heading']; ?></h4>
								<?php echo $diary['dairy_text']; ?>
							     </div>
							 </div>
							<?php
						    }
						    ?>
                                                
                                             </div>
                                        </div>
                                        </div>
                                    </div>
                            </div>
			    	<script>
					function load_more_message_dia(per_load,user_id,logged_in_user){
					var start_val=document.getElementById('start_val_dia').value;
					var start=parseInt(start_val);
					var dataString ="per_load="+per_load+"&start="+start+"&user_id="+user_id+"&logged_in_user="+logged_in_user;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>dashboard/get_more_messages',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$('#new_msg_div_diary').prepend(data);
						$('#start_val_dia').val(start+per_load);
						
					    }
					    });
					}
				    function submit_message_dia(){
				
					    var frm=document.msg_form_dia;
					    var txt=frm.msg_box_dia.value;
					    var receiver=frm.sent_to_dia.value;
					    var start=parseInt(document.getElementById('start_val').value);
					    var start_prog=parseInt(document.getElementById('start_val_prog').value);
					    var start_trai=parseInt(document.getElementById('start_val_trai').value);
					    var start_diet=parseInt(document.getElementById('start_val_diet').value);
					    var start_dia=parseInt(document.getElementById('start_val_dia').value);
					    var dataString ="sent_to="+receiver+"&msg_text="+txt;
					    $.ajax
					    ({
					    type: "POST",
					    url: "<?php echo base_url();?>dashboard/enter_message_from_client_profile_page",
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						   //alert(data);
						   if (data !='error') {
						    $('#new_msg_div_prog').append(data);
						    $('#new_msg_div').append(data);
						    $('#new_msg_div_trai').append(data);
						    $('#new_msg_div_diet').append(data);
						    $('#new_msg_div_diary').append(data);
						    $('#start_val').val(start+1);
						    $('#start_val_prog').val(start_prog+1);
						    $('#start_val_trai').val(start_trai+1);
						    $('#start_val_diet').val(start_diet+1);
						    $('#start_val_dia').val(start_dia+1);
						    $('#msg_box_dia').val('');
						   }
					    }
					    });
					    }
				    </script>
                            <div class="col-md-4 col-xs-12">
                               <div class="innerblogtool clearfix">
                            	<div class="Notificationblog">
				     <?php
				        $per_load_dia = 5;
					$start_dia = 0;
				    ?>
                                    <div id="msg_list_dia">
				    <?php
					$all_messages_dia=$ci->network_model->get_latest_user_messages($user_details[0]['id']);
					$chat_messages_dia=$ci->network_model->get_latest_user_chat($user_details[0]['id'],$per_load_dia,$start_dia);
				    ?>
                                    <div class="notohead">MESSAGES<?php if(count($all_messages_dia) > $per_load_dia) { ?><a class="Earlier" href="javascript:void(0)" onclick="load_more_message_dia(<?php echo $per_load_dia; ?>,<?php echo $user_details[0]['id']; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Earlier</a><?php } ?></div>
				    <div id="new_msg_div_diary">
				    <?php
				    foreach($chat_messages_dia as $msg)
				    {
					 $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
				    ?>
                                    <div class="massagebox" style="overflow:hidden;">
                                        <div class="daytim"><?php
					    if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d'))
					    {
						echo "Today";
					    }
					    else if(date('Y-m-d',strtotime($msg['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
					    {
						echo "Yesterday";
					    }
					    else
					    {
						echo date('Y-m-d',strtotime($msg['send_time']));
					    }
					    ?><span><?php echo date('H:i',strtotime($msg['send_time']));?></span></div>
                                        <div class="notiimgtxt">
                                            <div class="proimg"><img alt="" <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> style="height:38px; width:38px;"></div>
                                            <div class="notitxt"><span><?php echo $sender_information[0]['name'];?>:</span> <?php echo $msg['message'];?></div>
                                        </div>
                                    </div>
				    <?php
				    }
				    ?>
				</div>
			       </div>
				    <div class="searchbgright">
					<form name="msg_form_dia" id="msg_form_dia" onsubmit="submit_message_dia();return false;">
                                        <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-pencil"></i></button>
                                        <div class="searchfieldouter">
                                            <input type="text" name="msg_box_dia" id="msg_box_dia" class="custfield diffcolor diffsize" placeholder="WRITE A MESSAGE" style="text-transform:none;">
                                        </div>
					<input type="hidden" name="sent_to_dia" id="sent_to_dia" value="<?php echo $user_details[0]['id'];?>">
					<input type="hidden" name="start_val_dia" id="start_val_dia" value="5">
					</form>
                                    </div>
                                </div>
                            </div>
                                </div>
                        </div>
 	
                </div>
                </div><!-- /.row -->

            </div>
            <!-- /.container-fluid -->
			<div class="copytext2 hidden-lg hidden-md">© 2015 PT-Planner AB</div>
        </div>
        <script>
            function validate_edit()
            {
               var frm=document.editPro_form;
               if (frm.fullname.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_name').innerHTML='Please Enter Name';
                 return false;
               }
               else
               {
                document.getElementById('error_name').innerHTML='';
               }
	       	if (frm.email.value.search(/\S/) == '-1')
		{
		    document.getElementById('error_email_client').innerHTML='Email Id can not be blank';
		    frm.email.focus();
		    return false;
		}
		else{
		    var filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		    if (!filterEmail.test(frm.email.value))
		    {
			    document.getElementById('error_email_client').innerHTML='Not a valid Email Id';
			    frm.email.focus();
			    return false;
		    }
		    else
		    {
			if (document.getElementById('client_email_id_chk').value=='f')
			{
			     document.getElementById('error_email_client').innerHTML="This Email Id Already Registered";
			     return false;
			}
			else{
			    document.getElementById('error_email_client').innerHTML="";
			 }
			   
		    }
		    
		}
               if (frm.working_add.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_work_add').innerHTML='Enter  Address';
                 return false;
               }
               else
               {
                document.getElementById('error_work_add').innerHTML='';
               }
               if (frm.about.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_about').innerHTML='Please write Something About Your Client';
                 return false;
               }
               else
               {
                document.getElementById('error_about').innerHTML='';
               }
	       if(frm.user_image.value != '')
               {
                     var getImageFile=frm.user_image.value;
                     var imageFile=getImageFile.toUpperCase();
                     var indexOfJpg=imageFile.indexOf(".JPG");
                     var indexOfJpeg=imageFile.indexOf(".JPEG");
                     var indexOfGif=imageFile.indexOf(".GIF");
                     var indexOfBmp=imageFile.indexOf(".BMP");
                     var indexOfpng=imageFile.indexOf(".PNG");
  
                  if(indexOfJpg==-1 && indexOfJpeg==-1 && indexOfGif==-1 && indexOfBmp==-1 && indexOfpng==-1)
                  {
                       document.getElementById('error_image').innerHTML = 'Only .jpg/.jpeg/.gif/.bmp/.png files are allowed to upload';
                       frm.user_image.focus();
                       return false;
                  }
                  else 
		  {
                       document.getElementById('error_image').innerHTML = '';
                  }
                }
            }
	    </script>
    <script>
	    function check_mail_client()
	    {
		var frm1= document.editPro_form;
		var email_id=frm1.email.value;
	
		var filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filterEmail.test(email_id))
                {
		
	        
		
		}else{
		       
		       if (document.getElementById('hidden_client_mail').value!= email_id) {
			 var email_data='email_id='+email_id;
			
		    $.ajax({
			
				    type: "POST",
				    url: '<?php echo base_url();?>ajax/check_email.php?email_id='+email_id,
				    data: email_data,
				    cache: false,
				    success: function(data)
				    {
					
					if (data=='false')
					{	
					   document.getElementById('error_email_client').innerHTML="This Email Id Already Registered";
					   frm1.client_email_id_chk.value='f';
					}else{
						document.getElementById('error_email_client').innerHTML="";
						frm1.client_email_id_chk.value="";
					}
				    }
				    });
		    }
		    else
		    {
		      document.getElementById('error_email_client').innerHTML="";
		      frm1.client_email_id_chk.value="";
		    }
		}
		
		
		
	    }
    </script>
        	<div class="modal client fade" id="client_edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
				<div class="modal-content">
				    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				    <h3 class="modal-title">Edit Account</h3>
				    <form name="editPro_form" role="form" action="<?php echo base_url(); ?>client-profile/<?php echo $user_details[0]['id'] ?>" method="post" onsubmit="return validate_edit()" enctype="multipart/form-data">
					<div class="form-group">
                                        <label>Name</label>
					    <input type="text" name="fullname" placeholder="Full name" id="fullname" class="form-control" value="<?php echo $user_details[0]['name'];?>">
                                            <div id="error_name" style="color:red;"></div>
					</div>
					<div class="form-group">
                                            <label>Email</label>
					    <input type="text" name="email" placeholder="Email" id="email" class="form-control" value="<?php echo $user_details[0]['email'];?>" onchange="check_mail_client()">
						<div id="error_email_client" style="color:red;"></div>
						<input type="hidden" name="client_email_id_chk" id="client_email_id_chk" value="">
						<input type="hidden" name="hidden_client_mail" id="hidden_client_mail" value="<?php echo $user_details[0]['email'];?>">
					</div>
					<div class="form-group">
                                            <label>Phone</label>
					    <input type="text" name="phn_num" placeholder="Phone Number" id="phn_num" class="form-control" value="<?php echo $user_details[0]['phone'];?>">
						<div id="error_phone" style="color:red;"></div>
					</div>
                                        <div class="form-group">
                                        <label>Address</label>
					    <textarea name="working_add" placeholder="Working Address" id="working_add" class="form-control"><?php echo $user_details[0]['work_address'];?></textarea>
						<div id="error_work_add" style="color:red;"></div>
					</div>
					<div class="form-group">
                                        <label>Date Of birth</label>
					    <input type="text" name="date_of_birth" placeholder="Date" id="date_of_birth" class="form-control date-class" value="<?php echo $user_details[0]['date_of_birth'];?>" readonly>
						<div id="error_dob" style="color:red;"></div>
					</div>
					<div class="form-group">
                                        <label>Height</label>
					   <input type="text" name="height" placeholder="Date" id="height" class="form-control" value="<?php echo $user_details[0]['height'];?>">
						<div id="error_height" style="color:red;"></div>
					</div>
					<div class="form-group">
                                        <label>Weight</label>
					   <input type="text" name="weight" placeholder="Date" id="weight" class="form-control" value="<?php echo $user_details[0]['weight'];?>">
						<div id="error_weight" style="color:red;"></div>
					</div>
                                        <div class="form-group">
                                            <label>Something About Client</label>
					    <textarea name="about" placeholder="Something About Client" id="about" class="form-control"><?php echo $user_details[0]['about'];?></textarea>
						<div id="error_about" style="color:red;"></div>
					</div>
                                         <div class="form-group">
                                            <label>Image</label>
					    <input type="file" name="user_image">
						<div id="error_image" style="color:red;"></div>
					</div>
					<!--<input type="hidden" name="email_check" value="">-->
					
					 <button type="submit" id="login_submit" data-loading-text="&bull;&bull;&bull;" class="greenblue" style="border: none;margin-left: 46px;">Save Changes</button>
					<!--<div class="clearfix">
                                                 <div class="pull-right"><a href="#" >Save Changes</a></div>
                                        </div>-->
					
				    </form>
				</div>
			</div>
		</div>
<div class="modal fade" id="EXERCISE-INFORMATION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="custom_Exer">
	
      </div>
    </div>
  </div>
</div>  

<div class="modal fade" id="PROGRAM-INFORMATION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="program_popup">
	
      </div>
    </div>
  </div>
</div> 
<div class="modal fade APPOINTMENT6" id="APPOINTMENT6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id="repeat_program">
       
      </div>
    </div>
  </div>
</div>    


<script>
    function chk_valid_repeat()
    {
	var frm = document.repeat_prgm_frm;
	var repeat_status = $('input[name=repeat_status]:checked').val();
        if (repeat_status == 'EXD')
	{
	    if (document.getElementById('every_x_day').value == '') {
		document.getElementById('every_x_day').style.border = '1px solid red';
		return false;
	    }
	    else
	    {
		if (isNaN(document.getElementById('every_x_day').value))
		{
		   document.getElementById('every_x_day').style.border = '1px solid red';
		    return false;
		}
		else if (document.getElementById('every_x_day').value < 2 || document.getElementById('every_x_day').value > 6) {
		    document.getElementById('err_rep').innerHTML = 'Put value within 2 & 6';
		    document.getElementById('every_x_day').style.border = '1px solid red';
		    return false;
		}
		else
		{
		    document.getElementById('every_x_day').style.border = 'none';
		    document.getElementById('err_rep').innerHTML = '';
		}
	    }
	}
	if (document.getElementById('repeat_upto').value == '')
	{
	    document.getElementById('repeat_upto').style.border = '1px solid red';
	    return false;
	}
	else{
	    document.getElementById('repeat_upto').style.border = '1px solid #ccc';
	}
	frm.submit();
    }
    function get_repeat_pop_prgm(user_program_id,client_id) {
	 var date_val = document.getElementById('date_val_training').value;
	 var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
	  var dataString ="user_program_id="+user_program_id+'&client_id='+client_id+'&trainer_id='+trainer_id+'&date_val='+date_val;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/get_repeat_popup",
            data: dataString,
            cache: false,
            success: function(data)
            {
              
              $("#repeat_program").html(data);
             
            }
            });
    }
    function get_month(month,year)
        {
	    var client_id = '<?php echo $user_details[0]['id']?>';
            var dataString ="month="+month+'&year='+year+'&client_id='+client_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>ajax/get_calendar.php",
            data: dataString,
            cache: false,
            success: function(data)
            {
              
              $("#calendar_training").html(data);
             
            }
            });
        }
	
	function get_month_diet(month,year)
        {
	    var client_id = '<?php echo $user_details[0]['id']?>';
            var dataString ="month="+month+'&year='+year+'&client_id='+client_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>ajax/get_calendar_diet.php",
            data: dataString,
            cache: false,
            success: function(data)
            {
              
              $("#diet_calendar").html(data);
             
            }
            });
        }
	function get_month_diary(month,year)
        {
	    var client_id = '<?php echo $user_details[0]['id']?>';
            var dataString ="month="+month+'&year='+year+'&client_id='+client_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>ajax/get_calendar_diary.php",
            data: dataString,
            cache: false,
            success: function(data)
            {
              
              $("#diary_calendar").html(data);
             
            }
            });
        }
    function remove_program(e,program_id)
    {
	var client_id = '<?php echo $user_details[0]['id']?>';
	var date_val = document.getElementById('date_val_training').value;
	var dataString ='program_id='+program_id+'&client_id='+client_id+'&date_val='+date_val;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/remove_programs",
            data: dataString,
            cache: false,
            success: function(data)
            {
		
		e.parents(".panel-default").remove();
		
            }
            });
    }
    function add_sets()
    {
	var tot_cnt = document.getElementById('tot_set').value;
	 var dataString ='tot_cnt='+tot_cnt;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/add_more_sets",
            data: dataString,
            cache: false,
            success: function(data)
            {
		$("#repeat_sets").append(data);
		document.getElementById('tot_set').value = parseInt(tot_cnt) + 1;
            }
            });
    }
    function custom_exercise(exer_id,user_prgrm_id)
    {
	var client_id = '<?php echo $user_details[0]['id']?>';
	var date_val = document.getElementById('date_val_training').value;
	 var dataString ='exer_id='+exer_id+'&client_id='+client_id+'&user_prgrm_id='+user_prgrm_id+'&date_val='+date_val;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/customize_exercise_pop",
            data: dataString,
            cache: false,
            success: function(data)
            {
		$("#custom_Exer").html(data);
            }
            });
    }
    
    
    function assign_get_programs(e,date_val,month,year)
        {
	    
            var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
            var client_id = '<?php echo $user_details[0]['id']?>';
            var dataString ='date_val='+date_val+'&month='+month+'&year='+year+'&trainer_id='+trainer_id+'&client_id='+client_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/get_program",
            data: dataString,
            cache: false,
            success: function(data)
            {
		var cont= data.split("@@##@@");
              $("div.unit").removeClass("active");
              $("#program_value").html(cont[0]);
	      $("#date_val_training").val(date_val+"-"+month+"-"+year);
	      $("#progrm_date").html(date_val+" "+cont[1]);
	       $("#progrm_year").html(year);
	      
	       $("#rev_hist_train").html(cont[2]);
             $(e).parents(".unit").addClass("active");
	     $(e).parents(".unit").addClass("active");
            }
            });
        }
</script>
 <script>
    function color_box_slide_show(){
		$(".group1").colorbox({rel:'group1', transition:"none", width:"30%", height:"80%",slideshow:true});
				    }
 </script>
  <script>
    function add_more_measure_div(){
       var count=document.getElementById('count_measure_div').value;
       var recount=parseInt(count)+1;
       var dataString="count="+recount;
        $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>client_progress/get_more_graph_div",
            data: dataString,
            cache: false,
            success: function(data)
            {
                    $('#repeat_section_measure').append(data);
		    document.getElementById('count_measure_div').value=recount;
		    $('.date-class').datepicker({
		       changeMonth: true,
		       changeYear: true
		    });
            }
            });
    }
    
    function remove_measure_div(e){
       
          var count=document.getElementById('count_measure_div').value;
          var recount=parseInt(count)-1;
          $(e).parents('.organictxt').remove();
          $('#count_measure_div').val(recount);
    }
    
  </script>
<a href="javascript:void(0)" id="displayEditGraph" data-toggle="modal" data-target="#EDIT-GRAPH-INFORMATION"></a>
  <div class="modal fade" id="EDIT-GRAPH-INFORMATION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="edit_graph_body">
	<div class="appoin_txt" style="margin-bottom: 16px;">Edit Graph Information</div>
        <div class="row">
           <form name="editGraphForm" id="editGraphForm" method="POST" action="<?php echo base_url();?>client_progress/edit_graph_information">
        	<div class="col-sm-6" style="width: 100%;">
                      <div class="descriptiohead"><span>Graph Type</span><b style="overflow: visible;">
		        <select name="graph_type" id="graph_type" class="form-control" style="width: 195px;">
			    <option value="L">Line Graph</option>
			    <option value="B">Bar Graph</option>
			</select>
			</b>
                      </div>
		      <div class="descriptiohead"><span style="padding-right: 45px;">Graph For</span><b style="overflow: visible;">
		        <input type="text" name="graph_for" id="graph_for" class="form-control">
			</b>
                      </div>
		       <div class="descriptiohead"><span style="padding-right: 27px;">Measure Unit</span><b style="overflow: visible;">
		        <input type="text" name="measure_unit" id="measure_unit" class="form-control">
			</b>
		       </div>
		       <div id="repeat_section_measure" style="max-height: 200px;overflow-y: scroll;">
			<div class="organictxt">
					   <div class="singleorga">
						   <div class="txtfloat">Date:</div>
						   
						    <div class="txtfloat2">
							   <input type="text" name="xval[]" id="xval0" class="form-control txt-box-set-new date-class" readonly >
							      <div id="error_xval0" style="font-size: 11px;color: red;"></div>
						   </div>
					   </div>
					   <div class="singleorga">
						   <div class="txtfloat">Measurement:</div>
						   <div class="txtfloat2">
							   <input type="text" name="yval[]" id="yval0" class="form-control txt-box-set-new">
							   <div id="error_yval0" style="font-size: 11px;color: red;"></div>
						   </div>
					   </div>
		       </div>
		     </div>
		     <input type="hidden" name="count_measure_div" id="count_measure_div" value="0">
		     <input type="hidden" name="client_id" id="client_id" value="<?php echo $user_details[0]['id'];?>">
                       <!-- <a href="javascript:void(0)" onclick="add_more_measure_div()">+ Add Measurement</a>-->
		    <div class="btns" style="float:right;">
        		    <a href="javascript:void(0)" class="butsblue green" onclick="submit_graph_form()">Add</a>
        	    </div>
        	</div>  
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<a href="javascript:void(0)" id="showMeasure" data-toggle="modal" data-target="#ADD-MEASUREMENT"></a>
<div class="modal fade" id="ADD-MEASUREMENT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content" >
    <div class="modal-header">
      <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body" id="measurement_div">

    </div>
  </div>
</div>
</div>
<script>
        $(function() {
       $('.date-class').datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-50:+5"
       });
       });
</script>