<?php
class Exercise extends CI_Controller
{
    const VIEW_FOLDER = 'admin/exercise/';
    
 public function __construct()
	{
           
		parent::__construct();
		$this->load->helper(array('html','form','url'));
		$this->load->model('mod_exercise');
		$this->load->database();
		
		
	}
    public function index()
        {	
	   $data['all_data']=$this->mod_exercise->exercise_list();
           $data['view_link'] = 'admin/exercise/exercise_list';
	    $this->load->view('includes/template', $data);
	    
        }
	
    public function exercise_options($id)
    {
        $id = $this->uri->segment(3);
        $data['data'] = $this->mod_exercise->getby($id);
        $data['view_link'] = 'admin/exercise/exercise_options';
	$this->load->view('includes/template', $data);
	
    }
    
     public function video_options($id)
    {
        $id = $this->uri->segment(3);
        $data['all_videos'] = $this->mod_exercise->getbyid($id);
        //print_r($data['all_videos']);die;
        $data['view_link'] = 'admin/exercise/video_list';
	$this->load->view('includes/template', $data);
	
    }
    public function video_search()
    {
	$id= $this->input->post('id');
	  $video = $this->mod_exercise->fetch_video($id);
	?>
    <iframe id="ytplayer" type="text/html" width="550" height="300" src="<?php echo $video[0]['video_path']; ?>"
frameborder="0"> </iframe>

	<?php
	
    }
  
    
}

?>
