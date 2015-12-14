<body>
    <div class="mainarea">
    <?php
    $ci=&get_instance();
    $ci->load->model('common_model');
    $ci->load->model('sitesetting_model');
    $data_to_store = array(
	'id' => $this->session->userdata('site_user_id')
    );
     $user_info=$ci->common_model->get('user',array('*'),$data_to_store);
     if(count($user_info) == 0)
     {
	redirect('logout');
     }
     else{
	if($user_info[0]['status'] == 'N')
	{
	    redirect('logout');
	}
     }
     
      if($user_info[0]['image'] != '')
	{
	    $img_src = base_url()."user_images/".$user_info[0]['image'];
	}
	else{
	    $img_src = base_url()."assets/site/after_login/images/pf2.png";
	}
	$page_name = $this->uri->segment(1);
	
	$data_msg = array(
	'sent_to' => $this->session->userdata('site_user_id'),
	'read_status' => 'N'
          );
        $msg=$ci->common_model->get('messages',array('*'),$data_msg);
    ?>
    	    <script>
		function count_unread_messages()
		{
		    	var dataString ;
			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>dashboard/count_unread_messages",
			data: dataString,
			cache: false,
			success: function(data)
			{
			    //alert(data);
                          if (data != '') {
			   $('#msg_cnt_div').html('<span class="messagecount" id="total_cnt">'+data+'</span>');
			  }
			  else{
			   $( "#total_cnt" ).remove();
			  }
			}
			});
		        setTimeout(function(){
			    //alert('check');
			count_unread_messages();
			}, 500);
		}
		$( document ).ready(function() {
		   setTimeout(function(){
		    count_unread_messages();
		}, 500);
		});
	    </script>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	    <div class="headerouter">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/site/after_login/images/logo.png" alt="" /></a>
            </div>
            <!-- Top Menu Items -->
            <div class="profilepic">
		<a href="<?php echo base_url();?>my-account">
		    <span class="Protxt"><?php echo $user_info[0]['name']; ?></span>
		    <span class="proimg proimgtop">
		    <img src="<?php echo $img_src; ?>" alt="" style="height:41px;width :41px;"/></span>
		</a>
	    </div>
	    <div class="profilepiclog">
		<!--<a href="<?php //echo base_url('logout'); ?>">
		    <span class="Protxt">Logout</span>
		</a>-->
	    </div>
	    <ul class="nav navbar-left top-nav">
                <li <?php if($page_name == 'dashboard') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
		 <li <?php if($page_name == 'network') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>network">Network</a></li>
                <li <?php if($page_name == 'tools') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>tools">Toolbox</a></li>
                <li <?php if($page_name == 'compose-message') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>compose-message">Messages</a><span id="msg_cnt_div"><?php if(count($msg) >0 ) { ?><span class="messagecount" id="total_cnt"><?php echo count($msg); ?></span><?php } ?></span></li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	    <script>
		function search_client(search_val)
		{
		    	var dataString ="search_text="+search_val;
			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>dashboard/get_left_panel",
			data: dataString,
			cache: false,
			success: function(data)
			{
			       var res = data.split("^^");
			       $('#active_client_section').html(res[0]);
			       $('#inactive_client_section').html(res[1]);
                               $('#shared_client_section').html(res[2]);
			}
			});
		}
	    </script>
	    <script>
		function check_search()
		{
		    var frm = document.search_client;
		    if (frm.search_val.value.search(/\S/) == '-1')
		    {
			document.getElementById('error_div').innerHTML = "Please input some keyword";
			frm.search_val.focus();
			return false;
		    }
		    else{
			document.getElementById('error_div').innerHTML = "";
		    }
		}
	    </script>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="left_panel_div">
            	<ul class="nav navbar-nav side-nav">
                    <li>
                    	<div class="searchbg">
			   <!-- <form action="" method="post" name="search_client" onsubmit="return check_search();">-->
				 <button name="search" type="button" class="custombutton"><i class="fa fa-fw fa-search"></i></button>
				<div class="searchfieldouter">
<!--				<input name="search_val" type="text" class="custfield" onClick="if(this.value=='FIND CLIENT') this.value = ''; " onBlur=" if(this.value=='') this.value = 'FIND CLIENT';" value="<?php //if(isset($_REQUEST['search_val'])) echo $_REQUEST['search_val'];else echo 'FIND CLIENT'; ?>">-->
				<input name="search_val" type="text" class="custfield" value="" onChange="search_client(this.value)" onkeypress="search_client(this.value)" onkeyup="search_client(this.value)" placeholder="FIND CLIENT" style="text-transform:none;">
				</div>
				<div id="error_div" style="color:red;"></div>
			    <!--</form>-->
                           
                        </div>
                    </li>
                    <li id="active_client_section">
			<?php
			    $data_to_store = array(
			    'created_by' => $this->session->userdata('site_user_id'),
			    'type' => 'C',
			    'status' => 'Y'
			    );
			     $active_clients=$ci->common_model->get('user',array('*'),$data_to_store);
			     $data_to_store_in = array(
				'created_by' => $this->session->userdata('site_user_id'),
				'type' => 'C',
				'status' => 'N'
			    );
			     $inactive_clients=$ci->common_model->get('user',array('*'),$data_to_store_in);
			?>
                        <a class="" href="javascript:;" data-toggle="collapse" data-target="#demo">ACTIVE CLIENTS<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse in">
			    <?php
			    if(count($active_clients) > 0)
			    {
				foreach($active_clients as $active)
				{
				    if($active['image'] != '')
				    {
					$img_src = base_url()."user_images/".$active['image'];
				    }
				    else{
					$img_src = base_url()."assets/site/after_login/images/pf2.png";
				    }
				    $user_name = explode(" ",$active['name']);
				    if($active['deleted_status']=='N')
				    {
				    ?>
				    <a href="<?php echo base_url();?>client-profile/<?php echo $active['id'];?>">
				     <li>
					<div class="clientarea">
					    <div class="proimg"><img src="<?php echo $img_src; ?>" alt="" style="height:41px;width :41px;"/></div>
					    <div class="clientname">
						<?php echo $user_name[0]; ?>
						<?php
						if(count($user_name) > 1)
						{
						    ?>
						    <span><?php echo $user_name[1]; ?></span>
						    <?php
						}
						?>
						
					    </div>
					</div>
				    </li>
				     </a>
				    <?php
				    }
				}
			    }
			    ?>
                           
                        </ul>
                    </li>
                     <li id="inactive_client_section">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2" class="">INACTIVE CLIENTS <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse in">
			     <?php
			    if(count($inactive_clients) > 0)
			    {
				foreach($inactive_clients as $inactive)
				{
				    if($inactive['image'] != '')
				    {
					$img_src = base_url()."user_images/".$inactive['image'];
				    }
				    else{
					$img_src = base_url()."assets/site/after_login/images/pf2.png";
				    }
				    $user_name = explode(" ",$inactive['name']);
                                    if($inactive['deleted_status']=='N')
				    {
				    ?>
				    <a href="<?php echo base_url();?>client-profile/<?php echo $inactive['id'];?>">
				     <li>
					<div class="clientarea">
					    <div class="proimg"><img src="<?php echo $img_src; ?>" alt="" style="height:41px;width :41px;"/></div>
					    <div class="clientname">
						<?php echo $user_name[0]; ?>
						<?php
						if(count($user_name) > 1)
						{
						?>
						<span><?php echo $user_name[1]; ?></span>
						 <?php
						}
						?>
					    </div>
					</div>
				    </li>
				     </a>
				    <?php
				    }
				}
			    }
			    ?>
                          
                        </ul>
                    </li>
		    <li id="shared_client_section">
			<?php
			$where_share=array(
			     'trainer_id' => $this->session->userdata('site_user_id')
					   );
			 $share_clients=$ci->common_model->get('shared_clients',array('*'),$where_share);
			?>
			<a href="javascript:;">SHARED CLIENTS<i class="fa fa-fw fa-caret-right"></i></a>
			  <ul id="demo2" class="collapse in">
			     <?php
			    if(count($share_clients) > 0)
			    {
				foreach($share_clients as $share)
				{
				    $where_share_user=array(
			               'id' => $share['client_id']
					   );
				    $share_client_info=$ci->common_model->get('user',array('*'),$where_share_user);
				    if(count($share_client_info) > 0){
				    if($share_client_info[0]['image'] != '')
				    {
					$img_src = base_url()."user_images/".$share_client_info[0]['image'];
				    }
				    else{
					$img_src = base_url()."assets/site/after_login/images/pf2.png";
				    }
				    $user_name = explode(" ",$share_client_info[0]['name']);
                                    if($share_client_info[0]['deleted_status']=='N')
				    {
				    ?>
				    <a href="<?php echo base_url();?>client-profile/<?php echo $share_client_info[0]['id'];?>">
				     <li>
					<div class="clientarea">
					    <div class="proimg"><img src="<?php echo $img_src; ?>" alt="" style="height:41px;width :41px;"/></div>
					    <div class="clientname">
						<?php echo $user_name[0]; ?>
						<?php
						if(count($user_name) > 1)
						{
						?>
						<span><?php echo $user_name[1]; ?></span>
						 <?php
						}
						?>
					    </div>
					</div>
				    </li>
				     </a>
				    <?php
				    }
				}
				}
			    }
			    ?>
                          
                        </ul>

		    </li>
		    <li class="text-center butli"><a class="butsblue" href="#" data-toggle="modal" data-target="#myModal-1" >New Client</a></li>
		    <li class="copytext hidden-sm hidden-xs">&copy; 2015 PT-Planner AB</li>

		</ul>
	    </div>
	    <!-- /.navbar-collapse -->
	    </div>
	</nav>
	<div class="modal client fade" id="myModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
				<div class="modal-content">
				    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				    <h3 class="modal-title">Create Client</h3>
				    <form name="create_client" role="form" action="<?php echo base_url(); ?>dashboard/add_client" method="post" onsubmit="return chk_all_valid();">
					<div class="form-group">
					    <input type="text" name="name_val" placeholder="Full name" id="name" class="form-control">
					</div>
					
					<div class="form-group">
					    <input type="email" name="email" placeholder="Email Address" id="email" class="form-control" onblur="return check_mail()">
						<div id="error_email_pass" style="color:red;"></div>
					</div>
					<input type="hidden" name="email_check" id="email_check" value="">
					<button type="submit" id="login_submit" data-loading-text="•••" class="greenblue" style="border: none;margin-left: 46px;">Create Client</button>
					<!--<button type="submit" id="login_submit" data-loading-text="&bull;&bull;&bull;"> <i class="icon signinfont fa fa-sign-in"></i></button>-->
					
				    </form>
				</div>
			</div>
		</div>

	<script>
	    function check_mail()
	    {
		var frm1= document.create_client;
		var email_id=frm1.email.value;
	
		var filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filterEmail.test(email_id))
                {
		
	        
		
		}else{
			
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
						
					document.getElementById('error_email_pass').innerHTML="This Email Id Already Registered";
					frm1.email_check.value='f';
					}else{
						document.getElementById('error_email_pass').innerHTML="";
						frm1.email_check.value="";
					}
				    }
				    });
		}
		
		
		
	    }
	    function chk_all_valid()
	    {
		var frm = document.create_client;
		if (frm.name_val.value.search(/\S/) == '-1')
		{
		    frm.name_val.style.border='1px solid red';
		    frm.name_val.focus();
		    return false;
		}
		else{
		    frm.name_val.style.border='1px solid #ccc';
		}
		if (frm.email.value.search(/\S/) == '-1')
		{
		    frm.email.style.border='1px solid red';
		    frm.email.focus();
		    return false;
		}
		else{
		    var filterEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		    if (!filterEmail.test(frm.email.value))
		    {
			    frm.email.style.border='1px solid red';
			    frm.email.focus();
			    return false;
		    }
		    else
		    {
			if (document.getElementById('email_check').value=='f')
			{
			     frm.email.style.border='1px solid red';
			     return false;
			}
			else{
			    frm.email.style.border='1px solid #ccc';
			    document.getElementById('error_email_pass').innerHTML="";
			 }
			   
		    }
		    
		}
		
		     
	//        if (frm.password.value.search(/\S/) == '-1')
	//	{
	//	    frm.password.style.border='1px solid red';
	//	    frm.password.focus();
	//	    return false;
	//	}
	//	else{
	//	    frm.password.style.border='1px solid #ccc';
	//	}
	//	if (frm.cpassword.value.search(/\S/) == '-1')
	//	{
	//	    frm.cpassword.style.border='1px solid red';
	//	    frm.cpassword.focus();
	//	    return false;
	//	}
	//	else{
	//	    if (frm.password.value != frm.cpassword.value)
	//	    {
	//		 frm.cpassword.style.border='1px solid red';
	//		frm.cpassword.focus();
	//		return false;
	//	    }
	//	    else{
	//		frm.cpassword.style.border='1px solid #ccc';
	//	    }
	//	    
	//	}
		   
	    }
	</script>
	<?php
	$flash_message=$this->session->flashdata('flash_message');
	if(isset($flash_message)){
	//      if($flash_message == 'client_created')
	//    {
	//	$message = "Your client has been created successfully";
	//    }
	    if($flash_message == 'email_exits')
	    {
		$message = "Email address exists already";
	    }
	}
		  
	
	?>
	<script src="<?php echo base_url();?>assets/site/after_login/js/jquery.js"></script>
	<a href="#all_message" id="all_message_div" data-toggle="modal"></a>
		<div class="modal client fade" id="all_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog" style="width: 500px;">
				<div class="modal-content">
				    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				    <h3 class="modal-title" id="message_val"></h3>
				</div>
			</div>
		</div>
<?php
if(isset($flash_message)){
    if(($flash_message == 'email_send') || ($flash_message == 'client_created'))
    {
	?>
	<script>
			$(document).ready(function(){
			    $("#message_val").html('<?php echo $message; ?>');
			$("#all_message_div").click();
	
			});
	</script>
	<?php
    }
	   
}
?>
	