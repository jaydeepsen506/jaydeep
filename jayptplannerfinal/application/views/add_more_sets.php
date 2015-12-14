<div class="rate-table-row">
        <div class="rate-table-td" style="padding-left: 0;">
                Set <?php echo $tot_val + 1; ?>
        </div>
        <div class="rate-table-td text-right">
            <span class="reps_class"><input type="text" name="set_reps[]" value="" style="width: 30px;"></span>
                 reps
        </div>
        <div class="rate-table-td text-right">
            <span class="kg_class"><input type="text" name="set_kgs[]" value="" style="width: 30px;"></span>
                kg
        </div>
        <div class="rate-table-td text-right" style="padding-right: 0;cursor: pointer" onclick="$(this).parents('.rate-table-row').remove();document.getElementById('tot_set').value = parseInt(document.getElementById('tot_set').value) - 1;">
                X<span>  Remove</span>
        </div>
    </div>