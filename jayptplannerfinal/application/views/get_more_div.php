<div id="repeat_section" class="organictxt">
<div class="singleorga">
       <div class="txtfloat">Specifically:</div>
        
        <div class="txtfloat2">
                <input type="text" name="specifically[]" id="specifically<?php echo $count;?>" class="form-control txt-box-set-new">
                        <div id="error_spe<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
        </div>
</div>
<!--<div class="rate-table-row" style="float: right;"> 
      <div class="rate-table-td text-right" style="padding-right: 0; font-size: 12px; cursor: pointer" onclick="remove_div(this)">
                X<span class="descriptiohead"> Remove</span>
      </div>
</div>-->
<div class="singleorga">
       <div class="txtfloat">Amount:</div>
        <div class="txtfloat2">
                <input type="text" name="meal_amount[]" id="meal_amount<?php echo $count;?>" class="form-control txt-box-set-new">
                <div id="error_amt<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
        </div>
</div>
<div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_div(this)">
<span style="color: #282828"> X </span> Remove</a></div>

</div>
