 <?php
   $ci=&get_instance();
   $ci->load->model('network_model');
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
    ?>
    <a href="javascript:void(0)" onclick="show_msg_list(<?php echo $value;?>)" style="text-decoration:none;">
    <div class="messageview">
        <div  class="messagesingle" <?php if($msg_last[0]['read_status']=='N' && $msg_last[0]['sent_by']!=$this->session->userdata('site_user_id')) {?>style="background: rgba(135, 206, 235, 0.39);" <?php } ?>id="view<?php echo $value;?>">
                <div class="timeofricev">
                <div class="top">Today</div>
                <div class="bottom"><?php echo date('H:i',strtotime($msg_last[0]['send_time']));?></div>
            </div>
            <div class="proimg_inbox"><img <?php if($user_info[0]['image']!='') { ?>src="<?php echo base_url();?>user_images/<?php echo $user_info[0]['image'];?>" <?php }else{ ?>src="<?php echo base_url();?>assets/site/after_login/images/pf2.png"<?php }?> alt="" style="height:38px; width: 38px;"></div>
            <div class="messagebody"><span><?php echo $user_info[0]['name']; ?>:</span> <?php echo substr($msg_last[0]['message'],0,50); ?></div>
        </div>
    </div>
    </a>
    <?php
     echo "^^".$value;
    }
    ?>