<a class="" href="javascript:;" data-toggle="collapse" data-target="#demo">ACTIVE CLIENTS<i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo" class="collapse in">
            <?php
            if(count($active_clients) > 0)
            {
                foreach($active_clients as $active)
                {
                    if($active['image'] != '')
                    {
                        $img_src = base_url()."user_images/".$active['image'];
                    }
                    else{
                        $img_src = base_url()."assets/site/after_login/images/pf2.png";
                    }
                    $user_name = explode(" ",$active['name']);
                    if($active['deleted_status']=='N')
                    {
                    ?>
                    <a href="<?php echo base_url();?>client-profile/<?php echo $active['id'];?>">
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