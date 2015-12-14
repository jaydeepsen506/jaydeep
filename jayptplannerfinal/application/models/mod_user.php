<?php
class Mod_user extends CI_Model
{
 
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
    public function get_user($field=null, $value=null)
    {
        $this->db->select('*');
        $this->db->from('user');
        if($field && $value){
            $this->db->where($field,$value);
        }
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_stat_data($table,$condition)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
	
//	echo $this->db->last_query();
//        exit;
        return $query->result_array();
    }
    public function get_user_list($limit_start=null, $limit_end=null)
    {
        $this->db->select('*');
        $this->db->from('user');
        if($limit_start && $limit_end){
            $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
            $this->db->limit($limit_start, $limit_end);    
        }
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user_by_name($name)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->like('name', $name);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user_by_email($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user_by_email_username($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
	$this->db->where_or('username', $email);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('user');
         $this->db->where('id',$id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_subscription_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id',$id);
        $this->db->where('subscription_status','Y');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user_details($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id',$id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_user_by_forget_code($code)
    {
        $this->db->select('*');
        $this->db->from('user');
	$this->db->where('forget_id',$code);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function update_user_details($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        
        if($report !== 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function update_user_details_by_email($email,$data)
    {
        $this->db->where('email', $email);
        $this->db->update('user', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function update_status_by_code($data){
        $this->db->where('code', $data['code']);
        $data['code'] = '';
        $this->db->update('user', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        
        if($report !== 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function del_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
	
	$this->db->where('user_id', $id);
        $this->db->delete('matrimony');
	
	$this->db->where('profile_id', $id);
        $this->db->delete('view_relation');
	
	$this->db->where('viewer_id', $id);
        $this->db->delete('view_relation');
	
        return TRUE;
    }
    public function save_user($data)
    {
	$insert = $this->db->insert('user', $data);
	return $insert;
    }
    function login_verify($data)
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('(email = "'.$data['username'].'" or username = "'.$data['username'].'")');
        $this->db->where('password',$data['pwd']);
	$query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
	//return $query->num_rows();
	return $query->result_array();
    }
    
    function email_verify($data)
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('email',$data['email']);
	$query = $this->db->get();
	return $query->num_rows();
    }
    
    function username_verify($data)
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('username',$data['username']);
	$query = $this->db->get();
	return $query->num_rows();
    }
    
    function email_verify_except_own($data)
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('email',$data['email']);
        $this->db->where('id !=',$data['user_id']);
	$query = $this->db->get();
	return $query->num_rows();
    }
    
    function username_verify_except_own($data)
    {
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('username',$data['username']);
        $this->db->where('id !=',$data['user_id']);
	$query = $this->db->get();
	return $query->num_rows();
    }
    
    function status_verify($data){
        $this->db->select('*');
	$this->db->from('user');
	$this->db->where('email',$data['email']);
        $this->db->where('status','Y');
	$query = $this->db->get();
	return $query->num_rows();
    }
    function count($field=null,$value=null)
    {
        // count total category
        
        $this->db->select('*');
        $this->db->from('user');
	if($field != null && $value != null){
	    $this->db->where($field,$value);
	}
        
        $query = $this->db->get();
        return $query->num_rows();        
    }
    function count_search($data)
    {
        // count total category
        
        $this->db->select('*');
        $this->db->from('user');
	if(isset($data)){
	    $this->db->like('email',$data);
	    
	}
        
        $query = $this->db->get();
        return $query->num_rows();        
    }
    
    function search_user($limit_start=null, $limit_end=null,$data)
    {
        // fetch all data from database with or without pagination
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->group_by('id');
        if($limit_start && $limit_end){
            $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
            $this->db->limit($limit_start, $limit_end);    
        }
	if(isset($data)){
	    $this->db->like('email',$data);
	}
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    function search_user_by_id($id)
    {
        // fetch all data from database with or without pagination
        
        $this->db->select('*');
        $this->db->from('user');
        $this->db->group_by('gender');
        
	if(isset($id)){
	    $this->db->like('gender',$id);
	}
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    function count_by_id($id)
    {
	$this->db->select('*');
        $this->db->from('matching_algo');
	
	if(isset($id)){
	    $this->db->like('female_id',$id);
	   
	}
        
        $query = $this->db->get();
        return $query->num_rows();   
    }
    /*------------------------------------------- visitor stat -------------------------------------------*/
    
    public function insert_ip($data)
    {
	$insert = $this->db->insert('visitor_log', $data);
	return $insert;
    }
    
    function get_visitor_by_ip($ip)
    {
        $this->db->select('*');
	$this->db->where('ip',$ip);
        $this->db->from('visitor_log');
        $query = $this->db->get();
	return $query->result();
    
    }
    
    function get_total_user()
    {
        $this->db->select('id');
        $this->db->from('user');
        $query = $this->db->get();
	return $query->result();
    
    }  
    
}




?>