<ul class="nav navbar-nav side-nav">
    <li>
        <div class="searchbg">
           <!-- <form action="" method="post" name="search_client" onsubmit="return check_search();">-->
                 <button name="search" type="button" class="custombutton" onclick="return check_search();"><i class="fa fa-fw fa-search"></i></button>
                <div class="searchfieldouter">
<!--				<input name="search_val" type="text" class="custfield" onClick="if(this.value=='FIND CLIENT') this.value = ''; " onBlur=" if(this.value=='') this.value = 'FIND CLIENT';" value="<?php //if(isset($_REQUEST['search_val'])) echo $_REQUEST['search_val'];else echo 'FIND CLIENT'; ?>">-->
                <input name="search_val" type="text" class="custfield" value="" onChange="search_client(this.value)" onkeypress="search_client(this.value)" placeholder="FIND CLIENT">
                </div>
                <div id="error_div" style="color:red;"></div>
            <!--</form>-->
           
        </div>
    </li>
    <li>
        <?php
            //$data_to_store = array(
            //'created_by' => $this->session->userdata('site_user_id'),
            //'type' => 'C',
            //'status' => 'Y'
            //);
            // $active_clients=$ci->common_model->get('user',array('*'),$data_to_store);
            // $data_to_store_in = array(
            //    'created_by' => $this->session->userdata('site_user_id'),
            //    'type' => 'C',
            //    'status' => 'N'
            //);
            // $inactive_clients=$ci->common_model->get('user',array('*'),$data_to_store_in);
        ?>
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
    </li>
     <li>
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
    </li>
    <li>
        <a href="javascript:;">SHARED CLIENTS<i class="fa fa-fw fa-caret-right"></i></a>
    </li>
    <li class="text-center butli"><a class="butsblue" href="#" data-toggle="modal" data-target="#myModal-1" >New Clients</a></li>
    <li class="copytext hidden-sm hidden-xs">&copy; 2015 PT-Planner AB</li>

</ul>
