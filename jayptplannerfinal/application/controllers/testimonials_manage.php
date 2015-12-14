<?php
	class Testimonials_manage extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('testimonials_model');
			 if(!$this->session->userdata('is_logged_in')){
		          redirect('control');
			}
			
			$this->load->library('upload');
		}
		public function index()
		{
			$data['data']['userdata'] =  $this->testimonials_model->testimonials();
			$data['view_link'] = 'admin/testimonials/list_testimonials';
			$this->load->view('includes/template', $data);
		 }
		 public function add()
		 {
			$data['view_link'] = 'admin/testimonials/add_testimonials';
			$this->load->view('includes/template', $data);

		 }
		 public function insert()
		 {
			$nam=$_FILES['image']['name'];
			$val=time().rand(00,99).$nam;
			$path='testimonial_images/'.$val;
			$tmp=$_FILES['image']['tmp_name'];
			move_uploaded_file($tmp,$path);
			$this->upload->do_upload('image');	
			$name=$this->input->post('name');
			$short_desc=$this->input->post('short_desc');
			$desc=$this->input->post('desc');
			$status=$this->input->post('status');
			$data=array('name'=>$name,'image'=>$val,'short_desc'=>$short_desc,'desc'=>$desc,'status'=>$status);
				$this->testimonials_model->insert($data);
				$this->session->set_flashdata('flash_message','user_add');
				redirect('control/managetestimonials');
		 }
		 public function edit()
		 {
			 $id=$this->uri->segment(4);		
			 $data['data']['userdata'] =  $this->testimonials_model->edit($id);
			 $data['view_link'] = 'admin/testimonials/edit_testimonials';
			 $this->load->view('includes/template',$data);
			
		 }
		 public function update()
		 {
			
		        $id=$this->uri->segment(4);
			$nam=$_FILES['image']['name'];
			$val=time().rand(00,99).$nam;
			$path='testimonial_images/'.$val;
			$tmp=$_FILES['image']['tmp_name'];
			move_uploaded_file($tmp,$path);
			$this->upload->do_upload('image');	
			$name=$this->input->post('name');
			$short_desc=$this->input->post('short_desc');
			$desc=$this->input->post('desc');
			$status=$this->input->post('status');
			
				if($_FILES['image']['name']!='')
				{
				$data=array('name'=>$name,'image'=>$val,'short_desc'=>$short_desc,'desc'=>$desc,'status'=>$status);
				$this->testimonials_model->update($id,$data);
				$this->session->set_flashdata('flash_message','page_update');
				redirect('control/managetestimonials');
				}
				else
				{
					$data=array('name'=>$name,'short_desc'=>$short_desc,'desc'=>$desc,'status'=>$status);
				$this->testimonials_model->update($id,$data);
				$this->session->set_flashdata('flash_message','page_update');
				redirect('control/managetestimonials');
	
				}
		 }
                 
		 public function delete()
		 {
			$id=$this->uri->segment(4);
			$this->testimonials_model->delete($id);
			$this->session->set_flashdata('flash_message','user_deleted');
			redirect('control/managetestimonials');
		 }
		 
        }
?>