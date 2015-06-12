<?php

class Evolucion_model extends CI_Model {

    function insert_evol_pac($pac_id, $des, $trat_num, $evo_act_fch, $evo_pro_acti_fch, $doc, $cons,$pro_des=null) {

        $this->db->query("set names 'utf8';");

        date_default_timezone_set('America/Lima');
        $agenda_notas = $this->db->query("
           INSERT INTO agenda_notas(ide_per,des_not,ano_eje,fch_reg)
            values($pac_id,'$pro_des','" . date('Y') . "','" . date("d-m-Y H:i:s") . "');
        ");
        $ide_not = $this->db->insert_id();

        if ($agenda_notas && $ide_not) {
            date_default_timezone_set('America/Lima');
            $fch_fin = str_replace('/', '-', $evo_pro_acti_fch);
            $timestamp = strtotime($fch_fin);
            $fch_fin_1 = strtotime("+1 hour", $timestamp);
            $date = date('d/m/Y H:i:s', $fch_fin_1);

            $agenda = $this->db->query("
                 INSERT INTO agenda(ide_not,fch_ini,fch_fin,fch_reg,ano_eje,flg_pbl,age_cons)
                 values($ide_not,'$fch_fin','$date','" . date("d-m-Y H:i:s") . "','" . date('Y') . "',1,'$cons')
             ");
            $ide_age = $this->db->insert_id();
            if ($agenda && $ide_age) {
                $insert = $this->db->query("
                    INSERT INTO evolucion(evo_pac_id, evo_act_des, evo_trat_num, evo_fch_reg, evo_act_fch, evo_pro_acti_fch, evo_doc_id, evo_cons,ide_age,evo_pro_acti_des)
                    VALUES ($pac_id, '$des','$trat_num','".date('d/m/Y')."', '$evo_act_fch', '$evo_pro_acti_fch',$doc,'$cons',$ide_age,'$pro_des');
                ");

                if ($insert){
                    return true;
                } 
            } 
            //           echo date("d/m/Y H:i:s");     //                       
            //           print $evo_pro_acti_fch."  ";
            //           print $fch_fin."  ";
            //           print $timestamp."  ";
            //           print $fch_fin_1."  ";
            //           print $date."***";
        }else {
            return FALSE;
        }
    }
}    