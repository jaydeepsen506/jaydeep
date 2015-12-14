<!--|
| Copyright ? 2015 by Esolz Technologies
| Author :  amit.kumar.shaw@esolzmail.com
|
|	http://www.esolz.net/
|
| All rights reserved. This page is used for edit  Testimonials.
|-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="<?php echo base_url()?>/js/jquery.js"></script>

<script>

	function show(pid)
	{
		
		$.ajax(
                 {
                        type: "POST",
                        url: "<?php echo base_url().'index.php/prod_control/prodel';?>",
                        data: {data:pid},
                        success: function(res)
                         {
                            $("#image"+pid).remove();
							$(".btn btn-default").click();
                         }
                 });
	}
</script>
<script>
			   
			   ////$(".close").click();
$(document).ready(function () {
$('input[type=file]').change(function () {
var val = $(this).val().toLowerCase();
var val = $(this).val();
//var regex = new RegExp("(.*?)\.(docx|doc|pdf|xml|bmp|ppt|xls)$");
var regex = new RegExp("(.*?)\.(jpg)$");
 if(!(regex.test(val))) {
		
				$(this).val('');

				alert('Please select correct file format');
						}
				
		});
});

</script>
<script src="<?php echo base_url()?>js/jquery.js"></script>
<script src="<?php echo base_url()?>js/bpopup.js"></script>
<script>
$(document).ready(function()
	{
		$(".immg").click(function()
		{
			
			 // $("#a").bPopup();
			   alert("hello image zoom");
              
			 		
				
		});
		
	});
</script>


<section id="main-content">
    <section class="wrapper">
        <?php    
       
		//flash messages
	$flash_message=$this->session->flashdata('flash_message');
            if(isset($flash_message)){
                    if($flash_message == 'page_update')
                    {
                       //echo '<div class="alert alert-success">';
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
                      // echo '<div class="alert alert-success">';
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Product has been successfully Added.';
                       echo '</div>';
                    }
                    else if($flash_message == 'user_not_add'){
                       //echo'<div class="alert alert-danger">';
                       echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in insertion. Please try again.';        
                       echo'</div>';
                    }
                    else if($flash_message == 'user_deleted')
                    {
                      // echo '<div class="alert alert-success">';
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Product has been successfully deleted.';
                       echo '</div>';
                    }
            }
    ?>
      
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Product Management System
                    </header>
        <div id="d2">
		 <div class="panel-body">
			   
			<div class="clearfix">
			               
                                <div class="btn-group">
				   <button class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/addition/addpro';">
					<a href="javascript:void(0);">Add PRODUCT<i class="fa fa-plus"></i></a>
				    </button><br><br><br>
					 <button class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/addition/gallery';">
					<a href="javascript:void(0);">IMAGE GALLERY<i class="fa fa-plus"></i></a>
				    </button>  
                                </div>
			</div>
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="dynamic-table">
					<thead>
                               <tr>
								   <td><strong>Store Name</strong></td>
                                   <td><strong>Product Name</strong></td>
								   <td><strong>Image</strong></td>
				    <td><strong>Status</strong></td>
				     <td><strong>Edit</strong></td> 
                                    <td><strong>Delete</strong></td>
                                </tr>
                                </thead>
					
                                <tbody>
						<div id="result">					  
				<?php
									
				if((!empty($userdata)) &&(count($userdata)>0)){
    
					foreach($userdata as $row)
					{
					
				?>
				             
                                <tr id="image<?php echo $row['pid']; ?>">
								<td><?php echo $row['s_name'] ?></td>
                                <td><?php echo $row['pname'] ?></td>
                                <td><a href="<?php echo site_url("control").'/store/viewprod/'.$row['pid'] ; ?>" >View Image</a></td>                                <td><?php if($row['status']=='0'){ echo "ACTIVE";} else {echo "INACTIVE";}?></td>
				               <td><a href="<?php echo site_url("control").'/edit/product/'.$row['pid']; ?>"  ><i class="fa fa-edit"></i></a></td>
                               <td> <a class="fa fa-trash-o" data-toggle="modal" href="#myModal2<?php  echo $row['pid']; ?>"></a></td>
					<!--  <a class="fa fa-trash-o" data-toggle="modal" href="<?php echo site_url("control").'/delete/product'.$row['pid']; ?>" onclick="b()"></a>
				    </td>-->
				      <!-- Modal img-->
						  <div class="modal fade" id="myModal<?php  echo $row['pid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							       <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								           <h4  class="modal-title">DISPLAY IMAGE</h4>
								        </div>
							            <div class="modal-body">
			    
								        <img src="<?php echo base_url().'uploads/'.$row['image'];?>" height="320px" width="240px" />
			    
							            </div>
							            <div class="modal-footer">
								          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
										  <button class="btn btn-warning" type="button" onclick="location.href='<?php echo site_url("control").'/product/delete/'.$row['pid']; ?>';"> Confirm</button>
								       </div>
							       </div>											    
							    </div>				
						     </div>
			       <!--Modal del-->
				          <div class="modal fade" id="myModal2<?php  echo $row['pid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							       <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								           <h4  class="modal-title">Delete Info</h4>
								        </div>
							            <div class="modal-body">
			    
								           Want to delete			    
							            </div>
							            <div class="modal-footer">
								          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								          <button class="btn btn-warning" type="button" onclick="show('<?php echo $row['pid']; ?>')"> Confirm</button>
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
			</div>
                    </tbody>
		           			   
	    					
	    </div>  	
                </section>
               
	</div>
            
        </section>
    </section>
