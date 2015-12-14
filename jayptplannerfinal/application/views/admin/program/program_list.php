
<?php
$obj =&get_instance();
$obj->load->model('program_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Program Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                   <tr>
							<td><strong>Trainer Name</strong></td>
                                                        <td><strong>Name</strong></td>
							<td><strong>Created Date</strong></td>
							<td><strong>List of Exercises</strong></td>
							
							
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if((!empty($all_data)) &&(count($all_data)>0)){
                    
                                                        foreach($all_data as $row)
                                                        {
						    $id = $obj->program_model->trainer_name($row['created_by']);
						   
						     
                                                    ?>
                                                    <tr>
                                                        
							<td><?php echo $id[0]['name']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['created_date'];?></td>
						
							
							
							
						
	    
	    <td><a href="<?php echo base_url().'control/program_default_list/'.$row['id']?>"><i class="fa fa-edit"></i></a></td>
				  
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