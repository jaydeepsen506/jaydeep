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
                     Store Management System
                    </header>
		
        <div id="d2">
		 <div class="panel-body">
			
			<div class="adv-table">
				<button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/pages/add';">
                                          <a href="javascript:void(0);">ADD STORE<i class="fa fa-plus"></i></a>
                                    </button>
<form action="<?php echo site_url("control").'/brand_dtls/delete/'?>" method="post">
				<table  class="display table table-bordered table-striped" id="dynamic-table">
					<thead>
                        <div class="btn-group">
							
                               
				   <!-- <button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php echo site_url('control');?>/brnad_dtls/add';">
                                          <a href="javascript:void(0);">ADD Store <i class="fa fa-plus"></i></a>
                                    </button>-->
				    
                                </div>
                        
                               <tr>
                    <td><strong>STORE NAME</strong></td>
				    <td><strong>STORE ADDRESS</strong></td>
                    <td><strong>Edit</strong></td>
                   
				    <td><strong>Delete all <input name="PO_ALL" type="checkbox" id="PO_ALL" value="checkbox" onclick="CheckPowerAll()" />
					<input type="submit" name="submit" values="Delete"></strong></td>
                   <!--<td><strong>View Details</strong></td>-->
                                    		    
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
                        <td><?php echo $row['s_name'];?></td>
                        <td><?php echo $row['s_add'];?></td>
                        <td><a href="<?php echo site_url("control").'/storeset/update/'.$row['s_id']; ?>"><i class="fa fa-edit"></i></a></td>
						<td><input name="PO_PowerWindows[]" type="checkbox" value="<?php echo  $row['s_id']; ?>"</td>
						<a class="fa fa-trash-o" data-toggle="modal" href="<?php  echo site_url("control").'/storeset/delete/'.$row['s_id']; ?>"></a></td>
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
				</table>
				</form>
								
								
	    
								
	    </div>
			
                </section>
               
	       </div>
        </section>
    </section>	
