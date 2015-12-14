<?php
class Check_code extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('is_site_logged_in')){
			redirect('home');
		}
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('contactsetting_model');
		$this->load->model('common_model');
	}
        public function index()
        {
            	$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		// load template
		$this->load->view('test');
		// load HTML footer file
		$this->load->view('footer');
		// load HTML footer file
		$this->load->view('HTML_footer');
        }
       public function check_page()
        {
            	$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		// load template
		$this->load->view('check');
		// load HTML footer file
		$this->load->view('footer');
		// load HTML footer file
		$this->load->view('HTML_footer');
        }
	public function check_page_val()
        {
            	$header['settings'] =$this->sitesetting_model->get_settings();
		// load HTML header file
		$this->load->view('HTML_header');
		// load header file
		$this->load->view('header',$header);
		// load template
		$this->load->view('check_val');
		// load HTML footer file
		$this->load->view('footer');
		// load HTML footer file
		$this->load->view('HTML_footer');
        }
}
?>