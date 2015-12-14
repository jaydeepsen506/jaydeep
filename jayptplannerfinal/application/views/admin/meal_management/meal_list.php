
<?php
$obj =&get_instance();
$obj->load->model('meal_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Meal Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                   <tr>
                                                        <td><strong>Title</strong></td>
							<td><strong>Trainer Name</strong></td>
                                                        <td><strong>Description</strong></td>
							<td><strong>Details</strong></td>
                                                        <td><strong>Meal Option</strong></td>
                                                        <td><strong>All Images</strong></td>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($all_data)) &&(count($all_data)>0)){
                    
                                                        foreach($all_data as $row)
                                                        {
						     $id = $obj->meal_model->trainer_name($row['trainer_id']);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['title']; ?></td>
							<td><?php echo $id[0]['name']; ?></td>
							<?php $string= $row['description'] ?>
							<?php $string = substr($string,0,50).'...'; ?> 
							<td><?php echo $string ?></td>
							<td><a data-toggle="modal" href="#myModal<?php echo $row['id']; ?>"><button class="btn btn-warning" type="button"> View Details</button></a></td>
	    
	    <td><a href="<?php echo base_url().'control/meal_options/'.$row['id']?>"><i class="fa fa-edit"></i></a></td>
	     <td><a href="<?php echo base_url().'control/img_options/'.$row['id']?>"><i class="fa fa-edit"></i></a></td>
				  
						<div class="modal fade" id="myModal<?php  echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Meal Description</h4>
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
                    </tbody>				
	    </div>  	
                </section>
	       </div>
        </section>
    </section>