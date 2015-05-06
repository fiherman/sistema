<?php

class Pago extends CI_Controller{
    function insert_pago_paciente(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pago_model->insert_pago_pac($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }        
    }
    
    function insert_pago_dol_paciente(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pago_model->insert_pago_dol_pac($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
        
    }
    
    function get_saldo(){
        header("Content-Type: application/json");
        $cam=  explode('*', $_GET['datos']);
        $Consulta= $this->pago_model->get_saldo($cam[0],$cam[1]);  
//        $todo=array();
//        foreach($Consulta as $Datos)
//        {
//            $Lista=new stdClass();           
//            $Lista->pac_id   =  $Datos->trat_pac_id;
//            $Lista->trat_num =  $Datos->trat_num;
//            $Lista->total    =  $Datos->total;
//            $Lista->pagado   =  $Datos->pagado;
//            $Lista->saldo    =  $Datos->saldo;           
//            array_push($todo,$Lista);
//        }
        echo @json_encode($Consulta);//$todo
    }
    
    function eliminar_tratamiento(){
        $pac_id=$_GET['pac_id'];
        $trat_num=$_GET['trat_num'];
        
        $sql=$this->pago_model->eliminar_tratamiento($pac_id,$trat_num);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }    
    
    function get_historial_pagos(){
        header('Content-type: application/json');
        $pac_id=$_GET['pac_id'];
        $trat_num=$_GET['trat_num'];
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->pago_model->get_cont_historial_pagos($pac_id,$trat_num));

        if($count > 0){
            $total_pages = ceil($count / $limit);
        }
        if($page > $total_pages){
            $page   = $total_pages;
        }
        $start  = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if($start<0){
            $start = 0;
        }
        $Consulta =$this->pago_model->get_all_historial_pagos($pac_id,$trat_num,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->pag_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->pag_id),
                            trim($Datos->pag_monto_sol),
                            trim($Datos->pag_fch),
                            trim($Datos->documento),
                            trim($Datos->pag_codigo),                                                      
                            trim($Datos->pag_obs),
                            '<button class="btn_full_act" style="height:17px; font-size:10px; padding:0px 5px 0px 5px " Onclick="factura('.$Datos->pag_doc_fac.','.$Datos->pag_id.');" >'."IMPR. ".substr(trim($Datos->documento),0,4).".".'</button>',
                            trim($Datos->pag_doc_fac) 
               );	   
        }
        echo json_encode($Lista);
    }
    
    function get_historial_pagos_dol(){
        header('Content-type: application/json');
        $pac_id=$_GET['pac_id'];
        $trat_num=$_GET['trat_num'];
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->pago_model->get_cont_historial_pagos_dol($pac_id,$trat_num));

        if($count > 0){
            $total_pages = ceil($count / $limit);
        }
        if($page > $total_pages){
            $page   = $total_pages;
        }
        $start  = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if($start<0){
            $start = 0;
        }
        $Consulta =$this->pago_model->get_all_historial_pagos_dol($pac_id,$trat_num,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->pag_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->pag_id),
                            trim($Datos->pag_monto),
                            trim($Datos->pag_fch),
                            trim($Datos->documento),
                            trim($Datos->pag_codigo),                                                      
                            trim($Datos->pag_obs)
                            );	      
        }
        echo json_encode($Lista);
    }
    
    function get_serie_factura(){
       
        header("Content-Type: application/json");
        
        $Consulta= $this->pago_model->get_serie_fac(); 
        $limite= $this->pago_model->get_limite_fac(); 
        
        $limit=(int)$limite->sys_fac_fin;
        $serie_ant=(int)ltrim($Consulta->pag_num_factura, '0');
        
        if($serie_ant==$limit){
            $serie_nueva=str_pad($limite->sys_fac_ini, 6, "0", STR_PAD_LEFT);
        }else{
            $serie_nueva=str_pad($serie_ant+1, 6, "0", STR_PAD_LEFT);            
        }

        $serie_fact=array();
        $serie_fact['pag_id']=$Consulta->pag_id;                      
        $serie_fact['pag_num_fact']=trim($Consulta->pag_num_factura);  
        $serie_fact['serie_ant']=str_pad(trim($serie_ant),6,"0", STR_PAD_LEFT); 
        $serie_fact['serie_nueva']=$serie_nueva; 
        echo @json_encode($serie_fact);
    }
    
    function insert_pago_paciente_factura(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pago_model->insert_pago_pac_factura($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8],$cam[9]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }        
    }
    
}

