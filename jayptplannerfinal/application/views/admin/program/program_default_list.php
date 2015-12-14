
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
                         Program Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                    <tr>
                                                        <th>Program Name</th>
							<th>Exercise Name</th>
							<th>Category</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                   <?php
						    $this->load->helper('text');
				
					foreach($all_data as $row)
					{
					$id = $obj->program_model->trainer($row['program_id']);
					$id1 = $obj->program_model->train($row['exercise_id']);
					$id2 = $obj->program_model->type($row['type_id']);
						?>
					<tr>
					    <td><?php echo $id[0]['name']; ?></td>
					    <td><?php echo $id1[0]['title']; ?></td>
					    <td><?php echo $id2[0]['type_name']; ?></td>
				       
                                       </tr>

						<!-- Modal -->
						<div class="modal fade" id="myModal<?php  echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							
							</div>
						</div>
						<!-- modal -->
					  
				      
				  </tr>
				  <!-- row -->
			      <?php 
				    
				}
				
			      ?>
			      </tbody>
			      
			   </table>
			</div>
		   <a href="javascript:window.history.go(-1);"> <button data-dismiss="modal"
		   class="btn btn-default" type="button" >Back</button>
		 
                    </section>
		  </div>
	    
		  <div class="row">
		     <div class="col-lg-6"></div>	
		     <div class="col-lg-6">
			
			<?php echo '<div class="dataTables_paginate paging_bootstrap pagination" >'.$this->pagination->create_links().'</div>'; ?>
		     </div>
		  </div>
	       </section>
	    </div>
	    <!-- end main container -->
      </div>
   </section>
</section>

