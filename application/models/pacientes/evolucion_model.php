<?php
class Evolucion_model extends CI_Model{
    function insert_evol_pac($pac_id,$trat_num,$evo_fch,$evo_des,$evo_pro_fch,$evo_pro_des){
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
                INSERT INTO evolucion(evo_act_fch, evo_act_des, evo_pro_acti_fch, evo_pro_acti_des, evo_pac_id, evo_trat_num, evo_fch_reg)
                VALUES ('$evo_fch', '$evo_des', '$evo_pro_fch', '$evo_pro_des', $pac_id, $trat_num, '".date('d/m/Y')."');
        ");

       if($insert){           
           return true; 
       }else{
           return FALSE;
       }
    }
}
