<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
$ci->load->model('network_model');
?>
 <script type="text/javascript" src="<?php echo base_url();?>assets/site/after_login/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="innerblogright clearfix">
<div class="calenderblog">
<div class="calendar" id="calendar_booking">
	<?php
	    include 'calendar_appointment.php';
	     
	    $calendar = new Calendar_appointment();
	    $year = date("Y");
	    $month = date("m");
	    $where_meal_time=array(
	    'trainer_id' => $this->session->userdata('site_user_id')
		 );
	    $user_avl_time=$ci->common_model->get('trainer_avail_time',array('*'),$where_meal_time);
	    $tot_hours = 0;
	    foreach($user_avl_time as $avl_time)
	    {
		$time1 = new DateTime($avl_time['avl_time_from']);
		$time2 = new DateTime($avl_time['avl_time_to']);
		$interval = $time1->diff($time2);
		$hours = $interval->h;
		$tot_hours = $tot_hours + $hours;
		//print_r($interval);
	    }
	   
	    
	    $where_meal=array(
	    'trainer_id' => $this->session->userdata('site_user_id'),
	    'MONTH(booked_date)' => $month,
	    'YEAR(booked_date)' => $year,
		 );
	    $user_progrm=$ci->common_model->get('user_booking',array('*'),$where_meal,null,null,null,null,'booked_date');
	    $all_dates = array();
	    $date_val = array();
	    foreach($user_progrm as $programs)
	    {
		$where_meal_date=array(
		'trainer_id' => $this->session->userdata('site_user_id'),
		'booked_date' => $programs['booked_date']
		     );
		$user_progrm_all=$ci->common_model->get('user_booking',array('*'),$where_meal_date);
		$date_val['date_work'] = $programs['booked_date'];
		if(count($user_progrm_all) < $tot_hours)
		{
			 $date_val['status'] = 'A';
		}
		else{
			$date_val['status'] = 'F';
		
		}
		 $all_dates[] = $date_val;
	    }
	//   
	   echo $calendar->show($year,$month,$all_dates);
	//    $client_id = $user_details[0]['id'];
	//    $where_meal=array(
	//	    'client_id' => $user_details[0]['id'],
	//	    'trainer_id' => $this->session->userdata('site_user_id'),
	//	    'workout_date' => date("Y-m-d")
	//		 );
	//    $program_info=$ci->common_model->get('user_program_exercises',array('*'),$where_meal);
	    
	    ?>
</div>
<div class="text-left">
	<span class="refresh"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		<i class="fa fa-refresh"></i>
	</span>
	<div class="modal refresh-pop fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title text-center" id="myModalLabel">Sync the booked appointments</h5>
	       <ul class="social-pop list-unstyled">
		      <li><a href="#"> <img src="<?php echo base_url(); ?>assets/site/after_login/images/call.png" alt="" />  iCall</a></li>
		      <li><a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/calender.png" alt="" />  Google Calender</a></li>
		      <li><a href="#"><img src="<?php echo base_url(); ?>assets/site/after_login/images/outlook.png" alt="" />  Outlook</a></li>
	      </ul>
	    </div>
	  </div>
	</div>
	</div>
						
						
	<div class="activelivetxt">Fully booked</div>
	<div class="activeliveholotxt">Available appointments</div>
</div>
</div>
</div>
<script>
	function load_more_notification(per_load,logged_in_user)
	{
	    var start_val=document.getElementById('start_val_notofication').value;
	    var start=parseInt(start_val);
	    var dataString ="per_load="+per_load+"&start="+start+"&logged_in_user="+logged_in_user;
	     $.ajax({
			    
		type: "POST",
		url: '<?php echo base_url();?>dashboard/get_more_notifications',
		data: dataString,
		cache: false,
		success: function(data)
		{
		   // alert(data);
		    $('#new_noti_div').prepend(data);
		    $('#start_val_notofication').val(start+per_load);
		}
		});
	}
</script>
<div class="innerblogright clearfix">
<div class="Notificationblog">
<?php
$per_laod = 3;
$start = 0;
?>
<?php
$where_noti=array(
	'user_id' => $this->session->userdata('site_user_id')
		  );
$notifications = $ci->common_model->get('notifications',array('*'),$where_noti,null,null,null,null,null,null,'notification_time','ASC');
$limit_notification=$ci->network_model->get_latest_notifications($per_laod,$start);
?>
<div id="notification_list">
<div class="notohead">LATEST NOTIFICATIONS <?php if(count($notifications) > $per_laod) { ?><a href="javascript:void(0)" class="Earlier" onclick="load_more_notification(<?php echo $per_laod; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Earlier</a><?php } ?></div>
<div id="new_noti_div">
<?php
if(count($notifications) > 0){
	foreach($limit_notification as $noti){
?>
<div class="topnotiblo">
<div class="daytim"><?php
			if(date('Y-m-d',strtotime($noti['notification_time'])) == date('Y-m-d'))
			{
			    echo "Today";
			}
			else if(date('Y-m-d',strtotime($noti['notification_time'])) == date('Y-m-d',strtotime(' -1 day')))
			{
			    echo "Yesterday";
			}
			else
			{
			    echo date('Y-m-d',strtotime($noti['notification_time']));
			}
			?><span><?php echo date('H:i',strtotime($noti['notification_time']));?></span></div>
<div class="notiimgtxt">
	<?php
	$where_client=array(
		'id' => $noti['client_id']
			    );
	$client_info=$ci->common_model->get('user',array('*'),$where_client);
	?>
    <div class="proimg"><img <?php if($client_info[0]['image'] !=''){ ?>src="<?php echo base_url(); ?>user_images/<?php echo $client_info[0]['image'];?>"<?php }else{?>src="<?php echo base_url(); ?>assets/site/after_login/images/pf2.png"<?php }?> alt="" style="height: 38px;width: 38px;"></div>
    <div class="notitxt"><span><?php if($client_info[0]['name'] !=''){ echo $client_info[0]['name'];}else{ echo $client_info[0]['email']; }?></span><br><?php echo $noti['notification']; ?></div>
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
<form>
	<input type="hidden" name="start_val_notofication" id="start_val_notofication" value="3">
</form>
<script>
	function get_month_booking(month,year)
        {
		
	    var trainer_id = '<?php echo $this->session->userdata('site_user_id')?>';
            var dataString ="month="+month+'&year='+year+'&trainer_id='+trainer_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>ajax/get_calendar_booking.php",
            data: dataString,
            cache: false,
            success: function(data)
            {
             
              $("#calendar_booking").html(data);
             
            }
            });
        }
	function get_booking_popup(hourval)
        {
	    var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';
	    var current_date = document.getElementById('current_date').value;
            var dataString ="current_date="+current_date+'&trainer_id='+trainer_id+'&hourval='+hourval;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/get_booking_popup",
            data: dataString,
            cache: false,
            success: function(data)
            {
              
              $('#appoint_popup').html(data);
	     $('.date-class').datepicker({
          changeMonth: true,
          changeYear: true
       });
            }
            });
        }
	function assign_get_booking(e,date_val,month,year)
        {
	    
            var trainer_id = '<?php echo $this->session->userdata('site_user_id'); ?>';

            var dataString ='date_val='+date_val+'&month='+month+'&year='+year+'&trainer_id='+trainer_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/get_booking_details",
            data: dataString,
            cache: false,
            success: function(data)
            {
		//alert(data);
		var cont = data.split("###@@@");
		$("#tot_booking").html(cont[0]);
		$("#date_show").html(cont[1]);
		$("div.unit").removeClass("active");
		$('#load_booking').html(cont[2]);
		 $(e).parents(".unit").addClass("active");
	     $(e).parents(".unit").addClass("active");
            }
            });
        }
</script>