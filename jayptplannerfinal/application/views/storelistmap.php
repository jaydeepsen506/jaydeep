
	<style>
			body{font:12px/1.2 Verdana, sans-serif; padding:0 10px;}
			a:link, a:visited{text-decoration:none; color:#416CE5; border-bottom:1px solid #416CE5;}
			h2{font-size:13px; margin:15px 0 0 0;}
		</style>
	 <script src="<?php echo base_url()?>js/jquery.js"></script>
      <script src="<?php echo base_url()?>js/bpopup.js"></script>
		<link rel="stylesheet" href="<?php echo base_url()?>js/colorbox.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="<?php echo base_url()?>js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#prv").click(function(){
						alert("hello");
					$('#prv').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
<!--color box -->		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
		$(document).ready(function(){
				//alert('hello');
				
				
				$('#chk').click(function(){
						var elements = document.getElementsByName("checkbox[]");
						var l = elements.length;

						if (document.getElementById("chk").checked) {
							for (var i = 0; i < l; i++) {
								elements[i].checked = true;
							}
						} else {
							for (var i = 0; i < l; i++) {
								elements[i].checked = false;
							}
						}
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
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Store has been successfully Added.';
                       echo '</div>';
                    }
                    else if($flash_message == 'user_not_add'){
                       echo'<div class="alert alert-danger">';
                       echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in insertion. Please try again.';        
                       echo'</div>';
                    }
                    else if($flash_message == 'store_deleted')
                    {
                       echo '<div class="alert alert-success">';
                       echo '<i class="icon-ok-sign"></i><strong>Success!</strong> Store has been successfully deleted.';
                       echo '</div>';
                    }
                     else if($flash_message == 'store_not_deleted'){
                       echo'<div class="alert alert-danger">';
                       echo'<i class="icon-remove-sign"></i><strong>Error!</strong> in Updation. Please try again.';        
                       echo'</div>';
                    }
            }
    ?>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Store Details
                    </header>
		
       
		 <div class="panel-body">
            <div class="btn-group">
                               
				    <button id="editable-sample_new" class="btn btn-primary" onclick="location.href='<?php echo site_url('control'); ?>/pages/add';">
                                          <a href="javascript:void(0);">ADD Store<i class="fa fa-plus"></i></a>
                                    </button>
				    
                                </div>
			<form action="<?php echo base_url();?>index.php/control/store/checkbox" method="post">
			<div class="adv-table">
				<table  class="display table table-bordered table-striped" id="dynamic-table">
					<thead>
                               <tr>
                    <td><strong>Name</strong></td>
				    <td><strong>Address</strong></td>
                   <td><strong>Show map</strong></td>
                    <td><strong>Edit</strong></td>
                    <td><strong>Delete</strong></td>
					<td><strong><input type="checkbox" id="chk" name="check"></strong></td>
                                    		    
                                </tr>
                                </thead>
                                <tbody>
				<?php
								
				if((!empty($data)) &&(count($data)>0)){
    
					foreach($userdata as $row)
					{
					
				?>
                    <tr>
                        <td><?php echo $row['s_name'];?></td>
                        <td><?php echo $row['s_add'];?></td>
		            <!--<td><a href="<?php echo site_url("control").'/store/viewprod/'.$row['s_id']; ?>">View Product</a></td> -->
						<td><a class="fa fa-search" href="<?php echo site_url("control").'/store/map/'.$row['s_id']; ?>"></a>
                        </td>
						
				  		<td><a class="fa fa-edit" href="<?php echo site_url("control").'/storeset/update/'.$row['s_id']; ?>"></a>
                        </td>
                        <td> <a class="fa fa-trash-o" data-toggle="modal" href="#myModal<?php  echo $row['s_id']; ?>"></a>
                        </td>
						
                        <!-- Modal -->
						    <div class="modal fade" id="myModal<?php  echo $row['s_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							       <div class="modal-content">
								        <div class="modal-header">
								          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								           <h4  class="modal-title">Delete Info</h4>
								        </div>
							            <div class="modal-body">
			    
								          Are you sure you want to delete?
			    
							            </div>
							            <div class="modal-footer">
								          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
								          <button class="btn btn-warning" type="button" onclick="location.href='<?php echo site_url("control").'/storeset/delete/'.$row['s_id']; ?>';"> Confirm</button>
								       </div>
							       </div>											    
							    </div>				
						     </div>
						<td><input type='checkbox' name="checkbox[]" value="<?php echo $row['s_id'];?>"></td>
                        </div>
                    </div>
                    </div>
                               
                </tr>
				           
				  
                                <?php } ?>
                             <?php }
                             else{
                                echo "No Result Found";
                             }?>
<!-- FOR IMAGES-->
                 <?php
								
				if((!empty($data)) &&(count($data)>0))
				   {
    
					 foreach($userdata as $row)
					   {
					     ?>
						 <!-- div of colorbox  -->
                         <div style='display:none'>
			            <div id='inline_content' style='padding:10px; background:#fff;'>
								<img src="<?php echo base_url().'uploads/'.$row['image'];?>">
			            <p><strong>This content comes from a hidden element on this page.</strong></p>
			            <p>The inline option preserves bound JavaScript events and changes, and it puts the content back where it came from when it is closed.</p>
			            <p><a id="click" href="#" style='padding:5px; background:#ccc;'>Click me, it will be preserved!</a></p>
			
			            <p><strong>If you try to open a new Colorbox while it is already open, it will update itself with the new content.</strong></p>
			           <p>Updating Content Example:<br />
			           <a class="ajax" href="../content/ajax.html">Click here to load new content</a></p>
			          </div>
		              </div>
						    
				        <?php
				        } ?>
             <?php }
              else{
                     echo "No Result Found";
                   }?>

                    </tbody>
				<div align="right">
				<input type="submit" class="btn btn-primary" value="Delete">
				</div>
				</form>	
				
				</table>
				
				</div>	
                </section>
               
	       </div>
            
        </section>
    </section>
