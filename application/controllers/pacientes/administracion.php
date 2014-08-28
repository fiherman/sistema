<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Administracion extends CI_Controller{
    function insert_doc(){
        $cam=  explode('*', $_GET['datos']);
        
//        echo $cam[0].'<br>';
//        echo $cam[1].'<br>';
        $sql=$this->administracion_model->insert_doctores($cam[0],$cam[1],$cam[2],$cam[3],$cam[4]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }    
  
    function update_doc(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->administracion_model->update_doctores($cam[0],$cam[1],$cam[2],$cam[3],$cam[4],$cam[5]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    
    function get_all(){
	header('Content-type: application/json');
//        echo 'hola';
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->administracion_model->get_cont_by_date());

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
        $Consulta =$this->administracion_model->get_all_doctores($sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->doc_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->doc_id),
                            trim($Datos->doc_nom),
                            trim($Datos->doc_ape),
                            trim($Datos->doc_cop),
                            '<input id="btn_image_editar_doc" type="image" width="17px" height="15px" title="Editar Paciente" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_doc('.$Datos->doc_id.');"/>',
                            '<input id="btn_image_ver_doc" type="image" width="17px" height="15px" title="Ver Datos de Paciente" src="'.base_url('public/images/vista_previa.png').'" onClick="btn_ver_doc('.$Datos->doc_id.');"/>',
                            trim($Datos->doc_uni),                            
                            trim($Datos->doc_hab),
                            trim($Datos->doc_fch));	      
        }
        echo json_encode($Lista);
    }
    
    function get_buscar_doctor(){
	header('Content-type: application/json');
//        echo 'hola';
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
        $txtbuscar = $_GET['txtbuscar'];
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->administracion_model->get_cont_buscar_doctor($txtbuscar));

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
        $Consulta =$this->administracion_model->get_buscar_doctor($txtbuscar,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->doc_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->doc_id),
                            trim($Datos->doc_nom),
                            trim($Datos->doc_ape),
                            trim($Datos->doc_cop),
                            '<input id="btn_image_editar_doc" type="image" width="17px" height="15px" title="Editar Paciente" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_doc('.$Datos->doc_id.');"/>',
                            '<input id="btn_image_ver_doc" type="image" width="17px" height="15px" title="Ver Datos de Paciente" src="'.base_url('public/images/vista_previa.png').'" onClick="btn_ver_doc('.$Datos->doc_id.');"/>',
                            trim($Datos->doc_uni),                            
                            trim($Datos->doc_hab),
                            trim($Datos->doc_fch));	      
        }
        echo json_encode($Lista);
    }
    
    function get_all_esp(){
        header("Content-Type: application/json");       
        $Consulta= $this->administracion_model->get_ver_all_esp($_GET['seg_id']);  
        $trat=array();
        foreach($Consulta as $Datos){
            $Lista=new stdClass();           
            $Lista->cod=$Datos->esp_tip;                      
            $Lista->des=$Datos->des;                      
            array_push($trat,$Lista);
        }
        echo json_encode($trat);
    }
    
    ///especialidad//////////////
    function get_especialidad_des(){
        header('Content-type: application/json');
        $seg_id=$_GET['seg_id'];
        $esp_tip=$_GET['esp_tip'];
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->administracion_model->get_cont_especialidades($seg_id,$esp_tip));

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
        $Consulta =$this->administracion_model->get_all_especialidades($seg_id,$esp_tip,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->esp_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->esp_id),
                            trim($Datos->seg_id),
                            trim($Datos->esp_tip),
                            trim($Datos->esp_des),
                            trim($Datos->esp_cos_sol),
                            '<input id="btn_image_editar_esp" type="image" width="17px" height="15px" title="Editar Especialidad" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_especialidad('.$Datos->esp_id.');"/>',                            
                            );	      
        }
        echo json_encode($Lista);
    }
    
    function update_esp(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->administracion_model->update_especialidad($cam[0],$cam[1],$cam[2]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
    
    //////////////////////////////////USUARIOS/////////////////////////////////////////////////////////////////
    function get_all_usuarios(){
	header('Content-type: application/json');
//        echo 'hola';
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->administracion_model->get_cont_usuarios());

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
        $Consulta =$this->administracion_model->get_all_usuarios($sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->user_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->user_id),
                            trim($Datos->usuario),
                            trim($Datos->nom_com),
                            trim($Datos->email),
                            '<input id="btn_image_editar_doc" type="image" width="17px" height="15px" title="Editar Paciente" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_usu('.$Datos->user_id.');"/>',                            
                            trim($Datos->cpassword),                            
                            trim($Datos->ccpassword),
                            trim($Datos->estado)
               );	      
        }
        echo json_encode($Lista);
    }
    function get_buscar_usuarios(){
	header('Content-type: application/json');
//        echo 'hola';
        $page  = $_GET['page']; 
        $limit = $_GET['rows']; 
        $sidx  = $_GET['sidx']; 
        $sord  = $_GET['sord']; 
        $txtbuscar = $_GET['txtbuscar'];
         $total_pages = 0;
        if(!$sidx){
            $sidx  = 1;
        }
        $count = count($this->administracion_model->get_cont_buscar_usuario($txtbuscar));

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
        $Consulta =$this->administracion_model->get_buscar_usuario($txtbuscar,$sidx,$sord,$start,$limit);

        $Lista = new stdClass();
        $Lista->page    = $page;
        $Lista->total   = $total_pages;
        $Lista->records = $count;
        
        foreach($Consulta as $Index => $Datos)
        {
           $Lista->rows[$Index]['id'] = $Datos->user_id;
	   $Lista->rows[$Index]['cell']= array(trim($Datos->user_id),
                            trim($Datos->usuario),
                            trim($Datos->nom_com),
                            trim($Datos->email),
                            '<input id="btn_image_editar_doc" type="image" width="17px" height="15px" title="Editar Paciente" src="'.base_url('public/images/editar.png').'" onClick="btn_editar_usu('.$Datos->user_id.');"/>',                            
                            trim($Datos->cpassword),                            
                            trim($Datos->ccpassword),
                            trim($Datos->estado)
               );	      
        }
        echo json_encode($Lista);
    }
    
    function insert_usu(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->administracion_model->insert_usuarios($cam[0],$cam[1],$cam[2],$cam[3]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    } 
    function update_usu(){
        $cam=  explode('*', $_GET['datos']);
        $sql=$this->administracion_model->update_usuarios($cam[0],$cam[1],$cam[2],$cam[3],$cam[4]);
        if($sql){
            echo 'si';
        }else{
            echo 'no';
        }
    }
}
