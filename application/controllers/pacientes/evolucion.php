<?php

class Evolucion extends CI_Controller{
    function insert_evolucion_pac(){
        $cam=  explode('*', $_GET['datos']);
        
        $actual=explode(".",$cam[3]);
        $evo_act_fch_1=date("H:i:s",  strtotime($actual[1]));
        $evo_act_fch=$actual[0]." ".$evo_act_fch_1;
        
        $proxima=explode(".",$cam[4]);
        $evo_pro_acti_fch_1=date("H:i:s",  strtotime($proxima[1]));
        $evo_pro_acti_fch=$proxima[0]." ".$evo_pro_acti_fch_1;
        
        
        $sql=$this->evolucion_model->insert_evol_pac($cam[0],$cam[1],$cam[2],$evo_act_fch,$evo_pro_acti_fch,$cam[5],$cam[6]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
        
    }    
 
}