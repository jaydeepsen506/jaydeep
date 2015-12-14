<?php
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// load models
		$this->load->model('common_model');
	}
	function index()
	{
		$data['data']['about_us'] = $this->common_model->get('pages',array('*'),array('page_alias'=>'about-us','status'=> 'Y'));
		$data['view_link'] = 'home';
		// load template
		$this->load->view('site_includes/template', $data);
		
	}
}