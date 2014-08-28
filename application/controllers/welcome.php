<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
            session_start();
            parent::__construct();
            if(!isset($_SESSION['username'])){
                redirect('admin');
            }
        }

        public function index()
	{
                echo 'USUARIO: '.$_SESSION['username'];
		$this->load->view('welcome_message');
                echo '<br><a href='.base_url().'logout'.'>Salir</a>';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */