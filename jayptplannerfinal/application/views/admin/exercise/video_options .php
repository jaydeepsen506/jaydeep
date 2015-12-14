<?php
$obj =&get_instance();
$obj->load->model('mod_exercise');
?>
<section id="main-content">
    <section class="wrapper"> 
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                         Video Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Video File </th>
							
                                                    </tr>
                                                    </thead>
							    <?php
						    $this->load->helper('text');
				
					
					foreach($data as $row)
					{
					     
					 $id = $obj->mod_exercise->video_name($row['id']);
						
				?>
                                                   
				
                                <tr>
				    
				   <td><?php echo $row['title']; ?></td>
				    <td><?php echo $row['video_path']; ?></td>


				<td><iframe id="ytplayer" type="text/html" width="640" height="390"
			    src="<?php echo $row['video_path']; ?>" frameborder="0"/>	</td>		    
                                </tr>
		  <?php 
				    
				}
				
			      ?>
				

						<!-- Modal -->
						<div class="modal fade" id="myModal<?php  echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							
							</div>
						</div>
						<!-- modal -->
					  
				      
				  </tr>
				  <!-- row -->
			      
			      </tbody>
			   </table>
			</div>
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

