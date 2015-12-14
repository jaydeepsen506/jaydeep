<?php
class Usermanage_admin extends CI_Controller
{
        function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
                $this->load->model('trainer_model');
	}
        public function index()
        {
	      $data['data']['userdata'] =  $this->trainer_model->trainer_list();
	      $data['view_link'] = 'admin/trainer/list_trainer';
	      $this->load->view('includes/template', $data);
	      
   
	 }
         public function edit()
	{
		 $id=$this->uri->segment(4);		
		 $data['data']['page'] =  $this->trainer_model->trainer_info($id);
                 
                 if ($this->input->server('REQUEST_METHOD') === 'POST')
                    {
                        $name=$this->input->post('trainer_name');
                        $email=$this->input->post('trainer_email');
                        $company=$this->input->post('trainer_com');
                        $phn=$this->input->post('trainer_phn');
                        $bil_address=$this->input->post('bil_address');
                        $work_address=$this->input->post('work_address');
			$user_mode=$this->input->post('user_mode');
			$created_date=$this->input->post('created_date');
			$status=$this->input->post('status');
			
                        
                        $data_to_atore=array(
						'name'=>$name,
                                             'email'=> $email,
                                             'company'=>$company,
                                             'phone'=>$phn,
                                             'billing_address' => $bil_address,
                                             'work_address' => $work_address,
					     'status'=>$status
                                             );
                        if($this->trainer_model->update_trainer($id, $data_to_atore) == TRUE){

                                $this->session->set_flashdata('flash_message', 'pages_updated');
                            }else{
                                $this->session->set_flashdata('flash_message', 'pages_not_updated');
                            }
                        redirect('control/managetrainer');
                    }           
                 $data['network_list']=$this->trainer_model->get_network_list($id);
		 $data['view_link'] = 'admin/trainer/edit_trainer';
		 $this->load->view('includes/template',$data);
		  
	}
	 public function upgrade()
	{
		$id=$this->uri->segment(4);		
		 //echo($id);die;
		 $data['data']['page'] =  $this->trainer_model->trainer_info($id);
                  //print_r($data['data']['page']);die;
                  if ($this->input->server('REQUEST_METHOD') === 'POST')
                    {
			
                        $expiry_date= $this->input->post('expiry_date');
			//$expiry_date= $data[0]['expiry_date'];
                        //echo($expiry_date);die;
			$date = $expiry_date;
			//echo($date);die;
			$date1 = strtotime(date("Y-m-d", strtotime($date)) . " +1 month");
			//$end_date = date('Y-m-d', strtotime('+1 month'));
			//echo($date1);die;
			$unixtime = $date1;
			 $time = date("Y/m/d ",$unixtime);
                        
                        $data_to_store=array('expiry_date' =>$time,'user_mode' =>"P");
			
                        if($this->trainer_model->update_date($id, $data_to_store) == TRUE){

                                $this->session->set_flashdata('flash_message', 'pages_updated');
                            }else{
                                $this->session->set_flashdata('flash_message', 'pages_not_updated');
                            }
                        redirect('control/managetrainer');
                    }           
                 $data['network_list']=$this->trainer_model->get_network_list($id);
		 $data['view_link'] = 'admin/trainer/edit_trainer';
		 $this->load->view('includes/template',$data);
		  
	}
}
?>