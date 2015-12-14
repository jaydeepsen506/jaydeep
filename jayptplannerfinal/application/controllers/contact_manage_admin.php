<?php
class Contact_manage_admin extends CI_Controller
{
        function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
	}
        public function index()
        {
	     // $this->load->view('includes/template');
	      $data['data']['userdata'] =  $this->contact_model->contact();
	      $data['view_link'] = 'admin/contact/list_contact';
	      $this->load->view('includes/template', $data);
   
	 }
         public function edit()
	{
		$id=$this->uri->segment(4);		
		 $data['data']['userdata'] =  $this->contact_model->edit1($id);
		 $data['view_link'] = 'admin/contact/view_details';
		 $this->load->view('includes/template',$data);
		  
	}
}
?>