<div class="organictxt">
<div class="singleorga">
        <div class="txtfloat">Date:</div>
        
         <div class="txtfloat2">
                <input type="text" name="xval[]" id="xval<?php echo $count;?>" class="form-control txt-box-set-new date-class date_fld_add" readonly>
                   <div id="error_xval<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
        </div>
</div>
<div class="singleorga">
        <div class="txtfloat">Measurement:</div>
        <div class="txtfloat2">
                <input type="text" name="yval[]" id="yval<?php echo $count;?>" class="form-control txt-box-set-new mes_add">
                <div id="error_yval<?php echo $count;?>" style="font-size: 11px;color: red;"></div>
        </div>
</div>
<div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_measure_div(this)">
           <span style="color: #282828"> X </span> Remove</a></div>
</div>