<?php
class Contactus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('contactsetting_model');
		$this->load->model('common_model');
	}
	function index()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$data_to_store['name'] = trim($this->input->post('contactname'));
			$data_to_store['email'] = trim($this->input->post('contactemail'));
			$data_to_store['message'] = trim(addslashes($this->input->post('contactmessage')));
		    
			
			//send mail
			
			$site_details = $this->sitesetting_model->get_settings();
			$contact_details = $this->contactsetting_model->get_settings();
			$system_mail = $site_details[0]['system_email'];
			$contact_mail = $contact_details[0]['contact_email'];
			
			$name = $data_to_store['name'];
			$mail = $data_to_store['email'];
			$message =
			'<title>Contact Us Mail</title>
			<table border="0" cellpadding="\" cellspacing="\">
				<tbody>
					<tr>
						<td colspan="\">Hello {USERNAME} ,</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="\">A new contact mail has been received from {SENDER}. Details given bellow.</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>User Name:- {SENDER}</td>
					</tr>
					<tr>
						<td>User Email:- {EMAIL}</td>
					</tr>
					<tr>
						<td>Message:- {MESSAGE}</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="\">Thanks &amp; Regards.<br />
						PT-Planner Team</td>
					</tr>
				</tbody>
			</table>';
			    
			$content=$message;
			$title='Contact Us Mail';
			$replace=array('{USERNAME}','{SENDER}','{EMAIL}','{MESSAGE}');
			$replace_with=array('Admin',$data_to_store['name'],$data_to_store['email'],$data_to_store['message']);
			$output=str_replace($replace,$replace_with,$content);
			$message= $output;
	
	
			$this->load->library('email');
	    
			$config['protocol'] = 'sendmail';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
	    
			$this->email->from($system_mail,'PT-Planner');
			$this->email->to($contact_mail);
			
			$this->email->subject($title);
			$this->email->message($message);	
			
			echo $result = $this->email->send();
			//mail
			if($result)
			{
			$this->session->set_flashdata('flash_data','contact_success');
			}
			else{
			    $this->session->set_flashdata('flash_data','contact_failed');
			}
		    
			//redirect('TailgateOxford/contactus');
			exit;
		}
		
	}
}