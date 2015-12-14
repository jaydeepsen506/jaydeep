<!--|
| Copyright © 2014 by Esolz Technologies
| Author :  debojit.talukdar@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for Listing of all static pages.
|-->
<section id="main-content">
        <section class="wrapper">

	<?php
	        //echo "<pre>";print_r($langs);exit;
	
		//flash messages
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
                        Store Management
                    </header>
                    <div class="panel-body">
		
		    <div class="clearfix">
                                <div class="btn-group">
                               
				    <button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/pages/add';">
                                          <a href="javascript:void(0);">Add St<i class="fa fa-plus"></i></a>
                                    </button>
				    
                                </div>
		    </div>
		    <div class="space15"></div>
		    <br>
		    
		    
			<div id="editable-sample_wrapper" class="dataTables_wrapper form-inline" role="grid">		
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
				    <th>Store Name</th>
                                    <th>Store address</th>
                                    
				   <?php
				       if(isset($langs))
				       {
					  foreach($langs as $val)
					   {
					?>	
					<th><?php  if($val['lang_image']!='') { ?><img src="<?php echo site_url().'assets/admin/img/'.$val['lang_image']; ?>" alt="" style="height: 16px; width: 16px;"> <?php }else{   echo $val['name'];  }?> </th>      	
				    <?php }
				       }
				   ?>
				   
                                    
                                </tr>
                                </thead>
                                <tbody>
				<!--<?php
					$this->load->helper('text');
					foreach($pages as $row)
					{
	
				?>
                                <tr>
				    <td><a href="<?php echo site_url("control").'/pages/update/'.$row['id']; ?>"><?php echo $row['page_title']; ?></a></td>
                                    <td><?php if($row['status'] == 'Y') { ?> Active <?php } else { ?> Block <?php } ?></td>
                                  
                                    
				    <?php
				       if(isset($langs))
				       {
					  foreach($langs as $val)
					   {
						if($val['default_status']=='Y')
						 {
					?>	
					<td><a href="<?php echo site_url("control").'/pages/update/'.$row['id']; ?>"><i class="fa fa-edit"></i></a></td>
				    <?php          }else if($val['default_status']=='N')
						{
					?>		
					<td><a href="<?php echo site_url("control").'/pages/updatelang/'.$val['id'].'/'.$row['id']; ?>"><i class="fa fa-edit"></i></a></td>      			
							
					<?php	}
				    
					   }						    
				       }
				   ?>
				   
                                </tr>
				<?php } ?>
                                </tbody>
				
                            </table>
			  </div>  
                         <div class="row">
			     <div class="col-lg-6"></div>	
					<div class="col-lg-6">
					<?php echo '<div class="dataTables_paginate paging_bootstrap pagination" >'.$this->pagination->create_links().'</div>'; ?>
					 </div>
			     </div>
                    </div>
                </section>-->
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
