<?php
 $next_date = date('d/m/Y', strtotime($date_val.' +1 day'));
?>
<div class="organictxt">
<div class="singleorga">
        <div class="txtfloat">Date:</div>
        
         <div class="txtfloat2">
                <input type="text" name="x_val[]" id="x_val_<?php echo $count;?>" class="form-control txt-box-set-new date-class date_fld_add" value="<?php echo $next_date;?>" readonly>
                   <div id="error_x_val<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
        </div>
         <i class="fa fa-calendar" style="float: left;margin-top: 5px;margin-left: -15px;"></i>
</div>
<div class="singleorga">
        <div class="txtfloat">Measurement:</div>
        <div class="txtfloat2">
                <input type="text" name="y_val[]" id="y_val_<?php echo $count;?>" class="form-control txt-box-set-new mes_add">
                <div id="error_y_val<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
        </div>
</div>
<div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_measure(this)">
           <span style="color: #282828"> X </span> Remove</a></div>
</div>