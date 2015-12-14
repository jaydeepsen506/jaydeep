<?php
class Admin_homepage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
	$this->load->model('homepage_model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('control/login');
	}
    }
 
   
    public function index()
    {
	$id= $this->uri->segment(4);
		
        $data['home'] = $this->homepage_model->get_settings();
	//print_r($data['settings']);die;
	$data['view_link'] = 'admin/admin_homepage';
       $this->load->view('includes/template', $data);


    }
	
	public function updt()
    {

	$this->load->library('form_validation');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

				$data_to_store = array(
					'app_booking_text' => $this->input->post('app_booking_text'),
					'app_trainaway_text' => $this->input->post('app_trainaway_text'),
					'app_diets_text' => $this->input->post('app_diets_text'),
					'diary_text' => $this->input->post('diary_text'),
					'program_text' => $this->input->post('program_text'),
					'messages_text' => $this->input->post('messages_text'),
					'app_booking_content' => $this->input->post('app_booking_content'),
					'app_trainaway_content' => $this->input->post('app_trainaway_content'),
					'app_diets_content' => $this->input->post('app_diets_content'),
					'diary_content' => $this->input->post('diary_content'),
					'program_content' => $this->input->post('program_content'),
					'messages_content' => $this->input->post('messages_content'),
					'web_content' => $this->input->post('web_content'),
					'header_content' => $this->input->post('header_content'),
					'trial_content' => $this->input->post('trial_content'),
					'price_text' => $this->input->post('price_text'),
					'price_content' => $this->input->post('price_content'),
					'plan1' => $this->input->post('plan1'),
					'plan2' => $this->input->post('plan2'),
					'plan3' => $this->input->post('plan3'),
					'plan4' => $this->input->post('plan4')
				);

				if($this->homepage_model->update_settings($data_to_store) == TRUE){
				    $this->session->set_flashdata('flash_message', 'site_updated');
				
		   }
		   
		}
		

				redirect('control/homepage');

	}
}