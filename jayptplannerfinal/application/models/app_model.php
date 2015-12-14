<?php
class App_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_date_respective_client_diary_details($client_id,$date_val)
    {
        $this->db->select('*');
	$this->db->from('user_diary');
	$this->db->where('client_id',$client_id);
        $this->db->where('date_val',$date_val);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_date_respective_meal_details($client_id,$date_val){
	
	$this->db->select('*');
	$this->db->from('user_meal_dates');
	$this->db->where('client_id',$client_id);
        $this->db->where('workout_date',$date_val);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_marked_calender_exercise($client_id){
	
	$this->db->select('*');
	$this->db->from('user_program_exercises');
	$this->db->where('client_id',$client_id);
	$this->db->group_by('workout_date');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_marked_meal_dates($client_id){
	
	$this->db->select('*');
	$this->db->from('user_meal_dates');
	$this->db->where('client_id',$client_id);
	$this->db->group_by('workout_date');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_marked_diary($client_id){
	
	$this->db->select('*');
	$this->db->from('user_diary');
	$this->db->where('client_id',$client_id);
	$this->db->group_by('date_val');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    public function get_marked_appoinment($client_id){
	$this->db->select('*');
	$this->db->from('user_booking');
	$this->db->where('client_id',$client_id);
	$this->db->group_by('booked_date');
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
    public function get_trainer_by_date($date){
	
	$this->db->select('*');
	$this->db->from('trainer_avl_time_repeat_val');
        $this->db->join('user','user.id=trainer_avl_time_repeat_val.trainer_id');
	$this->db->where('trainer_avl_time_repeat_val.repeat_date',$date);
	$query = $this->db->get();
	$fetch=$query->result_array();
	return $fetch;
    }
    
}
?>