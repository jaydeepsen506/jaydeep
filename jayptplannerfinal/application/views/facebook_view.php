<?php
//Always place this code at the top of the Page
//session_start();
//if (isset($_SESSION['id'])) {
//    // Redirection to login page twitter or facebook
//    header("location: home.php");
//}
//
//if (array_key_exists("login", $_GET)) {
//    $oauth_provider = $_GET['oauth_provider'];
//    if ($oauth_provider == 'twitter') {
//        header("Location: login-twitter.php");
//    } else if ($oauth_provider == 'facebook') {
//        header("Location: login-facebook.php");
//    }
//}
?>
<title>9lessons Facebook | Twitter Login</title>
<style type="text/css">
    #buttons
	{
	text-align:center
	}
    #buttons img,
    #buttons a img
    { border: none;}
	h1
	{
	font-family:Arial, Helvetica, sans-serif;
	color:#999999;
	}
	
</style>



<div id="buttons">
<h1> Facebook Login </h1>
   <!-- <a href="?login&oauth_provider=twitter"><img src="<?php echo base_url();?>assets/images/tw_login.png"></a>&nbsp;&nbsp;&nbsp;-->
    <a href="http://esolz.co.in/lab6/social_web/site_facebook_login/facebook"><img src="<?php echo base_url();?>assets/images/fb_login.png"></a> <br />
	<br />
	 
</div>
