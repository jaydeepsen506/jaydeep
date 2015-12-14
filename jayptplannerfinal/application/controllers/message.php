<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
 

         public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_site_logged_in')){
			redirect('dashboard');
		}
		
		
	}
        public function index()
        {     
              $data['view_link'] = 'site/message'; 
	      $this->load->view('site_includes_after_login/template', $data);
        }
 }
?>