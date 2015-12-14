<!-- PRELOADER -->
<div id="preloader">
    <div class="battery inner">
	    <div class="load-line"></div>
    </div>
</div>

<div id="wrap"> 
    <!-- NAVIGATION BEGIN -->
    <nav class="navbar navbar-fixed-top navbar-slide show-menu">
	<div class="container_fluid"> 
	    <a class="navbar-brand goto" href="<?php echo base_url(); ?>#wrap"> <img src="<?php echo base_url(); ?>assets/site/images/logo_nav.png" alt="Your logo" height="40" width="205" /> </a>
	    <a class="contact-btn fa fa-envelope-o" data-toggle="modal" data-target="#modalContact"></a>
	    <button class="navbar-toggle menu-collapse-btn collapsed" data-toggle="collapse" data-target=".navMenuCollapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	    <div class="collapse navbar-collapse navMenuCollapse">
		<ul class="nav">
		    <li><a href="#index.html#wrap">Try for free</a> </li>
		    <li><a href="#the-web">The Web</a> </li>
		    <li><a href="#web-screenshots">Web Screenshots</a></li>
		    <li><a href="#the-app">The App</a></li>
		    <li><a href="#app-screenshots">App Screenshots</a></li>
		    <li><a href="#testimonials">Testimonials</a></li>
		    <li><a href="#pricing-table">Pricing</a></li>
		    <li><a href="#about-us">About us</a></li>
		</ul>
	    </div>
	</div>
    </nav>
    <!-- NAVIGAION END -->
    <?php
	$flash_message=$this->session->flashdata('flash_message');
	if(isset($flash_message)){
	      if($flash_message == 'not_trainer')
	    {
		$message = "Only a trainer can log in";
	    }
	    
	}
		  
	
	?>
	<script src="<?php echo base_url();?>assets/site/after_login/js/jquery.js"></script>
	<a href="#all_message" id="all_message_div" data-toggle="modal"></a>
		<div class="modal client fade" id="all_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog" style="width: 500px;">
				<div class="modal-content">
				    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				    <h3 class="modal-title" id="message_val"></h3>
				</div>
			</div>
		</div>
<?php
if(isset($flash_message)){
    if(($flash_message == 'not_trainer'))
    {
	?>
	<script>
			$(document).ready(function(){
			    $("#message_val").html('<?php echo $message; ?>');
			$("#all_message_div").click();
	
			});
	</script>
	<?php
    }
	   
}
?>