<?php
class Page_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_page_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch manufacturers data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_pages($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('pages');

		if($search_string){
			$this->db->like('page_title', $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_pages($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('pages');
		if($search_string){
			$this->db->like('page_title', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_page($data)
    {
		//$this->db->where('page_alias', $data['page_alias']);
		//$query = $this->db->get('pages');
		
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('page_title', $data['page_title']);
		$query = $this->db->get();
		
		
		//echo $query->num_rows;
		//die;

		if($query->num_rows > 0)
		{
			/*echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			echo "Page Already Exists";	
			echo '</strong></div>';*/
		}
		else
		{
			 $this->db->insert('pages', $data);
			$insert = $this->db->insert_id();
			
			
			return $insert;
		}
    }
    
    function insert_lang_content($data,$table_name)
    {
		$this->db->insert($table_name, $data);
		$insert = $this->db->insert_id();
		
		return $insert;
    }

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_page($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('pages', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete manufacturer
    * @param int $id - manufacture id
    * @return boolean
    */
	function delete_page($id){
		$this->db->where('id', $id);
		$this->db->delete('pages'); 
	}
	
	function get_langcontent($id,$lang_id)
	{
	    	$this->db->select('*');
		$this->db->from('lang_content');
		$this->db->where('contentid', $id);
		$this->db->where('langid', $lang_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function update_page_lang($content,$id)
	{
	      $data=array(
			  'value' => $content
			  ); 
	    
	      $this->db->where('id', $id);
	      $this->db->update('lang_content', $data);
	      return true;
	}
	
	function getall_langs()
	{
		$this->db->select('*');
		$this->db->from('languageinfo');
		$this->db->where('status', 'Y');
		//$this->db->where('default_status', 'N');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function fetch_all_langs()
	{
	        $this->db->select('*');
		$this->db->from('languageinfo');
		$this->db->where('default_status', 'N');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
 
}
?>