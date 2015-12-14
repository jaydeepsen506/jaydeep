<?php
class Admin_chngpassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('chngpassword_model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('control/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        $data['view_link'] = 'admin/chngpassword_page';
       $this->load->view('includes/template', $data);

    }//index
	
    function __encrip_password($password) {
        return md5($password);
    }
	
    public function updt()
    {
		$this->load->library('form_validation');
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			//form validation
            $this->form_validation->set_rules('npass', 'New Password', 'trim|required|min_length[4]|max_length[32]');
	    $this->form_validation->set_rules('cpass', 'Confirm Password', 'trim|required|matches[npass]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');
		
	    if ($this->form_validation->run())
	    {
		    $data_to_store = array(
			'pass_word' => $this->__encrip_password($this->input->post('cpass'))
		    );
		    //if the insert has returned true then we show the flash message
		    
		    if($this->chngpassword_model->update_password($data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'pwd_updated');
		    }else{
			$this->session->set_flashdata('flash_message', 'pwd_not_updated');
		    }
		    redirect('control/chngpassword');
    
	    }
	    else
	    {
		redirect('control/chngpassword');
	    }
	}

    }

}