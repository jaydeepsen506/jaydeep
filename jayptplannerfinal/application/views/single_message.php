<?php
$ci=&get_instance();
$ci->load->model('network_model');
$sender_information=$ci->network_model->get_user_information($msg[0]['sent_by']);
?>
<div class="massagebox" style="overflow:hidden;">
<div class="daytim"><?php
    if(date('Y-m-d',strtotime($msg[0]['send_time'])) == date('Y-m-d'))
    {
        echo "Today";
    }
    else if(date('Y-m-d',strtotime($msg[0]['send_time'])) == date('Y-m-d',strtotime(' -1 day')))
    {
        echo "Yesterday";
    }
    else
    {
        echo date('Y-m-d',strtotime($msg[0]['send_time']));
        //echo "Yesterday";
    }
    ?><span><?php echo date('H:i',strtotime($msg[0]['send_time']));?></span></div>
<div class="notiimgtxt">
    <div class="proimg"><img <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> style="height:38px;width:38px;" alt=""></div>
    <div class="notitxt"><span><?php echo $sender_information[0]['name'];?>:</span><?php echo $msg[0]['message']; ?></div>
</div>
</div>