<?php
class Toolbox_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct(){
        $this->load->database();
    }
    
    public function get_meals($trainer_id)
    {
        $this->db->select('*');
        $this->db->from('meal');
        $this->db->where('trainer_id',$trainer_id);
        $this->db->order_by('id','DESC');
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function get_meal_images($meal_id)
    {
        $this->db->select('*');
        $this->db->from('meal_images');
        $this->db->where('meal_id',$meal_id);
        $this->db->order_by('id');
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function get_meals_one_record($trainer_id)
    {
        $this->db->select('*');
        $this->db->from('meal');
        $this->db->where('trainer_id',$trainer_id);
        $this->db->order_by('id','DESC');
        $this->db->limit(1,0);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function get_programs($trainer_id)
    {
        $this->db->select('*');
        $this->db->from('program_list');
        $this->db->where('created_by',$trainer_id);
        $this->db->order_by('id','DESC');
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
}
?>