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
		<link rel="stylesheet" href="<?php echo base_url().'css/colorbox.css'?>" />
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
		<script src="<?php echo base_url().'js/jquery.colorbox.js'?>"></script>
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
		<script src="<?php echo base_url()?>/js/jquery.js"></script>

        <script>
	function show(id)
	{
	   
	   /*$.post("http://localhost/jayptplanner22/index.php/prod_control/imgdel",{data:id},function(res,status)
		{
			$("#image"+id).remove();
			//$("#result").html(res);
			//alert(status);
		});*/
	    
	    $.ajax(
                 {
                        type: "POST",
                        url: "<?php echo base_url().'index.php/prod_control/imgdel';?>",
                        data: {data:id},
                        success: function(res)
                         {
                            $("#image"+id).remove();
                         }
                 });
	}
    </script>
    </script>
	 <script src="<?php echo base_url().'js/jquery.js';?>"></script>
  </script>	

	</head>
	<body>
		<br><br><br><br><br><br>
		<center><h1><u>IMAGE GALLARY</u></h1></center>
<center>
	<br><br><br><br><br><br>
		
	
		<?php
		
         
	    foreach($userdata as $row)
		{
				
				?>
				<p id="image<?php echo $row['id']; ?>"> <a class="group1" href="<?php echo base_url().'uploads/'.$row['image'];?>" title=""><img src="<?php echo base_url().'uploads/'.$row['image'];?>" height="100px" width="100px"></img></a>
		            <button onclick="show('<?php echo $row['id']; ?>')">DELETE </button>
				</p>
		
	 <?php
	                
				 
	    }
		?>
		
		</center>
	</body>

</html>	
