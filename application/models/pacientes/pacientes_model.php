<?php

class Pacientes_model extends CI_Model {

    function insert_pacientes($nom, $ape, $direc, $dni, $distri, $sexo, $fchnac, $tel = null, $movi = null, $claro = null, $email, $depen = null, $seg_id) {
        $ide = $this->db->query('select count(id)+1 as id from pacientes')->result()[0];
        if ($ide) {
            $this->db->query("set names 'utf8';");

            if ($dni) {
                 $insert = $this->db->query(
                        "insert into pacientes(id,nombre,apellido,direccion,distrito,sexo,dni,telefono,movistar,claro,fec_nac,email,dependiente,seg_id,fch_reg,estado)"
                        . "values"
                        . "($ide->id,'$nom','$ape','$direc','$distri','$sexo',$dni,'$tel','$movi','$claro','$fchnac','$email','$depen',$seg_id,'" . date('d/m/Y') . "','1')");
                
            } else {
                $insert = $this->db->query(
                        "insert into pacientes(id,nombre,apellido,direccion,distrito,sexo,dni,telefono,movistar,claro,fec_nac,email,dependiente,seg_id,fch_reg,estado)"
                        . "values"
                        . "($ide->id,'$nom','$ape','$direc','$distri','$sexo',null,'$tel','$movi','$claro','$fchnac','$email','$depen',$seg_id,'" . date('d/m/Y') . "','1')");               
            }
            
            
            
            if ($insert) {
                if($dni){
                    $this->db->query("update pacientes set cad_lar=(nombre ||' '|| apellido ||' '|| dni ||' '||id) where id=$ide->id");
                }else{
                    $this->db->query("update pacientes set cad_lar=(nombre ||' '|| apellido ||' '||id) where id=$ide->id");
                }
                
                return true;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function update_pacientes($id, $nom, $ape, $direc, $dni = null, $distri, $sexo, $fchnac, $tel = null, $movi = null, $claro = null, $email, $depen = null, $seg_id) {

        $this->db->query("set names 'utf8';");

        $update = $this->db->query(
                "update pacientes set nombre='$nom',apellido='$ape',direccion='$direc',distrito='$distri',sexo='$sexo',dni=$dni,telefono='$tel',"
                . "movistar='$movi',claro='$claro',fec_nac='$fchnac',email='$email',dependiente='$depen',seg_id=$seg_id,fch_reg='" . date('d/m/Y') . "',estado='1' "
                . " where id=$id");
        if ($update) {
            $this->db->query("update pacientes set cad_lar=(nombre || ' ' || apellido || ' ' || dni || ' ' || id) where id=$id");
            return true;
        } else {
            return FALSE;
        }
    }

    function latin1($txt) {
        $encoding = mb_detect_encoding($txt, 'ASCII,UTF-8,ISO-8859-1');
        if ($encoding == "UTF-8") {
            $txt = utf8_decode($txt);
        }
        return $txt;
    }

    function get_cont_by_date() {
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from pacientes")->result();
    }

    function get_all_pacientes($sidx, $sord, $start, $limit) {
        $this->db->query("set names 'utf8';");
        return $this->db->query("
                select *,CASE
                WHEN seg_id = 1::numeric THEN 'SIN SEGURO'::text
                WHEN seg_id = 2::numeric THEN 'LA POSITIVA'::text
                WHEN seg_id = 3::numeric THEN 'CERRO VERDE'::text
                ELSE NULL::text
                END AS seguro from pacientes order by $sidx $sord limit $limit offset $start
                ")->result();
    }

    function get_cont_by_date_paciente($txtbuscar) {
        $this->db->query("set names 'utf8';");
        $laPalabras = @split(" ", $txtbuscar);
        $lsBus = "";
        for ($i = 0; $i <= count($laPalabras) - 1; $i++) {
            if ($i == 0) {
                $lsBus = " cad_lar LIKE Upper('%" . $laPalabras[$i] . "%')";
            } else {
                $lsBus.=" AND cad_lar LIKE Upper('%" . $laPalabras[$i] . "%')";
            }
        }
        return $this->db->query("select * from pacientes where $lsBus")->result();
    }

    function get_buscar_paciente($txtbuscar, $sidx, $sord, $start, $limit) {
        $this->db->query("set names 'utf8';");
        $laPalabras = @split(" ", $txtbuscar);
        $lsBus = "";
        for ($i = 0; $i <= count($laPalabras) - 1; $i++) {
            if ($i == 0) {
                $lsBus = " cad_lar LIKE UPPER('%" . $laPalabras[$i] . "%')";
            } else {
                $lsBus.=" AND cad_lar LIKE UPPER('%" . $laPalabras[$i] . "%')";
            }
        }
        return $this->db->query("
                select *,CASE
                WHEN seg_id = 1::numeric THEN 'SIN SEGURO'::text
                WHEN seg_id = 2::numeric THEN 'LA POSITIVA'::text
                WHEN seg_id = 3::numeric THEN 'CERRO VERDE'::text
                ELSE NULL::text
                END AS seguro from pacientes where $lsBus order by $sidx $sord limit $limit offset $start
                ")->result();
    }

    function insert_consulta_pac($cons_cos, $cons_fch, $cons_hora, $pac_id, $pac_con_com,$trat_num) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("insert into consulta(cons_cos, cons_fch,cons_hora, pac_id, pac_nom_com,cons_trat_num) values"
                . "($cons_cos,'$cons_fch','$cons_hora',$pac_id,'$pac_con_com',$trat_num)");

        if ($insert) {
            return true;
        } else {
            return FALSE;
        }
    }

    //TRATAMIENTO
    function get_trat_tip($seg_id) {
        return $this->db->query("SELECT esp_tip,(esp_tip_des || ' - ' || esp_des) as esp_des,esp_cod,esp_cos_sol,esp_cos_dol FROM especialidad where seg_id=$seg_id")->result();
    }

    function get_doctores() {
        return $this->db->query("select doc_id,(doc_nom || ' ' || doc_ape)as doc_nom_com from doctores where doc_hab='1'")->result();
    }

    function get_num_trat($pac_id) {
        return $this->db->query("select distinct trat_num as trat_tot from tratamiento where trat_pac_id=$pac_id order by 1")->result();
        
    }
    function get_consulta_costo($pac_id,$trat_num) {
        return $this->db->query("select * from consulta where pac_id=$pac_id and cons_trat_num=$trat_num")->result()[0];
    }

    function get_ver_trat_select($pac_id) {
        return $this->db->query("select distinct trat_num from tratamiento where trat_pac_id=$pac_id")->result();
    }

    function get_cont_ver_trat($pac_id, $num_trat) {
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from tratamiento where trat_pac_id=$pac_id and trat_num=$num_trat")->result();
    }

    function get_ver_trat_all($pac_id, $num_trat, $sidx, $sord, $start, $limit) {
//        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from vw_ver_trat_pac where trat_pac_id=$pac_id and trat_num=$num_trat order by $sidx $sord limit $limit offset $start")->result();
    }

    function get_trat_ttotal($pac_id, $num_trat) {
        return $this->db->query("
            select sum(trat_esp_cos_sol) as total from vw_ver_trat_pac where trat_pac_id=$pac_id and trat_num=$num_trat
            ")->result()[0];
    }

    function insert_tratamiento_pac($trat_num, $pac_id, $seg_id, $esp_tip, $esp_cod, $esp_des, $esp_cos, $doc_id,$esp_cos_dol,$cant) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
         INSERT INTO tratamiento(trat_num,trat_pac_id,trat_seg_id,trat_esp_tip,trat_esp_cod,trat_esp_des,trat_esp_cos_sol,trat_doc_id,trat_esp_cos_dol,trat_fch,trat_cant)
         VALUES ($trat_num,$pac_id,$seg_id,$esp_tip,$esp_cod,'$esp_des',$esp_cos,$doc_id,$esp_cos_dol,'" . date('d/m/Y') . "',$cant)"
        );

        if ($insert) {
            return true;
        } else {
            return FALSE;
        }
    }

    function insert_dscto_trat($pac_id, $trat_num, $trat_subtot, $dscto, $trat_tot, $des,$porcent) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
         INSERT INTO descuento(dscto_pac_id, dscto_trat_num, dscto_trat_subtot, dscto_trat_dscto, dscto_trat_tot, dscto_fch, dscto_des,dscto_porcent)
         VALUES ($pac_id, $trat_num, $trat_subtot, $dscto, $trat_tot,'" . date('d/m/Y') . "', '$des',$porcent)"
        );

        if ($insert) {
            return true;
        } else {
            return FALSE;
        }
    }
    
    function insert_dscto_trat_dol($pac_id, $trat_num, $trat_subtot, $dscto, $trat_tot, $des,$porcent) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
         INSERT INTO descuento_dol(dscto_pac_id, dscto_trat_num, dscto_trat_subtot, dscto_trat_dscto, dscto_trat_tot, dscto_fch, dscto_des,dscto_porcent)
         VALUES ($pac_id, $trat_num, $trat_subtot, $dscto, $trat_tot,'" . date('d/m/Y') . "', '$des',$porcent)"
        );

        if ($insert) {
            return true;
        } else {
            return FALSE;
        }
    }

    /// ver tratamiento
    function get_ver_trat_dscto($pac_id, $trat_num) {
        return $this->db->query("select * from descuento where dscto_pac_id=$pac_id and dscto_trat_num=$trat_num")->result();
    }
    
    
    ///////REPORTE///////////////////////////////////////////////////////////////////////////
    function get_cabecera_report($pac_id, $num_trat) {
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from consulta where pac_id=$pac_id and cons_trat_num=$num_trat")->result()[0];
    }
    
    function get_trat_report($pac_id, $num_trat) {
        $this->db->query("set names 'utf8';");        
        return $this->db->query("select * from vw_ver_trat_pac where trat_pac_id=$pac_id and trat_num=$num_trat  order by 5")->result();
    }
    
    function get_dscto_sol($pac_id, $num_trat) { 
        $dscto=$this->db->query("select dscto_trat_dscto,dscto_porcent from descuento where dscto_pac_id=$pac_id and dscto_trat_num=$num_trat")->result()[0];
        if($dscto){
            return $dscto;
        }else{
            return 0.00;
        }
        
         
    }
    function get_dscto_dol($pac_id, $num_trat) {           
        $dscto=$this->db->query("select dscto_trat_dscto,dscto_porcent from descuento_dol where dscto_pac_id=$pac_id and dscto_trat_num=$num_trat")->result()[0];
        if($dscto){
            return $dscto;
        }else{
            return 0.00;
        }
    }
    function get_pago_sol_dol($pac_id, $num_trat) { 
        
        $pag=$this->db->query("select * from pagos where pag_pac_id=$pac_id and pag_trat_num=$num_trat")->result();
        $pag_dol=$this->db->query("select * from pagos_dol where pag_pac_id=$pac_id and pag_trat_num=$num_trat")->result();
        
        $Lista=array();
//        if($pag && $pag_dol){
            array_push($Lista, $pag);
            array_push($Lista, $pag_dol);
            return $Lista;
//        }else{
//            return 0.00;
//        }
        
         
    }
    function get_pago_dol($pac_id, $num_trat) {           
        $dscto_d=$this->db->query("select * from pagos_dol where pag_pac_id=$pac_id and pag_trat_num=$num_trat")->result();
        if($dscto){
            return $dscto;
        }else{
            return 0.00;
        }
    }
    
    ///////////REPORTE INGRESOS////////////////////////
    function get_soles($fch){
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from vw_ver_historial_pagos where pag_form_pag='1' and pag_fch like'%$fch' order by pag_id")->result();
    }
    function get_dolares($fch){
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from vw_ver_historial_pagos_dol where pag_form_pag='1' and pag_fch like'%$fch' order by pag_fch")->result();
    }
    function get_voucher($fch){
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from vw_ver_historial_pagos where pag_form_pag='2' and pag_fch like'%$fch' order by pag_id")->result();
    }
    
    function get_consultas(){
        $this->db->query("set names 'utf8';");
        return $this->db->query("select * from consulta where cons_fch like '".date('d/m/Y')."'")->result();
    }
    /////////////////////////// EDAD
    
    function get_edad($fecha_nac){
        error_reporting(0);
        $fecha=str_replace('/','-',$fecha_nac);
        $dias=explode('-',$fecha,3);
        $d=mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
        $edad=(int)((time()-$d)/31556926);
        return $edad;
    }
}
