<?php
class Usermanage_client extends CI_Controller
{
    const VIEW_FOLDER = 'admin/manageclient/';
    
    public function __construct()
	{
           
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->model('client_model');
		$this->load->database();
		
		
	}
    public function index()
        {
	$data['all_data']=$this->client_model->client_list();
	$data['view_link'] = 'admin/manageclient/client_list';
	$this->load->view('includes/template', $data);
	    
        }

}

?>
