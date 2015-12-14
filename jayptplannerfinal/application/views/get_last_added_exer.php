<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
foreach($exer_info as $exer)
{
    $where_meal_exer=array(
        'id' => $exer['exercise_id']
             );
    $exer_info_det=$ci->common_model->get('exercise_list',array('*'),$where_meal_exer);
        $media = 'https://exorlive.com/media_'.$exer_info_det[0]['image_id'].'@50.50.media'
        ?>
        <li id="<?php echo $exer_info_det[0]['id']."##".$exer_info_det[0]['type_id']; ?>">
         <div class="panel-body">
            <div class="editblog">
            <div class="workimg"><img alt="" src="<?php echo $media; ?>"></div>
            <div class="workouttxt"><?php
            
            if(strlen($exer_info_det[0]['title']) > 25)
            {
                echo substr($exer_info_det[0]['title'],0,25)."..";
            }
            else{
                echo $exer_info_det[0]['title'];
            }
            ?>
             <span id="cust_row<?php echo $exer_info_det[0]['id']; ?>">
               &nbsp;
               </span>
            </div>
            <div class="editright">
                <div class="intobox">
                   &nbsp;
                </div>
                <a href="#" data-toggle="modal" data-target="#EXERCISE-INFORMATION" onclick="custom_exercise(<?php echo $exer['exercise_id']; ?>,<?php echo $exer['program_id']; ?>)"><img alt="" src="<?php echo base_url(); ?>assets/site/after_login/images/edit.png"></a>
                <a href="javascript:void(0)" onclick="remove_exer_frm_prog($(this),<?php echo $exer['id']; ?>)">
                    <i class="fa fa-fw fa fa-remove"></i>
                </a>
            </div>
          </div>
         </div>
        </li>
        
        <?php
   
    
}

?>