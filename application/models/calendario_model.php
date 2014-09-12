<?php
class calendario_model extends CI_Model{
    function get_agendas_para_el_publico($ide_per,$ano_eje)
    {
        return $this->db->query("
            select a.ide_not,a.ide_age,a.fch_ini,a.fch_fin,a.fch_reg,b.des_not,b.user_id,c.nom_com FROM agenda a 
            LEFT JOIN agenda_notas b 
            on a.ide_not = b.ide_not 
            LEFT JOIN usuarios c 
            ON b.user_id = c.user_id 
            where b.user_id =$ide_per  and a.ano_eje = '$ano_eje' and a.flg_pbl = 1
        ")->result();
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

