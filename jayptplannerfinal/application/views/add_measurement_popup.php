<?php
$ci=&get_instance();
$ci->load->model('progress_model');
$last_record=$ci->progress_model->get_last_graph_vals($graph_id);
$next_date = date('Y-m-d', strtotime($last_record[0]['x_axis_val'].' +1 day'));
?>
<script>
    function add_more_measurement(){
       var count=document.getElementById('count_measure').value;
       var recount=parseInt(count)+1;
       var date_val=document.getElementById('calender_date').value;
       var dataString="count="+recount+"&date_val="+date_val;
        $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>client_progress/get_more_measure_div",
            data: dataString,
            cache: false,
            success: function(data)
            {
                    var res = data.split("^^");
		    document.getElementById('calender_date').value=res[0];
                    $('#repeat_section_measure_div').append(res[1]);
		    document.getElementById('count_measure').value=recount;
		    $('.date-class').datepicker({
		       changeMonth: true,
		       changeYear: true,
		    });
            }
            });
    }
   function remove_measure(e){
          var count=document.getElementById('count_measure').value;
          var recount=parseInt(count)-1;
          $(e).parents('.organictxt').remove();
          $('#count_measure').val(recount);
    }
    function submit_measurement(graph_id) {
	var frm=document.getElementById('addMeasurement'+graph_id);
	var x_val = document.getElementsByName('x_val[]');
        var y_val=document.getElementsByName('y_val[]');
        var len = x_val.length;
        var len1= y_val.length;

	    if (len==1)
            {
                    if (x_val[0].value.search(/\S/) == '-1' && y_val[0].value.search(/\S/) == '-1') {
                            document.getElementById('error_x_val0').innerHTML='Add Date';
                            document.getElementById('error_y_val0').innerHTML='Add Measurement';
                            return false;
                    }
                    else if (x_val[0].value.search(/\S/) == '-1' && y_val[0].value.search(/\S/) != '-1')
                    {
                            document.getElementById('error_x_val0').innerHTML='Add Date';
                            document.getElementById('error_y_val0').innerHTML='';
                            return false;
                    }
                    else if (x_val[0].value.search(/\S/) != '-1' && y_val[0].value.search(/\S/) == '-1') {
                      
                            document.getElementById('error_x_val0').innerHTML='';
                            document.getElementById('error_y_val0').innerHTML='Add Measurement'; 
                            return false;
                    }
                    else if (x_val[0].value.search(/\S/) != '-1' && y_val[0].value.search(/\S/) != '-1')
                    {
                            if (isNaN(parseInt(y_val[0].value)))
                            {
                                document.getElementById('error_x_val0').innerHTML='';
                                document.getElementById('error_y_val0').innerHTML='Must be a numeric value';
                                return false;
                            }
                            else{
                                document.getElementById('error_x_val0').innerHTML='';
                                document.getElementById('error_y_val0').innerHTML=''; 
                            }  
                    }
            }
            else if(len>1)
            {
                    for (var i=0; i<len; i++)
                     {
                      //alert(i);
                            
                              if (x_val[i].value.search(/\S/) == '-1' && y_val[i].value.search(/\S/) == '-1') {
                                      document.getElementById('error_x_val'+i).innerHTML='Add Date';
                                      document.getElementById('error_y_val'+i).innerHTML='Add Measurement'; 
                                      return false;
                              }
                              else if (x_val[i].value.search(/\S/) == '-1' && y_val[i].value.search(/\S/) != '-1')
                              {
                                      document.getElementById('error_x_val'+i).innerHTML='Add Date';
                                      document.getElementById('error_y_val'+i).innerHTML='';
                                      return false;
                              }
                              else if (x_val[i].value.search(/\S/) != '-1' && y_val[i].value.search(/\S/) == '-1') {
                                
                                      document.getElementById('error_y_val'+i).innerHTML='Add Measurement';
                                      document.getElementById('error_x_val'+i).innerHTML='';
                                      return false;
                              }
                              else if (x_val[i].value.search(/\S/) != '-1' && y_val[i].value.search(/\S/) != '-1')
                              {
                                 if (isNaN(parseInt(y_val[i].value)))
                                    {
                                        document.getElementById('error_x_val'+i).innerHTML='';
                                        document.getElementById('error_y_val'+i).innerHTML='Must be a numeric value';
                                        return false;
                                    }
                                    else
                                    {
                                        document.getElementById('error_x_val'+i).innerHTML='';
                                        document.getElementById('error_y_val'+i).innerHTML='';
                                    }
                              }
                     }
            }
            frm.submit();
    }
</script>
<div class="appoin_txt" style="margin-bottom: 16px;">Add Measurement</div>
  <div class="row">
    <form name="addMeasurement<?php echo $graph_id;?>" id="addMeasurement<?php echo $graph_id;?>" method="POST" action="<?php echo base_url();?>client_progress/add_measurement">
          <div class="col-sm-6" style="width: 100%;">
                 <div id="repeat_section_measure_div" style="max-height: 200px;overflow-y: scroll;">
                  <div class="organictxt">
                                     <div class="singleorga">
                                             <div class="txtfloat">Date:</div>
                                             
                                              <div class="txtfloat2">
                                                     <input type="text" name="x_val[]" id="x_val_0" class="form-control txt-box-set-new date-class date_fld_add" value="<?php echo $next_date; ?>" readonly >
                                                        <div id="error_x_val0" style="font-size: 11px;color: red;"></div>
                                             </div>
					      <a href="javascript:void(0)" onclick="show_calender(this)"><i class="fa fa-calendar" style="float: left;margin-top: 5px;margin-left: -15px;color: black;"></i></a>
                                     </div>
                                     <div class="singleorga">
                                             <div class="txtfloat">Measurement:</div>
                                             <div class="txtfloat2">
                                                     <input type="text" name="y_val[]" id="y_val_0" class="form-control txt-box-set-new mes_add">
                                                     <div id="error_y_val0" style="font-size: 11px;color: red;"></div>
                                             </div>
                                     </div>
                 </div>
               </div>
               <input type="hidden" name="count_measure" id="count_measure" value="0">
               <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>">
               <input type="hidden" name="graph_id" id="graph_id" value="<?php echo $graph_id;?>">
	       <input type="hidden" name="calender_date" id="calender_date" value="<?php echo $next_date; ?>">
	       <input type="hidden" name="prev_calender_date" id="prev_calender_date" value="">
              <!-- <a href="javascript:void(0)" onclick="add_more_measurement()">+ Add Measurement</a>-->
              <div class="btns" style="float:right;">
                      <a href="javascript:void(0)" class="butsblue green" onclick="return submit_measurement(<?php echo $graph_id;?>)">Add</a>
              </div>
          </div>  
    </form>
</div>
<script>
        $(function() {
       $('.date-class').datepicker({
          changeMonth: true,
          changeYear: true,
       });
       });
</script>
