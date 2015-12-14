<?php
class Report_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get page by it's id
    * @param int $product_id 
    * @return array
    */
    
    public function get($condition=null,$condition1=null,$limit_start=null, $limit_end=null,$search_string=null, $order=null, $order_type='Desc')
    {
        $this->db->select('*');
        $this->db->from('report');
        if(isset($condition)){
	    foreach ($condition as $key => $value){
		$this->db->where($key,$value);
	    }
	}
	else if(isset($condition1)){
	    foreach ($condition1 as $key => $value){
		$this->db->or_where($key,$value);
	    }
	}
	if($limit_start != null){
            $this->db->limit($limit_start, $limit_end);    
        }
	if($search_string){
	    $this->db->like('title', $search_string);
	}
	$this->db->group_by('id');

	if($order){
	    $this->db->order_by($order, $order_type);
	}else{
	    $this->db->order_by('id', $order_type);
	}
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function add($data)
    {
        $this->db->insert('report',$data);
        $report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    echo "not";
	    die;
	    return false;
	}
    }
    

    function count($condition=null,$condition1=null,$limit_start=null, $limit_end=null)
    {
        // count total category
        
        $this->db->select('*');
        $this->db->from('report');
	if(isset($condition)){
	    foreach ($condition as $key => $value){
		$this->db->where($key,$value);
	    }
	}
	else if(isset($condition1)){
	    foreach ($condition1 as $key => $value){
		$this->db->or_where($key,$value);
	    }
	}
	if($limit_start != null){
            $this->db->limit($limit_start, $limit_end);    
        }
        $query = $this->db->get();
        return $query->num_rows();        
    }
    

    

    
    public function update($data,$condition=null)
    {
        
	if(isset($condition)){
	    foreach ($condition as $key => $value){
		$this->db->where($key,$value);
	    }
	}
	$this->db->update('report',$data);
        $report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    return false;
	}
    }
    

    
    // To Delete the Users
    function delete($condition=null)
    {
        
	if(isset($condition)){
	    foreach ($condition as $key => $value){
		$this->db->where($key,$value);
	    }
	}
	$this->db->delete('report');
	//echo $this->db->last_query();
	//exit;
        $report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0){
	    return true;
	}else{
	    return false;
	}
    }
    
}
?>