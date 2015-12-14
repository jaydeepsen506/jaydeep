<?php
$ci=&get_instance();
$ci->load->model('network_model');
$per_laod = 5;
$start = 0;
$sender_info=$ci->network_model->get_user_information($sender_id);
$latest_msg_list=$ci->network_model->get_latest_user_messages($sender_id);
$chat_messages=$ci->network_model->get_latest_user_chat($sender_id,$per_laod,$start);
$data_updt_message=array(
      'read_status' => 'Y'
	 );
$read_status=$ci->network_model->update_message_read_status($sender_id,$data_updt_message);
?>
<div class="messagername">Messages of <span><?php echo $sender_info[0]['name'] ?></span></span><?php if(count($latest_msg_list) > $per_laod) { ?><span style="margin-left: 100px;"><a href="javascript:void(0)" style="text-decoration: none;" onclick="load_more_message(<?php echo $per_laod; ?>,<?php echo $sender_id; ?>,<?php echo $this->session->userdata('site_user_id'); ?>)">Load More Messages</a></span><?php } ?></div>
<div class="whole_msg" id="total_msg">
<?php
foreach($chat_messages as $msg)
{
   $sender_information=$ci->network_model->get_user_information($msg['sent_by']);
?>
<div class="inboxmessageboy">
  <div class="msshead">
          <div <?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>class="massheadright"<?php }else { ?>class="massheadleft"<?php } ?>>
                  <div  <?php if($msg['sent_by']==$this->session->userdata('site_user_id')) { ?>class="proimg_inbox_right"<?php }else { ?>class="proimg_inbox"<?php } ?>><img <?php if($sender_information[0]['image']!='') { ?>src="<?php echo base_url(); ?>user_images/<?php echo $sender_information[0]['image'];?>" <?php }else { ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> alt="" style="height: 38px;width: 38px;"></div>
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
                    <input type="hidden" name="to_id" id="to_id" value="<?php echo $sender_id; ?>">
                </form>
    </div>
</div>