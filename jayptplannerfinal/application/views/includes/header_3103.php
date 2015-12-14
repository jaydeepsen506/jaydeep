<!DOCTYPE html>
<?php
$ci = &get_instance();
// load models
$ci->load->model('myaccount_model');
$setting_data = $ci->myaccount_model->get_account_data();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $settings[0]['meta_keywords']; ?>">
    <meta name="author" content="Referralonline">

	<!-- favicon -->
    <!--<link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url();?>assets/admin/images/favicon.ico" type="image/x-icon">
    <link rel="icon" type="<?php echo base_url();?>assets/admin/image/png" href="images/favicon.png" />-->

    <!--<link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/images/favicon.png">-->
	<?php
		$page = $this->uri->segment(2);
	?>
    <title><?php echo $settings[0]['site_name']; ?>  - Admin -
    <?php if($page == 'dashboard'){ ?> &nbsp;Home <?php } ?>
    <?php if($page == 'myaccount'){ ?> &nbsp;My Info <?php } ?>
    <?php if($page == 'chngpassword'){ ?> &nbsp;Change Password <?php } ?>
    <?php if($page == 'sitesetting'){ ?> &nbsp;Site Setting <?php } ?>
    <?php if($page == 'contactsetting'){ ?> &nbsp;Contact Setting <?php } ?>
    <?php  if($page == 'pages'){ ?> &nbsp;Pages Management <?php } ?>
    <?php  if($page == 'managecontact'){ ?> &nbsp;Contact Management <?php } ?>
       <?php  if($page == 'managetrainer'){ ?> &nbsp;Trainer Management <?php } ?>
       <?php  if($page == 'managetestimonials'){ ?> &nbsp;Testimonials Management <?php } ?>
    </title>
    <!--Core CSS -->
    <link href="<?php echo base_url();?>assets/admin/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <!--icheck-->
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/minimal/red.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/minimal/green.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/minimal/yellow.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/minimal/purple.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/square/square.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/square/red.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/square/green.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/square/blue.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/square/yellow.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/square/purple.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/flat/grey.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/flat/red.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/flat/blue.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/flat/yellow.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/js/iCheck/skins/flat/purple.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>assets/admin/css/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>assets/admin/js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link href="<?php echo base_url();?>assets/admin/js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="<?php echo base_url();?>assets/admin/js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/js/morris-chart/morris.css">

	<!--responsive table-->
    	<link href="<?php echo base_url();?>assets/admin/css/table-responsive.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/css/style-responsive.css" rel="stylesheet"/>


	<!--dynamic table-->
    <link href="<?php echo base_url();?>assets/admin/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url();?>assets/admin/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/js/data-tables/DT_bootstrap.css" />

	<!--Bootstrap Lightbox-->
    	<link href="<?php echo base_url();?>assets/admin/css/ekko-lightbox.css" rel="stylesheet" />


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>assets/admin/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
	
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="<?php echo base_url(); ?>control/dashboard" class="logo">
        <b><?php echo $settings[0]['site_name']; ?></b>
	
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<?php
	$user_name=$this->session->userdata('user_name');
	$query = $this->db->query("select * from membership where user_name ='".$user_name."'");
	$result = $query->result();
	
	if(!isset($result[0]))
	{ 
	   redirect('control');	
	}

?>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
       <!-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>-->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="<?php echo base_url();?>assets/admin/images/avatar1_small.jpg">
                <span class="username"><?php echo $setting_data[0]['first_name'] ." ".$setting_data[0]['last_name'];?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="<?php echo base_url(); ?>control/myaccount"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="<?php echo base_url(); ?>control/contactsetting"><i class="fa fa-cog"></i>Contact Settings</a></li>
                <li><a href="<?php echo base_url(); ?>control/logout"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>

</header>
<!--header end-->
<!--sidebar start-->

<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a <?php if($page == 'dashboard'){ ?> class="active" <?php } ?> href="<?php echo base_url(); ?>control/dashboard">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a <?php if($page == 'myaccount'){ ?> class="active" <?php } ?> href="<?php echo base_url(); ?>control/myaccount">
                        <i class="fa fa-th"></i>
                        <span>My Info </span>
                    </a>
                </li>
		<li>
                    <a <?php if($page == 'chngpassword'){ ?> class="active" <?php } ?> href="<?php echo base_url(); ?>control/chngpassword">
                        <i class="fa fa-th"></i>
                        <span>Change Password </span>
                    </a>
                </li>
		<li class="sub-menu">
                    <a href="javascript:;" <?php if(($page == 'sitesetting') || (($page == 'contactsetting')) || (($page == 'social_site'))){ ?> class="active" <?php } ?>>
                        <i class="fa fa-book"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub">
                        <li <?php if($page == 'sitesetting'){ ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>control/sitesetting">Site Settings</a></li>
                        <li <?php if($page == 'contactsetting'){ ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>control/contactsetting">Contact Settings</a></li>
                    </ul>
                </li>
		<li class="sub-menu">
                    <a href="javascript:;" <?php if($page == 'pages'){ ?> class="active" <?php } ?>>
                        <i class="fa fa-book"></i>
                        <span>Static Page</span>
                    </a>
                    <ul class="sub">
                        <li <?php if($page == 'pages'){ ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>control/pages">Manage Pages</a></li>
                    </ul>
                </li>
		<li class="sub-menu">
                    <a href="javascript:;" <?php if(($page == 'managecontact')||($page == 'managetrainer')||($page == 'managetestimonials')){ ?> class="active" <?php } ?>>
                        <i class="fa fa-book"></i>
                        <span>Admin Tools</span>
                    </a>
                    <ul class="sub">
                        <li <?php if($page == 'managecontact'){ ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>control/managecontact">Manage Contacts</a></li>
			<li <?php if($page == 'managetrainer'){ ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>control/managetrainer">Manage Trainer</a></li>
			<li <?php if($page == 'managetestimonials'){ ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>control/managetestimonials">Manage Testimonial</a></li>
                    </ul>
                </li>
           </ul>
	</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->


