   <?php
     if($this->session->userdata('site_user_id')=='')
     {
      redirect('');
     }
     ?>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/after_login/js/docsupport/chosen.css">
  <link href="<?php echo base_url(); ?>assets/site/after_login/css/developer.css" rel="stylesheet">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
        <script>
            function show_compose_section()
            {
                $('#compose_msg_div').show();
                $('#msg_listing_div').hide();
            }
	    function hide_compose_div() {
		$('#compose_msg_div').hide();
                $('#msg_listing_div').show();
	    }
        </script>
	<script>
	    function set_compose_message_values() {
		//code
		var x=document.getElementById("trainer");
		var y=document.getElementById("clients");
		var res;
		var recipient_list;
                var recipient_arr;
		var id_list='';
                for (var i = 0; i < x.options.length; i++) {
		    var flag=0;
		    if (id_list=='') {
			 if(x.options[i].selected ==true){
			    res=x.options[i].value.split("/");
			    recipient_list=document.getElementById('receiver_id').value;
			    recipient_arr=recipient_list.split(",");
			    for (var j = 0; j < recipient_arr.length; j++) {
				if (recipient_arr[j] ==res[0]) {
				   flag=1;
				}
			    }
			    if (flag==0) {
				id_list=res[0];
				var iDiv = document.createElement('div');
				var jDiv = document.createElement('img');
				iDiv.className = 'proimg';
				if (res[1]!='') {
				    jDiv.src = '<?php echo base_url();?>/user_images/'+res[1];
				}
				else
				{
				    jDiv.src = '<?php echo base_url();?>/assets/site/after_login/images/no-photo.png';
				}
				iDiv.appendChild(jDiv);
				jDiv.style.height = '38px';
				jDiv.style.width = '38px';
				jDiv.title=res[2]
				$("#recipient_div").append(iDiv);
			    }
			 }
		    }
		    else{
			if(x.options[i].selected ==true){
			    res=x.options[i].value.split("/");
			    recipient_list=document.getElementById('receiver_id').value;
			    recipient_arr=recipient_list.split(",");
			    for (var j = 0; j < recipient_arr.length; j++) {
				if (recipient_arr[j] ==res[0]) {
				   flag=1;
				}
			    }
			    if (flag==0) {
				id_list=id_list+","+res[0];
				var iDiv = document.createElement('div');
				var jDiv = document.createElement('img');
				iDiv.className = 'proimg';
				if (res[1]!='') {
				    jDiv.src = '<?php echo base_url();?>/user_images/'+res[1];
				}
				else
				{
				    jDiv.src = '<?php echo base_url();?>assets/site/after_login/images/no-photo.png';
				}
				iDiv.appendChild(jDiv);
				jDiv.style.height = '38px';
				jDiv.style.width = '38px';
				jDiv.title=res[2];
				$("#recipient_div").append(iDiv);
			    }
			}
		    }
                }
		for (var i = 0; i < y.options.length; i++) {
		    var flag=0;
		    if (id_list=='') {
			 if(y.options[i].selected ==true){
			    res=y.options[i].value.split("/");
			    recipient_list=document.getElementById('receiver_id').value;
			    recipient_arr=recipient_list.split(",");
			    for (var j = 0; j < recipient_arr.length; j++) {
				if (recipient_arr[j] ==res[0]) {
				   flag=1;
				}
			    }
			    if (flag==0) {
				id_list=res[0];
				var iDiv = document.createElement('div');
				var jDiv = document.createElement('img');
				iDiv.className = 'proimg';
				if (res[1]!='') {
				    jDiv.src = '<?php echo base_url();?>/user_images/'+res[1];
				}
				else
				{
				    jDiv.src = '<?php echo base_url();?>/assets/site/after_login/images/no-photo.png';
				}
				iDiv.appendChild(jDiv);
				jDiv.style.height = '38px';
				jDiv.style.width = '38px';
				jDiv.title=res[2]
				$("#recipient_div").append(iDiv);
			    }
			 }
		    }
		    else{
			if(y.options[i].selected ==true){
			    res=y.options[i].value.split("/");
			    recipient_list=document.getElementById('receiver_id').value;
			    recipient_arr=recipient_list.split(",");
			    for (var j = 0; j < recipient_arr.length; j++) {
				if (recipient_arr[j] ==res[0]) {
				   flag=1;
				}
			    }
			    if (flag==0) {
				id_list=id_list+","+res[0]; 
				var iDiv = document.createElement('div');
				var jDiv = document.createElement('img');
				iDiv.className = 'proimg';
				if (res[1]!='') {
				    jDiv.src = '<?php echo base_url();?>/user_images/'+res[1];
				}
				else
				{
				    jDiv.src = '<?php echo base_url();?>/assets/site/after_login/images/no-photo.png';
				}
				jDiv.style.height = '38px';
				jDiv.style.width = '38px';
				jDiv.title=res[2]
				iDiv.appendChild(jDiv);
				$("#recipient_div").append(iDiv);
			    }
			}
		    }
                }
		var frm=document.composeMsgForm;
		recipient_list1=document.getElementById('receiver_id').value;
		if (recipient_list1=='') {
		    recipient_list1=id_list;
		}
		else
		{
		    if (id_list !='') {
			 recipient_list1=recipient_list1+","+id_list;
		    }
		}
		frm.receiver_id.value=recipient_list1;
		if (document.getElementById('recipient_div').innerHTML!='') {
		    document.getElementById('recipient_add_tag').innerHTML="Add More Recipient";
		}
	    }
	</script>
	<script>
	    function message_validation()
	    {
		var frm=document.composeMsgForm;
		if (frm.message_text.value.search(/\S/) == '-1') {
		    document.getElementById('message_err').innerHTML="Enter message before sending";
		    frm.message_text.focus();
		    return false;
		}
		else
		{
		    document.getElementById('message_err').innerHTML="";
		}
	    }
	</script>
	<script>
	   function show_msg_list(user_id)
	   {
	     	        var dataString ="user_id="+user_id;
			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>dashboard/get_dynamic_message_list",
			data: dataString,
			cache: false,
			success: function(data)
			{
			       //alert(data);
			       $('#msg_listing_div').html(data);
			       $('.messagesingle').removeClass('active');
			       document.getElementById('view'+user_id).className = 'messagesingle active';
			       $('#messagecount'+user_id).remove();
			       $('#msg_listing_div').show();
			       $('#compose_msg_div').hide();
			}
			});
	   }
	//  function show_sender_list()
	//   {
	//     	        var dataString;
	//		$.ajax
	//		({
	//		type: "POST",
	//		url: "<?php echo base_url();?>dashboard/get_dynamic_sender_list",
	//		data: dataString,
	//		cache: false,
	//		success: function(data)
	//		{
	//		       //alert(data);
	//		       $('#sender_list').html(data);
	//		}
	//		});
	//	setTimeout(function(){
	//	show_sender_list();
	//	}, 3000);
	//   }
	</script>
	<script>
	  function submit_snd_msg_form()
	  {
	     var frm=document.sndMsgForm;
	     if (frm.message.value.search(/\S/) == '-1') {
		alert('Please Enter Message Before Sending');
		return false;
	     }
	     frm.submit();
	  }
	  function search_inbox(user_val)
	  {
	    //alert(user_val);
	    	var dataString ="search_text="+user_val;
		$.ajax
		({
		type: "POST",
		url: "<?php echo base_url();?>dashboard/get_dynamic_sender_list",
		data: dataString,
		cache: false,
		success: function(data)
		{
		       //alert(data);
		       $('#sender_list').html(data);
		}
		});
	  }
	  
	  ////Ajax function to retrive sender list if a new message arrive to the user
	  
	function check_unread_message_and_get_sender_list()
	  {
	    
	    	var dataString ;
		$.ajax
		({
		type: "POST",
		url: "<?php echo base_url();?>dashboard/get_unread_sender_list",
		data: dataString,
		cache: false,
		success: function(data)
		{
		       //alert(data);
		       if (data != 'no_new_message') {
			 //$('#sender_list').prepend(data);
                         $('#sender_list').html(data);
		       }
		}
		});
		setTimeout(function(){
			check_unread_message_and_get_sender_list();
			}, 500);
	  }
	$( document ).ready(function() {
	     setTimeout(function(){
	    check_unread_message_and_get_sender_list();
	}, 500);
	});
	</script>
        <?php
        $ci=&get_instance();
        $ci->load->model('network_model');
        ?>
        <div id="page-wrapper">
			<div class="strapmenu"></div>
            <div class="container-fluid tabouterdiv">

                <!-- Page Heading -->
              <div class="row rowinbox">
                	<div class="messageleftwidth">
                    	<div class="inboxleft">
                        	<div class="inboxpanel">
                            	<a href="javascript:void(0)" onclick="show_compose_section()">Compose<span class="iconcom del  add-bg add-img"><img src="<?php echo base_url(); ?>assets/site/after_login/images/edit_icon.png" alt="" /></a>
                            </div>
                            <div class="searchinbox">
                            	<button type="button" name="" class="inboxsearchbut add-bg srch-ico"><img src="<?php echo base_url(); ?>assets/site/after_login/images/search_icon.png" alt=""></button>
                                <div class="inboxsearchouter">
                              <!--<input name="" class="inboxsearch" type="text" onClick="if(this.value=='Search inbox') this.value = ''; " onBlur=" if(this.value=='') this.value = 'Search inbox';" value="Search inbox">-->
				<input name="search_inbox" class="inboxsearch" type="text" placeholder="Search inbox" onChange="search_inbox(this.value)" onkeypress="search_inbox(this.value)" onkeyup="search_inbox(this.value)">
				</div>
                          </div>
			    <div id="sender_list">
			    <?php
			    $user_arr=array();
			    foreach($all_sender as $sender)
			    {
				if($sender['sent_by']!=$this->session->userdata('site_user_id'))
				{
				  if(!in_array($sender['sent_by'], $user_arr))
				  {
				     array_push($user_arr,$sender['sent_by']);
				  }
				}
				if($sender['sent_to']!=$this->session->userdata('site_user_id'))
				{
				  if(!in_array($sender['sent_to'], $user_arr))
				  {
				     array_push($user_arr,$sender['sent_to']);
				  }
				}
			    }
			    foreach($user_arr as $key=>$value)
			    {
				$user_info=$ci->network_model->get_user_information($value);
				$msg_last=$ci->network_model->get_last_chat($value);
				$number_of_unread_messages=$ci->network_model->user_respective_total_number_of_unread_messages($value);
			    ?>
			    <a href="javascript:void(0)" onclick="show_msg_list(<?php echo $value;?>)" style="text-decoration:none;">
                            <div class="messageview">
                            	<div <?php if($value==$user_arr[0]) { if($msg_last[0]['read_status']=='N' && $msg_last[0]['sent_by']!=$this->session->userdata('site_user_id')){ ?>class="messagesingle active new" <?php }else{?>class="messagesingle active"<?php } }else { if($msg_last[0]['read_status']=='N' && $msg_last[0]['sent_by']!=$this->session->userdata('site_user_id')) { ?>class="messagesingle new"<?php }else{ ?>class="messagesingle"<?php } } ?> id="view<?php echo $value;?>" <?php //if($msg_last[0]['read_status']=='N' && $value!=$user_arr[0] && $msg_last[0]['sent_by']!=$this->session->userdata('site_user_id')) {style="background: rgba(135, 206, 235, 0.39);"?> <?php //} ?>>
				<?php
				if($number_of_unread_messages > 0){
				?>
				<em class="messagecount" id="messagecount<?php echo $value;?>"><?php echo $number_of_unread_messages; ?></em>
				<?php
				}
				?>
                                	<div class="timeofricev">
                                    	<div class="top">
					<?php
					if(date('Y-m-d',strtotime($msg_last[0]['send_time'])) == date('Y-m-d'))
					{
					    echo "Today";
					}
					else if(date('Y-m-d',strtotime($msg_last[0]['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
					{
					    echo "Yesterday";
					}
					else
					{
					    echo date('Y-m-d',strtotime($msg_last[0]['send_time']));
					}
					?>
					</div>
                                        <div class="bottom"><?php echo date('H:i',strtotime($msg_last[0]['send_time']));?></div>
                                    </div>
                                    <div class="proimg_inbox"><img <?php if($user_info[0]['image']!='') { ?>src="<?php echo base_url();?>user_images/<?php echo $user_info[0]['image'];?>" <?php } else {?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> alt="" style="height:38px; width: 38px;"></div>
                                    <div class="messagebody"><span><?php echo $user_info[0]['name']; ?>:</span> <?php echo substr($msg_last[0]['message'],0,50); ?></div>
                                </div>
                            </div>
			    </a>
			    <?php
			    }
			    ?>
			    </div>
                        </div>
                    </div>
                    <div class="messagerightwidth">
                    	<div class="inboxright">
                            <div id="compose_msg_div" style="display:none;">
                        	<div class="messagernamecompose">
                            	<div class="composehead clearfix">
                                	<div class="messagercomname">Compose new message</div>
                                    <div class="datemasscompose">Today, <?php echo date('H:i');?></div>
                                </div>
                                <div class="recepcenist">
				    <div id="recipient_div">
				    </div>
                                    <div class="addrecpcenist"><a href="javascript:void(0)" data-target="#msg_compose" data-toggle="modal" id="recipient_add_tag">Add Recipient</a></div>
                                </div>
                            </div>
                            <div class="inboxmessageboy">
				<form name="composeMsgForm" id="composeMsgForm" method="POST" action="<?php echo base_url();?>dashboard/send_message" onsubmit="return message_validation()">
                            	<div class="massboxin massboxincompose">
                                	<textarea name="message_text" id="message_text" cols="" rows="" class="bigtextarea" id="txtMeetingAgenda" placeholder="WRITE YOUR MESSAGE HERE"></textarea>
					<div id="message_err" style="color:red;"></div>
                                </div>
					
				<input type="hidden" name="sender_id" id="sender_id" value="<?php echo $this->session->userdata('site_user_id');?>">
				<input type="hidden" name="receiver_id" id="receiver_id" value="">
                                <div class="nobgoff clearfix">
                                	<input name="msg_submit" id="msg_submit" type="submit" class="sendmessage" value="Send message">
					<input type="button" class="cncl-btn" value="Cancel" style="margin-right: 10px;" onclick="hide_compose_div()">
                               	</div>
				 
				</form>
                            </div>
			    </div>
			    <script>
				function load_more_message(per_load,user_id,logged_in_user) {
				  var start_val=document.getElementById('message_start_val').value;
					var start=parseInt(start_val);
					var dataString ="per_load="+per_load+"&start="+start+"&user_id="+user_id+"&logged_in_user="+logged_in_user;
					 $.ajax({
							
					    type: "POST",
					    url: '<?php echo base_url();?>dashboard/get_client_more_messages',
					    data: dataString,
					    cache: false,
					    success: function(data)
					    {
						$('#total_msg').prepend(data);
						$('#message_start_val').val(start+per_load);
						
					    }
					    });
				}
			    </script>
                           <div id="msg_listing_div">
			     <?php
			    $per_laod = 5;
			    $start = 0;
			    if(count($user_arr) > 0){
			      $sender_info=$ci->network_model->get_user_information($user_arr[0]);
			      $latest_msg_list=$ci->network_model->get_latest_user_messages($user_arr[0]);
			      $chat_messages=$ci->network_model->get_latest_user_chat($user_arr[0],$per_laod,$start);
			      $data_updt_message=array(
				      'read_status' => 'Y'
						     );
			      $read_status=$ci->network_model->update_message_read_status($user_arr[0],$data_updt_message);
			    ?>
                            <div class="messagername">Messages of <span><?php echo $sender_info[0]['name'] ?></span><?php if(count($latest_msg_list) > $per_laod) { ?><span style="margin-left: 100px;"><a href="javascript:void(0)" style="text-decoration: none;" onclick="load_more_message(<?php echo $per_laod; ?>,<?php echo $user_arr[0]; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Load More Messages</a></span><?php } ?></div>
			    <div class="whole_msg" id="total_msg">
			    <?php
			    foreach($chat_messages as $msg)
			    {
				 $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
			    ?>
                            <div class="inboxmessageboy">
                            	<div class="msshead">
                                	<div <?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>class="massheadright"<?php }else { ?>class="massheadleft"<?php } ?>>
                                		<div  <?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>class="proimg_inbox_right"<?php }else { ?>class="proimg_inbox"<?php } ?>><img <?php if($sender_information[0]['image']!=''){ ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else{ ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php } ?>alt="" style="height: 38px;width: 38px;"></div>
                                        <div class="massheadname"><?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>me to <?php echo $sender_info[0]['name']; }else { echo $sender_info[0]['name']; ?> to me<?php } ?></div>
                                    </div>
                                    <div <?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>class="datemassleft"<?php }else { ?>class="datemass"<?php } ?>><?php
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
					?>, <?php echo date('H:i',strtotime($msg['send_time']));?></div>
                                </div>
                                <div <?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>class="massboxinright"<?php }else { ?>class="massboxin"<?php } ?>>
                                	
		                    <?php if($msg['sent_by']!=$this->session->userdata('site_user_id')) { ?>
                                    <div class="forward"><!--<a href="#"><img src="<?php //echo base_url(); ?>assets/site/after_login/images/forward.png" alt=""></a>--></div>
				    <?php
				    }
				    ?>
                                	<?php echo $msg['message'];?>
                                </div>
                            </div>
			    <?php
			    }
			    ?>
			    <form>
				<input type="hidden" name="message_start_val" id="message_start_val" value="5">
			    </form>
			    </div>
                            <div class="sendmsgblog">
                            	<div class="whiteboxarea">
				    <form name="sndMsgForm" id="sndMsgForm" method="POST" action="<?php echo base_url(); ?>dashboard/send_message_to_user">
                                	<input name="" type="button" class="sendmessage" value="Send message" onclick="submit_snd_msg_form()">
                                	<div class="txtfieldouter"><textarea name="message" id="message" cols="1" rows="1" class="textareafield"></textarea></div>
					<input type="hidden" name="to_id" id="to_id" value="<?php echo $user_arr[0]; ?>">
					</form>
                                </div>
                            </div>
			    <?php
			    }
			    ?>
                        </div>
                        </div>
                        <div class="copytext2 hidden-lg hidden-md">© 2015 PT-Planner AB</div>
                    </div>
                    
                </div><!-- /.row -->
			</div>
            <!-- /.container-fluid -->
        </div>
<div class="modal fade NEW-NETWORK" id="msg_compose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
      	<div class="datehead">Select Recipients</div>
	<form name="add_recipient_form" id="add_recipient_form">
         <div class="form-group">
        	<label>Select Other Trainers</label>
	          <div>
		    <select class="form-control chosen-select" name="trainer[]" id="trainer" multiple="true" style="width:100%">
			<?php
                        $user_arr=array();
			foreach($all_networks as $network)
			{
                            $other_members=$ci->network_model->get_network_members($network['network_id'],$this->session->userdata('site_user_id'));        
                            foreach($other_members as $mem)
                            {
                              if($mem['user_id']!=0)
                              {
                                if (!in_array($mem['user_id'], $user_arr))
                                {
                                  array_push($user_arr,$mem['user_id']);
                                }
                              }
                            }
                        }
                        foreach($user_arr as $key=>$value)
                        {
                            $user_info=$ci->network_model->get_user_information($value);
                            ?>
                         <option value="<?php echo $value."/".$user_info[0]['image']."/".$user_info[0]['name']; ?>"><?php echo $user_info[0]['name'];?></option>
                            <?php
                        }
			?>
		    </select>
	          </div>
        </div>
        <div class="form-group">
        	<label>Select Clients</label>
	          <div>
		    <select class="form-control chosen-select" name="clients[]" id="clients" multiple="true" style="width:100%">
			<?php
			foreach($all_clients as $client)
			{
			?>
			<option value="<?php echo $client['id']."/".$client['image']."/".$client['name'];?>"><?php echo $client['name'];?></option>
			<?php
			}
			?>
		    </select>
	          </div>
        </div>
        <div class="btns">
			<a class="butsblue green" style="background: #9ec32e; box-shadow: 0 2px #9dab72" href="javascript:void(0)" data-dismiss="modal" onclick="set_compose_message_values()">Add</a>
	</div>
	</form>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/site/after_login/js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/site/after_login/js/chosen.jquery.js" type="text/javascript"></script>
<script>
	//jquery.noConflict();
    $(document).ready(function(){
    $(".chosen-select").chosen();
     });
</script>
<script>
	 $(function () {
    $('#myTab a:last').tab('show')
  })
	 $( ".strapmenu" ).click(function() {
		$( ".messageleftwidth" ).toggleClass( "highlight" );
		$( ".messagerightwidth" ).toggleClass( "highlight2" )
 	});
	 
  
</script>