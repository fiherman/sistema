<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pacientes extends CI_Controller{
    public function __construct() {
        session_start();
        parent::__construct();
        
    }
    
    function insert_pac(){
        $cam=  explode('*', $_GET['datos']);
        
//        echo $cam[0].'<br>';
//        echo $cam[1].'<br>';
//        echo $cam[2].'<br>';    
       
//        $this->pacientes_model->insert_pacientes($nom,$ape,$direc,$dni,$distri,$sexo,$fchnac,$tel,$movi,$claro,$email,$depen,$seg);
        $sql=$this->pacientes_model->insert_pacientes($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8],$cam[9],$cam[10],$cam[11],$cam[12]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }    
  
    function update_pac(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pacientes_model->update_pacientes($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8],$cam[9],$cam[10],$cam[11],$cam[12],$cam[13]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    
    function insert_consulta_pac(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pacientes_model->insert_consulta_pac($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }

    function get_all(){
	header('Content-type: application/json');
        $page  = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx  = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord  = $_GET['sord']; // get the direction
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->pacientes_model->get_cont_by_date());

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
        $Consulta =$this->pacientes_model->get_all_pacientes($sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $edad=$this->pacientes_model->get_edad($Datos->fec_nac);
           $Lista->rows[$Index]['id'] = $Datos->id;
	   $Lista->rows[$Index]['cell']= array($Datos->id,
                            trim($Datos->nombre),
                            trim($Datos->apellido),               
                            trim($edad),
                            trim($Datos->direccion),
                            trim($Datos->dni),
                            trim($Datos->distrito),
                            trim($Datos->email),
                            '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Editar Paciente" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_pac('.$Datos->id.');"/>',
                            '<input id="btn_image_ver_pac" type="image" width="17px" height="15px" title="Ver Tratamiento" src="'.base_url('public/images/pago2.png').'" onClick="ver_tratamiento_pac('.$Datos->id.','.$edad.');"/>',
                            '<input id="btn_image_ver_cita" type="image" width="18px" height="18px" title="Ver Cita" src="'.base_url('public/images/vista_previa.png').'" onClick="ver_cita_pac('.$Datos->id.');"/>',
                            trim($Datos->sexo),
                            trim($Datos->telefono),
                            trim($Datos->movistar),
                            trim($Datos->claro),
                            trim($Datos->fec_nac),
                            trim($Datos->dependiente),
                            trim($Datos->seg_id),
                            trim($Datos->estado),
                            trim($Datos->seg_des));
	      
        }
        echo json_encode($Lista);
    }
    
    function get_buscar_paciente(){
	header('Content-type: application/json');
        $page  = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx  = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord  = $_GET['sord']; // get the direction
        $txtbuscar = $_GET['txtbuscar'];
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->pacientes_model->get_cont_by_date_paciente($txtbuscar));

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
        $Consulta =$this->pacientes_model->get_buscar_paciente($txtbuscar,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;

        foreach($Consulta as $Index => $Datos)
        {
           $edad=$this->pacientes_model->get_edad($Datos->fec_nac);
           $Lista->rows[$Index]['id'] = $Datos->id;
	   $Lista->rows[$Index]['cell']= array($Datos->id,
                            trim($Datos->nombre),
                            trim($Datos->apellido),
                            trim($edad),
                            trim($Datos->direccion),
                            trim($Datos->dni),
                            trim($Datos->distrito),
                            trim($Datos->email),
                            '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Editar Paciente" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_pac('.$Datos->id.');"/>',
                            '<input id="btn_image_ver_pac" type="image" width="17px" height="15px" title="Ver Tratamiento" src="'.base_url('public/images/pago2.png').'" onClick="ver_tratamiento_pac('.$Datos->id.','.$edad.');"/>',
                            '<input id="btn_image_ver_cita" type="image" width="18px" height="18px" title="Ver Cita" src="'.base_url('public/images/vista_previa.png').'" onClick="ver_cita_pac('.$Datos->id.');"/>',
                            trim($Datos->sexo),
                            trim($Datos->telefono),
                            trim($Datos->movistar),
                            trim($Datos->claro),
                            trim($Datos->fec_nac),
                            trim($Datos->dependiente),
                            trim($Datos->seg_id),
                            trim($Datos->estado),
                            trim($Datos->seg_des));
	      
        }
        echo json_encode($Lista);
    }
    
    function listartodo_trat(){
        header("Content-Type: application/json");
        $seg_id=$_GET['seg_id'];
        $Consulta= $this->pacientes_model->get_trat_tip($seg_id);       
               
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new stdClass();
            $Lista->esp_tip=$Datos->esp_tip;
//            $Lista->esp_tip_des=  utf8_encode(trim($Datos->esp_tip_des));
            $Lista->value=$Datos->esp_cod;
            $Lista->label=  utf8_encode(trim($Datos->esp_des));
            $Lista->sol=$Datos->esp_cos_sol;
            $Lista->dol=$Datos->esp_cos_dol;
            array_push($todo,$Lista);
        }
        echo @json_encode($todo);
    }
    
    function listartodo_doc(){
        header("Content-Type: application/json");       
        $Consulta= $this->pacientes_model->get_doctores();       
               
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new stdClass();           
            $Lista->value=$Datos->doc_id;
            $Lista->label=  utf8_encode(trim($Datos->doc_nom_com));           
            array_push($todo,$Lista);
        }
        echo @json_encode($todo);
    }
    /////factura///////////////////////
    function listartodo_ruc(){
        header("Content-Type: application/json");      
        $Consulta= $this->pacientes_model->get_factura_ruc();       
               
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new stdClass();
            $Lista->value=$Datos->id;
            $Lista->label=trim($Datos->ruc_num.' - '.utf8_encode(trim($Datos->ruc_raz_soc)));
            $Lista->num_ruc=trim($Datos->ruc_num);
            $Lista->raz_soc=utf8_encode(trim($Datos->ruc_raz_soc));          
            array_push($todo,$Lista);
        }
        echo @json_encode($todo);
    }
    
    //TRATAMIENTO
    function insert_tratamiento_pac(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pacientes_model->insert_tratamiento_pac($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8],$cam[9]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    function get_num_trat(){
            
        $Consulta= $this->pacientes_model->get_num_trat($_GET['ide_trb']);  
//        $trat=$Consulta->trat_tot;
        if($Consulta){
            header("Content-Type: application/json");   
            $trat=array();
            foreach($Consulta as $Datos){
                $Lista=new stdClass();           
                $Lista->trat=$Datos->trat_tot;                      
                array_push($trat,$Lista);
            }
            echo @json_encode($trat);
        }else{
            echo 'no';
        }
        
        
    }
    function get_ver_dscto(){
        header("Content-Type: application/json");   
        $cam=  explode('*', $_GET['datos']);
        $Consulta= $this->pacientes_model->get_ver_trat_dscto($cam[0],$cam[1]);  
        $todo=array();
        foreach($Consulta as $Datos)
        {
            $Lista=new stdClass();           
            $Lista->des = trim($Datos->dscto_des);
            $Lista->subtot =  $Datos->dscto_trat_subtot;
            $Lista->dscto  =  $Datos->dscto_trat_dscto;
            $Lista->tot    =  $Datos->dscto_trat_tot;           
            array_push($todo,$Lista);
        }
        echo @json_encode($todo);
    }
    function get_consulta_costo(){
        header("Content-Type: application/json");       
        $Consulta= $this->pacientes_model->get_consulta_costo($_GET['ide_trb'],$_GET['trat_num']);  
        $trat=array();
//        $Lista=new stdClass(); 
        $trat['costo']=$Consulta->cons_cos;                      
        $trat['fecha']=$Consulta->cons_fch;
       
        echo @json_encode($trat);
    }
    
    //VER TRATAMIENTO / TRAER NUMERO DE TRATAMIENTOS POR PACIENTE
    function get_ver_trat_select(){
        header("Content-Type: application/json");       
        $Consulta= $this->pacientes_model->get_ver_trat_select($_GET['ide_trb']);  
        $trat=array();
        foreach($Consulta as $Datos){
            $Lista=new stdClass();           
            $Lista->trat=$Datos->trat_num;                      
            array_push($trat,$Lista);
        }
        echo json_encode($trat);
    }
    
    function get_ver_tratamiento(){
        header('Content-type: application/json');
        $page  = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx  = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord  = $_GET['sord']; // get the direction
        $pac_id = $_GET['pac_id'];
        $num_trat = $_GET['num_trat'];
        
        $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->pacientes_model->get_cont_ver_trat($pac_id,$num_trat));

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
        $Consulta =$this->pacientes_model->get_ver_trat_all($pac_id,$num_trat,$sidx,$sord,$start,$limit);
        $ttotal=$this->pacientes_model->get_trat_ttotal($pac_id,$num_trat);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        $c=0;
        $tot=0;
        foreach($Consulta as $Index => $Datos)
        {
           $c+=1;
           $tot+=$Datos->trat_esp_cos_sol;
           $Lista->rows[$Index]['id'] = $Datos->trat_id;
           if($c==1){
               $Lista->rows[$Index]['cell']= array(
                    $Datos->trat_id,
                    $Datos->trat_num,
                    trim($Datos->trat_esp_des),
                    $Datos->trat_cant,
                    $Datos->trat_esp_cos_sol,
                    $Datos->trat_esp_cos_dol,
                    $Datos->trat_fch,
                    $Datos->seguro,
                    $Datos->trat_seg_id,
                    $Datos->doctor,
                    $Datos->trat_doc_id,
                    '',
                    '',
                    '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Editar Tratamiento" src="'.base_url('public/images/editar.png').'" onClick="btn_open_editar_consulta('.$Datos->trat_id.');"/>',
                    '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Eliminar Tratamiento" src="'.base_url('public/images/delete.png').'" onClick="del_trat_unidad('.$Datos->trat_id.','.$Datos->trat_esp_cos_sol.','.$Datos->trat_esp_cos_dol.');"/>',
                    $ttotal->total
               );
           }else{
               $Lista->rows[$Index]['cell']= array(
                    $Datos->trat_id,
                    $Datos->trat_num,
                    trim($Datos->trat_esp_des),
                    $Datos->trat_cant,
                    $Datos->trat_esp_cos_sol,
                    $Datos->trat_esp_cos_dol,
                    $Datos->trat_fch,
                    $Datos->seguro,
                    $Datos->trat_seg_id,
                    $Datos->doctor,
                    $Datos->trat_doc_id,
                    $Datos->trat_esp_tip,
                    $Datos->trat_esp_cod,
                    '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Editar Tratamiento" src="'.base_url('public/images/editar.png').'" onClick="btn_open_editar_trat('.$Datos->trat_id.','.$Datos->trat_esp_cos_sol.','.$Datos->trat_esp_cos_dol.');"/>',
                    '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Eliminar Tratamiento" src="'.base_url('public/images/delete.png').'" onClick="del_trat_unidad('.$Datos->trat_id.','.$Datos->trat_esp_cos_sol.','.$Datos->trat_esp_cos_dol.');"/>',
                    $ttotal->total
               );
           }
	   	      
        }
        echo json_encode($Lista);
    }
    
    function eliminar_tratamiento(){
        $trat_id = $_GET['trat_id'];
        $sql=$this->pacientes_model->delete_tratamiento_0($trat_id);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    function editar_tratamiento(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pacientes_model->update_tratamiento_unid($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6],$cam[7],$cam[8],$cam[9],$cam[10],$cam[11]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    
    function editar_trat_consulta(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->pacientes_model->update_tratamiento_unid_consulta($cam[0],$cam[1],$cam[2],$cam[3],$cam[4]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    
    function insert_dscto_trat(){
        $cam=  explode('*', $_GET['datos']);        
//        echo $cam[0].'<br>';
        $sql=$this->pacientes_model->insert_dscto_trat($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    } 
    
    function insert_dscto_trat_dol(){
        $cam=  explode('*', $_GET['datos']);        
//        echo $cam[0].'<br>';
        $sql=$this->pacientes_model->insert_dscto_trat_dol($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5],$cam[6]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    } 
    
    function get_cita_pac(){// CONSULTA DE CITA/*///        
        header('Content-type: application/json');
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        
        $pac_id=$_GET['ide'];
        
        $sql=$this->agenda_model->get_cita_paciente($pac_id);
        
        $Eventos = array();          
        
        if($sql){     
            foreach ($sql as $Index => $cita) {  
                date_default_timezone_set('America/Lima');                     
                $timestamp = strtotime($cita->fch_ini);
                $fch_cita=  $dias[date('w',$timestamp)]." ".date('d',$timestamp)." de ".$meses[date('n',$timestamp)-1]. " del ".date('Y',$timestamp);
                $hora=date('h:i a',$timestamp);
                
                $Eventos[$Index]['modo'] = "cita";
                $Eventos[$Index]['ide_not'] = $cita->ide_not;
                setlocale(LC_ALL,"es_ES");
                $Eventos[$Index]['fch_ini'] = $fch_cita;                
                $Eventos[$Index]['fch_hora'] = $hora;
                $Eventos[$Index]['nom_com'] = $cita->nom_com;
                $Eventos[$Index]['des_not'] = trim($cita->des_not);                                    
            }
        }else{
            $primera_cita=$this->agenda_model->get_primera_cita($pac_id);
            if($primera_cita){
                
                foreach ($primera_cita as $Index => $pri_cita) {
                    date_default_timezone_set('America/Lima');     
                    $timestamp= strtotime(str_replace('/', '-',$pri_cita->cons_fch." ".trim($pri_cita->cons_hora)));
                    $fch_cita=$dias[date('w',$timestamp)]." ".date('d',$timestamp)." de ".$meses[date('n',$timestamp)-1]. " del ".date('Y',$timestamp);
                    $hora=date('h:i a',$timestamp);
                    
                    $Eventos[$Index]['modo'] = "primera";
                    $Eventos[$Index]['cons_id'] = $pri_cita->cons_id;
                    setlocale(LC_ALL,"es_ES");
                    $Eventos[$Index]['fch_ini'] = $fch_cita;                
                    $Eventos[$Index]['fch_hora'] = $hora;
                    $Eventos[$Index]['des_not'] = "CONSULTA";
                    $Eventos[$Index]['nom_com'] = $pri_cita->pac_nom_com;                    
                  
                }
            }else{
                $Eventos['modo'] = "no";
            }
        }
        
        echo json_encode($Eventos);
    }
    
    //CONSULTA EL RUC DE UN PACIENTE..../ INSERTA NUEVO RUC
    function get_ruc($id){
        header("Content-Type: application/json"); 
        $sql=$this->pacientes_model->model_get_ruc($id);
        if($sql){
            $ruc=array();                                  
            $ruc['ruc_raz_soc']=trim($sql->ruc_raz_soc);
            $ruc['ruc_num']=trim($sql->ruc_num);
            $ruc['ruc_dir']=trim($sql->ruc_dir);
            $ruc['ruc_est']=trim($sql->ruc_est);

            echo json_encode($ruc);
        }       
    }
    function insert_ruc(){
        $cam=  explode('*', $_GET['datos']); 
        $sql=$this->pacientes_model->insert_nuevo_ruc($cam[0],$cam[1],$cam[2],$cam[3]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    
    function get_evolucion_anterior(){
        $Consulta= $this->pacientes_model->get_evo_anterior($_GET['pac_id']);  

        if($Consulta){
            header("Content-Type: application/json");   
            $trat=array();
            foreach($Consulta as $Datos){
                $Lista=new stdClass();           
                $Lista->evo_fch=date('d/m/Y',strtotime(str_replace("-", "/", trim($Datos->fecha)))); 
                $Lista->evo_hra=date("g:i a",strtotime($Datos->hora)); 
                $Lista->evo_des=trim($Datos->evo_pro_acti_des); 
                array_push($trat,$Lista);
            }
            echo @json_encode($trat);
        }else{
            echo 'no';
        }
    }
    
    function get_ver_evolucion(){
        header('Content-type: application/json');
        $page  = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx  = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord  = $_GET['sord']; // get the direction
        $pac_id = $_GET['pac_id'];
        $num_trat = $_GET['num_trat'];
        
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->pacientes_model->get_all_cont_evo($pac_id,$num_trat));

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
        $Consulta =$this->pacientes_model->get_all_evolucion($pac_id,$num_trat,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {           
           $Lista->rows[$Index]['id'] = $Datos->evo_ide;
	   $Lista->rows[$Index]['cell']= array($Datos->evo_ide,
                            trim($Datos->evo_act_des),
                            trim($Datos->nom_doc),               
                            trim(date('d/m/Y',strtotime(str_replace("-", "/", trim($Datos->fch)))).'  '.date("g:i a",strtotime($Datos->hora))),
                            trim(date('d/m/Y',strtotime(str_replace("-", "/", trim($Datos->prox))))),
                            trim($Datos->evo_cons));	      
        }
        echo json_encode($Lista);
    }
}
