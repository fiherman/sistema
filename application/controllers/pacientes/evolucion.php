<?php

class Evolucion extends CI_Controller{
    function insert_evolucion_pac(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->evolucion_model->insert_evol_pac($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
        
    }
 
}