<?php

class Calendario extends CI_Controller {

    function get_calendario() {
        
        $this->load->view("calendario/cal_view");
//        //echo @$_REQUEST[ide_per];
//        $verataque = protege_ataque(@$_REQUEST[ide_per], 'tramitedocumentario/agenda/para_el_publico');
//        if ($verataque == "ataque")
//            echo "Your query has been executed successfully";
//        else {
//            
//        }
    }
    function llenar_calendario_para_el_publico()
    {
        header('Content-type: application/json');
        $notas = $this->calendario_model->get_agendas_para_el_publico(1,date('Y'));
        $Eventos = array();       
        foreach($notas as $Index => $Agenda)
        {
            $Eventos[$Index] = array(			
                'id' => $Agenda->ide_age,
                'title' => character_limiter_calendar(utf8_string($Agenda->des_not),5),
                'start' => $this->format_date_calendar($Agenda->fch_ini),
                'end' => $this->format_date_calendar($Agenda->fch_fin),
                'allDay' => false,
                'fch_reg' =>$this->format_date_calendar($Agenda->fch_reg),
                'nom_tra' =>utf8_string($Agenda->nom_tra),
                'fch_ini' =>$this->format_date_calendar($Agenda->fch_fin),
                'fch_fin' =>$this->format_date_calendar($Agenda->fch_fin),
                'des_not' =>utf8_string($Agenda->des_not),
                'ide_not' =>($Agenda->ide_not)
            );
        }              
        echo json_encode($Eventos);
    }
    
    function get_consultorios(){
	echo json_encode(array(	
		array(
			'id' => 1,
			'name' => "CONSULTORIO 1"
		),		
		array(
			'id' => 2,
			'name' => "CONSULTORIO 2"
		),
                array(
			'id' => 3,
			'name' => "CONSULTORIO 3"
		),
                array(
			'id' => 3,
			'name' => "CONSULTORIO 4"
		),
            array(
			'id' => 3,
			'name' => "CONSULTORIO 5"
		),
            array(
			'id' => 3,
			'name' => "CONSULTORIO 6"
		),
            array(
			'id' => 3,
			'name' => "CONSULTORIO 7"
		),
            array(
			'id' => 3,
			'name' => "CONSULTORIO 8"
		),
            array(
			'id' => 3,
			'name' => "CONSULTORIO 9"
		),
            array(
			'id' => 3,
			'name' => "CONSULTORIO 10"
		)
	));
    }
    
    function get_notas(){
        
        $year = date('Y');
	$month = date('m');
	$day = date('d');

	echo json_encode(array(	
		array(
			'id' => 111,
			'title' => "Event1",
			'start' => "$year-$month-$day",
			'url' => "http://google.com/",
                        'resourceId' => 1
		),		
		array(
			'id' => 222,
			'title' => "Event2",
			'start' => "$year-$month-${day}T08:00:00Z",
			'end' => "$year-$month-${day}T12:00:00Z",
                        'allDay' => false,
			'url' => "http://google.com/",
                        'resourceId' => 2
		),
                array(
			'id' => 333,
			'title' => "Event3",
			'start' => "$year-$month-${day}T14:30:00Z",
			'end' => "$year-$month-${day}T16:00:00Z",
                        'allDay' => false,
                        'resourceId' => 3
		)	
	));
    }

}
