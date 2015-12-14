<?php
class Admin_dashboard extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('is_logged_in')){
            redirect('control');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {
	
	$data['view_link'] = 'admin/dashboard_page';
       $this->load->view('includes/template', $data);

    }//index

}