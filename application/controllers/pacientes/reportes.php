<?php
class reportes extends CI_Controller
{
    function saludo()
    {	 
         $Html="<!DOCTYPE>";
         $Html.="<html>";         
         $Html.="
                 <style>
                    #header { position: fixed; left: 0px; top: -30px; right: 0px; height: 20px; background-color: white; text-align: center; }
                    #footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 50px; background-color: white; font-family:arial, helvetica; font-size:12px; font-size:12px;text-align: right; }
                    @page {margin-top: 80px; margin-left: 2.0em;}
                    #header .page:after { content: counter(page, arial); }
                 </style>
                 ";         
         $Html.="<div id='header'>   
                    <table width=100%>
                        <tr>
                            <td width=80px> <img style='margin-left:0px' src='http://".$_SERVER["SERVER_NAME"]."/sistema/public/images/laroca.jpg'/><td>                            
                            <td width=400px><span style='margin-left:-20px;font-size: 16px;text-decoration: underline;color:#FF0000'>RESUMEN DE PAGOS POR CONSULTA DEL PACIENTE</span><td>
                            <td width=80px><span class='page'>N&deg;Pag: </span><td>
                        </tr>
                    </table>                                 
                 </div>
                 
                 <hr style='background-color: black; height: 1px; border: 0;margin-top:40px'>
                 <table>
                    <tr>
                        <td bgcolor=red>p1</td>
                        <td>p1</td>
                        <td>p1</td>
                        <td>p1</td>
                    </tr>
                    <tr>
                        <td>p1</td>
                        <td>p1</td>
                        <td>p1</td>
                        <td>p1</td>
                    </tr>
                    <tr>
                        <td>p1</td>
                        <td>p1</td>
                        <td>p1</td>
                        <td>p1</td>
                    </tr>
                 <table>
                 <div id='footer'><div style='height:1px; background-color:Black;'> BkSoft</div>
                 </html>";
//        echo $Html;
	 $this->dompdf_lib->set_paper ('a4','portraid');//landscape
	 $this->dompdf_lib->load_html($Html);
	 $this->dompdf_lib->render();
	 $this->dompdf_lib->stream("saludo.pdf", array("Attachment" => 0));
    }
}