<?php
class Pago_model extends CI_Model{
    function insert_pago_pac($pac_id,$trat_num,$pag_cod,$monto,$fch,$form_pag,$doc_fac,$obs = null,$usuario){
        $this->db->query("set names 'utf8';");
        $insert = $this->db->query("
                INSERT INTO pagos(pag_pac_id, pag_trat_num,pag_codigo, pag_monto, pag_fch, pag_form_pag,pag_doc_fac, pag_obs,pag_usu)
                VALUES ($pac_id, $trat_num,$pag_cod, $monto, '$fch', '$form_pag', '$doc_fac', '$obs','$usuario');
                ");

       if($insert){           
           return true; 
       }else{
           return FALSE;
       }
    }
    
    function get_saldo($pac_id,$trat_num){
        $ttotal = $this->db->query("select sum(trat_esp_cos)as ttotal from tratamiento where trat_pac_id=$pac_id and trat_num=$trat_num")->result()[0];
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
        $pagado = $this->db->query("select sum(pag_monto)as pagado from pagos where pag_pac_id=$pac_id and pag_trat_num=$trat_num")->result()[0];
            if($pagado->pagado!=""){  
                $saldo=$pago_total-$pagado->pagado;
                $lista[0]['pagado']=number_format($pagado->pagado,2,'.',',');//3
            }else{
                $pagado='0.00';
                $saldo=$pago_total;
                $lista[0]['pagado']=number_format($pagado,2,'.',',');//3
            } 
        
        $lista[0]['saldo']=$saldo;
        
        return $lista;
        
//        return $this->db->query("
//                 select 
//                a.trat_pac_id,
//                a.trat_num,
//                sum(a.trat_esp_cos)as total,
//                (select sum(pag_monto) from pagos where pag_pac_id=$pac_id and pag_trat_num=$trat_num)as pagado,
//                (sum(a.trat_esp_cos)-(select sum(pag_monto) from pagos where pag_pac_id=$pac_id and pag_trat_num=$trat_num))as saldo
//                from tratamiento a
//                where trat_pac_id=$pac_id and trat_num=$trat_num
//                group by a.trat_pac_id,a.trat_num
//        ")->result();
    }
}


