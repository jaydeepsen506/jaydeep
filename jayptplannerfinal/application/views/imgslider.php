<!DOCTYPE html>
<br>
<br>
<br>
<br>
<img src="<?php echo base_url().'/gallery.gif';?>" height="100" width="1000" >

<html lang="en">
<head>
<title>Simple jQuery Auto Image Rotator</title>
<meta name="title" content="Simple jQuery Auto Image Rotator"/>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'js/jquery.cycle.all.js';?>"></script> 
<style>
ul{
	list-type: none;
	list-style: none;
	padding: 0;
	margin: 0;
}

.slider{
 margin: 0 auto;
 width: 320px;
 height: 320px;	
 
 border: 8px solid #FFFFFF;
 border-radius:5px;
 box-shadow: 2px 2px 4px #333333;
}
</style>
<script language="javascript">
$(document).ready(function(){
	$('#slider1') .cycle({
		fx: 'fade', //'scrollLeft,scrollDown,scrollRight,scrollUp',blindX, blindY, blindZ, cover, curtainX, curtainY, fade, fadeZoom, growX, growY, none, scrollUp,scrollDown,scrollLeft,scrollRight,scrollHorz,scrollVert,shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,ipe ,zoom
		speed:  'slow', 
   		timeout: 1000
	});
});	
</script>

</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<section>
  
<div class="container">
<div class="slider">
<ul id="slider1"><?php
  foreach($data as $d){?>
  
	<li><img border="0" src="<?php echo base_url().'uploads/'.$d->image;?>"  alt="Cinque Terre" width="300" height="300" alt="jQuery Image slider" title="jQuery Image slider" /></li>
	<?php } ?>
</ul>
</div>
</div>
</section>


</body>
</html>	
