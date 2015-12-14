<div id="repeat_section" class="organictxt">
   <div class="singleorga">
       <div class="txtfloat">Specifically:</div>
       <div class="txtfloat2">
                <input type="text" name="specifically_edit[]" id="specifically_edit<?php echo $count;?>" class="form-control txt-box-set-new">
                <div class="err_div_spec" id="error_spe_edit<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
          </div>
   </div>
   <div class="singleorga">
       <div class="txtfloat">Amount:</div>
       <div class="txtfloat2">
        <input type="text" name="meal_amount_edit[]" id="meal_amount_edit<?php echo $count;?>" class="form-control txt-box-set-new">
                <div class="err_div_amnt" id="error_amt_edit<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
       </div>
   </div>
   <div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_div_edit_1($(this))">
       <span style="color: #282828"> X </span> Remove</a></div>
    <input type="hidden" name="meal_other_id[]" id="meal_other_id" value="">
</div>
