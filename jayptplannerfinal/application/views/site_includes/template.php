<?php
$ci = &get_instance();
$ci->load->model('sitesetting_model');
$page_name = $ci->uri->segment(2);
$site_name = 'site/';

$header['settings'] =$ci->sitesetting_model->get_settings();
// load HTML header file
$this->load->view('site_includes/HTML_header');
// load header file
$this->load->view('site_includes/header',$header);


if(isset($data))
{
    
   $this->load->view($site_name.$view_link,$data);
   
}
else
{
    
   $this->load->view($site_name.$view_link);
   
}
   
// load HTML footer file
$this->load->view('site_includes/footer');

// load HTML footer file
$this->load->view('site_includes/HTML_footer');

?>