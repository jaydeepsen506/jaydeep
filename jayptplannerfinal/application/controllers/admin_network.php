<?php
class Admin_network extends CI_Controller
{
        function __construct(){
		parent::__construct();
                $this->load->model('network_model');
	}
        ////// Listing Of All Networks 
        public function index(){
	      $data['data']['network_data'] =  $this->network_model->network_list();
	      $data['view_link'] = 'admin/network/network_list';
	      $this->load->view('includes/template', $data);
   
	}
}
?>