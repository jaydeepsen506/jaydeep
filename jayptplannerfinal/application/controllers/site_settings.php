<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_settings extends CI_Controller {
 

         public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_site_logged_in')){
			redirect('dashboard');
		}
		
		
	}
        public function index()
        {     
              $data['view_link'] = 'site/site_settings'; 
	      $this->load->view('site_includes_after_login/template', $data);
        }
 }
?>