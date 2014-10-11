<?php
class reportes extends CI_Controller
{
    function estado_cta($pac_id,$trat_num)
    {        error_reporting(0);
         date_default_timezone_set('America/Lima');
//    header('Content-type: application/json');
         $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $c=0;$tot_sol=0;$tot_dol=0;
         
         $Html="<title>ESTADO DE CTA</title>";         
         $Html.="<style>
                    .table_cab { border-collapse: separate;  border-spacing:  -1px; border-style: hidden;margin-left:10px }
                    .table_cab tr td{ border:1px solid #000000; font-size: 14px;  }
                    .table_trat{ font-size: 12px;margin-left:10px}
                    #cabesera{font-size: 14px;}
                    
                    #header { position: fixed; left: 10px; top: -30px; right: 0px; height: 20px; background-color: white; text-align: center; }
                    #footer { position: fixed; left: 10px; bottom: -50px; right: 0px; height: 50px; background-color: white; font-family:arial, helvetica; font-size:12px; font-size:12px;text-align: right; }
                    @page {margin-top: 80px; margin-left: 2.0em;}
                    #header .page:after { content: counter(page, arial); }
                 </style>";         
         $Html.="<div id='header'>   
                    <table width=100%><tr>
                            <td width=80px> <img style='margin-left:0px;width:130px' src='http://".$_SERVER["SERVER_NAME"]."/sistema/public/images/laroca.jpg'/><td>                            
                            <td width=400px><span style='margin-left:15%;font-size: 16px;text-decoration: underline;color:#FF0000'>ESTADO DE CUENTA DEL PACIENTE</span><td>
                            <td width=80px><span class='page'>".date('d/M/Y')."<br>N&deg;Pag: </span><td></tr>
                    </table>                                 
                 </div>                 
                 <hr style='background-color: black; height: 1px; border: 0;margin-top:40px;margin-left:10px'><br>";
         
         $cabesera=$this->pacientes_model->get_cabecera_report($pac_id,$trat_num);
         $trat=$this->pacientes_model->get_trat_report($pac_id,$trat_num);
         $dscto_sol=$this->pacientes_model->get_dscto_sol($pac_id,$trat_num);
         $dscto_dol=$this->pacientes_model->get_dscto_dol($pac_id,$trat_num);
         $pagos=$this->pacientes_model->get_pago_sol_dol($pac_id,$trat_num);
         $max= count($pagos[0]);
         if(count($pagos[1])>$max){
             $max=count($pagos[1]);
         }
                
//         $pag_dol=$this->pacientes_model->get_pago_dol($pac_id,$trat_num);         
         
         $Html.="<div style='font-size: 14px;margin-left:10px' >Codigo&nbsp;&nbsp;&nbsp;  : ".$cabesera->pac_id."</div> 
                 <div style='font-size: 14px;margin-left:10px'>Paciente &nbsp;: ".$cabesera->pac_nom_com." </div><br>";
         
         $Html.="<center>TRATAMIENTO N&deg;&nbsp;".$trat_num."</center>";
         
         $fch= strtotime(str_replace('/', '-', $cabesera->cons_fch));
         $fecha=$dias[date('w',$fch)]." ".date('d',$fch)." de ".$meses[date('n',$fch)-1]. " del ".date('Y',$fch) ;         
         
         $Html.="<div style='font-size: 14px;margin-left:10px'>Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : ".$fecha."</div> 
                 <div style='font-size: 14px;margin-left:10px'>Consulta &nbsp;: ".$cabesera->cons_id." </div><br>";
         $Html.="<table class='table_cab' width=100%>
                    <tr>
                        <td align=center width=5%>N&deg;</td>
                        <td align=center width=65%>Tratamiento - Descripci&oacute;n</td>
                        <td align=center width=5%>Cant.</td>
                        <td align=center width=10%>Costo S/.</td>
                        <td align=center width=10%>Costo US$. </td>
                    </tr></table>
                    <table class='table_trat' width=100%>";
         foreach($trat as $Index => $Datos){
	    $c+=1;$tot_sol+=$Datos->trat_esp_cos_sol;$tot_dol+=$Datos->trat_esp_cos_dol;
	     $Html.="<tr>";
		  $Html.="<td width=5% align=center>".$c."</td>";
		  $Html.="<td width=65%>".  utf8_decode(trim($Datos->trat_esp_des))."</td>";
		  $Html.="<td width=5% align=center>".trim($Datos->trat_cant)."</td>";
		  $Html.="<td width=10% align=right>".number_format($Datos->trat_esp_cos_sol,2)."</td>";
		  $Html.="<td width=10% align=right>".number_format($Datos->trat_esp_cos_dol,2)."</td>";
	     $Html.="</tr>";
	 }
         $Html.="</table>";
         $ttotal_s = $tot_sol-$dscto_sol->dscto_trat_dscto;
         $ttotal_d = $tot_dol-$dscto_dol->dscto_trat_dscto;
         $Html.="<div style='margin-left:57.5%'><table width=100% class='table_trat' style='margin-left:10px'>
                    <tr>
                        <td width=50% >SUB TOTAL</td>
                        <td width=25% align=right style='border-top: 1px solid black;'>".number_format($tot_sol,2)."</td>
                        <td width=25% align=right style='border-top: 1px solid black;'>".number_format($tot_dol,2)."</td>
                    </tr><tr>
                        <td>DSCTO</td>
                        <td align=right>".$dscto_sol->dscto_porcent."%"."&nbsp;&nbsp;&nbsp;".number_format($dscto_sol->dscto_trat_dscto,2,'.',',')."</td>
                        <td align=right>".$dscto_dol->dscto_porcent."%"."&nbsp;&nbsp;&nbsp;".number_format($dscto_dol->dscto_trat_dscto,2,'.',',')."</td>
                    </tr><tr>
                        <td>TOTAL</td>
                        <td align=right style='border: 1px solid black;'>".number_format($ttotal_s,2)."</td>
                        <td align=right style='border: 1px solid black;'>".number_format($ttotal_d,2)."</td>
                    </tr>
                   </table>
                 </div><br>";
         
         $Html.="<table class='table_cab' width=100% style='margin-left:10px;'>
                    <tr><td colspan=5 align=center> PAGOS </td></tr>
                    <tr>
                        <td width=4% align=center>N&deg;</td>
                        <td width=38% align=center>SOLES</td>
                        <td width=10% align=right >".number_format($ttotal_s,2)."</td>
                        <td width=38% align=center>DOLARES</td>
                        <td width=10% align=right>".number_format($ttotal_d,2)."</td>
                    </tr>
                 </table>
                 <table class='table_trat' width=100%>"; 
         $ssaldo_s=$ttotal_s;
         $ssaldo_d=$ttotal_d;
         for($i=0; $i<$max;$i++){
	    $ssaldo_s-=$pagos[0][$i]->pag_monto_sol;$ssaldo_d-=$pagos[1][$i]->pag_monto;
	     $Html.="<tr>";
		  $Html.="<td width=4% align=center>".($i+1)."</td>"; 
                  if($pagos[0][$i]->pag_fch && $pagos[0][$i]->pag_codigo){
                      $fch_s= strtotime(str_replace('/', '-', trim($pagos[0][$i]->pag_fch)));
                      $fecha_s=date('d',$fch_s)."/".substr($meses[date('n',$fch_s)-1],0,3). "/".date('Y',$fch_s); 
                      $fff="&nbsp;&nbsp;&nbsp;(".$fecha_s.") Doc. ".$pagos[0][$i]->pag_codigo;
                  }else{ $fff="&nbsp;&nbsp;&nbsp;---";  }
                  
                  
                  $Html.="<td width=38%>".$fff."</td>";
		  $Html.="<td width=10% align=right>-".number_format($pagos[0][$i]->pag_monto_sol,2)."</td>";
                  
                  if($pagos[1][$i]->pag_fch && $pagos[1][$i]->pag_codigo){
                      $fch_d= strtotime(str_replace('/', '-', trim($pagos[1][$i]->pag_fch)));
                      $fecha_d=date('d',$fch_d)."/".substr($meses[date('n',$fch_d)-1],0,3). "/".date('Y',$fch_d);
                      $ddd="&nbsp;&nbsp;&nbsp;(".$fecha_d.") Doc. ".$pagos[1][$i]->pag_codigo;
                  }else{ $ddd="&nbsp;&nbsp;&nbsp;---";  }
                                   
                  $Html.="<td width=38%>".$ddd."</td>";
		  $Html.="<td width=10% align=right>-".number_format($pagos[1][$i]->pag_monto,2)."</td>";
	     $Html.="</tr>";
	 }
         $Html.="</table>";
         $Html.="<table class='table_trat' width=100% style='margin-left:10px'>
                    <tr>
                        <td width=4% ></td>
                        <td width=38% align=right>SALDO SOLES</td>
                        <td width=10% align=right style='border: 1px solid black;'>".number_format($ssaldo_s,2)."</td>
                        <td width=38% align=right>SALDO DOLARES</td>
                        <td width=10% align=right style='border: 1px solid black;'>".number_format($ssaldo_d,2)."</td>
                    </tr>
                 </table><br><br>";
         $Html.="<table class='table_trat' style='margin-left:10px'>
                    <tr>
                        <td colspan=4>RESUMEN:</td>                        
                    </tr>
                    <tr>
                        <td>DEUDA ACTUAL SOLES</td><td>:</td><td align=right>S/.</td><td align=right>".number_format($ssaldo_s,2)."</td>                        
                    </tr>
                    <tr>
                        <td>DEUDA ACTUAL DOLARES</td><td>:</td><td align=right>US$</td><td align=right>".number_format($ssaldo_d,2)."</td>                        
                    </tr>
                 </table>";
         $Html.="
                 <div id='footer'><div style='height:1px; background-color:Black;margin-left:10px'> BkSoft</div>";
//        echo $Html;
        
//        echo json_encode($pagos[1][0]);
         
	 $this->dompdf_lib->set_paper ('a4','portraid');//landscape
	 $this->dompdf_lib->load_html($Html);
	 $this->dompdf_lib->render();
	 $this->dompdf_lib->stream("reporte_estado_de_cuenta_paciente.pdf", array("Attachment" => 0));
    }
    
    function ingresos_mes($fch){
         $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $totsol=0;$totdol=0;$totvouch=0;
         error_reporting(0);  
         date_default_timezone_set('America/Lima');
         $mmes=  strtotime(date('d-m-Y'));
         $mes=  strtotime("01-".$fch."-".date('Y'));
         $Html="<title>INGRESOS-".$meses[date('n',$mes)-1]."</title>";            
         $Html.="<style>
                    .table_cab { border-collapse: separate;  border-spacing:  -1px; border-style: hidden;margin-left:10px }
                    .table_cab tr td{ border:1px solid #000000; font-size: 14px;  }
                    .table_trat{ font-size: 12px;margin-left:10px}
                    #cabesera{font-size: 14px;}
                    
                    #header { position: fixed; left: 10px; top: -30px; right: 0px; height: 20px; background-color: white; text-align: center; }
                    #footer { position: fixed; left: 10px; bottom: -50px; right: 0px; height: 50px; background-color: white; font-family:arial, helvetica; font-size:12px; font-size:12px;text-align: right; }
                    @page {margin-top: 80px; margin-left: 2.0em;}
                    #header .page:after { content: counter(page, arial); }
                 </style>";         
         $Html.="<div id='header'>   
                    <table width=100%><tr>
                            <td width=80px> <img style='margin-left:0px;width:130px' src='http://".$_SERVER["SERVER_NAME"]."/sistema/public/images/laroca.jpg'/><td>                            
                            <td width=400px><span style='margin-left:22%;font-size: 16px;text-decoration: underline;color:#FF0000'>REPORTE DE INGRESOS MENSUAL</span><td>
                            <td width=80px><span class='page'>".date('d',$mmes)."/".substr($meses[date('n',$mmes)-1],0,3). "/".date('Y',$mmes)."<br>N&deg;Pag: </span><td></tr>
                    </table>                                 
                 </div>                 
                 <hr style='background-color: black; height: 1px; border: 0;margin-top:40px;margin-left:10px'><br>";
         


         $Html.="<center>".strtoupper($meses[date('n',$mes)-1])." DEL ".date('Y')." </center><br>";
         $Html.="<table class='table_cab' width=100%>
                  <tr>
                      <td align=center width=10%>FECHA</td>
                      <td align=center width=45%>PACIENTE</td>
                      <td align=center width=18%>Documento</td>
                      <td align=center width=9%>Soles</td>
                      <td align=center width=9%>Dolares</td>
                      <td align=center width=9%>Voucher</td>
                  </tr></table>
                  <table class='table_trat' width=100%>";
         
         for ($i=1;$i<=31;$i++){
            $setfch=$i."/".$fch."/".date('Y');
            $soles=$this->pacientes_model->get_soles($setfch);
            $dola=$this->pacientes_model->get_dolares($setfch);
            $vouch=$this->pacientes_model->get_voucher($setfch);
            if($soles ||  $dola || $vouch){
               if($soles){
                    foreach($soles as $Index => $Datos){
                        $totsol+=$Datos->pag_monto_sol;
                        $Html.="<tr>";
                            $Html.="<td width=10% align=center>".$Datos->pag_fch."</td>";
                            $Html.="<td width=45%>".  utf8_decode(trim($Datos->nom_com))."</td>";
                            $Html.="<td width=18%>". substr(trim($Datos->documento),0,3).": ".trim($Datos->pag_codigo)."</td>";
                            $Html.="<td width=9% align=right>".number_format($Datos->pag_monto_sol,2)."</td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right></td>";
                        $Html.="</tr>";
                    }                
                }            
                if($dola){
                    foreach($dola as $Index => $Datos){
                        $totdol+=$Datos->pag_monto;
                        $Html.="<tr>";
                            $Html.="<td width=10% align=center>".$Datos->pag_fch."</td>";
                            $Html.="<td width=45%>".  utf8_decode(trim($Datos->nom_com))."</td>";
                            $Html.="<td width=18%>". substr(trim($Datos->documento),0,3).": ".trim($Datos->pag_codigo)."</td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right>".number_format($Datos->pag_monto,2)."</td>";
                            $Html.="<td width=9% align=right></td>";
                        $Html.="</tr>";
                    }                
                }
                if($vouch){
                    foreach($vouch as $Index => $Datos){
                        $totvouch+=$Datos->pag_monto_sol;
                        $Html.="<tr>";
                            $Html.="<td width=10% align=center>".$Datos->pag_fch."</td>";
                            $Html.="<td width=45%>".  utf8_decode(trim($Datos->nom_com))."</td>";
                            $Html.="<td width=18%>". substr(trim($Datos->documento),0,3).": ".trim($Datos->pag_codigo)."</td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right>".number_format($Datos->pag_monto_sol,2)."</td>";
                        $Html.="</tr>";
                    }                
                } 
            }            
         }
         $Html.="<table class='table_trat' width=100%>
                  <tr>                      
                      <td align=center width=73%>TOTALES</td>
                      <td align=right width=9% style='border: 1px solid black;'>".number_format($totsol,2)."</td>
                      <td align=right width=9% style='border: 1px solid black;'>".number_format($totdol,2)."</td>
                      <td align=right width=9% style='border: 1px solid black;'>".number_format($totvouch,2)."</td>
                  </tr></table>
                  ";
         $Html.="</table>";      
         
         $Html.="<div id='footer'><div style='height:1px; background-color:Black;margin-left:10px'> BkSoft</div>";
       
         //<table class='table_trat' width=100%>
//          echo $Html;
        
//        echo json_encode($pagos[1][0]);
         
	 $this->dompdf_lib->set_paper ('a4','portraid');//landscape
	 $this->dompdf_lib->load_html($Html);
	 $this->dompdf_lib->render();
	 $this->dompdf_lib->stream("reporte_pagos_por_mes.pdf", array("Attachment" => 0));
    }
    
    function ingresos_dia(){
         $fch=$_GET['fch'];
         $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $totsol=0;$totdol=0;$totvouch=0;
         error_reporting(0);   
         date_default_timezone_set('America/Lima');
         $mes =  strtotime(date('d-m-Y'));
         $Html="<title>INGRESOS-DIA</title>";            
         $Html.="<style>
                    .table_cab { border-collapse: separate;  border-spacing:  -1px; border-style: hidden;margin-left:10px }
                    .table_cab tr td{ border:1px solid #000000; font-size: 14px;  }
                    .table_trat{ font-size: 12px;margin-left:10px}
                    #cabesera{font-size: 14px;}
                    
                    #header { position: fixed; left: 10px; top: -30px; right: 0px; height: 20px; background-color: white; text-align: center; }
                    #footer { position: fixed; left: 10px; bottom: -50px; right: 0px; height: 50px; background-color: white; font-family:arial, helvetica; font-size:12px; font-size:12px;text-align: right; }
                    @page {margin-top: 80px; margin-left: 2.0em;}
                    #header .page:after { content: counter(page, arial); }
                 </style>";         
         $Html.="<div id='header'>   
                    <table width=100%><tr>
                            <td width=80px> <img style='margin-left:0px;width:130px' src='http://".$_SERVER["SERVER_NAME"]."/sistema/public/images/laroca.jpg'/><td>                            
                            <td width=400px><span style='margin-left:22%;font-size: 16px;text-decoration: underline;color:#FF0000'>REPORTE DE INGRESOS DIARIO</span><td>
                            <td width=80px><span class='page'>".date('d',$mes)."/".substr($meses[date('n',$mes)-1],0,3). "/".date('Y',$mes)."<br>N&deg;Pag: </span><td></tr>
                    </table>                                 
                 </div>                 
                 <hr style='background-color: black; height: 1px; border: 0;margin-top:40px;margin-left:10px'><br>";
         


         $Html.="<center>".$fch." </center><br>";
         $Html.="<table class='table_cab' width=100%>
                  <tr>
                      <td align=center width=10%>FECHA</td>
                      <td align=center width=45%>PACIENTE</td>
                      <td align=center width=18%>Documento</td>
                      <td align=center width=9%>Soles</td>
                      <td align=center width=9%>Dolares</td>
                      <td align=center width=9%>Voucher</td>
                  </tr></table>
                  <table class='table_trat' width=100%>";
         
         
//            $setfch=$i."/".$fch."/".date('Y');
            $soles=$this->pacientes_model->get_soles($fch);
            $dola=$this->pacientes_model->get_dolares($fch);
            $vouch=$this->pacientes_model->get_voucher($fch);
            if($soles ||  $dola || $vouch){
               if($soles){
                    foreach($soles as $Index => $Datos){
                        $totsol+=$Datos->pag_monto_sol;
                        $Html.="<tr>";
                            $Html.="<td width=10% align=center>".$Datos->pag_fch."</td>";
                            $Html.="<td width=45%>".  utf8_decode(trim($Datos->nom_com))."</td>";
                            $Html.="<td width=18%>". substr(trim($Datos->documento),0,3).": ".trim($Datos->pag_codigo)."</td>";
                            $Html.="<td width=9% align=right>".number_format($Datos->pag_monto_sol,2)."</td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right></td>";
                        $Html.="</tr>";
                    }                
                }            
                if($dola){
                    foreach($dola as $Index => $Datos){
                        $totdol+=$Datos->pag_monto;
                        $Html.="<tr>";
                            $Html.="<td width=10% align=center>".$Datos->pag_fch."</td>";
                            $Html.="<td width=45%>".  utf8_decode(trim($Datos->nom_com))."</td>";
                            $Html.="<td width=18%>". substr(trim($Datos->documento),0,3).": ".trim($Datos->pag_codigo)."</td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right>".number_format($Datos->pag_monto,2)."</td>";
                            $Html.="<td width=9% align=right></td>";
                        $Html.="</tr>";
                    }                
                }
                if($vouch){
                    foreach($vouch as $Index => $Datos){
                        $totvouch+=$Datos->pag_monto_sol;
                        $Html.="<tr>";
                            $Html.="<td width=10% align=center>".$Datos->pag_fch."</td>";
                            $Html.="<td width=45%>".  utf8_decode(trim($Datos->nom_com))."</td>";
                            $Html.="<td width=18%>". substr(trim($Datos->documento),0,3).": ".trim($Datos->pag_codigo)."</td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right></td>";
                            $Html.="<td width=9% align=right>".number_format($Datos->pag_monto_sol,2)."</td>";
                        $Html.="</tr>";
                    }                
                } 
            }            
         
         $Html.="<table class='table_trat' width=100%>
                  <tr>                      
                      <td align=center width=73%>TOTALES</td>
                      <td align=right width=9% style='border: 1px solid black;'>".number_format($totsol,2)."</td>
                      <td align=right width=9% style='border: 1px solid black;'>".number_format($totdol,2)."</td>
                      <td align=right width=9% style='border: 1px solid black;'>".number_format($totvouch,2)."</td>
                  </tr></table>
                  ";
         $Html.="</table>";      
         
         $Html.="<div id='footer'><div style='height:1px; background-color:Black;margin-left:10px'> BkSoft</div>";
       
         //<table class='table_trat' width=100%>
//          echo $Html;
	 $this->dompdf_lib->set_paper ('a4','portraid');//landscape
	 $this->dompdf_lib->load_html($Html);
	 $this->dompdf_lib->render();
	 $this->dompdf_lib->stream("reporte_pagos_por_dia.pdf", array("Attachment" => 0));
    }
    
    function consultas_dia(){
         $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         $c=0;
         $fch=  strtotime(date('d-m-Y'));
         error_reporting(0);         
         date_default_timezone_set('America/Lima');
         $Html="<title>CONSULTAS-".date('d/M/Y')."</title>";            
         $Html.="<style>
                    .table_cab { border-collapse: separate;  border-spacing:  -1px; border-style: hidden;margin-left:10px }
                    .table_cab tr td{ border:1px solid #000000; font-size: 14px;  }
                    .table_trat{ font-size: 12px;margin-left:10px}
                    #cabesera{font-size: 14px;}
                    
                    #header { position: fixed; left: 10px; top: -30px; right: 0px; height: 20px; background-color: white; text-align: center; }
                    #footer { position: fixed; left: 10px; bottom: -50px; right: 0px; height: 50px; background-color: white; font-family:arial, helvetica; font-size:12px; font-size:12px;text-align: right; }
                    @page {margin-top: 80px; margin-left: 2.0em;}
                    #header .page:after { content: counter(page, arial); }
                 </style>";         
         $Html.="<div id='header'>   
                    <table width=100%><tr>
                            <td width=80px> <img style='margin-left:0px;width:130px' src='http://".$_SERVER["SERVER_NAME"]."/sistema/public/images/laroca.jpg'/><td>                            
                            <td width=400px><span style='margin-left:15%;font-size: 16px;text-decoration: underline;color:#FF0000'>CONSULTAS DEL DIA ".date('d',$fch)."/".substr($meses[date('n',$fch)-1],0,3). "/".date('Y',$fch)."</span><td>
                            <td width=80px><span class='page'>".date('d',$fch)."/".substr($meses[date('n',$fch)-1],0,3). "/".date('Y',$fch)."<br>N&deg;Pag: </span><td></tr>
                    </table>                                 
                 </div>                 
                 <hr style='background-color: black; height: 1px; border: 0;margin-top:40px;margin-left:10px'><br>";
         
         $data=$this->pacientes_model->get_consultas();
         
         $Html.="<table class='table_cab' width=100%>
                  <tr>
                      <td align=center width=5%>N&deg;</td>
                      <td align=center width=15%>CODIGO</td>
                      <td align=center width=60%>PACIENTE</td>
                      <td align=center width=10%>HORA</td>
                      <td align=center width=10%>COSTO</td>                      
                  </tr></table>
                  <table class='table_trat' width=100%>";
         
         foreach($data as $Index => $Datos){
	    $c+=1;
	     $Html.="<tr>";
		  $Html.="<td width=5% align=center>".$c."</td>";
                  $Html.="<td width=15% align=center>".trim($Datos->pac_id)."</td>";
		  $Html.="<td width=60%>".utf8_decode(trim($Datos->pac_nom_com))."</td>";		  
		  $Html.="<td width=10% align=center>".trim($Datos->cons_hora)."</td>";
		  $Html.="<td width=10% align=center>".number_format($Datos->cons_cos,2)."</td>";
	     $Html.="</tr>";
	 }
         $Html.="</table>";
         $Html.="<div id='footer'><div style='height:1px; background-color:Black;margin-left:10px'> BkSoft</div>";
       
         //<table class='table_trat' width=100%>
//          echo $Html;
        
//        echo json_encode($pagos[1][0]);
         
	 $this->dompdf_lib->set_paper ('a4','portraid');//landscape
	 $this->dompdf_lib->load_html($Html);
	 $this->dompdf_lib->render();
	 $this->dompdf_lib->stream("consultas.pdf", array("Attachment" => 0));
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