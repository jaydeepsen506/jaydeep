<?php
$ci=&get_instance();
$ci->load->model('network_model');
$members_count=$ci->network_model->get_total_members($network_info[0]['id']);
?>
<script>
       //$(document).ready(function() {
$(".tab-header-with-icon ul li").click(function(){
        $('.tab-cont').removeClass('active');
        $('.tab-header-with-icon ul li').removeClass('active');
        $(this).addClass('active');
        var getdata = $(this).attr('data');		
        $('#'+getdata).addClass('active');
});
//});
</script>
<script>
    	$(".tab-header ul li").click(function(){
		$('.tab-content').removeClass('active');
		$('.tab-header ul li').removeClass('active');
		$(this).addClass('active');
		var getdata = $(this).attr('data');		
		$('#'+getdata).addClass('active');
	});
</script>
<script>
   function show_add_div_other()
   {
     //alert("hello");
     $('#list_div_other').hide();
     //$('.tab-header-with-icon ul li').addClass('active');
     //$('.tab-cont').addClass('active');
   }
   function hide_listing_other()
   {
     $('#list_div_other').show();
     $('.tab-cont').removeClass('active');
     $('.tab-header-with-icon ul li').removeClass('active');
   }
</script>
<script>
    function submit_add_member_form_other() {
        //code
        var frm= document.addMemberFormOther;
        if (frm.member.value=='') {
            document.getElementById('error_other_section').innerHTML='Please Select Member';
            return false;
        }
        else
        {
            document.getElementById('error_other_section').innerHTML='';
        }
        frm.submit();
    }
</script>
<script>
 function submit_other_email_form()
 {
     var frm= document.add_more_email_other;
     if (frm.member_email.value.search(/\S/) == '-1') {
        document.getElementById('error_other_section1').innerHTML='Please put email id to add';
        return false;
     }
     else
     {
        document.getElementById('error_other_section1').innerHTML='';
     }
    frm.submit();
 }
</script>
<script>
    function submit_del_form_other(iVal) {
        
         var frm=document.getElementById('member_del_form_other'+iVal);
	 frm.submit();
    }
</script>
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-body">
					<div class="datehead"><?php echo $network_info[0]['network_name'];?></div>
						<div class="datehead" style="font-family:'HelveticaNeue-Light';"><?php echo $members_count; ?> member in this network</div>
						
						<div class="tab-outer">
						<div class="tab-header-with-icon" onclick="show_add_div_other()">
							<ul>
							<li class="add" data="6">
								<a href="javascript:void(0)">Add more member</a>
							</li>
							<li class="invite" data="7">
								<a href="javascript:void(0)">Invite people via e-mail</a>
							</li>
							</ul>
						</div>
						<div class="tab-cont" id="6">
                                                     <div id="add_member_div_other">
                                                        <form name="addMemberFormOther" id="addMemberFormOther" action="<?php echo base_url(); ?>dashboard/add_extra_member" method="POST">
                                                        <div class="form-group">
                                                           <label>Add member</label>
                                                             <div>
                                                               <select class="form-control chosen-select" name="member[]" id="member" multiple="true" style="width:100%">
                                                                   <?php
                                                                   foreach($trainer_list as $trainer)
                                                                   {
                                                                    $trainer_info=$ci->network_model->check_member_existance($this->input->post('network_id'),$trainer['id']);
                                                                    if(count($trainer_info) == 0)
                                                                    {
                                                                   ?>
                                                                   <option value="<?php echo $trainer['id'];?>"><?php if($trainer['name']!='') { echo $trainer['name']; } else{ echo $trainer['email']; }?></option>
                                                                   <?php
                                                                    }
                                                                   }
                                                                   ?>
                                                               </select>
                                                               <div id="error_other_section" style="color:red;"></div>
                                                             </div>
                                                       </div>
                                                        <div class="btns">
			<a class="butsblue green" style="background: #9ec32e; box-shadow: 0 2px #9dab72" href="javascript:void(0)" onclick="return submit_add_member_form_other()">Save</a>
                        <a class="butsblue green" style="background: #737373; box-shadow: 0 2px #737373;" href="javascript:void(0)" onclick="hide_listing_other()">Cancel</a>
		                                        </div>
                                                        <input type="hidden" name="network_id" id="network_id" value="<?php echo $this->input->post('network_id');?>">
                                                        </form>
                                                    </div>		
						
						</div>
						<div class="tab-cont" id="7">
                                                <form name="add_more_email_other" id="add_more_email_other" method="POST" action="<?php echo base_url();?>dashboard/add_more_email">
							 <div class="form-group">
                                                           <label>Add member with email(Separated by comma)</label>
                                                            <div class="tagsinput-primary">
                                                              <input type="text" name="member_email" id="member_email" class="tagsinput" data-role="tagsinput" placeholder="Type Name..." style="width: 100%;"/>
                                                              <div id="error_other_section1" style="color:red;"></div>
                                                            </div>
                                                         </div>
							 <input type="hidden" name="network_id" id="network_id" value="<?php echo $this->input->post('network_id');?>">
							 <input type="hidden" name="network_name" id="network_name" value="<?php echo $network_info[0]['network_name'];?>">
                                                         <div class="btns">
                                                            <a class="butsblue green" style="background: #9ec32e; box-shadow: 0 2px #9dab72" href="javascript:void(0)" onclick="submit_other_email_form()">Save</a>
                                                            <a class="butsblue green" style="background: #737373; box-shadow: 0 2px #737373;" href="javascript:void(0)" onclick="hide_listing_other()">Cancel</a>
		                                        </div>
							</form>
                                                </div>
                                                <div id="list_div_other">
                                                 <?php
                                                   // echo count($total_member);
                                                    foreach($total_member as $member)
                                                    {
                                                        if($member['user_id']!=0)
                                                        {
                                                            $user_info=$ci->network_model->get_user_information($member['user_id']);
                                                        }
                                                    ?>
							<div class="listing-txt clearfix">
								<div class="user-left">
									<a class="user-pic" href="#">
                                                                            <?php
                                                                            if($member['user_id']!=0)
                                                                             {
										if($user_info[0]['image']!=''){
                                                                            ?>
										<img src="<?php echo base_url();?>user_images/<?php echo $user_info[0]['image'];?>" alt="" style="height: 50px;width: 50px;"/>
                                                                                <?php
										}
										else
										{
										   ?>
										   <img src="<?php echo base_url();?>assets/site/after_login/images/no-photo.png" alt="" style="height: 50px;width: 50px;"/>
										   <?php
										}
                                                                             }
                                                                             else
                                                                             { 
                                                                                ?>
                                                                                <img src="<?php echo base_url();?>assets/site/after_login/images/no-photo.png" alt="" style="height: 50px;width: 50px;"/>
                                                                                <?php
                                                                             }
                                                                            ?>
									</a>
									<div class="us-name">
										<h2>
                                                                                <?php
                                                                                 if($member['user_id']!=0)
                                                                                   {
											if($user_info[0]['name']!=''){
												 
												 echo $user_info[0]['name'];
											}
											else
											{
											         echo $user_info[0]['email'];
											}
                                                                                    
                                                                                   }
                                                                                   else
                                                                                   {
                                                                                    echo $member['user_email'];
                                                                                   }
                                                                                   ?>
                                                                                </h2>
									</div>
								</div>
								<div class="icon-right clearfix">
									<div class="cre-del">
										<div class="crea">
											<a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/msg.png"></a>
										</div>
										<div class="del">
											<a href="javascript:void(0)" onclick="submit_del_form_other(<?php echo $member['id']; ?>)"><img src="<?php echo base_url(); ?>assets/site/after_login/images/del.png"></a>
										</div>
									</div>
								</div>
							</div>
                                                       <form name="member_del_form_other<?php echo $member['id']; ?>" id="member_del_form_other<?php echo $member['id']; ?>" action="<?php echo base_url();?>dashboard/network_member_delete" method="POST">
								<input type="hidden" name="net_mem_id" id="net_mem_id" value="<?php echo $member['id'];?>">
								<input type="hidden" name="netwrk_id" id="netwrk_id" value="<?php echo $network_info[0]['id'];?>">
							</form>
                                                        <?php
                                                    }
                                                        ?>
                                                        </div>
						
					</div>
				</div>
			
			</div>
		</div>