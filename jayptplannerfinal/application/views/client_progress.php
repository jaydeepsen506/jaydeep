<?php
class Client_progress extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//if(!$this->session->userdata('is_site_logged_in')){
		//	redirect('home');
		//}
		// load models
		$this->load->model('sitesetting_model');
		$this->load->model('contactsetting_model');
		$this->load->model('common_model');
		$this->load->model('network_model');
                $this->load->model('toolbox_model');
                //$this->load->model('progress_model');
	}
        
       	public function client_curr_image_upload()
	{
		$arr="";
                foreach ($_FILES["file"]["error"] as $key => $error){
			if ($error == UPLOAD_ERR_OK){
			  $time=time();  // time on creation
			  $random_num=rand(00,99);  // random number
			  $name = $time.$random_num; // avoid same file name collision
			if(move_uploaded_file( $_FILES["file"]["tmp_name"][$key], getcwd()."/client_current_images/" . $name))
			{
			//mysql_query("INSERT INTO images VALUES('','$name','$user_session_id','$time')");
			 $arr=$arr.$name.",";
			}
			else
			 {
			   echo "0";
			   exit;
			 }
	                 }
                }
                echo $arr;
	}
	
	public function add_client_current_image(){
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
	        {
		    echo $client_id=$this->input->post('client_id');
		    echo $uploaded_image=$this->input->post('uploaded_curr_image_name');
		}
	}
}
?>