<style type="text/css">
    .btn_alert_close{
        background-color:#FE9B41;                                  
        color:#ffffff;
        font-family:arial;
        font-size:13px;
        font-weight:bold;
        padding:2px 0px; 
        border: 1px solid #9F6000;
        margin: 0 0 -1% 33%;
        width: 24%;
    }
    .btn_alert_close:hover{
        color: #b95800;
        background-color: #ffbe84;
    }
    .btn_alert_close:active{ 
        color: #418BC3;
        background-color: #FFFFFF;
    }
    .btn_confirm{
        background-color:#80FF80;                                  
        color:#004000;
        font-family:arial;
        font-size:13px;
        font-weight:bold;
        padding:2px 0px; 
        border: 1px solid #00C000;        
        width: 24%;
        margin-top: 3%;
    }
    .btn_confirm:hover{
        color: #ffffff;
        background-color: #00C000;
    }
    .btn_confirm:active{ 
        color: #418BC3;
        background-color: #FFFFFF;
    }
    .infoblock { /* Alerta desabilitadora de pantalla */
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        background: #000;
        filter:alpha(opacity=60);
        -moz-opacity: 0.6;
        opacity: 0.6;
     }
    
</style>
<script type="text/javascript">
    $(document).ready(function() {
//        setTimeout(function(){ $("#ojo").fadeOut(800).fadeIn(800).fadeOut(350).fadeIn(350).fadeOut(300);}, 3000);
//        setTimeout(function() {
//            $("#ojo").fadeOut(3350);
//        },3000);
//        $("#ojo").dialog({
//            autoOpen: false,
//            modal:false
//            buttons: [ 
//                { text: "Aceptar", click: function() { 
//                        $(this).dialog( "close" ); 
//                        if(focoglobal!=""){ 
//                            foco(focoglobal);
//                        }
//                        focoglobal="";
//                    } 
//                } 
//            ]
//        }); 
       
    });
function fn_close_alert(tipo){   
    if(tipo==0){
        $("#ojo").hide();
    }else if(tipo==1){
        $("#confirmar").hide();
    }
    
}

//function fn_close_ojo(){
//    $("#ojo").hide();
//}
//function fn_close_ojo(){
//    $("#ojo").hide();
//}
//function fn_close_ojo(){
//    $("#ojo").hide();
//}
</script>

<!-- Dialogo de alertas 
<div id="alertdialog" style="display: none;" title=".:: Alerta ::."></div>
 Dialogo para confirmar cerrar 
<div id="salirdialog" style="display: none;" title=".:: Alerta ::.">
    <p>Si cierra este dialogo no se guardaran los datos<br/>Desea Cerrar?</p>
</div>-->
<!--<div  class="infoblock"></div>
<div  id="info" style="display: none;width: 30%; position: absolute; left: 34.9%; top: 35%;"></div>
<div  id="correcto" style="display: none;width: 30%; position: absolute; left: 34.9%; top: 35%;"></div>-->
<!--<div  id="ojo" style="display: none;"></div>-->
<div  id="informe" title="INFORMACION" style="display: none;"></div>
<div  id="mensaje" title="MENSAJE DEL SISTEMA" style="display: none;"></div>
<div  id="vista_previa_pac" title="VISTA PREVIA DEL PACIENTE" style="display: none;">
    <div style="width: 28%; margin-left: 4%; margin-top: 3%;margin-right: 2%;font-size: 14px;float: left">
        <p><b>
            CODIGO:<br>
            NOMBRES:<br>
            APELLIDOS:<br>
            DIRECCION:<br>
            DNI:<br>
            DISTRITO:<br>
            SEXO:<br>
            FECHA NAC:<br>
            TELEFONO:<br>
            MOVISTAR:<br>
            CLARO:<br>
            EMAIL:<br>
            DEPENDIENTE:<br>
            SEGURO:           
        </b></p>        
    </div>
    <div id="texto_paciente" style="width: 62%;margin-top: 3%;margin-right: 4%;font-size: 14px;float: left"></div>
</div>
<div  id="vista_previa_doc" title="VISTA PREVIA DEL DOCTOR" style="display: none;">
    <div style="width: 28%; margin-left: 4%; margin-top: 3%;margin-right: 2%;font-size: 14px;float: left">
        <p><b>
            CODIGO:<br>
            RNE:<br>
            NOMBRES:<br>
            APELLIDOS:<br>
            UNIVERSIDAD:<br>
            FECHA REGISTRO:<br>
            ESTADO:           
        </b></p>        
    </div>
    <div id="texto_doctor" style="width: 62%;margin-top: 3%;margin-right: 4%;font-size: 14px;float: left"></div>
</div>
<div  id="vista_previa_cita" title="INFORMACION DE LA CITA" style="display: none;">
    <div style="width: 21%; margin-left: 5%; margin-top: 3%;margin-right: 2%;font-size: 14px;float: left">
        <p><b>
            CODIGO<br>
            PACIENTE<br>
            FECHA<br>
            DESCRIPCION<br> 
        </b></p>        
    </div>
    <div id="texto_cita" style="width: 68%;margin-top: 3%;margin-right: 4%;font-size: 14px;float: left"></div>
</div>
<div  id="confirmar" style="display: none;height: 13%; width: 30%; position: absolute; left: 34.9%; top: 35%;text-align: center"></div>
<!--<div  id="error" style="display: none;width: 30%; position: absolute; left: 34.9%; top: 35%;"></div>-->



