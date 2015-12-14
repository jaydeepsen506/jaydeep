  <?php
  if($this->session->userdata('site_user_id')=='')
  {
	redirect('home');
  }
  ?>
        <script>
        $(document).ready(function() {
	$(".tab-header ul li").click(function(){
		$('.tab-content').removeClass('active');
		$('.tab-header ul li').removeClass('active');
		$(this).addClass('active');
		var getdata = $(this).attr('data');		
		$('#'+getdata).addClass('active');
	});
        });
        </script>
	<script>
		$(document).ready(function() {
	$(".tab-header-with-icon ul li").click(function(){
		$('.tab-cont').removeClass('active');
		$('.tab-header-with-icon ul li').removeClass('active');
		$(this).addClass('active');
		var getdata = $(this).attr('data');		
		$('#'+getdata).addClass('active');
	});
});
	</script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/after_login/js/docsupport/chosen.css">
  <link href="<?php echo base_url(); ?>assets/site/after_login/css/developer.css" rel="stylesheet">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
        <?php
        $ci=&get_instance();
        $ci->load->model('common_model');
        ?>
        <script>
		function show_modal(network_id) {
			//code
			//alert(network_id);
			var dataString ="network_id="+network_id;//alert(dataString);
			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>dashboard/add_member_to_network",
			data: dataString,
			cache: false,
			success: function(data)
			{
			       //alert(data);
			       $('#add-more').html(data);
			       $('#add_member').click();
			       $(".chosen-select").chosen();
			      // $('[data-toggle="popover"]').popover();	

			}
			});
		}
	</script>
	        <script>
		function show_modal_other(network_id) {
			//code
			//alert(network_id);
			var dataString ="network_id="+network_id;//alert(dataString);
			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>dashboard/add_member_to_other_network",
			data: dataString,
			cache: false,
			success: function(data)
			{
			       //alert(data);
			       $('#add-more-other').html(data);
			       $('#add_member_other').click();
			       $(".chosen-select").chosen();
			      // $('[data-toggle="popover"]').popover();	

			}
			});
		}
	</script>
<script>
	function network_edit_validation(id)
	{
		var frm=document.getElementById('net_edit_form'+id);
		if (frm.network_name.value.search(/\S/) == '-1') {
			document.getElementById('network_name_error_edit').innerHTML="Name can not be blank";
			return false;
		}
		else
		{
			document.getElementById('network_name_error_edit').innerHTML="";
		}
		frm.submit();
	}
</script>
<script>
	function submit_del_form(id) {
		//code
		var frm=document.getElementById('del_net_form'+id);
		frm.submit();
	}
</script>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="row customwidth_inedx">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="innerblog clearfix">
                            	<div class="notohead text-left">NETWORK
                            		<a href="javascript:void(0)" data-target="#EXERCISE-INFORMATION" data-toggle="modal">Create a new network</a>	
                            	</div>
                            	
                            	<div class="tab-outer">
                            		<div class="tab-header">
                            			<ul>
                            				<li class="active" data="1"><a href="javascript:void(0)">My network</a></li>
                            				<li data="2"><a href="javascript:void(0)" >Other network<span class="messagecount"><?php echo count($other_networks);?></span></a></li>
                            			</ul>
                            		</div>

                            		<div class="tab-content active" id="1">
                                            <?php
                                            foreach($network_list as $network)
                                            {
                                                $where=array(
                                                    'network_id'=> $network['id']
                                                             );
                                                $member=$ci->common_model->get('network_member',array('*'),$where);
                                            ?>
                            		   <div class="tab-listing clearfix">
                            				<div class="listing-left">
                            					<h4><?php echo ucfirst($network['network_name']);?></h4>
                            					<h5><?php echo count($member);?> member in this network</h5>
                            				</div>
                            				<div class="listing-right">
                            					<div class="cre-del">
                            						<div class="crea">
                            							<a href="#editModal<?php  echo $network['id']; ?>" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/site/after_login/images/cre.png" /></a>
                            						</div>
                            						<div class="del">
                            							<a href="#myModal<?php  echo $network['id']; ?>" data-toggle="modal"><img src="<?php echo base_url(); ?>assets/site/after_login/images/del.png" /></a>
                            						</div>
                            					</div>
                            					<div class="add-mem">
                            						<div class="addrecpcenist"><a href="javascript:void(0)"  onclick="show_modal(<?php echo $network['id'];?>)"> <img src="<?php echo base_url(); ?>assets/site/after_login/images/addicon-blk.png" /> Add member</a></div>
                            					</div>
                            				</div>
                            			</div>
					   	<div class="modal fade" id="myModal<?php  echo $network['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							       <div class="modal-content">
								  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								    <h4 class="modal-title">Delete Network</h4>
								    </div>
							    <div class="modal-body">
			    
								    Are you sure you want to delete?
			    
							    </div>
							    <form name="del_net_form<?php echo $network['id'];?>" id="del_net_form<?php echo $network['id'];?>" action="<?php echo base_url();?>dashboard/delete_network" method="POST">
								<input type="hidden" name="net_id" id="net_id" value="<?php echo $network['id'];?>">
							    </form>
							       <div class="modal-footer">
								    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								    <button class="btn btn-warning" type="button" style="background-color: #22a7f0;border-color: #22a7f0;" onclick="submit_del_form(<?php echo $network['id'];?>)"> Confirm</button>
								</div>
							       </div>											    
							    </div>				
						</div>
						<div class="modal fade" id="editModal<?php  echo $network['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							       <div class="modal-content">
								  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								    <h4 class="modal-title">Edit Network</h4>
								    </div>
							    <div class="modal-body">
			                                    <form name="net_edit_form<?php  echo $network['id']; ?>" id="net_edit_form<?php  echo $network['id']; ?>" action="<?php echo base_url();?>dashboard/change_network_name" method="POST">
							    <div class="form-group">
									<label>change Network Name</label>
									  <div class="tagsinput-primary">
									    <input name="network_name" class="form-control" id="network_name" type="text" placeholder="Type Name..." value="<?php echo $network['network_name'];?>"/>
									    <div id="network_name_error_edit" style="color:red;"></div>
									  </div>
                                                            </div>
							    <input type="hidden" name="network_id" id="network_id" value="<?php echo $network['id'];?>">
							    </form>
			    
							    </div>
							       <div class="modal-footer">
								    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								    <button class="btn btn-warning" type="button" style="background-color: #22a7f0;border-color: #22a7f0;" onclick="network_edit_validation(<?php  echo $network['id']; ?>)"> Save</button>
								</div>
							       </div>											    
							    </div>				
						</div>
                                                <?php
                                            }
                                                ?>
                            		</div>
                            		<div class="tab-content" id="2">
						<?php
						foreach($other_networks as $network)
						{
						 $where=array(
                                                    'network_id'=> $network['net_id']
                                                             );
                                                $member_other=$ci->common_model->get('network_member',array('*'),$where);
						?>
                        			<div class="tab-listing add clearfix">
                        				<div class="listing-left">
                        					<h4><?php echo ucfirst($network['network_name']);?></h4>
                        					<h5><?php echo count($member_other);?> member in this network</h5>
                        				</div>
                        				<div class="listing-right">
   
                        					<div class="add-mem">
                        						<div class="addrecpcenist"><a href="javascript:void(0)" onclick="show_modal_other(<?php echo $network['net_id'];?>)">Add member</a></div>
                        					</div>
                        				</div>
                        			</div>
						<?php
						}
						?>
                        		</div>

                            	</div>
                            	
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
				<?php $this->load->view('right_panel'); ?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
			<div class="copytext2 hidden-lg hidden-md">© 2015 PT-Planner AB</div>
        </div>
 <!-- Modals -->
<div class="modal fade APPOINTMENT6" id="APPOINTMENT6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="name-group clearfix">
        	<label>NAME</label>
        	<label>APPOINTMENT 6</label>
        </div>
         <div class="name-group clearfix">
        	<label>TIME</label>
        	<label>14:30-15:30</label>
        </div>
         <div class="name-group clearfix">
        	<label>REPEAT</label>
        	<label>Every Week (Wed)</label>
        </div>
         <div class="name-group clearfix">
        	<label>VISIBLE</label>
        	<label>Yes</label>
        </div>
         <div class="name-group clearfix">
        	<label>BOOKED</label>
        	<label>Carl Ekman</label>
        </div>
         <div class="name-group clearfix">
        	<label>PROGRAM</label>
        	<label>Power Chest</label>
        </div>
      </div>
    </div>
  </div>
</div>   

<div class="modal fade APPOINTMENT6" id="new-network" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="name-group clearfix">
        	<label>NAME</label>
        	<label>APPOINTMENT 6</label>
        </div>
         <div class="name-group clearfix">
        	<label>TIME</label>
        	<label>14:30-15:30</label>
        </div>
         <div class="name-group clearfix">
        	<label>REPEAT</label>
        	<label>Every Week (Wed)</label>
        </div>
         <div class="name-group clearfix">
        	<label>VISIBLE</label>
        	<label>Yes</label>
        </div>
         <div class="name-group clearfix">
        	<label>BOOKED</label>
        	<label>Carl Ekman</label>
        </div>
         <div class="name-group clearfix">
        	<label>PROGRAM</label>
        	<label>Power Chest</label>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
	function network_creation_validation()
	{
		var frm=document.network_creation_form;
		if (frm.network_name.value.search(/\S/) == '-1')
		{
		     document.getElementById('network_name_error').innerHTML="Please enter a name for the network";
		     frm.network_name.focus();
		     return false;
		}
		else
		{
		     document.getElementById('network_name_error').innerHTML="";
		}
		frm.submit();
	}
</script>
<!-- Add Network Modal-->
<div class="modal fade NEW-NETWORK" id="EXERCISE-INFORMATION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
	<form name="network_creation_form" id="network_creation_form" action="<?php echo base_url();?>dashboard/create_network" method="POST">
      	<div class="datehead">CREATE NETWORK</div>
        <div class="form-group">
        	<label>Network name</label>
          <input type="text" class="form-control" name="network_name" id="network_name">
		<div id="network_name_error" style="color:red;"></div>
        </div>
         <div class="form-group">
        	<label>Add member</label>
	          <div>
	            <!--<input name="tagsinput" class="tagsinput" data-role="tagsinput" placeholder="Type Name..." />-->
		    <select class="form-control chosen-select" name="member[]" id="member" multiple="true" style="width:100%">
			<!--<option value="">Select</option>-->
			<?php
			foreach($trainer_list as $trainer)
			{
			?>
			<option value="<?php echo $trainer['id'];?>"><?php echo $trainer['name'];?></option>
			<?php
			}
			?>
		    </select>
	          </div>
        </div>
	<div class="form-group">
        	<label>Add member with email( Put Email Id(s) seperated with comma )</label>
	          <div class="tagsinput-primary">
	            <input name="member_email" class="form-control" id="member_email" type="text" placeholder="Type Name..." />
	          </div>
        </div>
        <div class="btns">
			<a class="butsblue green" style="background: #9ec32e; box-shadow: 0 2px #9dab72" href="javascript:void(0)" onclick="network_creation_validation()">Save</a>
		</div>
	</form>
      </div>
    </div>
  </div>
</div>
<!--Add Member Modal-->
<a href="#add-more" id="add_member" data-toggle="modal"></a>
<div class="modal fade NEW-NETWORK add-more" id="add-more" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-body">
					<div class="datehead">Maecenas rutrum tristique exK</div>
						<div class="datehead" style="font-family:'HelveticaNeue-Light';">5 member in this network</div>
						
						<div class="tab-outer">
						<div class="tab-header-with-icon">
							<ul>
							<li class="add active" data="4">
								<a href="#">Add more member</a>
							</li>
							<li class="invite" data="5">
								<a href="#">Invite people via e-mail</a>
							</li>
							</ul>
						</div>
						<div class="tab-cont active" id="4">
							<div class="listing-txt clearfix">
								<div class="user-left">
									<a class="user-pic" href="#">
										<img src="images/user-pic.png" alt="" />
									</a>
									<div class="us-name">
										<h2>Lucas Darbyshire</h2>
									</div>
								</div>
								<div class="icon-right clearfix">
									<div class="cre-del">
										<div class="crea">
											<a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/msg.png"></a>
										</div>
										<div class="del">
											<a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/del.png"></a>
										</div>
									</div>
								</div>
							</div>
						
						</div>
						<div class="tab-cont" id="5">
						<div class="listing-txt clearfix">
							<div class="user-left">
								<a class="user-pic" href="#">
									<img src="images/user-pic.png" alt="" />
								</a>
								<div class="us-name">
									<h2>Lucas Darbyshire</h2>
								</div>
							</div>
							<div class="icon-right clearfix">
								<div class="cre-del">
									<div class="crea">
										<a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/msg.png"></a>
									</div>
									<div class="del">
										<a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/del.png"></a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			
			</div>
		</div>
	</div>
</div>
<!----  Add member tot other modal --------->
<a href="#add-more-other" id="add_member_other" data-toggle="modal"></a>
<div class="modal fade NEW-NETWORK add-more" id="add-more-other" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	$(document).ready(function(){
	$('[data-toggle="popover"]').popover()
          });	
</script>