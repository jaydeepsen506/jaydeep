<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class site_facebook_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('html','form','url'));
        $this->load->library('facebook');
    }
    public function index()
    {
        $user = $this->facebook->getUser();
         
         $this->load->view('facebook_view');
    }
    public function facebook()
    {
      
                    $user =  $this->facebook->getUser();
                    
                    if ($user)
                    {
                      try
                      {
                        // Proceed knowing you have a logged in user who's authenticated.
                        $user_profile = $this->facebook->api('/me');
                      }
                      catch (FacebookApiException $e)
                      {
                        error_log($e);
                        $user = null;
                      }
                    
                    
                    
                    
                    
                    
                        if (!empty($user_profile ))
                        {
                            # User info ok? Let's print it (Here we will be adding the login and registering routines)
                      
                            $username = $user_profile['name'];
                                             $uid = $user_profile['id'];
                                     $email = $user_profile['email'];
                            $user = new User();
                            $userdata = $user->checkUser($uid, 'facebook', $username,$email,$twitter_otoken,$twitter_otoken_secret);
                            if(!empty($userdata))
                            {
                                session_start();
                                $_SESSION['id'] = $userdata['id'];
                                $_SESSION['oauth_id'] = $uid;
                    
                                $_SESSION['username'] = $userdata['username'];
                                            $_SESSION['email'] = $email;
                                $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
                                header("Location: home.php");
                            }
                        }
                        else
                        {
                            # For testing purposes, if there was an error, let's kill the script
                            die("There was an error.");
                        }
                    }
                    else
                    {
                        # There's no active session, let's generate one
                            $login_url = $this->facebook->getLoginUrl(array( 'scope' => 'email'));
                        header("Location: " . $login_url);
                    }
           
             
            
            
    }






}
?>