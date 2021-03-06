<?php
class Booking_model extends CI_Model {
 
    public function __construct(){
        $this->load->database();
    }
    
    public function booking_list(){
        $this->db->select('*');
	$this->db->from('user_booking');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function getbyid($id)
    {
	$this->db->select('*');
	$this->db->from('meal_other_options');
	$this->db->where('meal_id',$id);
	$query=$this->db->get();
	//echo $this->db->last_query();die();
	return $query->result_array();
	
	
    }
       public function getby($id)
    {
	$this->db->select('*');
	$this->db->from('meal_images');
	$this->db->where('meal_id',$id);
	$query=$this->db->get();
	//echo $this->db->last_query();die();
	return $query->result_array();
	
	
    }
     public function meal_name($meal_id)
    { 
       $this->db->select("*");
	$this->db->from('meal');
	$this->db->where('id',$meal_id);
        $query = $this->db->get();
        return $query->result_array();

    }
   public function img_name($meal_id)
  { 
      $this->db->select("*");
	$this->db->from('meal');
	$this->db->where('id',$meal_id);
      $query = $this->db->get();
      return $query->result_array();

   }
      public function get()
    { 
        $this->db->select('meal_other_options.*');
        $this->db->select('meal.title');
        $this->db->from('meal_other_options');
	$this->db->join('meal', 'meal_other_options.id = meal_other_options.meal_id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
       public function trainer_name($trainer_id)
    {
	$this->db->select("*");
	$this->db->from('user');
	$this->db->where('id',$trainer_id);
	$qry=$this->db->get();
	return $qry->result_array();
	
    }
        public function trainer_name1($client_id)
    {
	$this->db->select("*");
	$this->db->from('user');
	$this->db->where('id',$client_id);
	$qry=$this->db->get();
	return $qry->result_array();
	
    }
        public function trainer_name2($booked_by)
    {
	$this->db->select("*");
	$this->db->from('user');
	$this->db->where('id',$booked_by);
	$qry=$this->db->get();
	return $qry->result_array();
	
    }
            public function trainer_name3($program_id)
    {
	$this->db->select("*");
	$this->db->from('program_list');
	$this->db->where('id',$program_id);
	$qry=$this->db->get();
	return $qry->result_array();
	
    }
        
    
      
        
    
   
    }
?>