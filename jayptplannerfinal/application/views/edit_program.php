<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
echo $prog_info[0]['name'];
echo "##@@";
$val_i = 1;
 $tot_exr = count($exer_info);
foreach($exer_info as $exer_all)
{
    $where_meal=array(
    'id' => $exer_all['exercise_id']
         );
     $exer=$ci->common_model->get('exercise_list',array('*'),$where_meal);
     $type_id = $exer[0]['type_id'];
     $media = 'https://exorlive.com/media_'.$exer[0]['image_id'].'@50.50.media';
     if($val_i == 1)
     {
        if($val_i < $tot_exr)
        {
          
           $all_program = $exer[0]['id']."##".$type_id.",";
        }
        else{
          
           $all_program = $exer[0]['id']."##".$type_id;
        }
     }
     else{
        if($val_i < $tot_exr)
        {
          
           $all_program .= $exer[0]['id']."##".$type_id.",";
        }
        else{
          
           $all_program .= $exer[0]['id']."##".$type_id;
        }
     }
     
     
        ?>
        <li class="ui-state-default-val" id="<?php echo $exer[0]['id']."##".$type_id; ?>">
            <div class="editblog">
            <div class="workimg"><img alt="" src="<?php echo $media; ?>"></div>
            <div class="workouttxt"><?php
            
            if(strlen($exer[0]['title']) > 15)
            {
                echo substr($exer[0]['title'],0,15)."..";
            }
            else{
                echo $exer[0]['title'];
            }
            ?> </div>
            <div class="editright">
                 <!--<a class="butsblue" href="javascript:void(0)" onclick="remove_to_program($(this))" style="width:100px !important">
                    Remove
                </a>-->
            </div>
          </div>
        </li>
        
        <?php
        $val_i++;
}
echo "##@@";
echo $all_program;

?>