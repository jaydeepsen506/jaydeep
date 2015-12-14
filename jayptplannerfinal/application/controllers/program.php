<?php
class Program extends CI_Controller
{
    const VIEW_FOLDER = 'admin/program/';
    
 public function __construct()
	{
           
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->model('program_model');
		$this->load->database();
		
		
	}
    public function index()
        {	
	   $data['all_data']=$this->program_model->booking_list();
           //print_r($data['all_data']);die;
	    $data['view_link'] = 'admin/program/program_list';
	    $this->load->view('includes/template', $data);
	    
        }
  
      public function edit()
   {
        $id= $this->uri->segment(4);
        $r=$this->meal_model->edit($id);
        return $r;
    }
    
      public function program_details()
    {
        $id = $this->uri->segment(3); 
        $data['all_data'] = $this->program_model->getby($id);
	//print_r($data['all_data']);die;
        $data['view_link'] = 'admin/program/program_default_list';
	$this->load->view('includes/template', $data);
	
    }
    
   
   

    
 
}

?>
