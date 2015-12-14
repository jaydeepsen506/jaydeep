
<section id="main-content">
        <section class="wrapper">

	<?php

		$flash_message=$this->session->flashdata('flash_message');
		if(isset($flash_message)){
	
		    if($flash_message == 'pages_updated')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Changes have been successfully updated.';
			echo '</div>';
		    }
		    if($flash_message == 'pages_not_updated'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in updation. Please try again.';        
			echo'</div>';
		    }
		    
		     if($flash_message == 'pages_inserted')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Data has been successfully inserted.';
			echo '</div>';
		    }
		    if($flash_message == 'pages_not_inserted'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in insertion. Please try again.';        
			echo'</div>';
	    
		    }
	
		    if($flash_message == 'error'){
			echo'<div class="alert alert-error">';
			echo'<i class="icon-remove-sign"></i><strong>Error!</strong> . Please try again.';        
			echo'</div>';
		    }
			    
		}
	?>
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Page Management
                    </header>
                    <div class="panel-body">
		
		    <div class="clearfix">
                                <div class="btn-group">
                               
				    <button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/homepage/add';">
                                          <a href="javascript:void(0);">ADD Page<i class="fa fa-plus"></i></a>
                                    </button>
				    
                                </div>
		    </div>
		    <div class="space15"></div>
		    <br>
		    
		    
			<div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">		
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
				  
				    <th>Web content Name</th>
				    <th>App booking text</th>
				  
				     
                                    
                                </tr>
                                </thead>
                                <tbody>
				<?php
					$this->load->helper('text');
				
					
					foreach($all_data as $row)
					{
						
				?>
                                <tr>

                                
				     <td><?php echo $row['web_content']; ?></td>
				     <td><?php echo $row['app_booking_text']; ?></td>
				    
				      
			
				    
				    
			<td><a href="<?php echo base_url().'control/homepage/update/'.$row['id']?>"><i class="fa fa-edit"></i></a></td>
                                  
					
				  
						
						<!-- modal -->
					  
				      
				  </tr>
				  <!-- row -->
			      <?php 
				    }
				?>
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