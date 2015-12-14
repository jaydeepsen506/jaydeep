<script>
  function remove_div_edit(e,field_id)
  {
            //alert(field_id);
	    var count=document.getElementById('count_div_edit').value;
            var recount=parseInt(count)-1;
	    var dataString="field_id="+field_id;
            $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/remove_meal_others",
            data: dataString,
            cache: false,
            success: function(data)
            {
                   //alert(data);
		   if (data == 'deleted') {
		      e.parents('#repeat_section').remove();
		   }
            }
            });
            $('#count_div_edit').val(recount);
  }
  function remove_div_edit_1(e)
  {
    
          var count=document.getElementById('count_div_edit').value;
          var recount=parseInt(count)-1;
          e.parents('#repeat_section').remove();
          $('#count_div_edit').val(recount);
  }
  function add_more_div_edit()
  {
       var count=document.getElementById('count_div_edit').value;
       var recount=parseInt(count)+1;
       var dataString="count="+recount;
        $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/get_more_div_edit",
            data: dataString,
            cache: false,
            success: function(data)
            {
                   //alert(data);
                   $('#main_repeat_div_edit').append(data);
                   $('#count_div_edit').val(recount);
            }
            });
  }
  function delete_image_1(e,image_name) {
       var string_val=document.getElementById('uploaded_image_name_edit').value;
       var dataString="image_name="+image_name+"&string_val="+string_val;
        $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/remove_uploaded_image",
            data: dataString,
            cache: false,
            success: function(data)
            {
		   if (data != 'error') {
		     document.getElementById('uploaded_image_name_edit').value=data
		      $(e).parents('.uploadedsingle').remove();
		   }
            }
            });
  }
</script>
<script>
$("#meal_image_edit").change(function()
 {
	//alert("check");
    var src=$("#meal_image_edit").val();
    if(src!="")
    {
        formdata= new FormData();
        var numfiles=this.files.length;
        var i, file, progress, size;
        for(i=0;i<numfiles;i++)
        {
        file = this.files[i];
        size = this.files[i].size;
        name = this.files[i].name;
        if (file.type.match(/image.*/))
        {
        if((Math.round(size))<=(1024*1024))
        {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function(e){
                var image = $('<img>').attr('src',e.target.result);
                };
                formdata.append("file[]", file);
                if(i==(numfiles-1))
                {
                  $('#waiting_div_edit').html('Please Wait while uploading......');
                $.ajax({
                        url: "<?php echo base_url(); ?>toolbox/image_upload",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res){ 
                          $('#waiting_div_edit').html('');
                          var str=res.substring(0, res.length-1);
                          var array=str.split(',');
                          for(var i=0;i < array.length;i++)
                           {  
                                var count_img=parseInt(document.getElementById('count_image_edit').value);
                                var new_count=count_img+1;
                                var filename=array[i];
                            	var iDiv = document.createElement('div');
				var jDiv = document.createElement('div');
                                var kDiv = document.createElement('img');
                                var mDiv = document.createElement('div');
				var newlink = document.createElement('a');
				newlink.setAttribute('onclick', 'delete_image_1(this,"'+filename+'")');
				newlink.setAttribute('class', 'remove_img');
                                newlink.setAttribute('href', 'javascript:void(0)');
				iDiv.className = 'uploadedsingle';
                                jDiv.className = 'imguploaded edit_img';
                                mDiv.className = 'Uptxt';
                                mDiv.innerHTML='Picture'+new_count;
                                kDiv.src= '<?php echo base_url();?>/meal_images/'+array[i];
                                kDiv.style.height = '80px';
				kDiv.style.width = '80px';
                                iDiv.appendChild(jDiv);
				jDiv.appendChild(kDiv);
				newlink.innerHTML='<i class="fa fa-times-circle-o"></i>';
				jDiv.appendChild(newlink);
                                iDiv.appendChild(mDiv);
                                $("#main_img_div_edit").append(iDiv);
                                document.getElementById('count_image_edit').value=new_count;
                            }
                            document.getElementById('uploaded_image_name_edit').value=document.getElementById('uploaded_image_name_edit').value+","+str;
				if(res=="0")
				{
				   alert("Error in upload. Retry");
				}
                        }
                        });
                }
        }
        else
        {
		alert(name+"Size limit exceeded");
		return;
        }
        }
        else
        {
		alert(name+"Not a valid file");
		return;
        }
        }
    }
    else
    {
    alert("Select a valid file");
    return;
    }
    return false;
});
</script>
<script>
   function meal_validation_edit() {
    //code
    var frm=document.editMealForm;
    if (frm.meal_title_edit.value.search(/\S/) == '-1') {
        document.getElementById('title_error_edit').innerHTML='Please Enter Meal Title';
        frm.meal_title_edit.focus();
        return false;
    }
    else
    {
        document.getElementById('title_error_edit').innerHTML='';
    }
    if (frm.meal_desc_edit.value.search(/\S/) == '-1') {
        document.getElementById('desc_error_edit').innerHTML='Please Enter Meal Description';
        frm.meal_desc_edit.focus();
        return false;
    }
    else
    {
        document.getElementById('desc_error_edit').innerHTML='';
    }
    var specifical = document.getElementsByName('specifically_edit[]');
    var meal_amount=document.getElementsByName('meal_amount_edit[]');
    var len = specifical.length;
    var len1= meal_amount.length;
    if (len==1)
    {
            if (specifical[0].value=='' && meal_amount[0].value=='') {
                    document.getElementById('error_spe_edit1').innerHTML='Add Specifical';
                    document.getElementById('specifically_edit1').style.borderColor='red';
                    document.getElementById('error_amt_edit1').innerHTML='Add Amount';
                    document.getElementById('meal_amount_edit1').style.borderColor='red';
                    return false;
            }
            else if (specifical[0].value=='' && meal_amount[0].value!='')
            {
                    document.getElementById('error_spe_edit1').innerHTML='Add Specifical';
                    document.getElementById('specifically_edit1').style.borderColor='red';
                    document.getElementById('error_amt_edit1').innerHTML='';
                    document.getElementById('meal_amount_edit1').style.border='1px solid #ccc';
                    return false;
            }
            else if (specifical[0].value!='' && meal_amount[0].value=='') {
              
                    document.getElementById('error_amt_edit1').innerHTML='Add Amount';
                    document.getElementById('meal_amount_edit1').style.borderColor='red';
                    document.getElementById('error_spe_edit1').innerHTML='';
                    document.getElementById('specifically_edit1').style.border='1px solid #ccc';
                    return false;
            }
            else if (specifical[0].value!='' && meal_amount[0].value!='')
            {
                    if (isNaN(parseInt(meal_amount[0].value)))
                    {
                            document.getElementById('error_amt_edit1').innerHTML='Amount should be in number';
                            document.getElementById('meal_amount_edit1').style.borderColor='red';
                            document.getElementById('error_spe_edit1').innerHTML='';
                            document.getElementById('specifically_edit1').style.border='1px solid #ccc';
                            return false;
                    }
                    else
                    {
                            document.getElementById('error_amt_edit1').innerHTML='';
                            document.getElementById('meal_amount_edit1').style.border='1px solid #ccc';
                            document.getElementById('error_spe_edit1').innerHTML='';
                            document.getElementById('specifically_edit1').style.border='1px solid #ccc';
                    }
            }
    }
    else if(len>1)
    {
            for (var i=1; i<=len; i++)
             {
//                      alert(i);
//                      var j=i+1;//alert(j);
//		      alert(specifical[i].value);
//                      if (specifical[i].value=='' && meal_amount[i].value=='') {
//			alert($('#error_spe_edit'+i).html());
//                              document.getElementById('error_spe_edit'+j).innerHTML='Add Specifical';
//                              document.getElementById('specifically_edit'+j).style.borderColor='red';
//                              document.getElementById('error_amt_edit'+j).innerHTML='Add Amount';
//                              document.getElementById('meal_amount_edit'+j).style.borderColor='red';
//                              return false;
//                      }
                      //else if (specifical[i].value=='' && meal_amount[i].value!='')
                      //{
                      //        document.getElementById('error_spe_edit'+i).innerHTML='Add Specifical';
                      //        document.getElementById('specifically_edit'+i).style.borderColor='red';
                      //        document.getElementById('error_amt_edit'+i).innerHTML='';
                      //        document.getElementById('meal_amount_edit'+i).style.border='1px solid #ccc';
                      //        return false;
                      //}
                      //else if (specifical[i].value!='' && meal_amount[i].value=='') {
                      //  
                      //        document.getElementById('error_amt_edit'+i).innerHTML='Add Amount';
                      //        document.getElementById('meal_amount_edit'+i).style.borderColor='red';
                      //        document.getElementById('error_spe_edit'+i).innerHTML='';
                      //        document.getElementById('specifically_edit'+i).style.border='1px solid #ccc';
                      //        return false;
                      //}
                      //else if (specifical[i].value!='' && meal_amount[i].value!='')
                      //{
                      //        if (isNaN(meal_amount[i].value))
                      //        {
                      //                document.getElementById('error_amt_edit'+i).innerHTML='Amount should be in number';
                      //                document.getElementById('meal_amount_edit'+i).style.borderColor='red';
                      //                document.getElementById('error_spe_edit'+i).innerHTML='';
                      //                document.getElementById('specifically_edit'+i).style.border='1px solid #ccc';
                      //                return false;
                      //        }
                      //        else
                      //        {
                      //                document.getElementById('error_amt_edit'+i).innerHTML='';
                      //                document.getElementById('meal_amount_edit'+i).style.border='1px solid #ccc';
                      //                document.getElementById('error_spe_edit'+i).innerHTML='';
                      //                document.getElementById('specifically_edit'+i).style.border='1px solid #ccc';
                      //        }
                      //}
             }
    }//alert(frm.instruction_edit.value);
    // if (frm.instruction_edit.value.search(/\S/) == '-1') {
    //    document.getElementById('ins_error_edit').innerHTML='Please Enter Instruction';
    //    frm.instruction_edit.focus();
    //    return false;
    //}
    //else
    //{
    //    document.getElementById('ins_error_edit').innerHTML='';
    //}
    frm.submit();
   }
</script>
<script>
   function show_specific_field(field_id) {
     document.getElementById('specifical_div'+field_id).style.display="none";
     document.getElementById('specifically_edit'+field_id).style.display="block";
   }
   function show_amoumt_field(field_id) {
     document.getElementById('amount_div'+field_id).style.display="none";
     document.getElementById('meal_amount_edit'+field_id).style.display="block";
   }
   function delete_image(e,image_id,image_name)
   {
       var dataString="image_id="+image_id+"&image_name="+image_name;
        $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/remove_image",
            data: dataString,
            cache: false,
            success: function(data)
            {
	      // alert(data);
                   if (data == 'deleted') {
		      $(e).parents('.uploadedsingle').remove();
		   }
            }
            });
   }
</script>

	<div class="row">
           <form name="editMealForm" id="editMealForm" method="POST" action="<?php echo base_url(); ?>toolbox/update_meals" enctype="multipart/form-data">
        	<div class="col-sm-6">
        	    <div class="appoin_txt">MEAL INFORMATION</div>
                    <div class="datehead"><input type="text" class=form-control name="meal_title_edit" id="meal_title_edit" value="<?php echo $meal_info[0]['title'];?>" style="display:none;"><div id="title_div" onclick="$('#title_div').hide();$('#meal_title_edit').show();"><?php echo $meal_info[0]['title'];?></div><div id="title_error_edit" style="color:red;font-size: 14px;font-family: 'HelveticaNeue-Light';"></div></div>
                    <div class="descriptiohead"> <span>DESCRIPTION</span><a href="javascript:void(0)" onclick="$('#desc_div').hide();$('#meal_desc_edit').show();">Edit</a></div>
                    <div class="descriptiotxt"> <textarea name="meal_desc_edit" id="meal_desc_edit" class=form-control style="display:none;" cols="9" rows="9"><?php echo $meal_info[0]['description']; ?></textarea><div id="desc_div"><?php echo $meal_info[0]['description']; ?></div><div id="desc_error_edit" style="color:red"></div></div>
                    <div class="descriptiohead"><span>PICTURES</span><b>Upload
                      <input type="file" name="meal_image_edit[]" id="meal_image_edit" multiple="multiple">
                    </b>
                    </div>
                    <div id="waiting_div_edit"></div>
                    <div class="uploadedpic" id="main_img_div_edit">
                        <?php
                        if(count($meal_images) > 0)
                        {
                            $i=1;
                            foreach($meal_images as $image)
                            {
                        ?>
                      <div class="uploadedsingle">
                        <div class="imguploaded edit_img">
			   <a href="javascript:void(0)" class="remove_img" onclick="delete_image(this,<?php echo $image['id'];?>,'<?php echo $image['filename'];?>')"><i class="fa fa-times-circle-o"></i></a>
			   <img alt="" src="<?php echo base_url();?>meal_images/<?php echo $image['filename']; ?>" style="height:80px;">
			</div>
                        <div class="Uptxt">Picture<?php echo $i; ?></div>
                      </div>
                      <?php
                              $i++;
                            }
                        }
                      ?>
                    </div>
        	</div>
        	<div class="col-sm-6">
        		<div class="appoin_txt">STANDARD MEASUREMENT</div>
			<div class="table-outer-edit">
			  <div id="main_repeat_div_edit">
				    <?php
				    $specific_count=1;
                                    if(count($meal_others) > 0)
                                    {
                                        foreach($meal_others as $meal)
                                        {
                                    ?>
					    <div id="repeat_section" class="organictxt">
					       <div class="singleorga">
						   <div class="txtfloat">Specifically:</div>
						   <div class="txtfloat2">
						    <input type="text" name="specifically_edit[]" id="specifically_edit<?php echo $specific_count;?>" class="form-control txt-box-set-new" value="<?php echo $meal['specifically'];?>" style="display:none;">
							<div id="specifical_div<?php echo $specific_count;?>" onclick="show_specific_field(<?php echo $specific_count;?>)" style="color: #22a7f0;"><?php echo $meal['specifically'];?></div>
							<div id="error_spe_edit<?php echo $specific_count;?>" style="font-size: 11px;color: red;"></div>
						      </div>
					       </div>
					       <div class="singleorga">
						   <div class="txtfloat">Amount:</div>
						   <div class="txtfloat2">
						    <input type="text" name="meal_amount_edit[]" id="meal_amount_edit<?php echo $specific_count;?>" class="form-control txt-box-set-new" value="<?php echo $meal['amount'];?>" style="display: none;">
							<div id="amount_div<?php echo $specific_count;?>" onclick="show_amoumt_field(<?php echo $specific_count;?>)" style="color: #22a7f0;"><?php echo $meal['amount'];?></div>
							<div id="error_amt_edit<?php echo $specific_count;?>" style="font-size: 11px;color: red;"></div>
						   </div>
					       </div>
					       <div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_div_edit($(this),<?php echo $meal['id'];?>)">
						   <span style="color: #282828"> X </span> Remove</a></div>
					        <input type="hidden" name="meal_other_id[]" id="meal_other_id" value="<?php echo $meal['id'];?>">
					   </div>
					   
				    <?php
				      $specific_count++;
					}
				    }
				    ?>
			     
			  </div>
			  <a  href="javascript:void(0)" onclick="add_more_div_edit()" style="color: #26a8f0; white-space: nowrap">+ Add Measurement</a>
		      </div>
                        <input type="hidden" name="count_image_edit" id="count_image_edit" <?php if(count($meal_images) > 0) { ?>value="<?php echo count($meal_images);?>" <?php }else{ ?>value="0"<?php } ?>>
                        <input type="hidden" name="uploaded_image_name_edit" id="uploaded_image_name_edit" value="">
			<input type="hidden" name="meal_id" id="meal_id" value="<?php echo $meal_info[0]['id'];?>">
			<input type="hidden" name="count_div_edit" id="count_div_edit" value="<?php echo count($meal_others);?>">
        		
        		<div class="btns">
        			<!--<a href="javascript:void(0)" class="butsblue red" data-dismiss="modal">Cancel</a>-->
        			<a href="javascript:void(0)" class="butsblue green" onclick="return meal_validation_edit()" style="float: right;">Save Changes</a>
        		</div>
        		
        	</div>
                </form>
        </div>