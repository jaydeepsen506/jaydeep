<script>
    function submit_edit_form(graph_id){
        var frm=document.getElementById('editGraphForm'+graph_id);
	if (frm.graph_for.value.search(/\S/) == '-1') {
	   document.getElementById('for_error').innerHTML="Please fill up the graph for field";
	   frm.graph_for.focus();
	   return false;
	}
	else
	{
	    document.getElementById('for_error').innerHTML="";
	}
	if (frm.measure_unit.value.search(/\S/) == '-1') {
	   document.getElementById('unit_error').innerHTML="Please fill up the unit field";
	   frm.measure_unit.focus();
	   return false;
	}
	else
	{
	    document.getElementById('unit_error').innerHTML="";
	}
	var count=0;
	var flag=0;
	$('input[name^="yval"]').each(function() {
	    //alert(count);
	    if($(this).val().search(/\S/) == '-1')
	    {
		$('#error_yval'+count).html('Please enter Measurement');
		flag++;
	    }
	    else
	    {
                $('#error_yval'+count).html('');
	    }
	    count++;
	});
	if (flag > 0) {
	    return false;
	}
       frm.submit();
    }
</script>
<script>
    function remove_measure(e,field_id) {
	    var dataString="field_id="+field_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>client_progress/remove_measurement",
            data: dataString,
            cache: false,
            success: function(data)
            {
                   //alert(data);
		   if (data == 'deleted') {
		      e.parents('.organictxt').remove();
		   }
            }
            });
    }
</script>
<div class="appoin_txt" style="margin-bottom: 16px;">Edit Graph Information</div>
  <div class="row">
     <form name="editGraphForm<?php echo $graph_id;?>" id="editGraphForm<?php echo $graph_id;?>" method="POST" action="<?php echo base_url();?>client_progress/save_graph_information">
          <div class="col-sm-6" style="width: 100%;">
                <div class="descriptiohead"><span>Graph Type</span><b style="overflow: visible;">
                  <select name="graph_type" id="graph_type" class="form-control" style="width: 195px;">
                      <option value="L" <?php if($graph[0]['graph_type']=='L') { echo "selected"; }?>>Line Graph</option>
                      <!--<option value="B" <?php //if($graph[0]['graph_type']=='B') { echo "selected"; }?>>Bar Graph</option>-->
                  </select>
                  </b>
                </div>
                <div class="descriptiohead"><span style="padding-right: 45px;">Graph For</span><b style="overflow: visible;">
                  <input type="text" name="graph_for" id="graph_for" class="form-control" value="<?php echo $graph[0]['graph_for'];?>">
                  </b>
		    <div id="for_error" class="error-class-graph"></div>
                </div>
                 <div class="descriptiohead"><span style="padding-right: 27px;">Measure Unit</span><b style="overflow: visible;">
                  <input type="text" name="measure_unit" id="measure_unit" class="form-control" value="<?php echo $graph[0]['measure_unit'];?>">
                  </b>
		    <div id="unit_error" class="error-class-graph"></div>
                 </div>
                 <div id="repeat_section_measure" style="max-height: 200px;overflow-y: scroll;">
                <?php
		   $i=0;
                   foreach($axis_val as $axis){
               ?>
                    <div class="organictxt">
                                       <div class="singleorga">
                                               <div class="txtfloat">Date:</div>
                                               
                                                <div class="txtfloat2">
                                                       <input type="text" name="xval[]" id="xval<?php echo $i;?>" class="form-control txt-box-set-new date-class date_fld_add" value="<?php echo $axis['x_axis_val'];?>" readonly>
                                                        <div id="error_xval<?php echo $i;?>" style="font-size: 11px;color: red;"></div>
                                               </div>
						<a href="javascript:void(0)" onclick="show_calender(this)"><i class="fa fa-calendar" style="float: left;margin-top: 5px;margin-left: -15px;color:black;"></i></a>
                                       </div>
                                       <div class="singleorga">
                                               <div class="txtfloat">Measurement:</div>
                                               <div class="txtfloat2">
                                                       <input type="text" name="yval[]" id="yval<?php echo $i;?>" class="form-control txt-box-set-new mes_add" value="<?php echo $axis['y_axis_val'];?>">
                                                       <div id="error_yval<?php echo $i;?>" style="font-size: 11px;color: red;"></div>
                                               </div>
                                       </div>
                                       <?php
                                       if($axis['id']!=$first_graph_val[0]['id']){
                                       ?>
                                       <div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_measure($(this),<?php echo $axis['id'];?>)">
           <span style="color: #282828"> X </span> Remove</a></div>
                                       <?php
                                       }
                                       ?>
                                       <input type="hidden" name="axis_values[]" id="axis_values" value="<?php echo $axis['id'];?>">
                   </div>
                    <?php
		    $i++;
                   }
                    ?>
               </div>
               <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>">
               <input type="hidden" name="graph_id" id="graph_id" value="<?php echo $graph_id;?>">
              <div class="btns" style="float:right;">
                      <a href="javascript:void(0)" class="butsblue green" onclick="return submit_edit_form(<?php echo $graph_id;?>)">Save</a>
              </div>
          </div>  
      </form>
</div>

