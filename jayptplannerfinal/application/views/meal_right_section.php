<?php
$ci=&get_instance();
$ci->load->model('common_model');
?>
<script>
$("#meal_image_right").change(function()
 {
	//alert("check");
    var src=$("#meal_image_right").val();
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
                  $('#waiting_div_right').html('Please Wait while uploading......');
                $.ajax({
                        url: "<?php echo base_url(); ?>toolbox/image_upload",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res){
                          $('#waiting_div_right').html('');
                          var str=res.substring(0, res.length-1);
                          var array=str.split(',');
                          for(var i=0;i < array.length;i++)
                           {  
                                var count_img=parseInt(document.getElementById('count_image_right').value);
                                var new_count=count_img+1;
                                var filename=array[i];
                            	var iDiv = document.createElement('div');
				var jDiv = document.createElement('div');
                                var kDiv = document.createElement('img');
                                var mDiv = document.createElement('div');
				iDiv.className = 'uploadedsingle';
                                jDiv.className = 'imguploaded';
                                mDiv.className = 'Uptxt';
                                mDiv.innerHTML='Picture'+new_count;
                                kDiv.src= '<?php echo base_url();?>/meal_images/'+array[i];
                                kDiv.style.height = '80px';
				kDiv.style.width = '80px';
                                iDiv.appendChild(jDiv);
                                iDiv.appendChild(mDiv);
                                jDiv.appendChild(kDiv);
                                $("#main_image_div_right").append(iDiv);
                                document.getElementById('count_image_right').value=new_count;
                            }
                            document.getElementById('uploaded_image_name_right').value=document.getElementById('uploaded_image_name_right').value+","+str;
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
<div class="col-xs-12">
  <form name="meal_right_section" id="meal_right_section" method="POST" action="<?php echo base_url(); ?>toolbox/edit_meal_right" enctype="multipart/form-data">
  <div class="appoin_txt">MEALS</div>
  <div class="datehead"><input type="text" name="meal_title_right" id="meal_title_right" class="form-control" value="<?php echo $meal_one_record[0]['title']; ?>" style="display: none;"><div id="title_right"><?php echo $meal_one_record[0]['title']; ?></div></div>
  <div class="descriptiohead"> <span>DESCRIPTION</span><!--<a href="javascript:void(0)" onclick="$('#desc_right').hide();$('#meal_desc_right').show();">Edit</a>--> </div>
  <div class="descriptiotxt"><textarea name="meal_desc_right" id="meal_desc_right" class="form-control" rows="9" style="width: 100%;;display:none;"><?php echo $meal_one_record[0]['description']; ?></textarea><div id="desc_right"><?php echo $meal_one_record[0]['description']; ?></div></div>
  <div class="descriptiohead"><span>PICTURES</span><b>
   <!-- <input type="file" name="meal_image_right[]" id="meal_image_right" multiple="multiple">-->
    </b></div>
  <div id="waiting_div_right"></div>
  <div class="uploadedpic" id="main_image_div_right">
    <?php
      $where_images=array(
           'meal_id' => $meal_one_record[0]['id']
                        );
      $meal_images=$ci->common_model->get('meal_images',array('*'),$where_images,null,null,null,null,null,null,'id','ASC');
      $image_i=1;
      foreach($meal_images as $image)
      {
    ?>
    <div class="uploadedsingle">
      <div class="imguploaded"><img src="<?php echo base_url();?>meal_images/<?php echo $image['filename'];?>" alt="" style="height:80px;"></div>
      <div class="Uptxt">Picture<?php echo $image_i;?></div>
    </div>
    <?php
       $image_i++;
      }
    ?>
  </div>
      <input type="hidden" name="count_image_right" id="count_image_right" value="<?php echo count($meal_images); ?>">
      <input type="hidden" name="meal_id_right" id="meal_id_right" value="<?php echo $meal_one_record[0]['id']; ?>">
      <input type="hidden" name="uploaded_image_name_right" id="uploaded_image_name_right" value="">
  <div class="clearfix">
    <!--<div class="pull-right"><a href="javascript:void(0)" class="greenblue" onclick="submit_right_side_edit_form()">Save Changes</a></div>-->
  </div>
  </form>
</div>
