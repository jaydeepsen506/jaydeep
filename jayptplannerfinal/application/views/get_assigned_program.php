<?php
$ci=&get_instance();
$ci->load->model('toolbox_model');
$ci->load->model('common_model');
?>
       <div class="tab-outer">
        
            <div>
               
                <div class="form-group">
                   <label>CHOOSE PROGRAM TO ADD</label>
                     <div>
                         <input type="hidden" id="date_val" name="date_val" value="<?php echo $date_val; ?>">
                        <input type="hidden" id="exer_id_pop" name="exer_id_pop" value="<?php echo $exer_id; ?>">
                       <select class="form-control chosen-select" name="programs" id="programs" style="width: 100%;">
                        <?php
                        foreach($program_info as $programs)
                        {
                              $where_meal_main=array(
                            'id' => $programs['program_id']
                                 );
                            $program_info_main=$ci->common_model->get('user_program',array('*'),$where_meal_main);
                         
                            $where_meal=array(
                            'id' => $program_info_main[0]['default_program_id']
                                 );
                            $program_info_each=$ci->common_model->get('program_list',array('*'),$where_meal);
                            ?>
                            <option value="<?php echo $program_info_each[0]['id']."###@@".$programs['program_id']."###@@".$programs['id']; ?>"><?php echo $program_info_each[0]['name']; ?></option>
                            <?php
                        }
                        ?>
                          
                        </select>
                     </div>
               </div>
                <div class="btns">
                    <a data-dismiss="modal" id="close_pop" style="display: none;"></a>
                    <a class="butsblue green" style="background: #9ec32e; box-shadow: 0 2px #9dab72" href="javascript:void(0)" onclick="return add_esercise_to_prgm()">Add</a>
                   
                </div>
                <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id; ?>">
               
            </div>		
        
        </div>
     <script>
        function add_esercise_to_prgm()
        {
            var programs_id = document.getElementById('programs').value;
            var date_val = document.getElementById('date_val').value;
            var exp_val = programs_id.split("###@@");
            var program_id = exp_val[0];
            var user_prog_id = exp_val[1];
            var user_prog_exer_id = exp_val[2];
            var client_id = document.getElementById('client_id').value;
            var exer_id_pop = document.getElementById('exer_id_pop').value;
            var dataString ="program_id="+program_id+"&user_prog_id="+user_prog_id+'&client_id='+client_id+'&exer_id_pop='+exer_id_pop+'&date_val='+date_val+'&user_prog_exer_id='+user_prog_exer_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/add_exer_to_program",
            data: dataString,
            cache: false,
            success: function(data)
            {
               
              $('#sortable'+user_prog_id).append(data);
              $('#close_pop').click();
            }
            });
        }
     </script>           
