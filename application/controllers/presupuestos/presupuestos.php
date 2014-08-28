<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Presupuestos extends CI_Controller{
    public function __construct() {
        session_start();
        parent::__construct();
        
    }

    public function index(){
        if(!isset($_SESSION['username'])){
            redirect(base_url());
        }else{
//             $this->load->view('menu_top_view');  
//             $this->load->view('presupuestos/presupuestos_view');
            $str='ÑANDU';
            echo utf8_encode($str);
        }
        
        
    }
}
