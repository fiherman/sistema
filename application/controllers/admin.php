
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct() {
        
        parent::__construct();
        session_start();
    }

    public function index(){        
       if(isset($_SESSION['username'])){
           redirect('principal', 'refresh');
       }else{
//        echo md5('123456'); die();       
//            $this->load->library('form_validation');
            $this->form_validation->set_rules('username','Usuario','required');
            $this->form_validation->set_rules('password','Contraseña','required|callback_check_database');        
            if($this->form_validation->run() == FALSE)
            {
                $this->load->view('login_view');                
//                redirect(base_url());
                
            }
            else
            {  
                redirect('principal', 'refresh');
                //$this->load->view('usuarios');
            }
       }
//        if($this->form_validation->run()!==false){
////            $this->load->model('admin_model');
//            $res=$this->admin_model->verify_user($this->input->post('username'),$this->input->post('password'));
//            if($res!==false){
//                $_SESSION['username']=$this->input->post('username');
//                redirect('principal/panel');
//            }else{
//                $this->form_validation->set_message('usuario o password invalidos');                
//            }
//        }
//        $this->load->view('login_view');
    }
    function check_database($password)
    {
	$username	 = strtoupper($this->input->post('username'));
	$result		 = $this->admin_model->verify_user(strtoupper($username), strtoupper($password));
	if($result)
	{  
            $master = $this->admin_model->get_master_login(strtoupper($username), strtoupper($password));
            
            $_SESSION['username'] = strtoupper($this->input->post('username'));
            $_SESSION['doctor'] = $master->nom_com;
            $_SESSION['password'] = trim($master->cpassword);
            redirect('principal');
            return TRUE;
	}
	else
	{   
	    $this->form_validation->set_message('check_database', 'usuario o password invalidos');
	    return false;
	}
    }
    public function logout(){
        session_destroy();
        redirect(base_url());
    }
    
}