    <!-- JavaScript --> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/jquery-1.8.2.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/bootstrap.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/owl.carousel.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/jquery.validate.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/wow.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/smoothscroll.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/jquery.smooth-scroll.min.js"></script> 
    <script src="<?php echo base_url(); ?>assets/site/scripts/jquery.superslides.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/site/scripts/placeholders.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/site/scripts/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/site/scripts/jquery.stellar.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/site/scripts/retina.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/site/scripts/custom.js"></script> 
    
    <!--[if lte IE 9]>
            <script src="<?php echo base_url(); ?>assets/site/scripts/respond.min.js"></script>
    <![endif]-->
    <!--------------------- for flash messages ------------------------>
    <script>
    <?php
        $flash_message = '';
        $flash_message = $this->session->flashdata('flash_message');
        if($flash_message == 'user_add')
        {
        ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Than You!<br>You have successfully registered in our site. Please check your email to active your account.');
        $('#modalMessage').modal('show');
    <?php }else if($flash_message == 'user_not_add'){ ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Sorry!<br>Please try after sometimes.');
        $('#modalMessage').modal('show');
    <?php }if($flash_message == 'user_exist'){ ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Sorry!<br>User already exist.');
        $('#modalMessage').modal('show');
    <?php }if($flash_message == 'user_active'){ ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Thank you!<br>You have successfully activated your account.');
        $('#modalMessage').modal('show');
    <?php }if($flash_message == 'user_block'){ ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Sorry!<br>Please try after sometimes.');
        $('#modalMessage').modal('show');
    <?php }if($flash_message == 'user_already_active'){ ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Sorry!<br>User already active.');
        $('#modalMessage').modal('show');
    <?php }if($flash_message == 'user_not_loged'){ ?>
        //Use modal popups to display messages
        $('#modalMessage .modal-title').html('<i class="icon icon-envelope-open"></i>Sorry!<br>Email and password not matched.');
        $('#modalMessage').modal('show');
    <?php } ?>
    </script>
  </body>
</html>