<?php
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('is_site_logged_in')){
			redirect('dashboard');
		}
		// load models
		$this->load->model('common_model');
		$this->load->model('sitesetting_model');
	}
	function index()
	{
		$data['data']['about_us'] = $this->common_model->get('pages',array('*'),array('page_alias'=>'about-us','status'=> 'Y'));
		$data['data']['testimonials'] = $this->common_model->get('testimonials',array('*'),array('status'=> 'Y'),null,null,null,null,null,null,'id','asc');
		$where=array('id' =>1);
		$data['web_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['app_booking_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['app_booking_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['app_trainaway_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['app_trainaway_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['app_diets_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['app_diets_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['diary_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['diary_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['program_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['program_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['messages_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['messages_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['header_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['trial_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['price_text'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['price_content'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['plan1'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['plan2'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['plan3'] = $this->common_model->get('home_page_management',array('*'),$where);
		//$data['plan4'] = $this->common_model->get('home_page_management',array('*'),$where);
		
		
		$data['view_link'] = 'home';
		// load template
		$this->load->view('site_includes/template', $data);
		
	}
	
}