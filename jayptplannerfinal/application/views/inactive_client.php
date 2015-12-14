<a href="javascript:;" data-toggle="collapse" data-target="#demo2" class="">INACTIVE CLIENTS <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo2" class="collapse in">
             <?php
            if(count($inactive_clients) > 0)
            {
                foreach($inactive_clients as $inactive)
                {
                    if($inactive['image'] != '')
                    {
                        $img_src = base_url()."user_images/".$inactive['image'];
                    }
                    else{
                        $img_src = base_url()."assets/site/after_login/images/pf2.png";
                    }
                    $user_name = explode(" ",$inactive['name']);
                    if($inactive['deleted_status']=='N')
                    {
                    ?>
                    <a href="<?php echo base_url();?>client-profile/<?php echo $inactive['id'];?>">
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