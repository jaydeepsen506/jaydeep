<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
foreach($last_info as $programs)
{
     $where_meal=array(
    'id' => $programs['program_id']
         );
    $program_info_main=$this->common_model->get('user_program',array('*'),$where_meal);
    
    $where_meal=array(
    'id' => $program_info_main[0]['default_program_id']
         );
    $program_info_each=$this->common_model->get('program_list',array('*'),$where_meal);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
           <h4 class="panel-title progress_title">
           <em>Program:</em><span><?php echo $program_info_each[0]['name']; ?></span>
           <div class="pull-right">
                        <a href="javascript:void(0)" onclick="remove_program($(this),<?php echo $programs['id']; ?>)"><i class="fa fa-fw fa fa-remove"></i>Remove</a><a href="#" data-toggle="modal" data-target="#APPOINTMENT6" onclick="get_repeat_pop_prgm(<?php echo $programs['program_id']; ?>,<?php echo $client_id; ?>)"><i class="fa fa-fw fa fa-repeat"></i>Never</a>
                        </div>
                    </h4>
         </div>
        <div class="panel-collapse">
            <ul class="connectedSortable" id="sortable<?php echo $programs['id']; ?>">
            <?php
            $where_meal_list=array(
            'user_program_id' => $programs['id'],
            'client_id' => $client_id
                 );
            $exer_info=$this->common_model->get('user_program_ex_exercise',array('*'),$where_meal_list);
            foreach($exer_info as $exer_val)
            {
                $where_meal_exer=array(
                'id' => $exer_val['exercise_id']
                     );
                $exer_info_det=$this->common_model->get('exercise_list',array('*'),$where_meal_exer);
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
            
            $where_cus_ex=array(
                'user_program_id' => $programs['id'],
                'client_id' => $client_id,
		'exercise_id' => $exer_info_det[0]['id']
                     );
                $cus_exer_info=$this->common_model->get('user_custom_exercise',array('*'),$where_cus_ex);
		$set_val = '';
		if(count($cus_exer_info) > 0)
		{
		    $set_value = $cus_exer_info[0]['set_value'];
		    
		    $exp_sets = explode(",",$set_value);
		    if(count($exp_sets) > 1)
		    {
			$first_val = current($exp_sets);
			$last_val = end($exp_sets);
			$exp_frst = explode("#@#@",$first_val);
			$exp_last = explode("#@#@",$last_val);
			$set_val = count($exp_sets)."X".$exp_frst[0]."-".$exp_last[0];
		    }
		    else{
			$first_val = current($exp_sets);
			
			$exp_frst = explode("#@#@",$first_val);
			
			$set_val = count($exp_sets)."X".$exp_frst[0];
		    }
		    
		}
            ?> <span id="cust_row<?php echo $exer_info_det[0]['id']; ?>"> <?php
	    if(count($cus_exer_info) > 0)
	    {
		echo "(Customized)";
	    }
	    else{
		echo "&nbsp;";
	    }
	    ?></span></div>
                    <div class="editright">
                        <div class="intobox"><?php
				if($set_val != '')
				{
				    echo $set_val;
				}
				else
				{
				    echo "&nbsp;";
				}
				?></div>
                        <a href="#" data-toggle="modal" data-target="#EXERCISE-INFORMATION" onclick="custom_exercise(<?php echo $exer_val['exercise_id']; ?>,<?php echo $programs['id']; ?>)"><img alt="" src="<?php echo base_url(); ?>assets/site/after_login/images/edit.png"></a>
                       <a href="javascript:void(0)" onclick="remove_exer_frm_prog($(this),<?php echo $exer_val['id']; ?>)">
			    <i class="fa fa-fw fa fa-remove"></i>
			</a>
                    </div>
                </div>
                </div>
                 </li>
                <?php
            }
            ?>
            </ul>
           
        </div>
                                             </div>
    <?php
}