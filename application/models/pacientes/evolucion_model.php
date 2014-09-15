<?php
class Evolucion_model extends CI_Model{
    function insert_evol_pac($evo_des,$evo_pro_des,$pac_id,$trat_num,$evo_act_fch,$evo_pro_acti_fch){
        
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
                INSERT INTO evolucion(evo_act_des,evo_pro_acti_des,evo_pac_id,evo_trat_num,evo_act_fch,evo_pro_acti_fch , evo_fch_reg)
                VALUES ('$evo_des', '$evo_pro_des', '$pac_id', '$trat_num', '$evo_act_fch', '$evo_pro_acti_fch','".date('d/m/Y')."');
        ");

       if($insert){
           date_default_timezone_set('America/Lima');
            $agenda_notas=$this->db->query("
               INSERT INTO agenda_notas(ide_per,des_not,ano_eje,fch_reg)
                values($pac_id,'$evo_pro_des','".date('Y')."','".date("d-m-Y H:i:s")."');
           ");
           $ide_not = $this->db->insert_id();
           
           $fch_fin = str_replace('/', '-', $evo_pro_acti_fch);
           $timestamp=strtotime($fch_fin);
           $fch_fin_1 = strtotime("+1 hour", $timestamp);
           $date= date('d/m/Y H:i:s', $fch_fin_1);
           
//           echo date("d/m/Y H:i:s");
           
//           echo date("a - A - g - h - G - H - i - s")." ";
//                       
//           print $evo_pro_acti_fch."  ";
//           print $fch_fin."  ";
//           print $timestamp."  ";
//           print $fch_fin_1."  ";
//           print $date."***";
           date_default_timezone_set('America/Lima');
           if($agenda_notas && $ide_not){               
                $agenda=$this->db->query("
                    INSERT INTO agenda(ide_not,fch_ini,fch_fin,fch_reg,ano_eje,flg_pbl)values
                     ($ide_not,'$evo_pro_acti_fch','$date','".date("d-m-Y H:i:s")."','".date('Y')."',1)
                ");
                if($agenda){
                    return true; 
                }                
           }  
       }else{
           return FALSE;
       }
    }
}
