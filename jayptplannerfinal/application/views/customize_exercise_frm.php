<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
?>
<script>
    function add_sets_custom()
    {
       var frm = document.add_custom;
       frm.submit();
    }
</script>
<form action="<?php echo base_url(); ?>toolbox/customize_exer_client" name="add_custom" method="post">
    
<input type="hidden" name="date_to_check" value="<?php echo $date_val; ?>">
        <div class="row">
        	<div class="col-sm-6">
        		<div class="appoin_txt">EXERCISE INFORMATION</div>
                    <div class="datehead"><?php echo $exer_info[0]['title'] ?></div>
                    <div class="descriptiohead"> <span>DESCRIPTION</span> </div>
                    <div class="descriptiotxt">
                        <?php echo $exer_info[0]['description'] ?>
                    </div>
                    <div class="descriptiohead"><span>PICTURES &amp; VIDEO</span><b>
                      <input type="file" name="">
                      </b></div>
                    <?php
                    $media_image = 'https://exorlive.com/media_'.$exer_info[0]['image_id'].'@80.80.media';
                    $media_video = 'https://exorlive.com/video/?ex='.$exer_info[0]['exercise_id'];
                    ?>
                    <div class="uploadedpic">
                      <div class="uploadedsingle">
                        <div class="imguploaded"><img alt="" src="<?php echo $media_image; ?>"></div>
                        <div class="Uptxt">Picture1</div>
                      </div>
                      
                       <div class="uploadedsingle">
                        <div class="imguploaded"><iframe src="<?php echo $media_video; ?>" height="300px" width="500px"></iframe></div>
                        <div class="Uptxt">Video 1 </div>
                      </div>
                    </div>
        	</div>
        	<div class="col-sm-6">
        		<div class="appoin_txt">CUSTOMIZE EXERCISE FOR</div>
                        <div class="datehead"><?php echo $user_info[0]['name'] ?></div>
        		<div class="table-outer">
        			<div class="rate-table">
                                    <div id="repeat_sets">
                                        
                                    
                                    <?php
                                    $where_cleint=array(
                                            'client_id' => $client_id,
                                            'user_program_id' => $user_prgrm_id,
                                            'exercise_id' => $exer_id,
                                                 );
                                    $custom_info=$ci->common_model->get('user_custom_exercise',array('*'),$where_cleint);
				   
                                    $tot_val_count = 0;
                                    if(count($custom_info) > 0)
                                    {
                                        $set_value = $custom_info[0]['set_value'];
                                        $exp_set = explode(",",$set_value);
                                        if(count($exp_set) > 0)
                                        {
                                            $tot_val_count = count($exp_set);
                                            //if(count($exp_set) > 1)
                                            //{
                                                $count_val = 1;
                                                foreach($exp_set as $set)
                                                {
                                                    $xp_Each = explode("#@#@",$set);
                                                    ?>
                                                    <div class="rate-table-row">
                                                            <div class="rate-table-td" style="padding-left: 0;">
                                                                    Set <?php echo $count_val; ?>
                                                            </div>
                                                            <div class="rate-table-td text-right">
                                                               <span class="reps_class" style="display: none;"> <input type="text" name="set_reps[]"  value="<?php echo $xp_Each[0]; ?>" style="width: 30px;"></span>
                                                                    <span id="reps_<?php echo $xp_Each[0]; ?>" onclick="$(this).parent('.rate-table-td').find('.reps_class').show();$(this).hide();"><?php echo $xp_Each[0]; ?></span> reps
                                                            </div>
                                                            <div class="rate-table-td text-right">
                                                                <span class="kg_class" style="display: none;"><input type="text" name="set_kgs[]" value="<?php echo $xp_Each[1]; ?>" style="width: 30px;"></span>
                                                                    <span id="kg_<?php echo $xp_Each[0]; ?>" onclick="$(this).parent('.rate-table-td').find('.kg_class').show();$(this).hide();"><?php echo $xp_Each[1]; ?></span> kg
                                                            </div>
                                                            <div class="rate-table-td text-right" style="padding-right: 0;cursor: pointer">
                                                                    X<span>  Remove</span>
                                                            </div>
                                                    </div>
                                                    <?php
                                                    $count_val++;
                                                }
                                            //}
					    
                                        }
                                    }
                                   $where_cleint=array(
                                            'id' => $user_prgrm_id
                                                 );
                                    $program_id=$ci->common_model->get('user_program_exercises',array('*'),$where_cleint);
                                   
                                    $instruction = '';
                                    if(isset($custom_info[0]['instruction']))
                                    {
                                        $instruction = $custom_info[0]['instruction'];
                                    }
                                    
                                    ?>
                                 
        				</div>
                                    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                                    <input type="hidden" name="user_program_id" value="<?php echo $user_prgrm_id; ?>">
                                    <input type="hidden" name="exer_id" value="<?php echo $exer_id; ?>">
                                     <input type="hidden" name="program_id" value="<?php echo $program_id[0]['program_id']; ?>">
                                    <input type="hidden" id="tot_set" value="<?php echo $tot_val_count; ?>">
        				<a href="javascript:void(0)" onclick="add_sets()">+ Add Set</a>
        			</div>
                                <div id="instruction_section" style="margin-top: 50px;min-height: 223px;">
                                  <div class="descriptiohead"> <span>INSTRUCTIONS</span><a href="javascript:void(0)" onclick="$('#instruc_div').hide();$('#instruction_edit').show();">Edit</a> </div>
                                  <div class="descriptiotxt"> <textarea name="instruction_edit" id="instruction_edit" class=form-control cols="9" rows="9" style="display:none;"><?php echo $instruction;?></textarea><div id="instruc_div" onclick="$('#instruc_div').hide();$('#instruction_edit').show();"><?php echo $instruction?></div><div id="ins_error_edit" style="color:red"></div></div>
                                </div>
        		</div>
        		
        		<div class="btns">
        			
        			<a href="javascript:void(0)" onclick="add_sets_custom()" class="butsblue green">Save changes</a>
        		</div>
        		
        	</div>
        </div>
</form>