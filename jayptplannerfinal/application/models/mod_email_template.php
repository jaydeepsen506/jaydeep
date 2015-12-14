<?php
class Mod_email_template extends CI_Model {

/**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }
    
    function count_template($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('email_template');
		if($search_string){
			$this->db->like('category', $search_string);
		}
		//if($order){
		//	$this->db->order_by($order, 'Asc');
		//}else{
		//    $this->db->order_by('id', 'Asc');
		//}
		$query = $this->db->get();
		return $query->num_rows();        
    }
    public function get_template($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('email_template');

		if($search_string){
			$this->db->like('category', $search_string);
		}
		$this->db->group_by('id');

		//if($order){
		//	$this->db->order_by($order, $order_type);
		//}else{
		//    $this->db->order_by('id', $order_type);
		//}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }
    
    
     public function get_template_by_id($id)
        {
            $this->db->select('*');
            $this->db->from('email_template');
            $this->db->where('id',$id);
            $subjects = $this->db->get();
            return $subjects->result_array();
            
        }
        
        public function update_template($data,$id)
        {
            //print_r($data);
            $this->db->where('id',$id);
            $query=$this->db->update('email_template',$data);
            if($query){
                return true;
            }else{
                return false;
            }
        }
        

   
    
}
?>