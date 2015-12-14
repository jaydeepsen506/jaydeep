 <?php
 $ci=&get_instance();
 $ci->load->model('network_model');
        foreach($all_messages as $msg)
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
