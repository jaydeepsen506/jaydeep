<?php
class Booking extends CI_Controller
{
    const VIEW_FOLDER = 'admin/booking/';
    
 public function __construct()
	{
           
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->model('booking_model');
		$this->load->database();
		
		
	}
    public function index()
        {	
	   $data['all_data']=$this->booking_model->booking_list();
           //print_r($data['all_data']);die;
	    $data['view_link'] = 'admin/booking/booking_list';
	    $this->load->view('includes/template', $data);
	    
        }
  
      public function edit()
   {
        $id= $this->uri->segment(4);
        $r=$this->meal_model->edit($id);
        return $r;
    }
    
   

    
 
}

?>
