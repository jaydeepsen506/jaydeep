<?php
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// load models
		$this->load->model('mod_user');
		$this->load->model('common_model');
		// load libraries
		$this->load->library('form_validation');
		$this->load->library('session');

		// load helper
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
	function index()
	{
		
		redirect('');
		
	}
	public function verify()
	{
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$page_name = $this->input->post('page_name');
			//form validation
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
			
			
			if ($this->form_validation->run())
			{
				$data_to_store = array(
				    'email' => trim($this->input->post('email')),
				    'password' => md5($this->input->post('password')),
				  
				);
	
				// getting user info
				$user_info = $this->common_model->get('user',array('*'),$data_to_store);
				
				//echo '<pre>';
				//print_r($user_info);
				//exit;
				if(!empty($user_info))
				{
					if($user_info[0]['type'] == 'T')
					{
						if($user_info[0]['status'] == 'N')
						{
						    $this->session->set_flashdata("flash_message",'user_block');
						    delete_cookie("email");
						    redirect('home');
						}
						else
						{
							$email = $data_to_store['email'];
							
							$this->session->set_flashdata("flash_message",'user_logedin');
			
							$user_id = $user_info[0]['id'];
							// creation session
							$data = array(
							    'site_user_id' => $user_id,
							    'email' => $this->input->post('email'),
							    'is_site_logged_in' => true
							);
							$this->session->set_userdata($data);
							
							
							/*------------------------------------ for remember me start -------------------------------*/
							
							if ( $this->input->post( 'remember_me' ) )
							{
							    
							    $cookie = array(
								'name'   => 'email',
								'value'   => $data_to_store['email'],
								'expire' => time() + 365 * 24 * 60 * 60,  // Two weeks
							    );
				
							    $this->input->set_cookie($cookie);
							    
							    $cookie = array(
								'name'   => 'password',
								'value'   => $data_to_store['password'],
								'expire' => time() + 365 * 24 * 60 * 60,  // Two weeks
							    );
				
							    $this->input->set_cookie($cookie);
							    
							    //var_dump($this->input->cookie('email', true)); 
							    //echo $this->input->cookie('email');
							    //echo $this->input->cookie('password');
							    //exit;
							}
							else
							{
							    delete_cookie("email");
							}
							
							
							/*------------------------------------for remember me end ---------------------------------*/
			
							redirect('dashboard');
						}
					}
					else{
						$this->session->set_flashdata("flash_message",'not_trainer');
						redirect('');
					}
					
				}
				else{
	
					$this->session->set_flashdata("flash_message",'user_not_loged');
	    
					redirect('');
				}
		
			}
			   
		}
		redirect('');
	}
	public function logout()
	{
		// destroying site session
		delete_cookie("email");
		
		// creation session
		$data = array(
		    'site_user_id' => '',
		    'email' => '',
		    'is_site_logged_in' => false
		);
		$this->session->set_userdata($data);
		
		$this->session->set_flashdata("flash_message",'user_loged_out');
	    
		redirect('');
	}
	
	
	public function verify_app_login()
	{
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'GET')
		{
			
				$data_to_store = array(
				    'email' => $this->input->get('email'),
				    'password' => md5($this->input->get('password')),
				  
				);
	
				// getting user info
				$user_info = $this->common_model->get('user',array('*'),$data_to_store);
				
				//echo '<pre>';
				
				//exit;
				if(!empty($user_info))
				{
					if($user_info[0]['type'] == 'C')
					{
						if($user_info[0]['status'] == 'N')
						{
							$data['response'] = 'error';
							$data['message'] = 'Your account is blocked';
						   
						}
						else
						{
							$email = $data_to_store['email'];
							
							
			
							$user_id = $user_info[0]['id'];
							// creation session
						
							
							/*------------------------------------ for remember me start -------------------------------*/
							
							if ( $this->input->get( 'remember_me' ) )
							{
							    $data = array(
								'site_user_id' => $user_id,
								'email' => $this->input->get('email'),
								'is_site_logged_in' => true,
								'cookie_name_email'   => 'email',
								'cookie_value_email'   => $data_to_store['email'],
								'cookie_expire_email' => time() + 365 * 24 * 60 * 60,  // Two weeks,
								'cookie_name_pwd'   => 'password',
								'cookie_value_pwd'   => $data_to_store['password'],
								'cookie_expire_pwd' => time() + 365 * 24 * 60 * 60,  // Two weeks
							    );
							    
							
							}
							else
							{
								$data = array(
								'site_user_id' => $user_id,
								'email' => $this->input->get('email'),
								'is_site_logged_in' => true,
								'cookie_name_email'   => '',
								'cookie_value_email'   => '',
								'cookie_expire_email' => '0',  // Two weeks
								'cookie_name_pwd'   => '',
								'cookie_value_pwd'   => '',
								'cookie_expire_pwd' => '0',  // Two weeks
							    );
							    
							}
							$data['response'] = 'success';
							$data['message'] = 'You have been logged in to account';
							
							
						}
					}
					else{
						$data['response'] = 'Error';
						$data['message'] = 'You are not a client';
					}
					
				}
				else{
	
					$data['response'] = 'Error';
					$data['message'] = 'You are not a valid user';
				}
		
			echo $jsonhtml=json_encode($data);
			   
		}
		
	}

}