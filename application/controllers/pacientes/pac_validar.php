
<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pac_validar extends CI_Controller {
    function __construct() {
        
        parent::__construct();
        session_start();
    } 

    function index(){        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('nombre','nombre','trim|required');
            $this->form_validation->set_rules('apellidos','apellido','trim|required');
            $this->form_validation->set_rules('direccion','direccion','trim|required');
            $this->form_validation->set_rules('dni','dni','trim|required|numeric');
            $this->form_validation->set_rules('distrito','distrito','trim|required');
            $this->form_validation->set_rules('sexo','sexo','trim|required');
            $this->form_validation->set_rules('fchnac','fecha nacimiento','trim|required');
            $this->form_validation->set_rules('telefono','telefono','trim');
            $this->form_validation->set_rules('movistar','movistar','trim');
            $this->form_validation->set_rules('claro','claro','trim');
            $this->form_validation->set_rules('email','emial','trim|required');
            $this->form_validation->set_rules('dependiente','dependiente','trim');
            $this->form_validation->set_rules('seguro','seguro','trim');         
            if($this->form_validation->run() == FALSE)
            {       
//                redirect('pacientes/registro');
                $this->load->view('menu_top_view');  
                $this->load->view('pacientes/pacientes_reg_view');
                $this->load->view('footer_view');                            
            }
            else
            {          
               
                $nom = utf8_decode(strtoupper($this->input->post('nombre')));
                $ape = utf8_decode(strtoupper($this->input->post('apellidos')));
                $direc = utf8_decode(strtoupper($this->input->post('direccion')));
                $dni = $this->input->post('dni');
                $distri = utf8_decode(strtoupper($this->input->post('distrito')));
                $sexo = $this->input->post('sexo');
                $fchnac = $this->input->post('fchnac');
                $tel = $this->input->post('telefono');
                $movi = $this->input->post('movistar');
                $claro = $this->input->post('claro');
                $email = utf8_decode($this->input->post('email'));
                $depen = utf8_decode(strtoupper($this->input->post('dependiente')));
                $seg = utf8_decode(strtoupper($this->input->post('seguro')));
                
//                echo date('d/m/Y');
//                echo $nom.'<br>',$ape.'<br>',  $direc.'<br>',$dni.'<br>',$distri.'<br>',$sexo.'<br>',$fchnac.'<br>',$tel.'<br>',$movi.'<br>',$claro.'<br>',$email.'<br>',$depen.'<br>',$seg;
//                $this->load->model('pacientes/pacientes_model');
                $result = $this->pacientes_model->insert_pacientes($nom,$ape,$direc,$dni,$distri,$sexo,$fchnac,$tel,$movi,$claro,$email,$depen,$seg);
                if($result){
                    redirect('pacientes/registro');
                }else{ echo 'mal'; }              
            }
       
    }   
    function ins(){
                
            $nom=utf8_decode(strtoupper($_GET['nombre']));
            $ape=utf8_decode(strtoupper($_GET['apellidos']));
            $direc=utf8_decode(strtoupper($_GET['direccion']));
            $dni=$_GET['dni'];
            $distri=utf8_decode(strtoupper($_GET['distrito']));
            $sexo=strtoupper($_GET['sexo']);
            $fchnac=$_GET['fchnac'];
            $tel = $_GET['telefono'];
            $movi = $_GET['movistar'];
            $claro = $_GET['claro'];
            $email=utf8_decode($_GET['email']);
            $depen=utf8_decode(strtoupper($_GET['dependiente']));
            $seg=utf8_decode(strtoupper($_GET['seguro']));
            
//            echo $nom,$ape,$direc,$dni,$distri,$sexo,$fchnac,$tel,$movi,$claro,$email,$depen,$seg;
//            echo uc_latin1($direc);
//            $this->load->model('pacientes/pacientes_model');
//            $result = $this->pacientes_model->insert_pacientes($nom,$ape,$direc,$dni,$distri,$sexo,$fchnac,$tel=null,$movi=null,$claro=null,$email,$depen=null,$seg=null);
//            if($result){
//                redirect('pacientes/registro');
//            }else{ echo 'mal'; }  
    }
    
}