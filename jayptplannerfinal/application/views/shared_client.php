<?php
$ci=&get_instance();
$ci->load->model('common_model');
?>
<a href="javascript:;">SHARED CLIENTS<i class="fa fa-fw fa-caret-right"></i></a>
  <ul id="demo2" class="collapse in">
     <?php
    if(count($shared_clients) > 0)
    {
        foreach($shared_clients as $share)
        {
            $where_share_user=array(
               'id' => $share['client_id']
                   );
            $share_client_info=$ci->common_model->get('user',array('*'),$where_share_user);
            if($share_client_info[0]['image'] != '')
            {
                $img_src = base_url()."user_images/".$share_client_info[0]['image'];
            }
            else{
                $img_src = base_url()."assets/site/after_login/images/pf2.png";
            }
            $user_name = explode(" ",$share_client_info[0]['name']);
            if($share_client_info[0]['deleted_status']=='N')
            {
            ?>
            <a href="<?php echo base_url();?>client-profile/<?php echo $share_client_info[0]['id'];?>">
             <li>
                <div class="clientarea">
                    <div class="proimg"><img src="<?php echo $img_src; ?>" alt="" style="height:41px;width :41px;"/></div>
                    <div class="clientname">
                        <?php echo $user_name[0]; ?>
                        <?php
                        if(count($user_name) > 1)
                        {
                        ?>
                        <span><?php echo $user_name[1]; ?></span>
                         <?php
                        }
                        ?>
                    </div>
                </div>
            </li>
             </a>
            <?php
            }
        }
    }
    ?>
  
</ul>