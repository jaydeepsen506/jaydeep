<form action="<?php echo base_url(); ?>toolbox/add_repeat_meal" method="post" name="repeat_prgm_frm">
    <div style="text-align: center; color: red;" id="err_rep"></div>
<input type="hidden" id="date_start" name="date_start" value="<?php echo $date_val; ?>">
<input type="hidden" id="main_meal_id" name="main_meal_id" value="<?php echo $main_meal_id; ?>">
<input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
<input type="hidden" id="trainer_id" name="trainer_id" value="<?php echo $trainer_id; ?>">
<div class="name-group clearfix">
        <label style="text-align: left;">REPEAT MEAL</label>
</div>
 <div class="name-group clearfix">
        <input type="radio" id="repeat_status_N" value="N" name="repeat_status" />
        <label for="repeat_status_N">Never</label>
</div>
<div class="name-group clearfix">
        <input type="radio" id="repeat_status_D" value="D" name="repeat_status" />
        <label for="repeat_status_D">Every Day</label>
</div>
<div class="dynamik-input">
        <div class="name-group clearfix">
                <input type="radio" id="repeat_status_EXD" value="EXD" name="repeat_status" />
                <label for="repeat_status_EXD">Every</label>
                <label><input type="text" name="every_x_day" id="every_x_day" maxlength="1" placeholder="X"></label>
                <label>Day</label>
        </div>
    </div>
<div class="name-group clearfix">
        <input type="radio" id="repeat_status_EW" value="EW" name="repeat_status" />
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
                <option value="<?php echo $num; ?>"><?php echo $val; ?></option>
                <?php
               
             }
            ?>
        </select>
        </label>
        
</div>
<div class="name-group clearfix">
        <input type="radio" id="repeat_status_EM" value="EM" name="repeat_status" />
        <label for="repeat_status_EM">Every Month </label>
</div>

<div class="form-group" style="text-align: center;">
    <label style="float: left;padding: 10px 25px;">Repeat Upto</label>
      <div>
       <input type="text" class="form-control" name="repeat_upto" id="repeat_upto" style="width: 50%;margin-top: 11px;">
      </div>
</div>
<div class="btns">
    <a onclick="chk_valid_repeat();" class="butsblue green" style="background: #9ec32e; box-shadow: 0 2px #9dab72;width: 50px !important;" href="javascript:void(0)">Add</a>
   
</div>
</form>
<input type="hidden" id="date_tomor" value="<?php echo date ("Y-m-d", strtotime("+1 day", strtotime(date("Y-m-d")))); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script>
     var tomor = document.getElementById('date_tomor').value;
     var today = new Date(tomor);
     
    $('#repeat_upto').datepicker({
	minDate: today,
        changeMonth: true,
        changeYear: true
	
    })
   
  </script>