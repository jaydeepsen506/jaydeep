<?php
class Progress_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct(){
        $this->load->database();
    }
    
    public function get_client_current_image($client_id)
    {
        $this->db->select('*');
        $this->db->from('client_current_images');
        $this->db->where('client_id',$client_id);
        $this->db->order_by('id','DESC');
        $this->db->limit(1,0);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function get_client_goal_image($client_id){
                
        $this->db->select('*');
        $this->db->from('client_goal_images');
        $this->db->where('client_id',$client_id);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function get_first_axis_vals($graph_id){
        
        $this->db->select('*');
        $this->db->from('user_graph_points');
        $this->db->where('graph_id',$graph_id);
        $this->db->order_by('id','ASC');
        $this->db->limit(1,0);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    
    public function get_last_graph_vals($graph_id){
        
        $this->db->select('*');
        $this->db->from('user_graph_points');
        $this->db->where('graph_id',$graph_id);
        $this->db->order_by('id','DESC');
        $this->db->limit(1,0);
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
}
?>