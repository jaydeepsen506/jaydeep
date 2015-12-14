<?php
$ci=&get_instance();
$ci->load->model('common_model');
if(count($all_notification) > 0){
	foreach($all_notification as $noti){
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