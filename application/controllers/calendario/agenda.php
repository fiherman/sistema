<?php
class agenda extends CI_Controller
{    
   function llenar_calendario()
   {
        header('Content-type: application/json');
        date_default_timezone_set('America/Lima');
        $notas = $this->agenda_model->get_notas();//$ide_per
        $Eventos = array();
        $DateNow= date('Y-m-d');
        
        foreach($notas as $Index => $Agenda)
        {
            
            if(date('Y-m-d',strtotime($Agenda->fch_ini))>=$DateNow)//Editables
            {
                $Eventos[$Index]['id'] = $Agenda->ide_age;
                $Eventos[$Index]['title'] = character_limiter_calendar(utf8_string($Agenda->des_not),5);
                $Eventos[$Index]['start'] = $this->format_date_calendar($Agenda->fch_ini);
                $Eventos[$Index]['end'] = $this->format_date_calendar($Agenda->fch_fin);
                $Eventos[$Index]['allDay'] = false;  
                $Eventos[$Index]['editable'] = true;
                $Eventos[$Index]['fch_reg'] = date('d/m/Y H:i:s',strtotime($Agenda->fch_reg));
                $Eventos[$Index]['nom_pac'] = utf8_string($Agenda->nom_pac);
                $Eventos[$Index]['fch_ini'] = date('d/m/Y H:i:s',strtotime($Agenda->fch_ini));
                $Eventos[$Index]['fch_fin'] = date('d/m/Y H:i:s',strtotime($Agenda->fch_fin));
                $Eventos[$Index]['des_not'] = utf8_string($Agenda->des_not); 
                $Eventos[$Index]['ide_not'] = $Agenda->ide_not; 
                $Eventos[$Index]['age_cons'] = $Agenda->age_cons; 
            }
            else//No seran editados por fecha pasada
            {
                $Eventos[$Index]['id'] = $Agenda->ide_age;
                $Eventos[$Index]['title'] = character_limiter_calendar(utf8_string($Agenda->des_not),5);
                $Eventos[$Index]['start'] = $this->format_date_calendar($Agenda->fch_ini);
                $Eventos[$Index]['end'] = $this->format_date_calendar($Agenda->fch_fin);
                $Eventos[$Index]['editable'] = false;
                $Eventos[$Index]['color'] = 'gray';
                $Eventos[$Index]['allDay'] = false;         
                $Eventos[$Index]['fch_reg'] = date('d/m/Y H:i:s',strtotime($Agenda->fch_reg));
                $Eventos[$Index]['nom_pac'] = utf8_string($Agenda->nom_pac);
                $Eventos[$Index]['fch_ini'] = date('d/m/Y H:i:s',strtotime($Agenda->fch_ini));
                $Eventos[$Index]['fch_fin'] = date('d/m/Y H:i:s',strtotime($Agenda->fch_fin));
                $Eventos[$Index]['des_not'] = utf8_string($Agenda->des_not); 
                $Eventos[$Index]['ide_not'] = $Agenda->ide_not;
                $Eventos[$Index]['age_cons'] = $Agenda->age_cons; 
            }  
//            echo $DateNow." ".date('Y-m-d',strtotime($Agenda->fch_ini))."-----------";
        }
        echo json_encode($Eventos);
    } 
  
   function cambiar_de_fecha()
   {
       header('Content-type: application/json');
       $fch_ini = $_GET['fch_ini'];
       $fch_fin = $_GET['fch_fin'];
       $ide_age = $_GET['ide_age'];
       
       $Lista = new stdClass();
       if(date($fch_ini) >= date('d-m-Y H:i:s'))
       {
           $Lista->revert = 0;
           $this->agenda_model->change_days($fch_ini,$fch_fin,$ide_age);
       }
       else
       {
           $Lista->revert = 1;
       }   
       echo json_encode($Lista);
       
       
   }
   function cambiar_de_hora()
   {
       $cam=  explode('*', $_GET['datos']);
       $fch_fin = $cam[0];
       $ide_age = $cam[1];
              
       $this->agenda_model->change_hours_minutes($fch_fin,$ide_age);
   }
   function index(){
        if(!isset($_SESSION['username'])){
            redirect(base_url());
        }else{
            $this->load->view('menu_top_view');  
            $this->load->view("calendario/agenda_view");
            $this->load->view('footer_view');
        }       
   }
   function eliminar_agenda()
   {
       $this->agenda_model->Delete($_REQUEST['ide_age']);
   }
  
   
   public function __construct() {
        session_start();
        parent::__construct();        
   }
   
   /////////////////////////
   
    function llenar_calendario_publico()
   {
        header('Content-type: application/json');
        $ide_per = @$this->session->userdata('logged_in')['ide_per'];
        $ano_eje = date('Y');
        $notas = $this->agenda_model->get_notas_publicas($ano_eje);
        $Eventos = array();       
        if(isset($ide_per))
        {
            foreach($notas as $Index => $Agenda)
            {
                if($Agenda->ide_per == $ide_per)//Editables
                {
                    $Eventos[$Index] = array(			
                        'id' => $Agenda->ide_age,
                        'title' => character_limiter_calendar(utf8_string($Agenda->des_not),5),
                        'start' => $this->format_date_calendar($Agenda->fch_ini),
                        'end' => $this->format_date_calendar($Agenda->fch_fin),
                        'allDay' => false,
                        'color'=> '#AC61C2',
                        'fch_reg' =>$this->format_date_calendar($Agenda->fch_reg),
                        'nom_tra' =>utf8_string($Agenda->nom_tra),
                        'fch_ini' =>$this->format_date_calendar($Agenda->fch_fin),
                        'fch_fin' =>$this->format_date_calendar($Agenda->fch_fin),
                        'des_not' =>utf8_string($Agenda->des_not),
                        'ide_not' =>($Agenda->ide_not)
                    );
                }
                else//No seran editados por fecha pasada
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
            }
            echo json_encode($Eventos);
        }
        else
        {
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
    }
    function llenar_calendario_para_el_publico()
    {
        header('Content-type: application/json');
        $notas = $this->agenda_model->get_agendas_para_el_publico($_REQUEST['ide_per'],date('Y'));
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
    function para_el_publico()
    {
        //echo @$_REQUEST[ide_per];
        $verataque=protege_ataque(@$_REQUEST[ide_per],'tramitedocumentario/agenda/para_el_publico');
        if($verataque=="ataque")
            echo "Your query has been executed successfully";
        else {
            $this->load->view("tramitedocumentario/agenda_para_el_publico_view"); 
        }
    }
   function publica()
   {        
        $this->load->view("tramitedocumentario/agenda_publica_view");        
   }
   function guardar_editado()
   {
       $ide_not = $_REQUEST['ide_not'];
       $des_not = $_REQUEST['des_not'];
       $this->agenda_notas_model->save_edit($ide_not,  utf8_decode($des_not));
   }
   function format_date_calendar($DateTime)
   {   
        $DateTime = str_replace("/", "-", $DateTime);
        $Date = date("m/d/Y",strtotime($DateTime));        
        $DateTimeCreate = new DateTime($DateTime);      
        $Time = $DateTimeCreate->format('H:i:s');
        return $Date." ".$Time;
   }
   function guardar_evento()
   {
       header('Content-type: application/json');
       $ide_per = $session_data = $this->session->userdata('logged_in')['ide_per'];
       $des_not = @$_REQUEST['nota'];
       $ano_eje = date('Y');
       $fch_reg = date('Y-m-d H:i:s');
       $fch_ini_fin = @$_REQUEST['FechaIniFin'];
       $flg_pbl = $_REQUEST['flg_pbl'];
       
       $get_fch_ini = strtotime("+2 hour", strtotime($fch_ini_fin));
       $set_fch_fin = date("Y-m-d H:i:s",$get_fch_ini);
       
       $this->agenda_notas_model->SaveNota($ide_per,utf8_decode($des_not),$ano_eje,$fch_reg);
       $ide_not = $this->db->insert_id();       
       $this->agenda_model->save_agenda($ide_not,$fch_ini_fin,$set_fch_fin,$fch_reg,$ano_eje,$flg_pbl);
      
       $return_fch_ini = date("Y-m-d H:i:s",strtotime($fch_ini_fin));
       $Calendario = new stdClass();
       $Calendario->ide_age = $this->db->insert_id();
       $Calendario->fch_ini = "$return_fch_ini";
       $Calendario->fch_fin = "$set_fch_fin";
       echo json_encode($Calendario);
   }
   function guardar_el_arrastre()
   {
       header('Content-type: application/json');
       $ide_not = @$_POST['ide_not'];
       $fch_ini_fin = @$_REQUEST['FechaIniFin'];
       $get_fch_ini = strtotime("+2 hour", strtotime($fch_ini_fin));
       $set_fch_fin = date("Y-m-d H:i:s",$get_fch_ini);
       $fch_reg = date('Y-m-d H:i:s');
       $ano_eje = date('Y');
       $this->agenda_model->save_agenda_arrastre($ide_not,$fch_ini_fin,$set_fch_fin,$fch_reg,$ano_eje);
       $return_fch_ini = date("Y-m-d H:i:s",strtotime($fch_ini_fin));
       
       $Calendario = new stdClass();
       $Calendario->ide_age = $this->db->insert_id();
       $Calendario->fch_ini = "$return_fch_ini";
       $Calendario->fch_fin = "$set_fch_fin";
       echo json_encode($Calendario);
   }
   function verificar_fecha_actual()
   {    
       $DateNow = date('d-m-Y H:i:s');
       $fch_ini = @$_REQUEST['fch_ini'];
       $get_fch_ini = date($fch_ini);

       if($get_fch_ini >= $DateNow)
       {
           echo "MayorActual";
       }
       else
       {
           echo "Pasada";
       }   
   }
   function mostrar_tool_tip()
   {
      // header('Content-type: application/json');
       $ide_not = $_REQUEST['ide_not'];
       $Mensaje = $this->agenda_notas_model->show_tool_tip($ide_not);
       //echo json_encode($Mensaje);
       $Html="";
       $Html.="<div class='tipCalendar'>";
           $Html.="<p>".$Mensaje[0]->des_not."</p>";
       $Html.="</div>";
       
       echo $Html;
   }
   function test()
   {

   }
    function mostrar_nombre()
   {
       echo $this->agenda_model->get_info_user_agenda($_REQUEST['ide_per'])[0]->nom_tra;
   }
}
