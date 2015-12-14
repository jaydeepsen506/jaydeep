
<?php
$obj =& get_instance();
$obj->load->model('meal_model');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                         Meal Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                    <tr>
                                                        <th>Meal Name</th>
							<th>Specifically</th>
							<th>Amount</th>
                                                        
                                                        
				    
                                                    </tr>
                                                    </thead>
                                                   <?php
				$this->load->helper('text');
				
					
					foreach($meal_options as $row)
					{
					     
					 $meal_name=$obj->meal_model->meal_name($row['meal_id']);
						
				?>
                                <tr>

                                
				  
                                      <td><?php
				       if(isset($meal_name[0]['title']))
				       {
				       echo $meal_name[0]['title'];
				       }?></td>
				       <td><?php echo $row['specifically']?></td>
				       <td><?php echo $row['amount']?></td>
                                       
				     
				      
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
					    class="btn btn-default" type="button" >Back</button></a>
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

