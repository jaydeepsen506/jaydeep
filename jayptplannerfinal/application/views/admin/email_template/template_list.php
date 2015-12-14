<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  madhurima.chatterjee@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for Listing of all countries.
|-->
<section id="main-content">
   <section class="wrapper">
	<?php
	    $flash_message=$this->session->flashdata('flash_message');
		if(isset($flash_message)){
	
		    
		    if($flash_message == 'subject_updated')
		    {
			echo '<div class="alert alert-success">';
			echo '<i class="icon-ok-sign"></i><strong>Success!</strong>Email has been successfully updated.';
			echo '</div>';
		  
		    }
		   
		   
		}
	
	
	?>
		   
         
		   <!-- settings changer -->
	 <div class="row">	
	    <div class="col-sm-12">	
		  
               <section class="panel">
                    
		  <header class="panel-heading">
		   Manage Email Template
		  </header>
               
		  <div class="panel-body">
		<!--     <div class="clearfix">-->
		<!--		   <div class="btn-group">-->
		<!--		      -->
		<!--		      <button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php //echo site_url('control'); ?>/email_template_management/add';">-->
		<!--			     <a href="javascript:void(0);">ADD TEMPLATE<i class="fa fa-plus"></i></a>-->
		<!--		       </button>-->
		<!--		      -->
		<!--		   </div>-->
		<!--		   -->
		<!--		-->
		<!--     </div>-->
		     
		     
				   
				
		     <div class="space15">
		      <!--<div class="panel-body">-->
		      <br>
                            <!--<div class="form">
				       <form class="cmxform form-horizontal" name="search_form" method="POST" action="<?php echo site_url("control").'/AdminSubject' ; ?>"">
					  <div class="form-group ">
					     <div class="col-lg-4">
				       <input type="text" class="form-control" name="search_text" id="search_text" placeholder="search by subject name"  value="" size="30"/></div>
					     
				       <input type="submit" name="search" id="search" value="Search" class="btn btn-primary">
					   </div>
				       </form>  </div>-->
			     <!--</div>-->
		      </div>
		     <br>
		     <section id="unseen">
                        <div class="adv-table">
			   <table  class="display table table-bordered table-striped">
			      <thead>
				  <tr>
				      <th>
					  Template Name
				      </th>
				      <th>
					Subject
				      </th>
				      <th>
					Status
				      </th>
				      <th>Edit</th>
				     
				      <!--<th> Delete </th>-->
				  </tr>
			      </thead>
			      <tbody>
			       <?php
				 $this->load->helper('text');
				 
				 
				 if(count($value)>0)
				 {
                                       //print_r($val);
				       foreach($value as $row)
				       {
                                          //$cat_name="";
                                         //foreach($value as $v)
                                         //{
                                            //echo $v['id'];
                                            //echo $row['subject_category'];
                                            
                                     
				?>
				  <!-- row -->
				  <tr>
				      <td>
					 <?php echo $row['category']; ?>
				      </td>
				      <td>
					  <?php echo $row['subject']; ?>
				      </td>
				     <td>
					  <?php
                                          if($row['status']=='Y')
                                           echo "Active";
                                          else
                                           echo "Blocked";
                                          ?>
				      </td>
				      
				      
					 
					      <td><a href="<?php echo site_url("control").'/email_template_management/update/'.$row['id']; ?>"><i class="fa fa-edit"></i></a></td>
					      

						<!--<td>-->
						<!--	<a class="fa fa-trash-o" data-toggle="modal" href="#myModal<?php  echo $row['id']; ?>"></a>-->
						<!--</td>-->

						<!-- Modal -->
						<div class="modal fade" id="myModal<?php  echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Delete Users</h4>
								</div>
								<div class="modal-body">
			
								Are you sure you want to delete?
			
								</div>
								<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								<button class="btn btn-warning" type="button" onclick="location.href='<?php echo site_url("control").'/email_template_management/delete/'.$row['id']; ?>';"> Confirm</button>
								</div>
							</div>
							</div>
						</div>
						<!-- modal -->
					  
				      
				  </tr>
				  <!-- row -->
			      <?php 
				    }
				}else
				{
			      ?>
				 <tr>
				    <td class="dataTables_empty">No Result Found</td>
				    <td class="dataTables_empty"></td>
				    <td class="dataTables_empty"></td>
				    <td class="dataTables_empty"></td>
				    <td class="dataTables_empty"></td>
                                    
				 </tr>
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
