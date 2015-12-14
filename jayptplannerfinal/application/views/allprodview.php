<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<title>MAKE A COLORBOX</title>
		<style>
			body{font:12px/1.2 Verdana, sans-serif; padding:0 10px;}
			a:link, a:visited{text-decoration:none; color:#416CE5; border-bottom:1px solid #416CE5;}
			h2{font-size:13px; margin:15px 0 0 0;}
		</style>
		<link rel="stylesheet" href="http://localhost/jayptplanner22/js/colorbox.css'?>" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://localhost/jayptplanner22/js/jquery.colorbox.js'?>"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				
				
				//$("#click").click(function(){ 
				//$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				//	return false;
				//});
			});
		</script>
	</head>
	<body><center>
	<br><br><br><br><br><br>
		<h1><u>Product Gallery</u></h1>
	
				<?php
		
         
	    foreach($userdata as $row)
		{
				
			
				?>
				 <a class="group1" href="<?php echo base_url().'uploads/'.$row['image'];?>" title=""><img src="<?php echo base_url().'uploads/'.$row['image'];?>" height="100px" width="100px"></img></a>
		       
		
	 <?php
	                
				 
	    }
		?>
		
	
		
		</center>
	</body>

</html>	
