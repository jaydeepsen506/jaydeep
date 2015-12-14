<?php
class Mod_exercise extends CI_Model {
 
   public function __construct(){
        $this->load->database();
    }
    
   public function exercise_list(){
        $this->db->select('*');
	$this->db->from('exercise_list');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
   
   public function img_name($meal_id)
  { 
      $this->db->select("*");
	$this->db->from('meal');
	$this->db->where('id',$meal_id);
      $query = $this->db->get();
      return $query->result_array();

   }
    public function video_name($id)
  { 
      $this->db->select("*");
	$this->db->from('exercise_list');
	$this->db->where('id',$id);
      $query = $this->db->get();
      return $query->result_array();

   }
   
   public function getby($id)
    {
	$this->db->select('*');
	$this->db->from('exercise_list');
	$this->db->where('id',$id);
	$query=$this->db->get();
	//echo $this->db->last_query();die();
	return $query->result_array();
	
	
    }
      public function getbyid($id)
    {
	$this->db->select('*');
	$this->db->from('exercise_list');
	$this->db->where('id',$id);
	$query=$this->db->get();
	//echo $this->db->last_query();die();
	return $query->result_array();
   }
    public function fetch_video($id)
    {
	$this->db->select('*');
	$this->db->from('exercise_list');
	$this->db->where('id',$id);
	$query=$this->db->get();
	//echo $this->db->last_query();die();
	return $query->result_array();
   }
        
    
      
        
    
   
    }
?>