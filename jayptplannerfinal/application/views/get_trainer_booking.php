<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
$where_meal=array(
'trainer_id' => $this->session->userdata('site_user_id'),
'booked_date' => $date_val
     );
$booking_info=$ci->common_model->get('user_booking',array('*'),$where_meal);
$day_val = $day_val;
$month_val = $month_val;
$year_val = $year_val;
$monthName = date("F", mktime(0, 0, 0, sprintf('%02d',$month_val), 10));
$weekday = date('l', strtotime($date_val));
echo count($booking_info);
echo "###@@@";
?>
<?php echo $weekday; ?> <span class="datecolor"><?php echo $day_val; ?> <?php echo $monthName; ?></span> <span class="yearfont"><?php echo $year_val; ?></span>
<?php
echo "###@@@";
$time_arr = array();
$data_msg_exist = array(
            'trainer_id' => $this->session->userdata('site_user_id'),
            'repeat_date' => $date_val
           );
$trainer_repeat_date=$ci->common_model->get('trainer_avl_time_repeat_val',array('*'),$data_msg_exist);
if(count($trainer_repeat_date) > 0)
{

foreach($trainer_time as $time_avl)
{
    $start_time = date("H",strtotime($time_avl['avl_time_from']));
    $end_time = date("H",strtotime($time_avl['avl_time_to']));
    for($time=$start_time;$time<=$end_time;$time++)
    {
         for($mins=0; $mins<60; $mins+=30)
         {
             $time_arr[]= str_pad($time,2,'0',STR_PAD_LEFT).":".str_pad($mins,2,'0',STR_PAD_LEFT);
         }
       
    }
}
//date_default_timezone_set('Asia/Kolkata');
sort($time_arr);

$tot_time = count($time_arr);
 $frst_slots = ceil($tot_time/2);
 $remaining = ($tot_time - $frst_slots);
 
 $first_arr = array_chunk($time_arr, $frst_slots);
 //if($trainer_settings[0]['repeat_status'] == '')
 $val = 1;
 //print_r($first_arr);
foreach($first_arr as $arr_time)
{
    $end_val = '';
    $start_val = '';
    if($val == 1)
    {
         $end_val = end($arr_time);
         if($end_val)
        {
            $hour_val = date("H",strtotime($end_val));
            $mint_val = date("i",strtotime($end_val));
           $next_hour_val = ($hour_val + 1).":00";
            $next_hour = '';
           if($mint_val == '30')
           {
             $next_hour = date("H:i",strtotime($next_hour_val));
             if($next_hour != '')
            {
              array_push($arr_time,$next_hour);
            }
           }
         
        }
    }
    else{
         $start_val = current($arr_time);
         if($start_val)
        {
           $mint_val = date("i",strtotime($start_val));
           $hour_val = date("H",strtotime($start_val));
           $prev_hour = '';
            if($mint_val == '30')
           {
            $prev_hour = date("H:i",strtotime($hour_val.':00'));
             if($prev_hour != '')
            {
              array_unshift($arr_time, $prev_hour);
            }
           }
          
           
        }
    }
    
  //  echo $end_val."<br/>".$start_val;
     
     
   // print_r($arr_time);
    $revised_arr[] = $arr_time;
    
    $val++;
}
//print_r($revised_arr);
 
 $where_meal_sett=array(
'trainer_id' => $this->session->userdata('site_user_id')
     );
$trainer_settings=$ci->common_model->get('trainer_settings',array('*'),$where_meal_sett);
if($trainer_settings[0]['repeat_status'] == 'N')
$repeat_val = 'Never';
elseif($trainer_settings[0]['repeat_status'] == 'D')
$repeat_val = 'Every Day';
elseif($trainer_settings[0]['repeat_status'] == 'EXD')
{
    $x_val = $trainer_settings[0]['every_x_day'];
    $repeat_val = 'Every '.$x_val.' Day'; 
}
elseif($trainer_settings[0]['repeat_status'] == 'EW')
{
  
    $repeat_val = 'Every Week'; 
}
elseif($trainer_settings[0]['repeat_status'] == 'EM')
{
  
    $repeat_val = 'Every Month'; 
}

}
//print_r($sec_arr);
$count_val = 1;
?>
<input type="hidden" id="current_date" value="<?php echo $date_val; ?>">
<?php
if(count($trainer_repeat_date) > 0)
{
    if(count($revised_arr) > 0)
    {
        
    
foreach($revised_arr as $arr_time)
{
    ?>
    <div class="col-sm-6 col-xs-12">
    <div class="timelist gapright">
        <div class="listouter">
    <?php
    $ch_i = 1;
    $curr_time = date("Y-m-d H:i");
    foreach($arr_time as $each_hour)
    {
     $hour_to_check = date("Y-m-d H:i",strtotime($date_val." ".$each_hour));
        ?>
        <div class="listrow">
                <div class="listcell">
                    <span><?php echo $each_hour; ?></span>
                </div>
                
                <?php
                if($ch_i < count($arr_time))
                {
                    
             
                $where_book=array(
                'trainer_id' => $this->session->userdata('site_user_id'),
                'booked_date' => $date_val,
                'booking_time_start' => date("H:i:s",strtotime($each_hour))
                     );
                $booking_exist=$ci->common_model->get('user_booking',array('*'),$where_book);
                $min_each_hour = date("i",strtotime($each_hour));
                if($min_each_hour == '00')
                {
                if(count($booking_exist) > 0)
                {
                    $hour_part = date("H",strtotime($each_hour));
                    $nxt_val = ($hour_part+1).":00";
                    $next_hour_part = date("H:i",strtotime($nxt_val));
                    $hour_to_check_next = date("Y-m-d H:i",strtotime($date_val." ".$next_hour_part));
                    
                    if(($curr_time >= $hour_to_check) && ($curr_time <= $hour_to_check_next))
                    {
                        $class_exis = 'bgcolor2';
                    }
                    else{
                        $class_exis = 'bgcolor3';
                    }
                    
                    $where_cli=array(
                    'id' => $booking_exist[0]['client_id']
                         );
                    $client_det=$ci->common_model->get('user',array('*'),$where_cli);
                    if($booking_exist[0]['program_id'] != '')
                    {
                        
                   
                    $exp_prg = explode(",",$booking_exist[0]['program_id']);
                    if(count($exp_prg) > 0)
                    {
                        $program_nam = array();
                        foreach($exp_prg as $prgm)
                        {
                            $where_prg=array(
                            'id' => $prgm
                                 );
                            $prgname =$ci->common_model->get('program_list',array('*'),$where_prg);
                            $program_nam[] = $prgname[0]['name'];
                        }
                        $program_nam_str = implode(",",$program_nam);
                    }
                  }
                  else{
                    $program_nam_str = '';
                  }
                    ?>
                    <div class="listcell bordercelltop">
                        <div class="bookarea <?php echo $class_exis; ?>" style="height: 400%;">
                            <div class="bookhead whitecolor">APPOINTMENT <?php echo $count_val; ?></div>
                            <div class="afterhead whitecolor"><?php echo $repeat_val; ?></div>
                            <div class="avilable whitecolor"><?php echo $client_det[0]['name']; ?></div>
                            <div class="bookable whitecolor"><?php echo $program_nam_str; ?></div>
                            <ul class="lowerlinkswh">
                                <?php
                                if(($curr_time < $hour_to_check))
                                {
                                    ?>
                                     <li><a href="javascript:void(0)" onclick="cancel_booking(<?php echo $booking_exist[0]['id']; ?>)" class="whitecolor">Cancel</a></li>
                                      <li><a href="#" data-target="#Appointment_val" data-toggle="modal" class="whitecolor" onclick="change_booking('<?php echo $each_hour; ?>',<?php echo $booking_exist[0]['id']; ?>)">Change</a></li>
                                    <?php
                                }
                                else{
                                    ?>
                                     <li><a href="#" class="disabled whitecolor">Cancel</a></li>
                                     <li><a href="#" class="disabled whitecolor">Change</a></li>
                                    <?php
                                }
                                ?>
                               
                               
                            </ul>
                        </div>
                    </div>
                    <?php
                    $count_val++;
                }
                else{
                   
                    if($hour_to_check >= $curr_time)
                    {
                         //echo $each_hour;
                         //echo $curr_time;
                        $hour_part = date("H",strtotime($each_hour));
                          $nxt_val = ($hour_part+1).":00";
                        $next_hour_part = date("H:i",strtotime($nxt_val));
                        $hour_to_check_next = date("Y-m-d H:i",strtotime($date_val." ".$next_hour_part));
                        if(($curr_time >= $hour_to_check) && ($curr_time <= $hour_to_check_next))
                        {
                            $class_exis = 'bgcolor2';
                            $extra_cls = 'whitecolor';
                        }
                        else{
                            $class_exis = 'bgcolor4';
                              $extra_cls = '';
                        }
                        $where_trn_avl=array(
                            'trainer_id' => $this->session->userdata('site_user_id'),
                            'avl_time_to' => date("H:i:s",strtotime($each_hour.":00"))
                                 );
                        $trn_avl =$ci->common_model->get('trainer_avail_time',array('*'),$where_trn_avl);
                       
                        if(count($trn_avl) == 0)
                        {
                            
                       
                        ?>
                            <div class="listcell bordercell">
                                <div class="bookarea <?php echo $class_exis; ?>" style="height: 400%;">
                                    <div class="bookhead <?php echo $extra_cls; ?>">APPOINTMENT <?php echo $count_val; ?></div>
                                    <div class="afterhead <?php echo $extra_cls; ?>"><?php echo $repeat_val; ?></div>
                                    <div class="avilable <?php echo $extra_cls; ?>">Available</div>
                                    <div class="bookable <?php echo $extra_cls; ?>">Bookable</div>
                                    <ul class="lowerlinks">
                                        <li style="text-align: left;"><a href="javascript:void(0)" onclick="get_booking_popup('<?php echo $each_hour; ?>')" class="<?php echo $extra_cls; ?>" data-target="#Appointment_val" data-toggle="modal">Book</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <?php
                            $count_val++;
                        }
                        
                    }
                    else{
                    
                          $hour_part = date("H",strtotime($each_hour));
                          $nxt_val = ($hour_part+1).":00";
                        $next_hour_part = date("H:i",strtotime($nxt_val));
                         $hour_to_check_next = date("Y-m-d H:i",strtotime($date_val." ".$next_hour_part));
                        if(($curr_time >= $hour_to_check) && ($curr_time <= $hour_to_check_next))
                        {
                            $class_not = 'bgcolor2';
                            $extra_cls = 'whitecolor';
                        }
                        else{
                            $class_not = 'bgcolor1';
                             $extra_cls = '';
                        }
                        $where_trn_avl=array(
                            'trainer_id' => $this->session->userdata('site_user_id'),
                            'avl_time_to' => date("H:i:s",strtotime($each_hour.":00"))
                                 );
                        $trn_avl =$ci->common_model->get('trainer_avail_time',array('*'),$where_trn_avl);
                       
                        if(count($trn_avl) == 0)
                        {
                        ?>
                        <div class="listcell bordercell">
                            <div class="bookarea <?php echo $class_not; ?>" style="height: 400%;">
                                <div class="bookhead <?php echo $extra_cls; ?>">APPOINTMENT  <?php echo $count_val; ?></div>
                                <div class="afterhead <?php echo $extra_cls; ?>"><?php echo $repeat_val; ?></div>
                                <div class="avilable <?php echo $extra_cls; ?>">Available</div>
                                <div class="bookable <?php echo $extra_cls; ?>">No longer bookable</div>
                                <ul class="lowerlinks">
                                    <li style="text-align: left;"><a href="javascript:void(0)" class="disabled <?php echo $extra_cls; ?>">Book</a></li>
                                  
                                </ul>
                            </div>
                        </div>
                        <?php
                        $count_val++;
                        }
                       
                    }
                }
                
                }
                else{
                    
                    ?>
                    <div class="listcell bordercell"></div>
                    <?php
                }
                   }
                   else{
                    ?>
                    <div class="listcell bordercell"></div>
                    <?php
                   }
                ?>
                
            </div>
        <?php
        if($ch_i < count($arr_time))
        {
        ?>
        <div class="listrow">
                <div class="listcell"></div>
                <div class="listcell bordercell"></div>
            </div>
        <?php
        }
        
        $ch_i++;
    }
    ?>
        </div>
    </div>
    </div>
    <?php
}
}
}
?>