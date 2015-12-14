     <?php
     if($this->session->userdata('site_user_id')=='')
     {
      redirect('');
     }
     $ci=&get_instance();
     $ci->load->model('network_model');
     $ci->load->model('common_model');
     ?>
     <style>
               #canvas .circle {
                       display: inline-block;
                       margin: 1em;
               }

               .circles-decimals {
                       font-size: .4em;
               }
               .circles-text{
                   font-size: 25px !important;
               }
       </style>
        <div id="page-wrapper">

            <div class="container-fluid tabouterdiv">

                <!-- Page Heading -->
                <div class="row rowcustomblog">
                
                    <div class="tab-content">
                   	    <div class="row customwidth tab-pane active" role="tabpanel" id="progress">
                            <div class="col-md-6 col-xs-12">
                                <div class="innerblog clearfix account">
                                	<a href="javascript:void(0)" class="edit" data-toggle="modal" data-target="#edit_profile_modal">Edit</a>
                                	<div class="account-profile clearfix">
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
                                		<div class="profile-name">
                                			<img src="<?php echo $img_src; ?>" alt="" style="width:192px; height:200px;"/>
                                		</div>
                                		<div class="profile-txt">
                                                    <?php
                                                    $name_array=explode(" ",$user_details[0]['name']);
                                                    ?>
                                			<h2> <span><?php echo $name_array[0]; ?></span>  <?php echo end($name_array); ?></h2>
                                			<a href="#"><i class="fa fa-envelope-o"></i><?php echo $user_details[0]['email']; ?></a>
                                			<a href="#"><i class="fa fa-phone"></i> <?php echo $user_details[0]['phone']; ?></a>
                                		</div>
                                	</div>
                                	<div class="address">
                                		<div class="row">
	                            			<div class="col-sm-6">
	                            				<h2><i class="fa fa-map-marker"></i> Working Address</h2>
	                            				<p><?php echo $user_details[0]['work_address'];?></p>
	                            			</div>
	                            			<div class="col-sm-6">
	                            				<h2><i class="fa fa-map-marker"></i> Billing Address</h2>
	                            				<p><?php echo $user_details[0]['billing_address']; ?></p>
	                            			</div>
                            			</div>
                            		</div>
                            		<div class="address">
                            			<p class="acnt-p"><?php echo $user_details[0]['about']; ?></p>
                            		</div>
                            		<div class="address text-center">
                            			<a href="<?php echo base_url('logout'); ?>" class="log"><i class="fa fa-power-off"></i> LOG OUT FROM THIS ACCOUNT</a>
                            		</div>
                                </div>
                        		<div class="innerblog pass-area">
                        			<div class="appoin_txt">
                        				<i class="fa fa-unlock-alt"></i> PASSWORD SETTINGS
                        				<span class="paswrd">To change your password click here below</span>
                        				<button type="button" class="btn btn-default pass-btn" data-toggle="modal" data-target="#change_pass_modal">Change password</button>
                        			</div>
                        		</div>
                            </div>
			    <script>
			     function get_month_circle(){
			            var dataString;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>toolbox/get_monthly',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$("#canvas").html(data);
						$("#week").removeClass("active");
						$("#year").removeClass("active");
						$("#month").addClass("active");
					    }
					    });
			     }
			     function get_year_circle() {
			          var dataString;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>toolbox/get_yearly',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$("#canvas").html(data);
						$("#month").removeClass("active");
						$("#week").removeClass("active");
						$("#year").addClass("active");
					    }
					    });
			     }
			     function get_wk_circle(){
			        var dataString;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>toolbox/get_weekly',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						//alert(data);
						$("#canvas").html(data);
						$("#month").removeClass("active");
						$("#year").removeClass("active");
						$("#week").addClass("active");
					    }
					    });
			     }
			    </script>
                            <div class="col-md-6 col-xs-12">
                                <div class="innerblogtool clearfix">
                                	 <div class="hour">
                                	 	<h3>How many hours available for booking</h3>
                                	 	<ul class="time list-unstyled clearfix">
                                	 		<li class="active" id="week"><a href="javascript:void(0)" onclick="get_wk_circle()">Weekly</a></li>
                                	 		<li id="month"><a href="javascript:void(0)" onclick="get_month_circle()">Monthly</a></li>
                                	 		<li id="year"><a href="javascript:void(0)" onclick="get_year_circle()">Yearly</a></li>
                                	 	</ul>
						<?php
						  $all_dates=$ci->network_model->get_dates_within_week();
						  $where_time=array(
						   'trainer_id' => $this->session->userdata('site_user_id')
								    );
						  $all_times=$ci->common_model->get('trainer_avail_time',array('*'),$where_time);
						  $total_count=0;
						  $booked=0;
						  $not_booked=0;
						  foreach($all_dates as $date_val){
						      foreach($all_times as $time){
						        $start_hour = date('H', strtotime($time['avl_time_from']));
				                        $end_hour = date('H', strtotime($time['avl_time_to']));
				                        for($i = $start_hour;$i < $end_hour ;$i++){
							  $total_count++;
							  $start=$i.":00:00";
				                          $end=($i+1).":00:00";
							  $check_date=date('Y-m-d',strtotime($date_val['repeat_date']));
							  $where_check=array(
							      'trainer_id' => $this->session->userdata('site_user_id'),
							      'booked_date' => $check_date,
							      'booking_time_start' => $start,
							      'booking_time_end' => $end
									     ); 
							  $booking=$this->common_model->get('user_booking',array('*'),$where_check);
							  if(count($booking) > 0){
							   $booked++;
							  }else
							  {
							    $not_booked++;
							  }
				                         }
						      
						      }
						  }
						   $booked_percent=number_format((($booked*100)/$total_count),2);
						   $available_percent=number_format((($not_booked*100)/$total_count),2);
						?>
                                	 	<div class="time-chart row" id="canvas">
                                	 		<div class="col-sm-6 time-part">
							 <div class="circle" id="circles-1"></div>
                                	 			<h3>Available for appoinment</h3>
                                	 			<span><?php echo $not_booked." Hrs";?></span>
                                	 		</div>
                                	 		<div class="col-sm-6 time-part">
								<div class="circle" id="circles-2"></div>
                                	 			<h3>Booked appoinment</h3>
                                	 			<span><?php echo $booked." Hrs";?></span>
                                	 		</div>
                                	 	</div>
<!--                                	 	<div class="time-chart row" id="canvas">
                                	 		<div class="col-sm-6 time-part">
                                	 			<img src="<?php //echo base_url();?>assets/site/after_login/images/time-1.png" alt="" />
								<div class="circle" id="circles-2"></div>
                                	 			<h3>available for appoinment</h3>
                                	 			<span>75hrs</span>
                                	 		</div>
                                	 		<div class="col-sm-6 time-part">
                                	 			<img src="<?php //echo base_url();?>assets/site/after_login/images/time-3.png" alt="" />
                                	 			<h3>available for appoinment</h3>
                                	 			<span>85hrs</span>
                                	 		</div>
                                	 	</div>-->
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
               var frm=document.editAcc_form;
               if (frm.fullname.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_name').innerHTML='Please Enter Name';
                 return false;
               }
               else
               {
                document.getElementById('error_name').innerHTML='';
               }
               if (frm.working_add.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_work_add').innerHTML='Enter Working Address';
                 return false;
               }
               else
               {
                document.getElementById('error_work_add').innerHTML='';
               }
               if (frm.billing_add.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_bill_add').innerHTML='Enter Billing Address';
                 return false;
               }
               else
               {
                document.getElementById('error_bill_add').innerHTML='';
               }
               if (frm.billing_add.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_bill_add').innerHTML='Enter Billing Address';
                 return false;
               }
               else
               {
                document.getElementById('error_bill_add').innerHTML='';
               }
               if (frm.about.value.search(/\S/) == '-1')
               {
                 document.getElementById('error_about').innerHTML='Please write Something About You';
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
        	<div class="modal client fade" id="edit_profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
				<div class="modal-content">
				    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				    <h3 class="modal-title">Edit Account</h3>
				    <form name="editAcc_form" role="form" action="<?php echo base_url(); ?>dashboard/my_account_page" method="post" onsubmit="return validate_edit()" enctype="multipart/form-data">
					<div class="form-group">
                                        <label>Name</label>
					    <input type="text" name="fullname" placeholder="Full name" id="fullname" class="form-control" value="<?php echo $user_details[0]['name'];?>">
                                            <div id="error_name" style="color:red;"></div>
					</div>
					
					<div class="form-group">
                                            <label>Phone</label>
					    <input type="text" name="phn_num" placeholder="Phone Number" id="phn_num" class="form-control" value="<?php echo $user_details[0]['phone'];?>">
						<div id="error_phone" style="color:red;"></div>
					</div>
                                        <div class="form-group">
                                        <label>Working Address</label>
					    <textarea name="working_add" placeholder="Working Address" id="working_add" class="form-control"><?php echo $user_details[0]['work_address'];?></textarea>
						<div id="error_work_add" style="color:red;"></div>
					</div>
                                        <div class="form-group">
                                            <label>Billing Address</label>
					    <textarea name="billing_add" placeholder="Billing Address" id="billing_add" class="form-control"><?php echo $user_details[0]['billing_address'];?></textarea>
						<div id="error_bill_add" style="color:red;"></div>
					</div>
                                        <div class="form-group">
                                            <label>Something About You</label>
					    <textarea name="about" placeholder="Something About You" id="about" class="form-control"><?php echo $user_details[0]['about'];?></textarea>
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
 <script>
  function password_validation()
  {
     var frm=document.changePass_form;
     if (frm.new_pass.value.search(/\S/) == '-1')
	{
	  document.getElementById('error_pass').innerHTML='Please Enter New Password';
	  frm.new_pass.focus();
	  return false;
	}
	else
	{
	 document.getElementById('error_pass').innerHTML='';
	}
     if (frm.re_pass.value.search(/\S/) == '-1')
	{
	  document.getElementById('error_rePass').innerHTML='Please Re-Enter Your New Password';
	  frm.re_pass.focus();
	  return false;
	}
	else
	{
	 if(frm.new_pass.value != frm.re_pass.value)
	 {
	   document.getElementById('error_rePass').innerHTML='Password Mis-matched';
	   frm.re_pass.focus();
	   return false;
	 }
	 else
	 {
	    document.getElementById('error_rePass').innerHTML='';
	 }
	}
  }
 </script>
	<div class="modal client fade" id="change_pass_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
				<div class="modal-content">
				    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				    <h3 class="modal-title">Change Password</h3>
				 <form name="changePass_form" role="form" action="<?php echo base_url(); ?>dashboard/change_password" method="post" onsubmit="return password_validation()">
					
					<div class="form-group">
                                            <label>New Password</label>
					    <input type="password" name="new_pass" placeholder="New Password" id="new_pass" class="form-control">
						<div id="error_pass" style="color:red;"></div>
					</div>
					<div class="form-group">
                                            <label>Re-type New Password</label>
					    <input type="password" name="re_pass" placeholder="New Password" id="re_pass" class="form-control">
						<div id="error_rePass" style="color:red;"></div>
					</div>
					 <button type="submit" id="pass_submit" data-loading-text="&bull;&bull;&bull;" class="greenblue" style="border: none;margin-left: 46px;">Save Changes</button>
					
				  </form>
				</div>
		 </div>
	</div>
	
  <script src="<?php echo base_url();?>assets/site/after_login/js/circles.min.js"></script>
  <script>
  var percentage = '<?php echo $available_percent; ?>';
   Circles.create({
   id:         'circles-1',
   value: percentage,
   radius:     70,
   width:      20,
   text:       '<?php echo $not_booked; ?>Hrs',
   colors:     ['#BEE3F7', '#45AEEA']
})
   Circles.create({
   id:         'circles-2',
   value: <?php echo $booked_percent; ?>,
   radius:     70,
   width:      20,
   text:       '<?php echo $booked; ?>Hrs',
   colors:     ['#BEE3F7', '#45AEEA']
})
   </script>


