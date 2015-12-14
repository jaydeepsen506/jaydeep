<?php
class Home_model extends CI_Model {
 
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
		$this->db->from('homepage');
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
     public function add_homepage($data_to_store)
    {
	  $qr=$this->db->insert('home_page_management',$data_to_store);
	  return $qr;
    }
     public function find()
    {	
         $qr=$this->db->query("select * from home_page_management ");
         $r=$qr->result_array();
	return $r; 
    }
    
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
    
  

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_page($id, $data_to_store)
    {
		$this->db->where('id', $id);
		$this->db->update('home_page_management', $data_to_store);
		$report = array();
		print_r("$report");die;
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
		$this->db->delete('homepage'); 
	}
	


	
 
}
?>