<?php

class Calendario extends CI_Controller {

    function index() {
//         if(!isset($_SESSION['username'])){
//            redirect(base_url());
//        }else{
            $this->load->view("calendario/agenda_view");
//        }        
//        $this->load->view("calendario/calendario_view");
        
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
			'name' => "CONSULTORIO  1"
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
        header("Content-type: text/xml");      
        
//        $xml = new DomDocument();
//        $root = $xml->createElement('data');
//        $root = $xml->appendChild($root); 
//
//        $colaborador=$xml->createElement('event');
//        $colaborador->setAttribute('id', '1234');
//        $colaborador =$root->appendChild($colaborador);
//        
//
//        $start_date=$xml->createElement('start_date','<![CDATA["2014-09-13 07:00:0010:00:00"]]>');
//        $start_date =$colaborador->appendChild($start_date);
//
//        $end_date=$xml->createElement('end_date','2014-09-13 09:00:00');
//        $end_date =$colaborador->appendChild($end_date);
//
//        $text=$xml->createElement('text','Section A test');
//        $text =$colaborador->appendChild($text);
//
//        $section_id=$xml->createElement('section_id',"2");
//        $section_id =$colaborador->appendChild($section_id);
//
//
//
//        $xml->formatOutput = true;         
// 
//        $strings_xml = $xml->saveXML();        
        
//        echo $strings_xml;
        
        echo $strings_xml = "
                <data>
	<event id='1'>
		<start_date><![CDATA[2014/09/13 12:00:00]]></start_date>
		<end_date><![CDATA[2014-09-13 14:00:00]]></end_date>
		<text><![CDATA[Section A test]]></text>
		<section_id>1</section_id>
	</event>
	<event id='2'>
		<start_date><![CDATA[2014/09/13 10:00:00]]></start_date>
		<end_date><![CDATA[2014-09-13 11:00:00]]></end_date>
		<text><![CDATA[Section B test]]></text>
		<section_id>2</section_id>
	</event>
	<event id='3'>
		<start_date><![CDATA[2014-09-13 10:00:00]]></start_date>
		<end_date><![CDATA[2014-09-13 11:00:00]]></end_date>
		<text><![CDATA[Section B test]]></text>
		<section_id>2</section_id>
	</event>
	<event id='4'>
		<start_date><![CDATA[2014-09-13 16:00:00]]></start_date>
		<end_date><![CDATA[2014-09-13 18:00:00]]></end_date>
		<text><![CDATA[Section C test]]></text>
		<section_id>3</section_id>
	</event>
	<event id='5'>
		<start_date><![CDATA[2014-09-13 10:00:00]]></start_date>
		<end_date><![CDATA[2014-09-13 15:00:00]]></end_date>
		<text><![CDATA[Section D test]]></text>
		<section_id>4</section_id>
	</event>
	<event id='6'>
		<start_date><![CDATA[2014-09-13 12:00:00]]></start_date>
		<end_date><![CDATA[2014-09-13 14:00:00]]></end_date>
		<text><![CDATA[day before test]]></text>
		<section_id>1</section_id>
	</event>
	<event id='7'>
		<start_date><![CDATA[2014-09-12 12:00:00]]></start_date>
		<end_date><![CDATA[2014-09-12 14:00:00]]></end_date>
		<text><![CDATA[day after test]]></text>
		<section_id>1</section_id>
	</event>
</data>
                ";
//        
//        header('Content-type: application/json');
//        $tot= array();
//        $data=new stdClass();
//        
//         $Lista			 = new stdClass();
//	 $Lista['id']            = "1";
//	 $Lista['text']          = "ODONTOGRAMA";	 
//	 $Lista['start_date']	 = "2014-09-13 06:00";
//	 $Lista['end_date']	 = "2014-09-13 09:00";
//	 $Lista['section_id']	 = "1";
//         
//         $Datos			 = new stdClass();
//	 $Datos['id']            = "2";
//	 $Datos['text']          = "CARIES";	 
//	 $Datos['start_date']	 = "2014-09-13 12:00";
//	 $Datos['end_date']	 = "2014-09-13 18:00";
//	 $Datos['section_id']	 = "2";
//         
//         array_push($tot, $Lista);
//         array_push($tot, $Datos);
//         
//         $data->data = $tot;
//	 echo json_encode($data);
        
//	echo json_encode(array(                	
//		array(
//			'id'         => "1",
//			
//			'start_date' => "2014-09-13 06:00",
//			'end_date'   => "2014-09-13 07:00",
//                        'text'       => "ODONTOGRAMA",
//                        'section_id' => 1
//		),		
//		array(
//			'id'         => "2",
//			
//			'start_date' => "2014-09-13 08:00",
//			'end_date'   => "2014-09-13 09:00",
//                        'text'       => "CARIES",
//                        'section_id' => 2
//		),
//                array(
//			'id'         => "3",
//			
//			'start_date' => "2014-09-13 15:00",
//			'end_date'   => "2014-09-13 17:00",
//                        'text'       => "PERIODONCIA",
//                        'section_id' => 3
//		)	
//	));
    }

}
