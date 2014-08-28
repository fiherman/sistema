<?php
class prueba_model extends CI_Model{
    function get_user($usu){
	 return @$this->db->query("select * from usuarios where usuario='$usu'")->result()[0];
       
    }
    
    function get_user_pass($usu,$pass){
	 return @$this->db->query("select * from usuarios where usuario='$usu' and cpassword='$pass'")->result()[0];
       
    }
}
