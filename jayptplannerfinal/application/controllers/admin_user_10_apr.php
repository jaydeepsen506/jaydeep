<?php
	class Admin_user extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('user_model');
			 if(!$this->session->userdata('is_logged_in')){
		          redirect('control');
			}			
			$this->load->library('upload');
		}
		public function index()
		{
			$data['data']['userdata'] =  $this->user_model->get_user();
			$data['view_link'] = 'admin/user/list';
			$this->load->view('includes/template', $data);
		 }
		 public function edit()
		 {
			 $id=$this->uri->segment(4);		
			 $data['data']['userdata'] =  $this->user_model->edit($id);
			 $data['view_link'] = 'admin/user/edit';
			 $this->load->view('includes/template',$data);
			
		 }
		 public function update()
		 {
			
		        $id=$this->uri->segment(4);
			$nam=$_FILES['image']['name'];
			$val=time().rand(00,99).$nam;
			$path='user_images/'.$val;
			$tmp=$_FILES['image']['tmp_name'];
			move_uploaded_file($tmp,$path);
			$this->upload->do_upload('image');	
			$name=$this->input->post('name');
			$email=$this->input->post('email');
			$address=$this->input->post('address');
			$company=$this->input->post('company');
			$work=$this->input->post('work_address');
			$billing=$this->input->post('billing_address');
			$phone=$this->input->post('phone');
			$status=$this->input->post('status');
			
				if($_FILES['image']['name']!='')
				{
				$data=array('name'=>$name,'picture'=>$val,'email'=>$email,'address'=>$address,'company'=>$company,'work_address'=>$work,'billing_address'=>$billing,'phone'=>$phone,'status'=>$status);
				$this->user_model->update($id,$data);
				$this->session->set_flashdata('flash_message','page_update');
				redirect('control/user');
				}
				else
				{
					$data=array('name'=>$name,'email'=>$email,'address'=>$address,'company'=>$company,'work_address'=>$work,'billing_address'=>$billing,'phone'=>$phone,'status'=>$status);
				$this->user_model->update($id,$data);
				$this->session->set_flashdata('flash_message','page_update');
				redirect('control/user');
	
				}
		 }
                  
		 
		 
}
?>