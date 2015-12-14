<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
$day_name = date('l', strtotime($date_val));
if(count($meal_info) > 0)
{
    foreach($meal_info as $meals)
    {
        $main_meal_id = $meals['main_meal_id'];
    }
    $where_meal=array(
        'id' => $main_meal_id
             );
    $meal_info_main=$ci->common_model->get('user_meal',array('*'),$where_meal);
    ?>
    <div class="panel panel-default">
    <div class="panel-heading">
       <h4 class="panel-title progress_title">
       <em>Diet:</em><span><?php echo $day_name; ?></span>
        <div class="pull-right">
              <a href="javascript:void(0)" onclick="remove_meal($(this),<?php echo $main_meal_id; ?>)"><i class="fa fa-fw fa fa-remove"></i>Remove</a>
              <?php
                  if($meal_info_main[0]['repeat_status'] =='N')
                  {
                  ?>
                  <a href="#" data-toggle="modal" data-target="#APPOINTMENT6" onclick="get_repeat_pop_meal(<?php echo $main_meal_id; ?>,<?php echo $client_id; ?>)"><i class="fa fa-fw fa fa-repeat"></i>
                  <?php
                  }
                  else{
                      ?>
                      <a href="javascript:void(0)"><i class="fa fa-fw fa fa-repeat"></i>
                      <?php
                  }
                  ?>
               <?php
          if($meal_info_main[0]['repeat_status'] =='N')
          echo "Never";
          elseif($meal_info_main[0]['repeat_status'] =='D')
          echo "Every Day";
          elseif($meal_info_main[0]['repeat_status'] =='EXD')
          {
              echo "Every ".$meal_info_main[0]['every_x_day']." Day";
          }
          elseif($meal_info_main[0]['repeat_status'] =='EW')
          {
              $dayNames = array(
                  0=>'Sunday',
                  1=>'Monday', 
                  2=>'Tuesday', 
                  3=>'Wednesday', 
                  4=>'Thursday', 
                  5=>'Friday', 
                  6=>'Saturday', 
               );
              foreach($dayNames as $num=>$val)
              {
                 if($meal_info_main[0]['every_week'] == $num)
                 {
                  echo "Every ".$val."";
                 }
                
              }
              
          }
          elseif($meal_info_main[0]['repeat_status'] =='EM')
          {
              echo "Every Month";
          }
    
          ?></a>
              </div>
    
    </h4>
     </div>
    <div class="panel-collapse">
        <?php
        foreach($meal_info as $meals)
        {
             $where_meal_exer=array(
                'id' => $meals['meal_id']
                     );
                $meal_info_det=$ci->common_model->get('meal',array('*'),$where_meal_exer);
                $where_meal_exer=array(
                'meal_id' => $meals['meal_id']
                     );
                $meal_info_image=$ci->common_model->get('meal_images',array('*'),$where_meal_exer);
                if(isset($meal_info_image[0]['filename']))
                {
                    $media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
                }
                else
                {
                    $media = base_url().'assets/site/after_login/images/no-image.gif';
                }
               // $media = base_url().'meal_images/'.$meal_info_image[0]['filename'];
            ?>
            <div class="panel-body">
                <div class="editblog">
                <div class="workimg"><img alt="" src="<?php echo $media; ?>" style="height: 50px;width: 50px;"></div>
                <div class="workouttxt">
                <?php
    
                    if(strlen($meal_info_det[0]['title']) > 25)
                    {
                        echo substr($meal_info_det[0]['title'],0,25)."..";
                    }
                    else{
                        echo $meal_info_det[0]['title'];
                    }
                    $where_meal_list=array(
                    'meal_dates_id' => $meals['id'],
                    'client_id' => $client_id
                         );
                    $meals_info=$ci->common_model->get('user_custom_meal',array('*'),$where_meal_list);
                    
                    $where_meal_opt=array(
                    'meal_id' => $meals['meal_id']
                         );
                    $meal_info_det_other=$ci->common_model->get('meal_other_options',array('*'),$where_meal_opt);
                   foreach($meal_info_det_other as $options)
                   {
                    $main_opts[] = $options['specifically']."#@#@".$options['amount'];
                   }
                    $set_val = '';
                    
                        $customized = false;
									if(count($meals_info) > 0)
									{
									    
									    $set_value = $meals_info[0]['set_value'];
									    if($set_value != '')
									    {
										$exp_sets = explode(",",$set_value);
									    }
									    if(count($exp_sets) != count($meal_info_det_other))
									    {
										$customized = true;
									    }
									    else
									    {
										foreach($exp_sets as $sets)
										{
										    if(!in_array($sets,$main_opts))
										    {
											$customized = true;
											break;
										    }
										}
									    }
									    
									}
    
        
                    ?>  <span>
                        <?php
                        if($customized == true)
                        {
                            echo "(Customized)";
                        }
                        else{
                            echo "&nbsp;";
                        }
                        ?>
                       </span></div>
                <div class="editright">
                    
                    <a href="#" data-toggle="modal" data-target="#MEAL-INFORMATION" onclick="custom_meal(<?php echo $meals['meal_id']; ?>,<?php echo $meals['id']; ?>)"><img alt="" src="<?php echo base_url(); ?>assets/site/after_login/images/edit.png"></a>
                    <a href="javascript:void(0)" onclick="remove_meal_frm_prog($(this),<?php echo $meals['id']; ?>)">
                        <i class="fa fa-fw fa fa-remove"></i>
                    </a>
                </div>
            </div>
                    </div>

            <?php
        }
        ?>
        
    </div>
 </div>
    <?php
}

?>