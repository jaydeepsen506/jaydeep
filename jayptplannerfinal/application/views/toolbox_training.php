  <?php
if($this->session->userdata('site_user_id')=='')
{
    redirect('');
}
?>
  <style type="text/css" media="all">
    .black-cl{
      color:black !important;
    }
    .txt-box-set{
      height: 25px !important;
      width: 149px !important;
    }
    .labl-set{
      padding-left: 0;
      vertical-align: middle;
      width: 36%;
    }
    .chosen-container-single .chosen-single{
      height: 29px !important;
    }
    .drop_down{
      overflow: inherit;
    }
    .workimg{
      line-height: 58px;
    }
    #exercise_load{
      max-height: 350px;
overflow-y: scroll;
    }
    #category_load{
      max-height: 350px;
overflow-y: scroll;
    }
    #sortable2{
      max-height: 350px;
      overflow-y: scroll;
      padding: 0;
    }
    #category_load_pop{
      max-height: 400px;
      overflow-y: scroll;
      padding: 0;
    }
    #sortable1{
       max-height: 350px;
      overflow-y: scroll;
      padding: 0;
      min-height: 350px;
      border: 1px solid #f7f8f9;
    }
    .diffsize{
      text-transform: none;
    }
    #type_program_chosen{
      width: 100% !important;
    }
    #sortable2 li,#sortable1 li{
     list-style-type: none;
    }
    </style>
  <?php
  $ci=&get_instance();
  $ci->load->model('toolbox_model');
  $ci->load->model('common_model');
  ?>
  <script>
    function get_edit_popup(meal_id)
    {
        var dataString ="meal_id="+meal_id;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>toolbox/get_edit_popup",
        data: dataString,
        cache: false,
        success: function(data)
        {
               $('#edit_form_body').html(data);
               $('#edit_hyper').click();
        }
        });
    }
    function show_all()
    {
       $("#exercise_load").html("");
      $('#search_div').hide();
      $('#category_load').show();
      $('#show_all_cat').hide();
      $('#search_type_list').val('');
      $('#search_val_list').val('');
    }
    function show_all_pop()
    {
       $("#sortable2").html("");
      $('#search_val_div_pop').hide();
      $('#category_load_pop').show();
      $('#show_all_cat_pop').hide();
      $('#search_txt_div_pop').val('');
      $('#search_txt_pop').val('');
       $( "#sortable1 li" ).each(function() {
        $( this ).find('.editright').html("");
      });
    }
    function get_exercises(type_id,mode)
    {
      if (type_id == '')
      {
        if (mode == 'list')
          {
            $("#exercise_load").html("");
            $('#search_div').hide();
            $('#category_load').show();
          }
          else{
             $('#sortable2').html("");
             $('#search_val_div_pop').hide();
             $('#category_load_pop').show();
          }
      }
      else
      {
         var dataString ="type_id="+type_id+"&mode="+mode;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>toolbox/get_exercise_list",
        data: dataString,
        cache: false,
        success: function(data)
        {
          if (mode == 'list')
          {
               $('#search_type_list').val(type_id);
               $('#exercise_load').html(data);
               $('#category_load').hide();
               $('#search_div').show();
               $('#show_all_cat').show();
          }
          else{
            $('#sortable2').html(data);
             $('#search_txt_div_pop').val(type_id);
             $('#search_val_div_pop').show();
             $('#show_all_cat_pop').show();
             $('#category_load_pop').hide();
             $( "#sortable1 li" ).each(function() {
                var li_id = $( this ).attr("id");
                var li_id_val = li_id.split("##");
                var type_prgrm = li_id_val[1];
                if (type_prgrm != type_id)
                {
                  
                  $( this ).find('.editright').html("");
                }
                else{
                  
                  $( this ).find('.editright').html('<a class="butsblue remove_icon" href="javascript:void(0)" onclick="remove_to_program($(this))" style="width:100px !important">Remove</a>');
                }
              });
             //$( "#sortable1, #sortable2" ).sortable({
             //   connectWith: ".connectedSortable",
             //   cancel: ".ui-state-disabled",
             //   
             // }).disableSelection();
             
          }
        }
        });
      }
    }
     function search_exercise(exer_val,mode)
    {
      if (mode == 'list')
          {
          var type = $("#search_type_list").val();
          }
          else{
            var type = $("#search_txt_div_pop").val();
          }
     
        var dataString ="search_text="+exer_val+"&type_id="+type+"&mode="+mode;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>toolbox/get_exercise_list",
        data: dataString,
        cache: false,
        success: function(data)
        {
          if (mode == 'list')
          {
            $('#exercise_load').html(data);
          }
          else{
            
               $('#sortable2').html(data);
          }
        }
        });
    }
    function add_program()
    {
      document.getElementById('progran_edit_id').value = '';
      document.getElementById('program_title').value = '';
      document.getElementById('sortable1').innerHTML = '';
      document.getElementById('program_title_error').innerHTML = '';
      document.getElementById('all_program').value = '';
      document.getElementById('create_program_frm').setAttribute("action","<?php echo base_url(); ?>toolbox/insert_program");
      $("#create_btn").show();
      $("#edit_btn").hide();
      $("#dlt_btn").hide();
      
    }
    function edit_program(program_id)
    {
      document.getElementById('progran_edit_id').value = program_id;
      document.getElementById('program_title').value = '';
      document.getElementById('sortable1').innerHTML = '';
      document.getElementById('program_title_error').innerHTML = '';
      document.getElementById('all_program').value = '';
      document.getElementById('create_program_frm').setAttribute("action","<?php echo base_url(); ?>toolbox/update_program");
      var dataString ="program_id="+program_id;
      $.ajax
      ({
      type: "POST",
      url: "<?php echo base_url();?>toolbox/get_program_info",
      data: dataString,
      cache: false,
      success: function(data)
      {
        var contnt = data.split("##@@");
        document.getElementById('program_title').value = contnt[0];
        document.getElementById('sortable1').innerHTML = contnt[1];
        document.getElementById('all_program').value = contnt[2];
        $("#create_btn").hide();
        $("#edit_btn").show();
        $("#dlt_btn").show();
        //$( "#sortable1, #sortable2" ).sortable({
        //  connectWith: ".connectedSortable",
        //  cancel: ".ui-state-disabled",
        //  
        //}).disableSelection();
      }
      });
    }
  </script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/after_login/js/docsupport/chosen.css">
  <div id="page-wrapper">
    <div class="container-fluid tabouterdiv">
      <!-- Page Heading -->
      <div class="row">
        <div class="tabbut">
          <ul class="nav nav-tabs" role="tablist" id="myTab">
            <?php
            $flash_message=$this->session->flashdata('flash_message');
             ?>
            <li role="presentation" <?php if(isset($flash_message) && $flash_message == 'meal_tab') {  ?>class="" <?php  }else{ ?> class="active"<?php } ?>><a href="#tramnning" aria-controls="tramnning" role="tab" data-toggle="tab"><span class="tramnning"></span>TRAINING</a></li>
            <li role="presentation" <?php if(isset($flash_message) && $flash_message == 'meal_tab') {  ?>class="active" <?php }else{ ?> class=""<?php } ?>><a href="#diet" aria-controls="diet" role="tab" data-toggle="tab"><span class="diet"></span>DIET</a></li>
          </ul>
        </div>
        <div class="tab-content">
          <div <?php if(isset($flash_message) && $flash_message == 'meal_tab') { ?>class="row customwidth tab-pane"<?php }else { ?>class="row customwidth tab-pane active" <?php } ?> role="tabpanel" id="tramnning">
            <div class="col-md-7 col-xs-12 leftsidetab">
              <div class="innerblog clearfix">
                <div class="clearfix gaplower">
                  <div class="col-sm-6 col-xs-12">
                    <div class="appoin_txt">EXERCISE PROGRAMS</div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <div class="buttongeneral_tool"><a class="butsblue" href="#" data-target="#EXERCISE-INFORMATION" data-toggle="modal" onclick="add_program();">New Program</a></div>
                  </div>
                </div>
                <div class="clearfix ">
                  <div class="col-xs-12">
                    <div class="bs-example">
                      <div class="panel-group" id="accordion">
                        
                        <?php
                        foreach($program_list as $programs)
                        {
                          $where_meal=array(
                          'program_id' => $programs['id']
                               );
                          $all_exer=$ci->common_model->get('default_program_exercises',array('*'),$where_meal);
                       
                          ?>
                          <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <span><?php echo $programs['name']; ?></span>
                                    
                                    <a data-toggle="collapse" data-parent="#accordion" href="#coll<?php echo $programs['id']; ?>" class="collapsed"><i class="fa fa-fw fa-caret-down"></i></a>
                                    <a href="javascript:void(0);" data-target="#EXERCISE-INFORMATION" data-toggle="modal" onclick="edit_program(<?php echo $programs['id']; ?>)">Edit Workout Info</a>
                                </h4>
                            </div>
                            <div id="coll<?php echo $programs['id']; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                  <?php
                                  foreach($all_exer as $all_ex)
                                  {
                                    $where_meal=array(
                                    'id' => $all_ex['exercise_id']
                                         );
                                    $exer_det=$ci->common_model->get('exercise_list',array('*'),$where_meal);
                                    $media = 'https://exorlive.com/media_'.$exer_det[0]['image_id'].'@50.50.media'
                                    ?>
                                    <div class="editblog">
                                            <div class="workimg"><img src="<?php echo $media; ?>" alt="" /></div>
                                        <div class="workouttxt"><?php
                                            if(strlen($exer_det[0]['title']) > 25)
                                            {
                                                echo substr($exer_det[0]['title'],0,25)."..";
                                            }
                                            else{
                                                echo $exer_det[0]['title'];
                                            }
                                            
                                            
                                            ?> </div>
                                        
                                    </div>
                                    <?php
                                  }
                                  ?>
                                </div>
                            </div>
                        </div>

                          <?php
                        }
                        ?>
                      </div>
                    </div>
                   <!-- <canvas id="canvas" height="450" width="600"></canvas>
                    					 <script>
					    
					var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
				
					var barChartData = {
						labels : ["January","February","March","April","May","June","July"],
						datasets : [
							{
								fillColor : "rgba(151,187,205,0.5)",
								strokeColor : "rgba(151,187,205,0.8)",
								highlightFill : "rgba(151,187,205,0.75)",
								highlightStroke : "rgba(151,187,205,1)",
								data : [65, 59, 80, 81, 56, 55, 40]
							}
						]
				
					}
					window.onload = function(){
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myBar = new Chart(ctx).Bar(barChartData, {
							responsive : true
						});
					}
				
					</script>-->

                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-xs-12">
              <div class="innerblogtool clearfix">
                <div class="clearfix gaptool">
                  <div class="col-sm-4 col-xs-12">
                    <div class="appoin_txt">EXERCISES</div>
                  </div>
                  <div class="searchbgright drop_down" id="show_all_cat" style="display: none;float: right;">
                  <a href="javascript:void(0);" onclick="show_all();">Show All Categories</a>
                </div>
                  
                </div>
                
                <div class="searchbgright" id="search_div" style="display: none;">
                  <button class="custombutton diffcolor" type="button" name=""><i class="fa fa-fw fa-search"></i></button>
                  <div class="searchfieldouter">
                    <input type="hidden" id="search_type_list" value="">
                    <input type="text" id="search_val_list" onClick="if(this.value=='SEARCH EXERCISE') this.value = ''; " onBlur=" if(this.value=='') this.value = 'SEARCH EXERCISE';" value="SEARCH EXERCISE" onChange="search_exercise(this.value,'list')" onkeypress="search_exercise(this.value,'list')" onkeyup="search_exercise(this.value,'list')" class="custfield diffcolor diffsize" name="">
                  </div>
                </div>
                <div id="category_load">
                  <?php
                        $type_list=$ci->common_model->get('exorlive_type_list',array('*'));
			foreach($type_list as $type)
			{
			?>
			 <div class="editblog">
                           
                              <div class="workouttxt"><?php echo $type['type_name'];?> </div>
                              <div class="editright">
                                  <a href="javascript:void(0);" onclick="get_exercises(<?php echo $type['type_id'];?>,'list');">Browse</a>
                              </div>
                              
                          </div>
			<?php
			}
			?>
                 
                </div>
                <div id="exercise_load">
                  
                </div>
                
              </div>
            </div>
          </div>
          <div <?php if(isset($flash_message) && $flash_message == 'meal_tab') { ?>class="row customwidth tab-pane active"<?php }else { ?>class="row customwidth tab-pane" <?php } ?> role="tabpanel" id="diet">
            <div class="col-md-7 col-xs-12 leftsidetab">
              <div class="innerblog clearfix">
                <div class="clearfix gaplower">
                  <div class="col-sm-6 col-xs-12">
                    <div class="appoin_txt">MEALS</div>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <div class="buttongeneral_tool"><a class="butsblue" href="javascript:void(0)" data-toggle="modal" data-target="#MEAL-INFORMATION">Add meal</a></div>
                  </div>
                </div>
                <div class="clearfix ">
                  <script>
                    function search_meal(meal_val)
                    {
                       	var dataString ="search_text="+meal_val;
			$.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>toolbox/get_meal_list_ajax",
			data: dataString,
			cache: false,
			success: function(data)
			{
			       $('#meal_listing').html(data);
			}
			});
                    }
                  </script>
                  <script>
                    function get_edit_right_section(field_id)
                    {
                      	var dataString ="meal_id="+field_id;
                        $.ajax
			({
			type: "POST",
			url: "<?php echo base_url();?>toolbox/get_edit_right_section",
			data: dataString,
			cache: false,
			success: function(data)
			{
			       $('#right_panel').html(data);
			}
			});
                    }
                  </script>
                  <div class="col-xs-12">
                    <div class="searchbgright">
                      <button class="custombutton diffcolor" type="button" name=""><i class="fa fa-fw fa-search"></i></button>
                      <div class="searchfieldouter">
                        <!--<input type="text" onClick="if(this.value=='SEARCH MEALS') this.value = ''; " onBlur=" if(this.value=='') this.value = 'SEARCH MEALS'; " value="SEARCH MEALS" class="custfield diffcolor diffsize" name="">-->
                        <input type="text" value="" class="custfield diffcolor diffsize" name="search_meal" id="search_meal" onChange="search_meal(this.value)" onkeypress="search_meal(this.value)" onkeyup="search_meal(this.value)" placeholder="SEARCH MEALS" style="text-transform:none;">
                      </div>
                    </div>
                    <div id="meal_listing">
                      <?php
                      foreach($meals as $meal)
                      {
                        $image=$ci->toolbox_model->get_meal_images($meal['id']);
                      ?>
                    <a href="javascript:void(0)" onclick="get_edit_right_section(<?php echo $meal['id'];?>)">
                    <div class="editblog">
                      <div class="workimg"><img alt="" <?php  if(count($image) > 0) { ?> src="<?php echo base_url();?>meal_images/<?php echo $image[0]['filename'];?>" <?php }elseif(count($image) == 0) { ?> src="<?php echo base_url();?>assets/site/after_login/images/no-image.gif" <?php } ?>style="height:50px; width:50px;"></div>
                      <div class="workouttxt"><?php echo $meal['title'];?></div>
                      <div class="editright fc"> <a href="javascript:void(0)" onclick="get_edit_popup(<?php echo $meal['id'];?>)">Edit</a> </div>
                    </div>
                    </a>
                    <?php
                      }
                    ?>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
            <script>
              function submit_right_side_edit_form() {
               var frm=document.meal_right_section;
               frm.submit();
              }
            </script>
            <script>
$(document).ready(function(){
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
});
</script>
            <div class="col-md-5 col-xs-12">
              <div class="innerblogtool innerblogtooldiet clearfix">
                <div class="clearfix gaplower" id="right_panel">
                  <?php
                  if(count($meal_one_record) > 0){
                  ?>
                  <div class="col-xs-12">
                    <form name="meal_right_section" id="meal_right_section" method="POST" action="<?php echo base_url(); ?>toolbox/edit_meal_right" enctype="multipart/form-data">
                    <div class="appoin_txt">MEALS</div>
                    <div class="datehead"><input type="text" name="meal_title_right" id="meal_title_right" class="form-control" value="<?php echo $meal_one_record[0]['title']; ?>" style="display: none;"><div id="title_right"><?php echo $meal_one_record[0]['title']; ?></div></div>
                    <div class="descriptiohead"> <span>DESCRIPTION</span></div>
                    <div class="descriptiotxt"><textarea name="meal_desc_right" id="meal_desc_right" class="form-control" rows="9" style="width: 100%;;display:none;"><?php echo $meal_one_record[0]['description']; ?></textarea><div id="desc_right"><?php echo $meal_one_record[0]['description']; ?></div></div>
                    <div class="descriptiohead"><span>PICTURES</span><b>
                      <!--<input type="file" name="meal_image_right[]" id="meal_image_right" multiple="multiple">-->
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
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="copytext2 hidden-lg hidden-md">© 2015 PT-Planner AB</div>
  </div>
  <script>
    function create_program_val()
    {
      var frm = document.create_program_frm;
      $('#all_program').val("");
      if (frm.program_title.value.search(/\S/) == '-1')
      {
        document.getElementById('program_title_error').innerHTML = 'Please input program name';
        frm.program_title.focus();
        return false;
      }
      else{
        document.getElementById('program_title_error').innerHTML = '';
      }
      var tot_ele = $('ul#sortable1 li').length;
      if (tot_ele == 0)
      {
       alert("Please put exercises");
       return false;
      }
      else{
        $( "#sortable1 li" ).each(function() {
          var li_id = $( this ).attr("id");
          //var li_id_val = li_id.split("##");
          var cur_val = $('#all_program').val();
          if(cur_val)
            $('#all_program').val(cur_val + "," + li_id);
          else
            $('#all_program').val(li_id);
        });
      }
      frm.submit();
      
    }
    function del_program_val()
    {
       var frm = document.create_program_frm;
       document.getElementById('create_program_frm').setAttribute("action","<?php echo base_url(); ?>toolbox/delete_program");
       frm.submit();
    }
    function fetch_exer_detail(exer_id)
    {
      var dataString ="exer_id="+exer_id;
        $.ajax
        ({
        type: "POST",
        url: "<?php echo base_url();?>toolbox/get_exer_info",
        data: dataString,
        cache: false,
        success: function(data)
        {
          $("#view_exer_body").html(data);
          $("#view_exer").click();
        }
        });
    }
    function add_to_program(e)
    {
      e.parents('.ui-state-default-val').detach().appendTo('#sortable1');
      var this_id = e.parents('.ui-state-default-val').attr("id");
      var exp_id = this_id.split("##");
      e.attr("onclick","remove_to_program($(this))");
      e.addClass('remove_icon');       
      e.attr("style","width:100px !important");
      e.html("Remove");
    }
    function remove_to_program(e)
    {
      e.parents('.ui-state-default-val').detach().appendTo('#sortable2');
      var this_id = e.parents('.ui-state-default-val').attr("id");
      var exp_id = this_id.split("##");
      e.attr("onclick","add_to_program($(this))");
      e.removeClass('remove_icon');
      e.attr("style","");
      e.html("Add");
    }
  </script>
  
  <div class="modal fade" id="EXERCISE-INFORMATION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <form action="<?php echo base_url(); ?>toolbox/insert_program" method="post" id="create_program_frm" name="create_program_frm">
            
              <input type="hidden" id="progran_edit_id" name="progran_edit_id" value="">
        	<div class="col-sm-6">
        		<div class="appoin_txt">PROGRAM NAME</div>
                    <div class="datehead">
                      <input type="text" class=form-control name="program_title" id="program_title">
                        <div id="program_title_error" style="color:red;font-size: 14px;font-family: 'HelveticaNeue-Light';"></div>
                    </div>
                    <input type="hidden" id="all_program" name="all_program" value="">
                    <ul id="sortable1" class="connectedSortable">
                   
                    </ul>
        	</div>
        	<div class="col-sm-6">
                  <div class="searchbgright drop_down" id="show_all_cat_pop" style="display: none;">
                    <a href="javascript:void(0);" onclick="show_all_pop();">Show All Categories</a>
                    
                  </div>
        	  <div class="searchbgright" id="search_val_div_pop" style="display: none;">
                    <input type="hidden" id="search_txt_div_pop" value="">
                  <button name="" type="button" class="custombutton diffcolor"><i class="fa fa-fw fa-search"></i></button>
                  <div class="searchfieldouter" id="search_div_program">
                    <input type="text" id="search_txt_pop" name="" class="custfield diffcolor diffsize" value="SEARCH EXERCISE"  onChange="search_exercise(this.value,'drag')" onkeypress="search_exercise(this.value,'drag')" onkeyup="search_exercise(this.value,'drag')" onblur=" if(this.value=='') this.value = 'SEARCH EXERCISE';" onclick="if(this.value=='SEARCH EXERCISE') this.value = ''; ">
                  </div>
                </div>
                <div id="category_load_pop">
                  <?php
                        $type_list=$ci->common_model->get('exorlive_type_list',array('*'));
			foreach($type_list as $type)
			{
			?>
			 <div class="editblog">
                           
                              <div class="workouttxt"><?php echo $type['type_name'];?> </div>
                              <div class="editright">
                                  <a href="javascript:void(0);" onclick="get_exercises(<?php echo $type['type_id'];?>,'drag');">Browse</a>
                              </div>
                              
                          </div>
			<?php
			}
			?>
                 
                </div>

                  <ul id="sortable2" class="connectedSortable">
                    
                  </ul>
                  <div class="btns">
                      <a href="javascript:void(0)" class="butsblue green" id="create_btn" onclick="return create_program_val();">Create Program</a>
                      <a href="javascript:void(0)" class="butsblue red" id="dlt_btn" onclick="return del_program_val();" style="display: none;">Delete Program</a>
                      <a href="javascript:void(0)" class="butsblue green" id="edit_btn" onclick="return create_program_val();" style="display: none;">Save Changes</a>
                  </div>
        		
        	</div>
                </form>
        </div>
      </div>
    </div>
  </div>
</div>  
<script>
  function add_more_div()
  {
       var count=document.getElementById('count_div').value;
       var recount=parseInt(count)+1;
       var dataString="count="+recount;
        $.ajax
            ({
            type: "POST",
            url: "<?php echo base_url();?>toolbox/get_more_div",
            data: dataString,
            cache: false,
            success: function(data)
            {
                   //alert(data);
                   $('#main_repeat_div').append(data);
                   $('#count_div').val(recount);
            }
            });
  }
  function remove_div(e)
  {
          //alert('hi');
          var count=document.getElementById('count_div').value;
          var recount=parseInt(count)-1;
          $(e).parents('.organictxt').remove();
          $('#count_div').val(recount);
  }
</script>
<script>
   function meal_validation() {
    //code
    var frm=document.addMealForm;
    if (frm.meal_title.value.search(/\S/) == '-1') {
        document.getElementById('title_error').innerHTML='Please Enter Meal Title';
        frm.meal_title.focus();
        return false;
    }
    else
    {
        document.getElementById('title_error').innerHTML='';
    }
    if (frm.meal_desc.value.search(/\S/) == '-1') {
        document.getElementById('desc_error').innerHTML='Please Enter Meal Description';
        frm.meal_desc.focus();
        return false;
    }
    else
    {
        document.getElementById('desc_error').innerHTML='';
    }
    var specifical = document.getElementsByName('specifically[]');
    var meal_amount=document.getElementsByName('meal_amount[]');
    var len = specifical.length;
    var len1= meal_amount.length;
    if (len==1)
    {
            if (specifical[0].value=='' && meal_amount[0].value=='') {
                    document.getElementById('error_spe0').innerHTML='Add Specifical';
                    document.getElementById('specifically0').style.borderColor='red';
                    document.getElementById('error_amt0').innerHTML='Add Amount';
                    document.getElementById('meal_amount0').style.borderColor='red';
                    return false;
            }
            else if (specifical[0].value=='' && meal_amount[0].value!='')
            {
                    document.getElementById('error_spe0').innerHTML='Add Specifical';
                    document.getElementById('specifically0').style.borderColor='red';
                    document.getElementById('error_amt0').innerHTML='';
                    document.getElementById('meal_amount0').style.border='1px solid #ccc';
                    return false;
            }
            else if (specifical[0].value!='' && meal_amount[0].value=='') {
              
                    document.getElementById('error_amt0').innerHTML='Add Amount';
                    document.getElementById('meal_amount0').style.borderColor='red';
                    document.getElementById('error_spe0').innerHTML='';
                    document.getElementById('specifically0').style.border='1px solid #ccc';
                    return false;
            }
            else if (specifical[0].value!='' && meal_amount[0].value!='')
            {
                    //if (isNaN(parseInt(meal_amount[0].value)))
                    //{
                    //        document.getElementById('error_amt0').innerHTML='Amount should be in number';
                    //        document.getElementById('meal_amount0').style.borderColor='red';
                    //        document.getElementById('error_spe0').innerHTML='';
                    //        document.getElementById('specifically0').style.border='1px solid #ccc';
                    //        return false;
                    //}
                    //else
                    //{
                            document.getElementById('error_amt0').innerHTML='';
                            document.getElementById('meal_amount0').style.border='1px solid #ccc';
                            document.getElementById('error_spe0').innerHTML='';
                            document.getElementById('specifically0').style.border='1px solid #ccc';
                    //}
            }
    }
    else if(len>1)
    {
            for (var i=0; i<len; i++)
             {
              //alert(i);
                    
                      if (specifical[i].value=='' && meal_amount[i].value=='') {
                              document.getElementById('error_spe'+i).innerHTML='Add Specifical';
                              document.getElementById('specifically'+i).style.borderColor='red';
                              document.getElementById('error_amt'+i).innerHTML='Add Amount';
                              document.getElementById('meal_amount'+i).style.borderColor='red';
                              return false;
                      }
                      else if (specifical[i].value=='' && meal_amount[i].value!='')
                      {
                              document.getElementById('error_spe'+i).innerHTML='Add Specifical';
                              document.getElementById('specifically'+i).style.borderColor='red';
                              document.getElementById('error_amt'+i).innerHTML='';
                              document.getElementById('meal_amount'+i).style.border='1px solid #ccc';
                              return false;
                      }
                      else if (specifical[i].value!='' && meal_amount[i].value=='') {
                        
                              document.getElementById('error_amt'+i).innerHTML='Add Amount';
                              document.getElementById('meal_amount'+i).style.borderColor='red';
                              document.getElementById('error_spe'+i).innerHTML='';
                              document.getElementById('specifically'+i).style.border='1px solid #ccc';
                              return false;
                      }
                      else if (specifical[i].value!='' && meal_amount[i].value!='')
                      {
                              //if (isNaN(meal_amount[i].value))
                              //{
                              //        document.getElementById('error_amt'+i).innerHTML='Amount should be in number';
                              //        document.getElementById('meal_amount'+i).style.borderColor='red';
                              //        document.getElementById('error_spe'+i).innerHTML='';
                              //        document.getElementById('specifically'+i).style.border='1px solid #ccc';
                              //        return false;
                              //}
                              //else
                              //{
                                      document.getElementById('error_amt'+i).innerHTML='';
                                      document.getElementById('meal_amount'+i).style.border='1px solid #ccc';
                                      document.getElementById('error_spe'+i).innerHTML='';
                                      document.getElementById('specifically'+i).style.border='1px solid #ccc';
                              //}
                      }
             }
    }
    // if (frm.instruction.value.search(/\S/) == '-1') {
    //    document.getElementById('ins_error').innerHTML='Please Enter Instruction';
    //    frm.instruction.focus();
    //    return false;
    //}
    //else
    //{
    //    document.getElementById('ins_error').innerHTML='';
    //}
    frm.submit();
   }
</script>
<div class="modal fade" id="MEAL-INFORMATION" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
           <form name="addMealForm" id="addMealForm" method="POST" action="<?php echo base_url();?>toolbox/add_meal" enctype="multipart/form-data">
        	<div class="col-sm-6">
        	    <div class="appoin_txt">MEAL INFORMATION</div>
                    <div class="datehead"><input type="text" class=form-control name="meal_title" id="meal_title"><div id="title_error" style="color:red;font-size: 14px;font-family: 'HelveticaNeue-Light';"></div></div>
                    <div class="descriptiohead"> <span>DESCRIPTION</span> </div>
                    <div class="descriptiotxt"> <textarea name="meal_desc" id="meal_desc" class=form-control ></textarea><div id="desc_error" style="color:red"></div></div>
                    <div class="descriptiohead"><span>PICTURES</span><b>Upload
                      <input type="file" name="meal_image[]" id="meal_image" multiple="multiple">
                    </b>
                    </div>
                    <div id="waiting_div"></div>
                    <div class="uploadedpic" id="main_img_div">
                    </div>
        	</div>
        	<div class="col-sm-6">
        		<div class="appoin_txt">STANDAR MEASUREMENT</div>
        		<div class="table-outer-edit">
        			<!--<div class="rate-table">-->
                                  <div id="main_repeat_div">
                                    <div id="repeat_section" class="organictxt">
        				<div class="singleorga">
        					<div class="txtfloat">Specifically:</div>
                                                
                                                 <div class="txtfloat2">
        						<input type="text" name="specifically[]" id="specifically0" class="form-control txt-box-set-new">
                                                           <div id="error_spe0" style="font-size: 11px;color: red;"></div>
        					</div>
        				</div>
<!--                                        <div class="rate-table-row" style="float: right;"> 
                                              <div class="rate-table-td text-right" style="padding-right: 0; font-size: 12px; cursor: pointer" onclick="remove_div(this)">
        						X<span class="descriptiohead">  Remove</span>
        				      </div>
                                        </div>-->
        				<div class="singleorga">
        					<div class="txtfloat">Amount:</div>
                                                <div class="txtfloat2">
        						<input type="text" name="meal_amount[]" id="meal_amount0" class="form-control txt-box-set-new">
                                                        <div id="error_amt0" style="font-size: 11px;color: red;"></div>
        					</div>
        				</div>
                                        <div class="removetxtxr"> <a href="javascript:void(0)" onclick="remove_div(this)">
						   <span style="color: #282828"> X </span> Remove</a></div>

                                        </div>
                                    </div>
        				<a href="javascript:void(0)" onclick="add_more_div()">+ Add Measurement</a>
        			<!--</div>-->
<!--                                <div id="instruction_section" style="margin-top: 50px;min-height: 70px;">
                                  <div class="descriptiohead"> <span>INSTRUCTIONS</span> </div>
                                  <div class="descriptiotxt"> <textarea name="instruction" id="instruction" class=form-control></textarea><div id="ins_error" style="color:red"></div></div>
                                </div>-->
        		</div>
                        <input type="hidden" name="count_image" id="count_image" value="0">
                        <input type="hidden" name="count_div" id="count_div" value="0">
                        <input type="hidden" name="uploaded_image_name" id="uploaded_image_name" value="">
        		
        		<div class="btns">
        			<a href="javascript:void(0)" class="butsblue red" data-dismiss="modal">Cancel</a>
        			<a href="javascript:void(0)" class="butsblue green" onclick="return meal_validation()">Add Meal</a>
        		</div>
        		
        	</div>
                </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
 function remove_image_1(e,image_name){
        var string_val=document.getElementById('uploaded_image_name').value;
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
		     document.getElementById('uploaded_image_name').value=data
		      $(e).parents('.uploadedsingle').remove();
		   }
            }
            });
 }
</script>
<script>
$(document).ready(function(){
$("#meal_image").change(function()
 {
	//alert("check");
    var src=$("#meal_image").val();
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
                  $('#waiting_div').html('Please Wait while uploading......');
                $.ajax({
                        url: "<?php echo base_url(); ?>toolbox/image_upload",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res){
                          $('#waiting_div').html('');
                          var str=res.substring(0, res.length-1);
                          var array=str.split(',');
                          for(var i=0;i < array.length;i++)
                           {  
                                var count_img=parseInt(document.getElementById('count_image').value);
                                var new_count=count_img+1;
                                var filename=array[i];
                            	var iDiv = document.createElement('div');
				var jDiv = document.createElement('div');
                                var kDiv = document.createElement('img');
                                var mDiv = document.createElement('div');
                                var newlink = document.createElement('a');
				newlink.setAttribute('onclick', 'remove_image_1(this,"'+filename+'")');
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
                                iDiv.appendChild(mDiv);
                                jDiv.appendChild(kDiv);
                                newlink.innerHTML='<i class="fa fa-times-circle-o"></i>';
				jDiv.appendChild(newlink);
                                $("#main_img_div").append(iDiv);
                                document.getElementById('count_image').value=new_count;
                            }
                            document.getElementById('uploaded_image_name').value=document.getElementById('uploaded_image_name').value+","+str;
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
});
</script>
<a id="edit_hyper" href="javascript:void(0)" data-toggle="modal" data-target="#MEAL-INFORMATION-EDIT"></a>
<div class="modal fade" id="MEAL-INFORMATION-EDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="edit_form_body">

  </div>
    </div>
  </div>
</div>

<a id="view_exer" href="javascript:void(0)" data-toggle="modal" data-target="#view_exer_pop"></a>
<div class="modal fade" id="view_exer_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="view_exer_body">
      
      </div>
    </div>
  </div>
</div> 


<script src="<?php echo base_url(); ?>assets/site/after_login/js/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="<?php echo base_url(); ?>assets/site/after_login/js/chosen.jquery.js" type="text/javascript"></script>
  <script>
	//jquery.noConflict();
    $(document).ready(function(){
    $(".chosen-select").chosen();
     });
</script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
  $(function() {
    //$( "#sortable1, #sortable2" ).sortable({
    //  connectWith: ".connectedSortable",
    //  stop: function( event, ui ) {
    //    }
    //}).disableSelection();
    
    //$( "#sortable1" ).sortable({
    //    stop: function( event, ui ) {
    //      
    //        alert(ui.item.attr("id"));
    //    }
    //});
    //$( "#sortable2" ).sortable({
    //    stop: function( event, ui ) {
    //        alert(ui.item.attr("id"));
    //    }
    //});

  });
  </script>

   
