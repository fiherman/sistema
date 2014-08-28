<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

    public function __construct() {
        session_start();
        parent::__construct();            
        
    }

    public function index() {  
        if(isset($_SESSION['username'])){
            redirect('principal');
        }else{
            $this->load->view('login_view');
        }
    }

//    function registro() {
//        $this->load->view('registro_view');
//    }
//
//    function login_verificar($usu) {
//        header('Content-type: application/json');
//        $sql=$this->prueba_model->get_user($usu);
//        $Lista = new stdClass();      
//        $Lista->usuario = trim($sql->usuario);        
//        echo json_encode($Lista);
//    }
//    function get_user_pass($usu,$pass) {
//        header('Content-type: application/json');
//        $sql=$this->prueba_model->get_user($usu,$pass);
//        $Lista = new stdClass();      
//        $Lista->usuario = trim($sql->usuario);        
//        $Lista->cpassword = trim($sql->cpassword);   
//        $Lista->nom_com = trim($sql->nom_com); 
//        $Lista->consul = trim($sql->consul);        
//        echo json_encode($Lista);
//    }
//    function login_session($usu,$pass,$nom_com,$consul) {
//       
//        $_SESSION['username']=$usu;        
//        $_SESSION['password']=$pass;        
//        $_SESSION['nom_com']=str_replace('%20', ' ', $nom_com);
//        $_SESSION['consul']=$consul;
////        echo json_encode($usu);
//    }
    
//    public function logout(){
//        session_destroy();
//        redirect(base_url());
//    }
//    

}
