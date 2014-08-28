<?php

class Mycal extends CI_Controller{
    public function __construct() {
        session_start();
        parent::__construct();
        
    }
    function display($ano=NULL,$mes=NULL){
        if(!$ano){
            $ano= date('Y');
        }
        if(!$mes){
            $mes= date('m');
        }
        if($dia=  $this->input->post('dia')){
            $fecha=$dia.'/'.$mes.'/'.$ano;
            $this->mycal_model->set_calendar($fecha, $this->input->post('evento'));
        }
        $data['calendar']= $this->mycal_model->generate($ano,$mes);
        
        $this->load->view('menu_top_view');  
        $this->load->view('mycal_view',$data);             
        $this->load->view('footer_view');
        
        
        
    }
}

