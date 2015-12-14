
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
                         Image Details
                    </header>
                            <div id="d2">
                                     <div class="panel-body">
                                            <div class="adv-table">
                                                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                                                            <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Image File </th>
							
                                                    </tr>
                                                    </thead>
                                                   <?php
						    $this->load->helper('text');
				
					
					foreach($data as $row)
					{
					     
					 $img_name = $obj->mod_exercise->img_name($row['id']);
						
				?>
                                <tr>
				    
				   <td><?php echo $row['title']; ?></td>
	


				<?php $string= $row['image_path'] ?>
				<?php $str = substr($string,0,27); ?>
				
				
							
<td> <img src="<?php echo $str?> <?php echo $row['exercise_id']?> @50.50.media "/></td>				    
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
					    class="btn btn-default" type="button" >Back</button
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

