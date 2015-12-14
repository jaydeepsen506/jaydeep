
<section id="main-content">
    <section class="wrapper">
      
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Manage Contact
                    </header>
		
        <div id="d2">
		 <div class="panel-body">
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="dynamic-table">
					<thead>
                               <tr>
                                   <td><strong>First Name</strong></td>
				    <td><strong>Last Name</strong></td>
				    <td><strong>Email</strong></td>
				    <td><strong>Subject</strong></td>
                                    <td><strong>View Details</strong></td>
                                    		    
                                </tr>
                                </thead>
                                <tbody>
				<?php
									
				if((!empty($userdata)) &&(count($userdata)>0)){
    
					foreach($userdata as $row)
					{
					
				?>
                                <tr>
                                    <td><a href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>"><?php echo $row->first_name ?></a></td>
				    <td><a href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>"><?php echo $row->last_name ?></a></td>
				    <td><a href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>"><?php echo $row->contact_email?></a></td>
				    <td><?php echo $row->subject?> </td>
                                    <td>
					<a class="fa fa-edit" href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>" onclick="b()" > </a>
                                    </td>
				  		
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
                                echo "No Result Found";
                             }
                             ?>
                    </tbody>
	    
								
	    </div>  	
                </section>
               
	       </div>
            
        </section>
    </section>
	
	 


