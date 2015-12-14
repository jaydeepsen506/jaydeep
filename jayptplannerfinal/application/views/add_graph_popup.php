<script>
        function submit_graph_form() {
	var frm= document.forms.addGraphForm;
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
        var x_val = document.getElementsByName('xval[]');
        var y_val=document.getElementsByName('yval[]');
        var len = x_val.length;
        var len1= y_val.length;

	    if (len==1)
            {
                    if (x_val[0].value.search(/\S/) == '-1' && y_val[0].value.search(/\S/) == '-1') {
                            document.getElementById('error_xval0').innerHTML='Add X-axis value';
                            document.getElementById('error_yval0').innerHTML='Add Y-axis value';
                            return false;
                    }
                    else if (x_val[0].value.search(/\S/) == '-1' && y_val[0].value.search(/\S/) != '-1')
                    {
                            document.getElementById('error_xval0').innerHTML='Add X-axis value';
                            document.getElementById('error_yval0').innerHTML='';
                            return false;
                    }
                    else if (x_val[0].value.search(/\S/) != '-1' && y_val[0].value.search(/\S/) == '-1') {
                      
                            document.getElementById('error_xval0').innerHTML='';
                            document.getElementById('error_yval0').innerHTML='Add Y-axis value'; 
                            return false;
                    }
                    else if (x_val[0].value.search(/\S/) != '-1' && y_val[0].value.search(/\S/) != '-1')
                    {
                            if (isNaN(parseInt(y_val[0].value)))
                            {
                                document.getElementById('error_xval0').innerHTML='';
                                document.getElementById('error_yval0').innerHTML='Must be a numeric value';
                                return false;
                            }
                            else{
                                document.getElementById('error_xval0').innerHTML='';
                                document.getElementById('error_yval0').innerHTML=''; 
                            }  
                    }
            }
            else if(len>1)
            {
                    for (var i=0; i<len; i++)
                     {
                      //alert(i);
                            
                              if (x_val[i].value.search(/\S/) == '-1' && y_val[i].value.search(/\S/) == '-1') {
                                      document.getElementById('error_xval'+i).innerHTML='Add X-axis Value';
                                      document.getElementById('error_yval'+i).innerHTML='Add Y-axis Value'; 
                                      return false;
                              }
                              else if (x_val[i].value.search(/\S/) == '-1' && y_val[i].value.search(/\S/) != '-1')
                              {
                                      document.getElementById('error_xval'+i).innerHTML='Add X-axis Value';
                                      document.getElementById('error_yval'+i).innerHTML='';
                                      return false;
                              }
                              else if (x_val[i].value.search(/\S/) != '-1' && y_val[i].value.search(/\S/) == '-1') {
                                
                                      document.getElementById('error_yval'+i).innerHTML='Add Y-axis Value';
                                      document.getElementById('error_xval'+i).innerHTML='';
                                      return false;
                              }
                              else if (x_val[i].value.search(/\S/) != '-1' && y_val[i].value.search(/\S/) != '-1')
                              {
                                 if (isNaN(parseInt(y_val[i].value)))
                                    {
                                        document.getElementById('error_xval'+i).innerHTML='';
                                        document.getElementById('error_yval'+i).innerHTML='Must be a numeric value';
                                        return false;
                                    }
                                    else
                                    {
                                        document.getElementById('error_xval'+i).innerHTML='';
                                        document.getElementById('error_yval'+i).innerHTML='';
                                    }
                              }
                     }
            }
            frm.submit();
    }
</script>
<div class="appoin_txt" style="margin-bottom: 16px;">Add Graph Information</div>
        <div class="row">
           <form name="addGraphForm" id="addGraphForm" method="POST" action="<?php echo base_url();?>client_progress/add_graph_information">
        	<div class="col-sm-6" style="width: 100%;">
                      <div class="descriptiohead"><span>Graph Type</span><b style="overflow: visible;">
		        <select name="graph_type" id="graph_type" class="form-control" style="width: 195px;">
			    <option value="L">Line Graph</option>
			    <!--<option value="B">Bar Graph</option>-->
			</select>
			</b>
                      </div>
		      <div class="descriptiohead"><span style="padding-right: 45px;">Graph For</span><b style="overflow: visible;">
		        <input type="text" name="graph_for" id="graph_for" class="form-control"> 
			</b>
			<div id="for_error" class="error-class-graph"></div>
                      </div>
		       <div class="descriptiohead"><span style="padding-right: 27px;">Measure Unit</span><b style="overflow: visible;">
		        <input type="text" name="measure_unit" id="measure_unit" class="form-control">
			</b>
			<div id="unit_error" class="error-class-graph"></div>
		       </div>
		       <div id="repeat_section_measure">
			<div class="organictxt">
					   <div class="singleorga">
						   <div class="txtfloat">Date:</div>
						   
						    <div class="txtfloat2">
							   <input type="text" name="xval[]" id="xval0" class="form-control txt-box-set-new date-class date_fld_add" value="<?php echo date('Y-m-d');?>" readonly >
							      <div id="error_xval0" style="font-size: 11px;color: #DF1905;"></div>
						   </div>
						    <a href="javascript:void(0)" onclick="show_calender(this)"><i class="fa fa-calendar" style="float: left;margin-top: 5px;margin-left: -15px;color:black;"></i></a>
					   </div>
					   <div class="singleorga">
						   <div class="txtfloat">Measurement:</div>
						   <div class="txtfloat2">
							   <input type="text" name="yval[]" id="yval0" class="form-control txt-box-set-new mes_add">
							   <div id="error_yval0" style="font-size: 11px;color: #DF1905;"></div>
						   </div>
					   </div>
		       </div>
		     </div>
		     <input type="hidden" name="count_measure_div" id="count_measure_div" value="0">
		     <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id;?>">
                       <!-- <a href="javascript:void(0)" onclick="add_more_measure_div()">+ Add Measurement</a>-->
		    <div class="btns" style="float:right;">
        		    <a href="javascript:void(0)" class="butsblue green" onclick="return submit_graph_form()">Add</a>
        	    </div>
        	</div>  
            </form>
 </div>

