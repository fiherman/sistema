<?php
class Admin_model extends CI_Model{
   
    function __construct() {
        parent::__construct();
    }

    function verify_user($user,$pass){
	 $q = $this
              ->db
              ->where('usuario',$user)
              ->where('ccpassword',  md5($pass))
              ->limit(1)
              ->get('usuarios');
         if($q->num_rows>0){
             return $q->row();
//             echo '<pre>';
//             print_r($q->row());
//             echo '</pre>';
             
         }
         return false;
    }
    
    function get_master_login($user,$pass){
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from usuarios where usuario='$user' and ccpassword=md5('$pass')")->result()[0];
    }
}
