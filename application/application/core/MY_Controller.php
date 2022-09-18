<?php 

class MY_Controller extends CI_Controller{

    function __construct() {
        parent::__construct();
        
        if(!$this->session->userdata('loggedIn')){
            $currentURL = current_url();
            $params   = $_SERVER['QUERY_STRING'];
            if($params!=null)
                $fullURL = $currentURL . '?' . $params; 
            else
                $fullURL = $currentURL;
            $this->session->set_userdata('previous_url', $fullURL); 
            redirect('login');
        }
    }
}
?>