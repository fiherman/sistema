<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panel extends CI_Controller{
    public function __construct() {
        session_start();
        parent::__construct();
        
    }

    public function index(){
        if(!isset($_SESSION['username'])){
            redirect(base_url());
        }else{
            $this->load->view('menu_top_view');  
            $this->load->view('panel_view');            
//            $this->load->view('footer_view');  
//            echo '</body></html>';
        }
    }
}

