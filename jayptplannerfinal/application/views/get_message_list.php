<?php
$ci=&get_instance();
$ci->load->model('network_model');
//echo $user_id;die();
foreach($all_messages as $msg){
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