<!--|
| Copyright ? 2015 by Esolz Technologies
| Author :  amit.kumar.shaw@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for List User.
|-->
<section id="main-content">
    <section class="wrapper">
        <?php    
       
		//flash messages
	$flash_message=$this->session->flashdata('flash_message');
            if(isset($flash_message)){
                    if($flash_message == 'page_update')
                    {
                       echo '<div class="alert alert-success">';
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Update successfully .';
                       echo '</div>';
                    }
                    else if($flash_message == 'page_not_update'){
                       echo'<div class="alert alert-danger">';
                       echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in Updation. Please try again.';        
                       echo'</div>';
                    }
                    else if($flash_message == 'user_add')
                    {
                       echo '<div class="alert alert-success">';
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> User has been successfully Added.';
                       echo '</div>';
                    }
                    else if($flash_message == 'user_not_add'){
                       echo'<div class="alert alert-danger">';
                       echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in insertion. Please try again.';        
                       echo'</div>';
                    }
                    else if($flash_message == 'user_deleted')
                    {
                       echo '<div class="alert alert-success">';
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> User has been successfully deleted.';
                       echo '</div>';
                    }
		     else if($flash_message == 'email_exist')
                    {
                       echo '<div class="alert alert-danger">';
                       echo '<i class="icon-ok-sign"></i><strong>Error!</strong> Email already exist';
                       echo '</div>';
                    }
            }
    ?>
      
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Manage User
                    </header>
        <div id="d2">
		 <div class="panel-body">
			<div class="clearfix">
<!--                                <div class="btn-group">
				    <button class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/user/add';">
					<a href="javascript:void(0);">Add User<i class="fa fa-plus"></i></a>
				    </button>  
                                </div>
-->			</div>
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="dynamic-table">
					<thead>
                               <tr>
                                   <td><strong> Name</strong></td>
				    <td><strong> Email</strong></td>
				    <td><strong>Status</strong></td>
				     <td><strong>Edit</strong></td> 
                                    <td><strong>Delete</strong></td>
                                </tr>
                                </thead>
                                <tbody>
				<?php
									
				if((!empty($userdata)) &&(count($userdata)>0)){
    
					foreach($userdata as $row)
					{
					
				?>
                                <tr>
                                    <td><a href="<?php echo site_url("control").'/user/edit/'.$row->id; ?>"><?php echo $row->name ?></a></td>
				     <td><a href="<?php echo site_url("control").'/user/edit/'.$row->id; ?>"><?php echo $row->email ?></a></td>
                                    <td><?php if($row->status=='Y'){ echo "Active";} else {echo "Inactive";}?></td>
				     <td>
					<a class="fa fa-edit" href="<?php echo site_url("control").'/user/edit/'.$row->id; ?>" onclick="b()" > </a>
                                    </td>
                                    
                                    <td>
					  <a class="fa fa-trash-o" data-toggle="modal" href="#myModal<?php  echo $row->id; ?>"></a>
				    </td>
				      <!-- Modal -->
						    <div class="modal fade" id="myModal<?php  echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							       <div class="modal-content">
								  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								    <h4 class="modal-title">Delete Info</h4>
								    </div>
							    <div class="modal-body">
			    
								    Are you sure you want to delete?
			    
							    </div>
							       <div class="modal-footer">
								    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								    <button class="btn btn-warning" type="button" onclick="location.href='<?php echo site_url("control").'/user/delete/'.$row->id; ?>';"> Confirm</button>
								</div>
							       </div>											    
							    </div>				
						     </div>	     
				  		
			</div>
		</div>
	    </div>                               
                                </tr>
                            
                                <?php
                                
                                      }			      
			     ?>
                             <?php }
                             else
                             {
                                //echo "No Result Found";
                             }
                             ?>
                    </tbody>
	    					
	    </div>  	
                </section>
               
	</div>
            
        </section>
    </section>
