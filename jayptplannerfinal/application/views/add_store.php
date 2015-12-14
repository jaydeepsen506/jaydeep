<SCRIPT LANGUAGE = "JavaScript">


function CheckPowerAll() {
    var elements = document.getElementsByName("PO_PowerWindows[]");
    var l = elements.length;

    if (document.getElementById("PO_ALL").checked) {
        for (var i = 0; i < l; i++) {
            elements[i].checked = true;
        }
    } else {
        for (var i = 0; i < l; i++) {
            elements[i].checked = false;
        }
    }
}
</SCRIPT>
<section id="main-content">
    <section class="wrapper">
      
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Store Management
                    </header>
		
        <div id="d2">
		 <!--<div class="panel-body">-->
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="dynamic-table">
					<thead>
<div class="btn-group">
                               
				    <button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/pages/add';">
                                          <a href="javascript:void(0);">ADD STORE<i class="fa fa-plus"></i></a>
                                    </button>
				    
                                </div>


                               <tr>
                    <td><strong>Store Name</strong></td>
		    <td><strong>Store Address</strong></td>
				    <td><strong>Edit</strong></td>
                   <td><strong>Delete all <input name="PO_ALL" type="checkbox" id="PO_ALL" value="checkbox" onclick="CheckPowerAll()" />
					<input type="submit" name="submit" values="Delete"></strong></td>               		    
                                </tr>
                                </thead>
                                <tbody>
				<?php
								error_reporting(1);	
				if((!empty($data)) &&(count($data)>0)){
    
					foreach($userdata as $row)
					{
					
				?>
                                <tr>
                        <td><?php echo $row[s_name];?></td>
                        <td><?php echo $row[s_add];?></td>
						  <td><a href="<?php echo site_url("control").'/storeset/update/'.$row['s_id']; ?>"><i class="fa fa-edit"></i></a></td>
						  <td><input name="PO_PowerWindows[]" type="checkbox" value="<?php echo  $row['s_id']; ?>"
                        <td><a class="fa fa-trash-o" data-toggle="modal" href="<?php  echo site_url("control").'/storeset/delete/'.$row['s_id']; ?>"></a></td>
			<div class="modal fade" id="myModal<?php  echo $row['s_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
								    <button class="btn btn-warning" type="button" onclick="location.href='<?php echo site_url("control").'/storesettings/delete/'.$row['s_id']; ?>';"> Confirm</button>
								</div>
							       </div>											    
							    </div>				
						     </div>	 
				  		
			</div>
		</div>
	    </div>	

				    <!--<td><a href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>"><?php echo $row->last_name ?></a></td>
				    <td><a href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>"><?php echo $row->contact_email?></a></td>
				    <td><?php echo $row->subject?> </td>
                                    <td>
					<a class="fa fa-edit" href="<?php echo site_url("control").'/managecontact/edit/'.$row->id; ?>" onclick="b()" > </a>
                                    </td>-->
				  		
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
	
	 
