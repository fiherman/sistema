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
            $this->db->query("update pacientes set cad_lar=(nombre || ' ' || apellido || ' ' || dni) where id=$id");
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

    function insert_consulta_pac($cons_cos, $cons_fch, $cons_hora, $pac_id, $pac_con_com) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("insert into consulta(cons_cos, cons_fch,cons_hora, pac_id, pac_nom_com) values"
                . "($cons_cos,'$cons_fch','$cons_hora',$pac_id,'$pac_con_com')");

        if ($insert) {
            return true;
        } else {
            return FALSE;
        }
    }

    //TRATAMIENTO
    function get_trat_tip($seg_id) {
        return $this->db->query("SELECT esp_tip,(esp_tip_des || ' - ' || esp_des) as esp_des,esp_cod,esp_cos_sol FROM especialidad where seg_id=$seg_id")->result();
    }

    function get_doctores() {
        return $this->db->query("select doc_id,(doc_nom || ' ' || doc_ape)as doc_nom_com from doctores where doc_hab='1'")->result();
    }

    function get_num_trat($pac_id) {
        return $this->db->query("select COUNT(distinct trat_num) as trat_tot from tratamiento where trat_pac_id=$pac_id")->result()[0];
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
            select sum(trat_esp_cos) as total from vw_ver_trat_pac where trat_pac_id=$pac_id and trat_num=$num_trat
            ")->result()[0];
    }

    function insert_tratamiento_pac($trat_num, $pac_id, $seg_id, $esp_tip, $esp_cod, $esp_des, $esp_cos, $doc_id) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
         INSERT INTO tratamiento(trat_num,trat_pac_id,trat_seg_id,trat_esp_tip,trat_esp_cod,trat_esp_des,trat_esp_cos,trat_doc_id,trat_fch)
         VALUES ($trat_num,$pac_id,$seg_id,$esp_tip,$esp_cod,'$esp_des',$esp_cos,$doc_id,'" . date('d/m/Y') . "')"
        );

        if ($insert) {
            return true;
        } else {
            return FALSE;
        }
    }

    function insert_dscto_trat($pac_id, $trat_num, $trat_subtot, $dscto, $trat_tot, $des) {
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
         INSERT INTO descuento(dscto_pac_id, dscto_trat_num, dscto_trat_subtot, dscto_trat_dscto, dscto_trat_tot, dscto_fch, dscto_des)
         VALUES ($pac_id, $trat_num, $trat_subtot, $dscto, $trat_tot,'" . date('d/m/Y') . "', '$des')"
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

}
