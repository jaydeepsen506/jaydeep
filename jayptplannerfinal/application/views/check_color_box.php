 <?php
 ?>
 <link rel="stylesheet" href="<?php echo base_url();?>color_box/colorbox.css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <script src="<?php echo base_url();?>color_box/jquery.colorbox.js"></script>
 <script>
    function color_box_slide_show(){
        $(".group1").colorbox({rel:'group1', transition:"none", width:"30%", height:"80%",slideshow:true});
    }
 </script>
 <div id="page-wrapper">
    <div class="container-fluid tabouterdiv">
        <a href="../client_current_images/143265039470download.jpg" onclick="color_box_slide_show()" class="group1" title="check1">Color Box</a>
        <?php
        $file=getcwd().'/client_current_images/143265039470download.jpg';
        ?>
	<div style="display:none;">
        <p><a class="group1" href="../client_goal_images/143271164226images (5).jpg" title="check2">Grouped Photo 1</a></p>
	<p><a class="group1" href="../client_current_images/143265039470download.jpg" title="check3">Grouped Photo 2</a></p>
	<p><a class="group1" href="../client_goal_images/143271164226images (5).jpg" title="check4">Grouped Photo 3</a></p>
	</div>
    </div>
 </div>