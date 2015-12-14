<?php
class Common_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Update password
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function add($table,$data)
    {
	$this->db->insert($table, $data);
	$report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0)
	{
	    return $this->db->insert_id();
	}
	else
	{
	    return 0;
	}
    }
    
    function update($table,$data,$condition=null)
    {
	if(isset($condition))
	{
	    foreach ($condition as $key => $value)
	    {
		$this->db->where($key,$value);
	    }
	}
	$this->db->update($table, $data);
	//echo $this->db->last_query();
	//exit;
	$report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	if($report !== 0)
	{
	    return true;
	}else{
	    return false;
	}
    }
	

    
    public function get($table,$what=null,$condition=null,$like_val = null,$like_key=null,$limit_start=null, $limit_end=null,$group=null,$condition1=null,$order_in='id',$order_by='desc')
    {
	if(isset($what))
	{
	    foreach ($what as $key => $value){
		$this->db->select($value);
	    }
	}
	else
	{
	    $this->db->select('*');
	}
	$this->db->from($table);
	if(isset($condition))
	{
	    foreach ($condition as $key => $value)
	    {
		$this->db->where($key,$value);
	    }
	}
	if(isset($condition1))
	{
	    $this->db->where($condition1);
	}
	if(isset($like_val) && isset($like_key))
	{
	    $this->db->like($like_key, $like_val); 
	}
	if($limit_start != null)
	{
            $this->db->limit($limit_start, $limit_end);    
        }
	if($group != null)
	{
            $this->db->group_by($group);
        }
	$this->db->order_by($order_in,$order_by);
	$query = $this->db->get();
	//echo $this->db->last_query();
 	//echo $this->db->last_query();
	return $query->result_array(); 
    }
    function count($table,$condition=null,$like_val = null,$like_key=null,$limit_start=null, $limit_end=null)
    {
        // count total category
        
        $this->db->select('*');
        $this->db->from($table);
	if(isset($condition))
	{
	    foreach ($condition as $key => $value){
		$this->db->where($key,$value);
	    }
	}
	if(isset($like_val) && isset($like_key))
	{
	    $this->db->like($like_key, $like_val); 
	}
	if($limit_start != null)
	{
            $this->db->limit($limit_start, $limit_end);    
        }
        $query = $this->db->get();
	
        return $query->num_rows();        
    }
    function delete($table,$condition=null)
    {
        if(isset($condition))
	{
	    foreach ($condition as $key => $value){
		$this->db->where($key,$value);
	    }
	}
        $this->db->delete($table);
        return true;
    }
    
    function get_clients($trainer_id)
    {
	
	$this->db->select('shared_clients.trainer_id,shared_clients.client_id, user.*');
        $this->db->from('shared_clients');
	$this->db->join('user', 'user.id = shared_clients.client_id');
	
	$this->db->where('shared_clients.trainer_id',$trainer_id);
	$this->db->where('user.status','Y');
	$this->db->where('user.deleted_status','N');
	$project = $this->db->get();
	return $project->result_array();
    }
    
    function get_before_1month()
    {
	
	$user = $this->db->query("SELECT * FROM `user` WHERE NOW() >= DATE_SUB(`expiry_date`,INTERVAL 1 MONTH) and `type`='T' and `user_mode`='T' and `status`='Y' and `deleted_status`='N'");
	return $user->result_array();
    }
    
    function get_on_expire()
    {
	
	$user = $this->db->query("SELECT * FROM `user` WHERE `expiry_date` = '".date('Y-m-d')."' and `type`='T' and `status`='Y' and `deleted_status`='N'");
	return $user->result_array();
    }
}
?>