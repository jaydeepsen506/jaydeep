<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');

$where_meal=array(
'user_id' => $this->session->userdata('site_user_id'),
'status' => 'Y'
     );
$get_networks = $ci->common_model->get('network_member',array('*'),$where_meal);
$member = array();
foreach($get_networks as $networks)
{
    $where_meal_mem=array(
    'network_id' => $networks['network_id'],
    'status' => 'Y',
    'user_id !=' => $this->session->userdata('site_user_id')
         );
    $get_members = $ci->common_model->get('network_member',array('*'),$where_meal_mem);
    if(count($get_members) > 0)
    {
      foreach($get_members as $members)
      {
        if(!in_array($members['user_id'],$member))
        {
            $member[] = $members['user_id'];
        }
        
      }
    }
}

$where_meal_avl_rep=array(
'trainer_id' => $this->session->userdata('site_user_id'),
'repeat_date' =>$date_val
     );
$get_rep_detail = $ci->common_model->get('trainer_avl_time_repeat_val',array('*'),$where_meal_avl_rep);


$where_meal_avl=array(
'trainer_id' => $this->session->userdata('site_user_id')
     );
$get_time = $ci->common_model->get('trainer_avail_time',array('*'),$where_meal_avl);

if(count($get_time) > 0)
{
    foreach($get_time as $time_avl)
    {
         $start_time = date("H",strtotime($time_avl['avl_time_from']));
        $end_time = date("H",strtotime($time_avl['avl_time_to']));
     
        for($time=$start_time;$time<$end_time;$time++)
        {
            $val_time = $time;
             $start_book = str_pad($time,2,'0',STR_PAD_LEFT).":00";
             $end_time_val = ($val_time + 1);
             $end_book = str_pad($end_time_val,2,'0',STR_PAD_LEFT).":00";
            $time_arr[]= $start_book."-".$end_book;
        }
    }
}
sort($time_arr);

?>
<script>
    function choose_pt(val)
    {
	if (val == '') {
	   var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
	}
	else{
	     var trainer_id = val;
	}
	var date_val = document.getElementById('appoint_date').value;
	var dataString ="trainer_id="+trainer_id+'&date_val='+date_val;
	$.ajax
	({
	type: "POST",
	url: "<?php echo base_url();?>toolbox/get_change_pt_value",
	data: dataString,
	cache: false,
	success: function(data)
	{
	  $('#choosable_time').html(data);
	  $('#slot_another').val(" ");
	  $('#date_val').val(date_val);
	  $('#avl_slot_id').show();
	  $('#client_all_div').show();
	}
	});
    }
    function choose_date(val_date)
    {
	
	var date_val = val_date;
	var dataString ="date_val="+date_val;
	$.ajax
	({
	type: "POST",
	url: "<?php echo base_url();?>dashboard/get_avl_trainers",
	data: dataString,
	cache: false,
	success: function(data)
	{
	   
	  $('#trainer_diff').html(data);
	  $('#trainer_list').show();
	  $('#date_val').val(date_val);
	  
	}
	});
    }
    function choose_slot(e,start_time,end_time)
    {
	var date_val = document.getElementById('appoint_date').value;
	$('#slot_another').val(start_time+'-'+end_time);
	$('.time_choosen a').removeClass("active");
	$(e).addClass("active");
	$('#date_val').val(date_val);
    }
    function book_now_details()
    {
	var frm = document.appoit_form;
	if (frm.slot_another.value.search(/\S/) == '-1')
	{
	     $('#show_eror').html("Please choose any slot");
	     return false;
	}
	else{
	     $('#show_eror').html("");
	}
	if (frm.client_name.value == '')
	{
	     $('#show_eror').html("Please choose any client");
	     return false;
	}
	else{
	     $('#show_eror').html("");
	}
	frm.submit();
    }
    
     function edit_book_details()
    {
	var frm = document.appoit_form;
        if (frm.trainer_diff.value.search(/\S/) == '-1')
	{
	     $('#show_eror').html("Please choose any trainer");
	     return false;
	}
	else{
	     $('#show_eror').html("");
	}
	if (frm.slot_another.value.search(/\S/) == '-1')
	{
	     $('#show_eror').html("Please choose any slot");
	     return false;
	}
	else{
	     $('#show_eror').html("");
	}
	if (frm.client_name.value == '')
	{
	     $('#show_eror').html("Please choose any client");
	     return false;
	}
	else{
	     $('#show_eror').html("");
	}
	frm.submit();
    }
    </script>
<form action="<?php echo base_url(); ?>toolbox/do_booking" method="post" name="appoit_form">
   <input type="hidden" name="mode" value="book_appointment">
<input type="hidden" name="date_val" id="date_val" value="<?php echo $date_val; ?>">
<input type="hidden" name="slot_another" id="slot_another" value="">
    <div class="appoint_pop">
      <span class="close_cell" data-dismiss="modal" aria-hidden="true"><img src="<?php echo base_url(); ?>assets/site/after_login/images/close_icon.png" alt="" /></span>
      <h2 class="pop_heading">Book New appointment</h2>
      <div style="color: red;" id="show_eror"></div>
      <div class="choice_cell">
      	<label>Choose date</label>
      	<span>
            <input type="text" class="text_in date-class" id="appoint_date" value="" onchange="choose_date(this.value)" readonly="true" />
      	</span>
      </div>
      <div class="choice_cell" id="trainer_list" style="display: none;">
        
      	<label>Choose PT</label>
      	<span>
      		<select class="select_box" id="trainer_diff" name="trainer_diff" onchange="choose_pt(this.value)">
                    
      		</select>
      	</span>
      </div>
     
      <div class="choice_cell" id="avl_slot_id" style="display: none;">
      	<label>Choose available appointments for the day</label>
      	<div class="time_choosen" id="choosable_time">
            
      		
      	</div>
      </div>
      
      <div class="choice_cell" id="client_all_div" style="display: none;">
      	<label>Choose client</label>
      	<span>
            <?php
            $where_user=array(
            'created_by' => $this->session->userdata('site_user_id'),
            'status' => 'Y',
            'deleted_status' => 'N'
                 );
            $get_own_user = $ci->common_model->get('user',array('*'),$where_user);
            
           
            $get_shared_user = $ci->common_model->get_clients($this->session->userdata('site_user_id'));
            ?>
      		<select class="select_box" name="client_name">
                    <option value="">none</option>
                    <?php
                    foreach($get_own_user as $user)
                    {
                        ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php
                            echo $user['name'];
                            ?>
                        </option>
                        <?php
                    }
                    foreach($get_shared_user as $user)
                    {
                        ?>
                        <option value="<?php echo $user['id']; ?>">
                            <?php
                            echo $user['name'];
                            ?>
                        </option>
                        <?php
                    }
                    ?>
      			
      		</select>
      	</span>
      </div>
      
      <a href="javascript:void(0)" onclick="edit_book_details()" class="confirm_btn">Book Now</a>
      </div>
</form>