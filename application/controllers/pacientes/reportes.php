<?php
class reportes extends CI_Controller
{
    function saludo($pac_id,$trat_num)
    {        error_reporting(0);
         $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $c=0;$tot_sol=0;$tot_dol=0;
         
         $Html="";         
         $Html.="<style>
                    #table_cab { border-collapse: separate;  border-spacing:  -1px; border-style: hidden }
                    #table_cab tr td{ border:1px solid #000000; font-size: 14px;  }
                    #table_trat{ font-size: 12px;}
                    #cabesera{font-size: 14px;}
                    
                    #header { position: fixed; left: 0px; top: -30px; right: 0px; height: 20px; background-color: white; text-align: center; }
                    #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px; background-color: white; font-family:arial, helvetica; font-size:12px; font-size:12px;text-align: right; }
                    @page {margin-top: 80px; margin-left: 2.0em;}
                    #header .page:after { content: counter(page, arial); }
                 </style>";         
         $Html.="<div id='header'>   
                    <table width=100%><tr>
                            <td width=80px> <img style='margin-left:0px' src='http://".$_SERVER["SERVER_NAME"]."/sistema/public/images/laroca.jpg'/><td>                            
                            <td width=400px><span style='margin-left:-20px;font-size: 16px;text-decoration: underline;color:#FF0000'>RESUMEN DE PAGOS POR CONSULTA DEL PACIENTE</span><td>
                            <td width=80px><span class='page'>".date('d/M/Y')."<br>N&deg;Pag: </span><td></tr>
                    </table>                                 
                 </div>                 
                 <hr style='background-color: black; height: 1px; border: 0;margin-top:40px'><br>";
         
         $cabesera=$this->pacientes_model->get_cabecera_report($pac_id,$trat_num);
         $trat=$this->pacientes_model->get_trat_report($pac_id,$trat_num);
         $dscto_sol=$this->pacientes_model->get_dscto_sol($pac_id,$trat_num);
         $dscto_dol=$this->pacientes_model->get_dscto_dol($pac_id,$trat_num);
         
         $Html.="<div style='font-size: 14px;' >Codigo&nbsp;&nbsp;&nbsp;  : ".$cabesera->pac_id."</div> 
                 <div style='font-size: 14px;'>Paciente &nbsp;: ".$cabesera->pac_nom_com." </div><br>";
         
         $Html.="<center>TRATAMIENTO N&deg;&nbsp;".$trat_num."</center>";
         
         $fch= strtotime(str_replace('/', '-', $cabesera->cons_fch));
         $fecha=$dias[date('w',$fch)]." ".date('d',$fch)." de ".$meses[date('n',$fch)-1]. " del ".date('Y',$fch) ;         
         
         $Html.="<div style='font-size: 14px;'>Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : ".$fecha."</div> 
                 <div style='font-size: 14px;'>Consulta &nbsp;: ".$cabesera->cons_id." </div><br>";
         $Html.="<table id='table_cab' width=100%>
                    <tr>
                        <td align=center width=5%>N</td>
                        <td align=center width=70%>Tratamiento - Descripci&oacute;n</td>
                        <td align=center width=5%>Cant.</td>
                        <td align=center width=10%>Costo S/.</td>
                        <td align=center width=10%>Costo US$. </td>
                    </tr></table>
                    <table id='table_trat' width=100%>";
         foreach($trat as $Index => $Datos){
	    $c+=1;$tot_sol+=$Datos->trat_esp_cos_sol;$tot_dol+=$Datos->trat_esp_cos_dol;
	     $Html.="<tr>";
		  $Html.="<td width=5% align=center>".$c."</td>";
		  $Html.="<td width=70%>".  utf8_decode(trim($Datos->trat_esp_des))."</td>";
		  $Html.="<td width=5% align=center>".trim($Datos->trat_cant)."</td>";
		  $Html.="<td width=10% align=right>".number_format($Datos->trat_esp_cos_sol,2)."</td>";
		  $Html.="<td width=10% align=right>".number_format($Datos->trat_esp_cos_dol,2)."</td>";
	     $Html.="</tr>";
	 }
        
         $ttotal_s = $tot_sol-$dscto_sol->dscto_trat_dscto;
         $ttotal_d = $tot_dol-$dscto_dol->dscto_trat_dscto;
         $Html.="<div style='margin-left:60%'><table width=100% >
                    <tr>
                        <td width=50% >SUB TOTAL</td>
                        <td width=25% align=right style='border-top: 1px solid black;'>".number_format($tot_sol,2)."</td>
                        <td width=25% align=right style='border-top: 1px solid black;'>".number_format($tot_dol,2)."</td>
                    </tr><tr>
                        <td>DSCTO</td>
                        <td align=right>".number_format($dscto_sol->dscto_trat_dscto,2,'.',',')."</td>
                        <td align=right>".number_format($dscto_dol->dscto_trat_dscto,2,'.',',')."</td>
                    </tr><tr>
                        <td>TOTAL</td>
                        <td align=right style='border-top: 1px solid black;'>".number_format($ttotal_s,2)."</td>
                        <td align=right style='border-top: 1px solid black;'>".number_format($ttotal_d,2)."</td>
                    </tr>
                 </table></div>";
         $Html.="
                 <div id='footer'><div style='height:1px; background-color:Black;'> BkSoft</div>";
//        echo $Html;
	 $this->dompdf_lib->set_paper ('a4','portraid');//landscape
	 $this->dompdf_lib->load_html($Html);
	 $this->dompdf_lib->render();
	 $this->dompdf_lib->stream("reporte_pagos.pdf", array("Attachment" => 0));
    }
    
    function get_all_pac_rep(){
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
           $Lista->rows[$Index]['id'] = $Datos->id;
	   $Lista->rows[$Index]['cell']= array($Datos->id,
                            trim($Datos->nombre),
                            trim($Datos->apellido),
                            trim($Datos->direccion),
                            trim($Datos->dni),
                            trim($Datos->distrito),
                            trim($Datos->email),
                            '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Resumen de Pagos - Tratamiento" src="'.base_url('public/images/reporte.png').'" onClick="btn_rep_trat('.$Datos->id.');"/>',                            
                            trim($Datos->sexo),
                            trim($Datos->telefono),
                            trim($Datos->movistar),
                            trim($Datos->claro),
                            trim($Datos->fec_nac),
                            trim($Datos->dependiente),
                            trim($Datos->seg_id),
                            trim($Datos->estado),
                            trim($Datos->seguro));
	      
        }
        echo json_encode($Lista);
    }
    
    function get_buscar_paciente_rep(){
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
           $Lista->rows[$Index]['id'] = $Datos->id;
	   $Lista->rows[$Index]['cell']= array($Datos->id,
                            $Datos->nombre,
                            $Datos->apellido,
                            $Datos->direccion,
                            $Datos->dni,
                            $Datos->distrito,
                            $Datos->email,
                            '<input id="btn_image_editar_pac" type="image" width="17px" height="15px" title="Resumen de Pagos - Tratamiento" src="'.base_url('public/images/reporte.png').'" onClick="btn_rep_trat('.$Datos->id.');"/>',
                            $Datos->sexo,
                            $Datos->telefono,
                            $Datos->movistar,
                            $Datos->claro,
                            $Datos->fec_nac,
                            $Datos->dependiente,
                            $Datos->seg_id,
                            $Datos->estado,
                            $Datos->seguro);
	      
        }
        echo json_encode($Lista);
    }
}
//
//$Html.="</table>
//                 <div style=''>
//                    <div style='text-align: right; width: 50%;'>SUB TOTAL</div> 
//                    <div style='border-top: 1px solid black; text-align: right; font-size: 13px; width: 7%; margin-left: 1%;'>665</div>
//                    <div style='width: 7%; text-align: right; font-size: 13px; float: left; border-top: 1px solid black; margin-left: 1%;'>665</div>
//                 </div>";