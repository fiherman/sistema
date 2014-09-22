<?php
class Pago_model extends CI_Model{
    function insert_pago_pac($pac_id,$trat_num,$pag_cod,$monto,$fch,$form_pag,$doc_fac,$obs = null,$usuario){
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
                INSERT INTO pagos(pag_pac_id, pag_trat_num,pag_codigo, pag_monto_sol, pag_fch, pag_form_pag,pag_doc_fac, pag_obs,pag_usu)
                VALUES ($pac_id, $trat_num,$pag_cod, $monto, '$fch', '$form_pag', '$doc_fac', '$obs','$usuario');
                ");

       if($insert){           
           return true; 
       }else{
           return FALSE;
       }
    }
    
     function insert_pago_dol_pac($pac_id,$trat_num,$pag_cod,$monto,$fch,$form_pag,$doc_fac,$obs = null,$usuario){
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
                INSERT INTO pagos_dol(pag_pac_id, pag_trat_num,pag_codigo, pag_monto, pag_fch, pag_form_pag,pag_doc_fac, pag_obs,pag_usu)
                VALUES ($pac_id, $trat_num,$pag_cod, $monto, '$fch', '$form_pag', '$doc_fac', '$obs','$usuario');
                ");

       if($insert){           
           return true; 
       }else{
           return FALSE;
       }
    }
    
    function get_saldo($pac_id,$trat_num){
        $ttotal = $this->db->query("select sum(trat_esp_cos_sol)as ttotal from tratamiento where trat_pac_id=$pac_id and trat_num=$trat_num")->result()[0];
        $dscto  = $this->db->query("select sum(dscto_trat_dscto) as dscto from descuento where dscto_pac_id=$pac_id and dscto_trat_num=$trat_num")->result()[0];
       
        $lista=array();
        $lista[0]['ttotal']= number_format($ttotal->ttotal,2,'.',',');
        
        $pago_total=0;
            if($dscto->dscto!=""){
                $pago_total=($ttotal->ttotal-$dscto->dscto);
                $lista[0]['dscto']=number_format($dscto->dscto,2,'.',',');//1
            }else{
                $pago_total=$ttotal->ttotal;
                $dscto='0.00';
                $lista[0]['dscto']=number_format($dscto,2,'.',',');//1
            }
        $lista[0]['pago_total']=number_format($pago_total,2,'.',',');//2
        $saldo=0;
        $pagado = $this->db->query("select sum(pag_monto_sol)as pagado from pagos where pag_pac_id=$pac_id and pag_trat_num=$trat_num")->result()[0];
            if($pagado->pagado!=""){  
                $saldo=$pago_total-$pagado->pagado;
                $lista[0]['pagado']=number_format($pagado->pagado,2,'.',',');//3
            }else{
                $pagado='0.00';
                $saldo=$pago_total;
                $lista[0]['pagado']=number_format($pagado,2,'.',',');//3
            } 
        
        $lista[0]['saldo']=  number_format($saldo,2);
        /////////////////////////////////////////DOLARES//////////////////////////////////////////////////////////////////////////////////////////
        
        $ttotaldol = $this->db->query("select sum(trat_esp_cos_dol)as ttotal from tratamiento where trat_pac_id=$pac_id and trat_num=$trat_num")->result()[0];
        $dsctodol  = $this->db->query("select sum(dscto_trat_dscto) as dscto from descuento_dol where dscto_pac_id=$pac_id and dscto_trat_num=$trat_num")->result()[0];
       
        
        $lista[1]['ttotal']= number_format($ttotaldol->ttotal,2,'.',',');//1
        
        $pago_total_dol=0;
            if($dsctodol->dscto!=""){
                $pago_total_dol=($ttotaldol->ttotal-$dsctodol->dscto);
                $lista[1]['dscto']=number_format($dsctodol->dscto,2,'.',',');//2
            }else{
                $pago_total_dol=$ttotaldol->ttotal;
                $dsctodol='0.00';
                $lista[1]['dscto']=number_format($dsctodol,2,'.',',');//2
            }
        $lista[1]['pago_total']=number_format($pago_total_dol,2,'.',',');//3
        $saldo_dol=0;
        $pagadodol = $this->db->query("select sum(pag_monto)as pagado from pagos_dol where pag_pac_id=$pac_id and pag_trat_num=$trat_num")->result()[0];
            if($pagadodol->pagado!=""){  
                $saldo_dol=$pago_total_dol-$pagadodol->pagado;
                $lista[1]['pagado']=number_format($pagadodol->pagado,2,'.',',');//4
            }else{
                $pagadodol='0.00';
                $saldo_dol=$pago_total_dol;
                $lista[1]['pagado']=number_format($pagadodol,2,'.',',');//4
            } 
        
        $lista[1]['saldo']= number_format($saldo_dol,2);//5       
        
        return $lista;
    }
    ////////////////////HISTORIAL DE PAGOS SOLES ////////////////////////////////////////////////////////////////////////////////////////
    function get_cont_historial_pagos($pac_id,$trat_num){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select * from vw_ver_historial_pagos where pag_pac_id= $pac_id and pag_trat_num=$trat_num
        ")->result();
    }
    
    function get_all_historial_pagos($pac_id,$trat_num,$sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select * from vw_ver_historial_pagos where pag_pac_id= $pac_id and pag_trat_num=$trat_num order by $sidx $sord limit $limit offset $start
        ")->result();
    }
    
    //////////////////HISTORIAL DE PAGOS DOLARES///////////////////////
    
    function get_cont_historial_pagos_dol($pac_id,$trat_num){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select * from vw_ver_historial_pagos_dol where pag_pac_id= $pac_id and pag_trat_num=$trat_num
        ")->result();
    }
    
    function get_all_historial_pagos_dol($pac_id,$trat_num,$sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select * from vw_ver_historial_pagos_dol where pag_pac_id= $pac_id and pag_trat_num=$trat_num order by $sidx $sord limit $limit offset $start
        ")->result();
    }
}


