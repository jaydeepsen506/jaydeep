<?php
//$ci=&get_instance();
//$ci->load->model('meal_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Exercise Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                   <tr>
                                                        <td><strong>Title</strong></td>
                                                        <td><strong>Description</strong></td>
							<td><strong>Details</strong></td>
                                                        <td><strong>Image details</strong></td>
                                                        <td><strong>Video details</strong></td>
                                                        
                                                    </tr>
                                                    </thead>
						    <script>
							function video_fetch(id)
							{
							    
							    var dataString = 'id=' + id;
								$.ajax
								({
								type: "POST",
								url: "<?php echo base_url();?>exercise/video_search",
								data: dataString,
								cache: false,
								success: function(data)
								{
								  
								      
								       $('#video').html(data);
								       $('#video_list').click();
								    
								}
								});
							}
						    </script>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($all_data)) &&(count($all_data)>0)){
                    
                                                        foreach($all_data as $row)
                                                        {
                                                    ?>
                                                     <tr>
                                                        <td><?php echo $row['title']; ?></td>
							<?php $page = $row['video_path']; ?>
							
							<?php $string= $row['description'] ?>
							
							<?php $string = substr($string,0,50).'...'; ?> 
							<td><?php echo $string ?></td>
    <td><a data-toggle="modal" href="#myModal<?php echo $row['id']; ?>"><button class="btn btn-warning" type="button">View Details</button></a></td>
    <td><a href="<?php echo base_url().'control/exercise_options/'.$row['id']?>"><i class="fa fa-edit"></i></a></td>
    <td><button class="btn btn-warning" type="button" onclick="video_fetch(<?php echo $row['id'] ;?> )">Video Details</button></td>
    
						<div class="modal fade" id="myModal<?php  echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Exercise Description</h4>
								</div>
								<div class="modal-body">
			
							    <?php echo  $row['description']  ?>
			
								</div>
								<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								
								
								</div>
							</div>
							</div>
						</div>
				
                                                    </tr>    
                                            </div>
                                    </div>
                                </div>
	
                                <?php
                                      }
			     ?>
                             <?php }
                             else
                             {
                                echo "No Result Found";
                             }
                             ?>
			     <a href="javascript:void(0)" id="video_list" data-toggle="modal" data-target="#videoModal"> </a>
				  	<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Exercise Video</h4>
								</div>
								<div class="modal-body" id="video">
							       </div>
								<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								
								
								</div>
							</div>
							</div>
						</div>
                    </tbody>				
	    </div>  	
                </section>
	       </div>
        </section>
    </section>