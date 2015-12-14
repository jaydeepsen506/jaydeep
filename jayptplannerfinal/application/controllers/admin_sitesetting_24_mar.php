<?php
class Admin_sitesetting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('sitesetting_model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('control/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
		//settings data 
        $data['settings'] = $this->sitesetting_model->get_settings();
	$data['view_link'] = 'admin/sitesetting_page';
       $this->load->view('includes/template', $data);


    }//index
	
	public function updt()
    {
		$this->load->library('form_validation');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			//form validation
            $this->form_validation->set_rules('site_name', 'Website Name', 'trim|required');
	    $this->form_validation->set_rules('system_email', 'System Email', 'trim|required|valid_email');
	    //$this->form_validation->set_rules('contact_email', 'Contact Email', 'trim|required|valid_email');
	    $this->form_validation->set_rules('admin_pagination', 'Records per page of Admin', 'trim|required');
	    $this->form_validation->set_rules('site_pagination', 'Records per page of Site', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
		
		
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'site_name' => $this->input->post('site_name'),
					'system_email' => $this->input->post('system_email'),
					//'contact_email' => $this->input->post('contact_email'),
					'admin_pagination' => $this->input->post('admin_pagination'),
					'site_pagination' => $this->input->post('site_pagination'),
					'meta_keywords' => $this->input->post('meta_keywords'),
					'meta_description' => $this->input->post('meta_description'),
				);

				if($this->sitesetting_model->update_settings($data_to_store) == TRUE){
				    $this->session->set_flashdata('flash_message', 'site_updated');
				}else{
				    $this->session->set_flashdata('flash_message', 'site_not_updated');
				}
		
		   }
		   
		}
		

				redirect('control/sitesetting');

	}
}