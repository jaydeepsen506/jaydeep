<?php
class prod_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
    }
    /*store related function*/
    function view_store()
    {
        $r= $this->db->query("select * from store");
        return $r->result_array();
    }
	function viewprod($a)
    {
        $r= $this->db->query("select *  from productimg where pid='$a'");
        return $r->result_array();
    }
	
    function ins_store()
    {
      $nm=$this->input->post('page_nm');
      $add=$this->input->post('page_add');
      $this->db->set('s_name', $nm);
      $this->db->set('s_add', $add);
      $this->db->insert('store'); 
      return true;                   
    }
   
	function multistoredel()
	{
		$chk=$this->input->post('PO_PowerWindows');
		
		$c=count($chk);
		for($i=0;$i<$c;$i++)
		{
			$q=$this->db->query("delete from store where s_id='$chk[$i]'");
		}
		if($q)
		{
			return true;
		}
	}
    function updateshow($a)
    {
        $q=$this->db->query("select * from store where s_id='$a'");
        $r=$q->row();
        return $r;
    }
    function update($a)
    {
        $nm=$this->input->post('page_nm');
        $add=$this->input->post('page_add');
		$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($add) . '&sensor=true');
		$coordinates = json_decode($coordinates);
					 
		$la=$coordinates->results[0]->geometry->location->lat;
		$lat=number_format($la, 6);
		$lon= $coordinates->results[0]->geometry->location->lng;
		$long=number_format($lon, 6);
        $data = array(
               's_name' => $nm,
               's_add' => $add,
               'lat' => $lat,
			   'long'=>$long
            );

       $this->db->where('s_id', $a);
       $this->db->update('store', $data); 
        return true;
    }
    public function fetch_map($id){
		$this->db->where('s_id', $id);
		$sql=$this->db->get('store');
		if($sql){
			return $sql->row_array();
		}
		
	}
	 public function store_insert()
	 {
		        $nm=$this->input->post('page_nm');
				$add=$this->input->post('page_add');
			    
				$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($add) . '&sensor=true');
				$coordinates = json_decode($coordinates);
					 
				$la=$coordinates->results[0]->geometry->location->lat;
				$lat=number_format($la, 6);
				$lon= $coordinates->results[0]->geometry->location->lng;
				$long=number_format($lon, 6);
				//echo "<br>".$lat."<br>".$long;
				$pos=$lat.", ".$long;
				$data=array(
					's_id'=>'',
					's_name'=>$nm,
					's_add'=>$add,
					'lat'=>$lat,
					'long'=>$long
				);
        $sql=$this->db->insert('store',$data);
        if($sql){
            return true;
        }
	 }	
    /*product related function*/
     function view_prod()
    {
       
        $r=$this->db->query("select * from store as s,product as p where s.s_id=p.s_id ");
        return $r->result_array();
    }
	function dis_store()
    {
        $this->db->select('*')->from('store');
        $r=$this->db->get();
        return $r->result_array();
    }
    function insprod($ar)
    {
        	 $name=$this->input->post('name');
             $status=$this->input->post('status');
			 $sid=$this->input->post('store');
		     $this->db->query("insert into product values('','$name','$status','$sid')");
			 $id=mysql_insert_id();
			 		 
			 /* multiple upload and insert*/
			  $j = 0;     // Variable for indexing uploaded image.
		      $target_path = $_SERVER['DOCUMENT_ROOT']."/jayptplanner22/uploads/";     // Declaring Path for uploaded images.
		    // echo $target_path;
			// die;
		   for ($i = 0; $i < $ar; $i++)
		   {
			  // $file_name="";
		      //$file_part1 = '';
			// Loop to get individual element from the array
			  $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
			  $ext = explode('.', $_FILES['file']['name'][$i]);   // Explode file name from dot(.)
			 // $file_part1 = current($ext);
			  $file_extension = end($ext); // Store extensions in the variable.
			  
			  $file_name = md5(uniqid().time()). "." . $file_extension;

			 $target_path_new = $target_path.$file_name;     // Set the target path with a new name of image.
			  $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
			  if (($_FILES["file"]["size"][$i] < 100000) && in_array($file_extension, $validextensions))
			    {
				    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path_new))
					{
				             $this->db->query("insert into productimg values('','$file_name','$id','')");
			        }
			        else
			        {     //  If File Was Not Moved.
				       echo $j. ').<span id="error">please try again!.</span><br/><br/>';
			        }
	            }
	            else
	            {     //   If File Size And File Type Was Incorrect.
			       echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
	            }
				
	        }
             
             return true;
		 

        
    }
	function proeditshow($a)
	{
		$data_array = array();
		$q=$this->db->query("select * from product where pid='$a'");
		if($q->num_rows()>0){
			$q = $q->result();
			foreach($q[0] as $index=>$each_prod){
				$data_array[$index]=$each_prod;
			}
			//print_r($data_array);
			//die;
			$this->db->where('pid', $a);
			$product_image = $this->db->get('productimg');
			if($product_image->num_rows()>0){
				$product_image = $product_image->result();
				foreach($product_image as $count=>$each_image){
					$data_array['image'][$count]=$each_image->image;
				}
			}
			else{
				$data_array['image'] = array();
			}
		}
		/*echo "<pre>";
		print_r($data_array);
		echo "<pre>";
	    die;*/
		
		return $data_array;
	}
	function produpdate($pid)
	{
        $j=0;
		$name=$this->input->post('name');
        $status=$this->input->post('status');
		$data=array(
			'pname'=> $name,
			'status'=>$status,
		);
		$this->db->where('pid',$pid);
		$this->db->update('product',$data);
		$q=$this->db->query("select * from productimg where pid='$pid'");
		$c=$q->num_rows();
		$q2=$q->result_array();
	
	
			
		
		$target_path = $_SERVER['DOCUMENT_ROOT']."/jayptplanner22/uploads/";     // Declaring Path for uploaded images.
		   
		   for ($i = 0; $i < $c; $i++)
		   {
			 
			// Loop to get individual element from the array
			  $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
			  $ext = explode('.', $_FILES['file']['name'][$i]);   // Explode file name from dot(.)
			 // $file_part1 = current($ext);
			  $file_extension = end($ext); // Store extensions in the variable.
			  
			  $file_name = md5(uniqid().time()). "." . $file_extension;

			 $target_path_new = $target_path.$file_name;     // Set the target path with a new name of image.
			  $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
			  if (($_FILES["file"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions))
			    {
				    if($_FILES['file']['name'][$i]!='')
					{
				       move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path_new);
					   $id=$q2[$i]['id'];
					   $this->db->query("update productimg set image='$file_name' where id='$id'");
					}  
					
	            }
	            else
	            {     //   If File Size And File Type Was Incorrect.
			       echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
	            }
		   }
		  
        return true;
		
	}
	 function prodelete()
    {
		$pid=$this->input->post('data');
        $r=$this->db->query("delete from product where pid='$pid'");
		if($r)
		{
			  $this->db->query("delete from productimg  where pid='$pid'");
		}
        return true;
    }
	function imgdelete()
	{
		$id=$this->input->post('data');
        $r=$this->db->query("delete from productimg where id='$id'");
		return true;
	}
	function gallery()
	{
		$q=$this->db->query("select * from productimg where status=0");
       	$r=$q->result();
        return $r;
	}

	
}
?>
