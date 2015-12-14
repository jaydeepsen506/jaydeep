<script>
  function settings_validation(){
    
     var repeat_val = $('input[name=repeat_status]:checked').val();
    if (repeat_val != 'N')
    {
      if (repeat_val == 'EXD')
      {
	 if (document.getElementById('every_x_day').value == '') {
		document.getElementById('every_x_day').style.border = '1px solid red';
		return false;
	    }
	    else
	    {
		if (isNaN(document.getElementById('every_x_day').value))
		{
		   document.getElementById('every_x_day').style.border = '1px solid red';
		    return false;
		}
		else if (document.getElementById('every_x_day').value < 2 || document.getElementById('every_x_day').value > 6) {
		    document.getElementById('day_error').innerHTML = 'Put value within 2 & 6';
		    document.getElementById('every_x_day').style.border = '1px solid red';
		    return false;
		}
		else
		{
		    document.getElementById('every_x_day').style.border = 'none';
		    document.getElementById('day_error').innerHTML = '';
		}
	    }
	}
	document.getElementById('day_error').innerHTML = '';
      if (document.getElementById('repeat_upto_date').value == '')
      {
	  document.getElementById('repeat_upto_date').style.border = '1px solid red';
	  return false;
      }
      else{
	  document.getElementById('repeat_upto_date').style.border = '1px solid #ccc';
      }
    }
    var frm=document.settings_form;
    var avail_from = document.getElementsByName('avl_time_from[]');
    var avail_to=document.getElementsByName('avl_time_to[]');
    var len = avail_from.length;
    var len1= avail_to.length;
    var flag=0;
     if (len==1)
            {
                    if (avail_from[0].value == avail_to[0].value) {
                            flag=1;
                           document.getElementById("from0").style.borderColor = "red";
                           document.getElementById("to0").style.borderColor = "red";
                    }
                    else if(avail_from[0].value > avail_to[0].value){
                            flag=1;
                            document.getElementById("from0").style.borderColor = "red";
                            document.getElementById("to0").style.borderColor = "red";
                    }
                    else
                    {
                            document.getElementById("from0").style.borderColor = "#A9A9A9";
                            document.getElementById("to0").style.borderColor = "#A9A9A9";
                    }
            }
      else if (len > 1) {
        for (var i=0; i<len; i++)
            {
                if (avail_from[i].value == avail_to[i].value) {
                            flag=1;
                            document.getElementById("from"+i).style.borderColor = "red";
                            document.getElementById("to"+i).style.borderColor = "red";
                    }
                else if(avail_from[i].value > avail_to[i].value){
                            flag=1;
                            document.getElementById("from"+i).style.borderColor = "red";
                           document.getElementById("to"+i).style.borderColor = "red";
                    }
                else
                {
                     for(var j=0; j<i; j++){
                        if ((avail_from[i].value >= avail_from[j].value && avail_from[i].value < avail_to[j].value) || (avail_to[i].value >= avail_from[j].value && avail_to[i].value <= avail_to[j].value)) {
                           flag=1;
                           document.getElementById("from"+i).style.borderColor = "red";
                           document.getElementById("to"+i).style.borderColor = "red";
                        }
                        else{
                             document.getElementById("from"+i).style.borderColor = "#A9A9A9";
                             document.getElementById("to"+i).style.borderColor = "#A9A9A9";
                        }
                     }
                }
            }
        
      }
      if (flag==1) {
        $('#time_error').html('Invalid Time selection');
        return false;
      }
      else
      {
        $('#time_error').html('');
      }
      
     
    frm.submit();
  }
  function remove_time(e) {
      $(e).parents('.add_row').remove();
      var count_time=document.getElementById('time_count').value;
      var recount=parseInt(count_time)-1;
      $('#time_count').val(recount);
    }
  function remove_time_1(e,field_id){
      	    var count=document.getElementById('time_count').value;
            var recount=parseInt(count)-1;
	    var dataString="field_id="+field_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>dashboard/remove_time",
            data: dataString,
            cache: false,
            success: function(data)
            {
		   if (data == 'deleted') {
		      $(e).parents('.add_row').remove();
		   }
            }
            });
            $('#time_count').val(recount);
  }
</script>
<span class="close_cell" data-dismiss="modal" aria-hidden="true"><img src="<?php echo base_url(); ?>assets/site/after_login/images/close_icon.png" alt="" /></span>
      <h2 class="pop_heading">Tell the system  when you want to be available for appoinment</h2>
      <div class="setting-error" id="time_error"></div>
      <div style="text-align: center; color: red;" id="err_rep"></div>
      <form name="settings_form" id="settings_form" method="POST" action="<?php echo base_url();?>dashboard/add_settings">
      <div class="add_cell" id="repeat_cell_area">
        <?php
        if(count($trainer_avail_time) > 0)
        {
            
        
        $val = 1;
        $val1 =0;
        foreach($trainer_avail_time as $time)
        {
            ?>
            <div class="add_row">
                    <div class="add_cols">
                            Available
                    </div>
                    <div class="add_cols">
                            <span class="hour_input">
                                <select name="avl_time_from[]" id="from<?php echo $val1;?>" onclick="$this.css('border-color', '#A9A9A9');">
                                    <?php
                                        for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
                                        {
                                            for($mins=0; $mins<60; $mins+=60) // the interval for mins is '30'
                                            {
                                                 $time_val=str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                                 if($time_val==date('H:i',strtotime($time['avl_time_from'])))
                                                 {
                                                   echo '<option selected>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                                 }
                                                 else
                                                 {
                                                    echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                                 }
                                            }
                                       
                                        }
                                    
                                        ?>
                                </select>
                            </span> <span>hrs</span>
                    </div>
                    <div class="add_cols">
                            to
                    </div>
                    <div class="add_cols">
                            <span class="hour_input">
                                <select name="avl_time_to[]" id="to<?php echo $val1;?>" onclick="$this.css('border-color', '#A9A9A9');">
                                    <?php
                                        for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
                                        {
                                            for($mins=0; $mins<60; $mins+=60) // the interval for mins is '30'
                                            {
                                               $time_val=str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                               if($time_val==date('H:i',strtotime($time['avl_time_to'])))
                                                 {
                                                   echo '<option selected>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                                 }
                                                 else{
                                                    echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                                 }
                                            }
                                       
                                        }
                                    
                                        ?>
                                </select>
                            </span> <span>hrs</span>
                            <input type="hidden" name="existing_time_arr[]" id="existing_time_arr" value="<?php echo $time['id'];?>">
                    </div>
                    <?php
                    if($val != 1)
                    {
                    ?>
                    <div class="add_cols">
                            <a href="javascript:void(0)" onclick="remove_time_1(this,'<?php echo $time['id']; ?>')"><span><img src="<?php echo base_url(); ?>assets/site/after_login/images/close_icon.png" alt="" /></span><span>Remove</span></a>
                    </div>
                    <?php
                    }
                    ?> 
            </div>
            <?php
            $val1++;
            $val++;
        }
        }
        else{
            ?>
            <div class="add_row">
                    <div class="add_cols">
                            Available
                    </div>
                    <div class="add_cols">
                            <span class="hour_input">
                                <select name="avl_time_from[]" id="from0" onclick="$this.css('border-color', '#A9A9A9');">
                                    <?php
                                        for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
                                        {
                                            for($mins=0; $mins<60; $mins+=60) // the interval for mins is '30'
                                            {
                                                 echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                            }
                                       
                                        }
                                    
                                        ?>
                                </select>
                            </span> <span>hrs</span>
                    </div>
                    <div class="add_cols">
                            to
                    </div>
                    <div class="add_cols">
                            <span class="hour_input">
                                 <select name="avl_time_to[]" id="to0" onclick="$this.css('border-color', '#A9A9A9');">
                                    <?php
                                        for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
                                        {
                                            for($mins=0; $mins<60; $mins+=60) // the interval for mins is '30'
                                            {
                                                 echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'
                                                       .str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                            }
                                       
                                        }
                                    
                                        ?>
                                </select>
                            </span> <span>hrs</span>
                    </div>
                    
            </div>
            <?php
        }
        ?>
      	
      	
      </div>
      
      <a href="javascript:void(0)" class="add_new" onclick="add_more_time();"><span><img src="<?php echo base_url(); ?>assets/site/after_login/images/plus_icon.png" alt="" /></span><span>Add Available time </span></a>
      
      <div class="repeat_timecell">
      		<div class="add_row  clearfix">
      			<span>REPEAT this times</span> <a href="#" class="add_new"><span><img src="<?php echo base_url(); ?>assets/site/after_login/images/rotate_icon.png" alt="" /></span><span>Every Wednesday</span></a>
      		</div>
      		<div class="add_row">
      			<span><input type="radio" id="repeat_status_N" value="N" name="repeat_status" <?php if(isset($trainer_settings[0]['repeat_status']) && $trainer_settings[0]['repeat_status']=='N') { echo "checked";}?>/>
                        <label for="repeat_status_N">Never</label></span>
      		</div>
      		<div class="add_row">
      			<span><input type="radio" id="repeat_status_D" value="D" name="repeat_status" <?php if(isset($trainer_settings[0]['repeat_status']) && $trainer_settings[0]['repeat_status']=='D') { echo "checked";}?>/>
                        <label for="repeat_status_D">Every Day</label></span>
      		</div>
      		<div class="add_row">
      			 <span> <input type="radio" id="repeat_status_EXD" value="EXD" name="repeat_status" <?php if(isset($trainer_settings[0]['repeat_status']) && $trainer_settings[0]['repeat_status']=='EXD') { echo "checked";}?>/>
                            <label for="repeat_status_EXD">Every</label>
                            <label><input type="text" name="every_x_day" id="every_x_day" maxlength="1" placeholder="X"  <?php if(isset($trainer_settings[0]['repeat_status']) && $trainer_settings[0]['repeat_status']=='EXD') {?>value="<?php echo $trainer_settings[0]['every_x_day'];?>"<?php }?>></label>
                            <label>Day</label><span id="day_error" class="setting-error" style="margin-left: 20px;"></span></span>
      		</div>
      		<div class="add_row">
      			<span><input type="radio" id="repeat_status_EW" value="EW" name="repeat_status" <?php if( isset($trainer_settings[0]['repeat_status']) && $trainer_settings[0]['repeat_status']=='EW') { echo "checked";}?>/>
                            <label for="repeat_status_EW">Every Week
                            <select name="every_week">
                                <?php
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
                                    ?>
                                    <option value="<?php echo $num; ?>" <?php if(isset($trainer_settings[0]['every_week']) && $trainer_settings[0]['every_week']==$num){ echo "selected";}?>><?php echo $val; ?></option>
                                    <?php
                                   
                                 }
                                ?>
                            </select>
                            </label>
                        </span>
      		</div>
      		<div class="add_row">
      			 <span><input type="radio" id="repeat_status_EM" value="EM" name="repeat_status" <?php if(isset($trainer_settings[0]['repeat_status']) && $trainer_settings[0]['repeat_status']=='EM') { echo "checked";}?>/>
                        <label for="repeat_status_EM">Every Month </label></span>
      		</div>
		<div class="add_row choice_cell">
		  <label>Repeat Upto</label>
		  <span>
		      <input type="text" class="text_in date-class" id="repeat_upto_date" name="repeat_upto_date" value="<?php if(isset($trainer_settings[0]['repeat_upto_date'])) echo $trainer_settings[0]['repeat_upto_date']; ?>" readonly="true" style="width: 100%;text-align: left;font-size:14px;" />
		  </span>
		</div>

      </div>
      <input type="hidden" name="time_count" id="time_count" value="<?php if(count($trainer_avail_time) > 0) { echo count($trainer_avail_time)-1; }else{ echo '0';}?>">
      <a href="javascript:void(0)" class="confirm_btn" onclick="return settings_validation()">Confirm</a>
      </form>
 <script>
    function add_more_time() {
      var count_time=document.getElementById('time_count').value;
      var recount=parseInt(count_time)+1;
      var datastring="count_time="+recount;
       $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>dashboard/get_more_time",
        data: datastring,
        cache: false,
        success: function(data)
        {
          $('#time_count').val(recount);
          $('#repeat_cell_area').append(data);
        }
        });
    }
 </script>