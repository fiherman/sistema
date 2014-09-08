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
                            trim($Datos->pag_monto),
                            trim($Datos->pag_fch),
                            trim($Datos->documento),
                            trim($Datos->pag_codigo),                                                      
                            trim($Datos->pag_obs)
                            );	      
        }
        echo json_encode($Lista);
    }
}

