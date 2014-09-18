<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<title>Calendario</title>

<meta http-equiv="Content-type" content="text/html;charset=UTF-8">

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('public/css/reset.css'); ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('public/css/temaazul/jquery-ui-1.10.3.custom.min.css') ?>" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('public/js/fullcalendar/fullcalendar.css') ?>" />
<script src="<?php echo base_url('public/js/jquery-1.10.2.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/js/jquery-ui-1.10.3.custom.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/js/fullcalendar/fullcalendar.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/js/scripts-jquery.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/js/jquery.blockUI.js'); ?>" type="text/javascript"></script>        
<!-- JQTIP2 -->
<script src="<?php echo base_url('public/js/jqtip/jquery.qtip.min.js'); ?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/js/jqtip/jquery.qtip.min.css'); ?>" />
<!-- END JQTIP -->

<script>
    var FechaClick, VistaAgenda, allDayAgenda, get_ide_age, get_ide_not;
    $(document).ready(function() {

        $('#TxtNota').val('').focus();
        $('#Dlg_Agenda').dialog({modal: true, autoOpen: false, width: 508, height: 242, buttons: [
                {text: "Guardar", click: GuardarEvento},
                {text: "Salir", click: Salir}
        ]});
        $('#DlgInfoCalendar').dialog({modal: true, autoOpen: false, width: 550, height: 430, buttons: [
                {id: 'BtnEditarEvento', text: "Editar", click: EditarEvento},
                {id: 'BtnGuardarEditado', text: "Guardar", click: GuardarEditEvento, disabled: true},
                {id: 'BtnEliminarEvento', text: "Eliminar", click: EliminarEvento},
                {text: "Salir", click: Salir}
        ]});
        $('#external-events div.external-event').each(function() {
            var eventObject = {
                title: $.trim($(this).text()),
                ide_not: $(this).attr('ide_not')
            };
            $(this).data('eventObject', eventObject);
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        }); 
        
        nom_pac=$("#calendar_buscar_pac").val();
        ide_pac=$("#hiddencalendar_buscar_pac").val();
        if(nom_pac!="" && ide_pac!=""){
            cargar_calendario_1();
        }else{
            cargar_calendario_1();
        }
        
    });
    
    function cargar_calendario_0(){
         $('#calendar').fullCalendar({
            editable: true,
            theme: true,
            events: "agenda/llenar_calendario",
            allDaySlot: false,
            height: 650,
            droppable: true,
            defaultView: "agendaWeek",
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
                fch_ini = $.fullCalendar.formatDate(event.start, 'dd-MM-yyyy HH:mm:ss');
                fch_fin = $.fullCalendar.formatDate(event.end, 'dd-MM-yyyy HH:mm:ss');
                $.ajax({url: 'agenda/cambiar_de_fecha', type: 'get', data: {fch_ini: fch_ini, fch_fin: fch_fin, ide_age: event.id},
                    success: function(agenda) {
                        if (agenda.revert == 1)//La fecha a actualizar es menor a la actual
                        {
                            revertFunc();
                        }
                    }
                });
            },        
            eventResize: function(event, dayDelta, minuteDelta, revertFunc){
                fch_ini = $.fullCalendar.formatDate(event.end, 'dd-MM-yyyy HH:mm:ss');
                var datos = fch_ini + '*' + event.id;
                $.ajax({
                    url: 'agenda/cambiar_de_hora?datos=' + datos
                });
            }
        });
    }
    function cargar_calendario_1(){
         $('#calendar').fullCalendar({
            editable: true,
            theme: true,
            events: "agenda/llenar_calendario",
            allDaySlot: false,
//                    weekends: false,  //ESCONDE SABADOS Y DOMINGOS
            height: 650,
            droppable: true,
            defaultView: "agendaWeek",
//                    defaultView: 'resourceDay',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
                fch_ini = $.fullCalendar.formatDate(event.start, 'dd-MM-yyyy HH:mm:ss');
                fch_fin = $.fullCalendar.formatDate(event.end, 'dd-MM-yyyy HH:mm:ss');
                $.ajax({url: 'agenda/cambiar_de_fecha', type: 'get', data: {fch_ini: fch_ini, fch_fin: fch_fin, ide_age: event.id},
                    success: function(agenda) {
                        if (agenda.revert == 1)//La fecha a actualizar es menor a la actual
                        {
                            revertFunc();
                        }
                    }
                });
            },
            loading: function(bool) {
                if (bool)
                    $('#loading').show();
                else
                    $('#loading').hide();
            },
//            drop: function(date, allDay) {//Arrastra eventos y los guarda
//                var originalEventObject = $(this).data('eventObject');
//                var copiedEventObject = $.extend({}, originalEventObject);
//                copiedEventObject.start = date;
//                copiedEventObject.allDay = allDay;
//
//                var FechaIniFin = $.fullCalendar.formatDate(date, 'dd-MM-yyyy HH:mm:ss');
//                $.ajax({
//                    url: 'agenda/guardar_el_arrastre', type: 'post',
//                    data: {
//                        nota: copiedEventObject.title,
//                        FechaIniFin: FechaIniFin,
//                        ide_not: copiedEventObject.ide_not
//                    },
//                    success: function(agenda)
//                    {
//                        var NuevoEvento = new Object();
//                        NuevoEvento.title = copiedEventObject.title;
//                        NuevoEvento.start = agenda.fch_ini;
//                        NuevoEvento.end = agenda.fch_fin;
//                        NuevoEvento.allDay = allDay;
//                        NuevoEvento.id = agenda.ide_age;
//                        $('#calendar').fullCalendar('renderEvent', NuevoEvento, true);
//                        location.reload();
//                    }
//                });
//            },
            dayClick: function(date, allDay, jsEvent, view) {
                //////////////////////////////alert(4);
                FechaClick = date;
                VistaAgenda = view.name;
                allDayAgenda = allDay;
                get_fch_ini = $.fullCalendar.formatDate(date, 'dd-MM-yyyy HH:mm:ss');
                $('#Dlg_Agenda').dialog('open');
                /*$.ajax({url:'agenda/verificar_fecha_actual',data:{fch_ini:get_fch_ini},
                 success:function(Fecha){
                 if(Fecha == 'MayorActual')
                 {
                 $('#Dlg_Agenda').dialog('open');                                    
                 }
                 else
                 {
                 
                 $.blockUI({ 
                 message: "<p style='padding:20px;'>La fecha que eligio es pasada.</p>", 
                 timeout: 2000 
                 }); 
                 
                 }
                 }
                 });*/

                //$(this).css('background-color', 'red');
            },
            eventClick: function(data, jsEvent, view) {
                $('#nom_pac').html(data.nom_pac);
                $('#fch_reg').html(data.fch_reg);
                $('#fch_ini').html(data.fch_ini);
                $('#fch_fin').html(data.fch_fin);
                $('#des_not').html(data.des_not);
                $('#consultorio').html(data.age_cons);
                $('#DlgInfoCalendar').dialog('open');
                get_ide_age = data.id;
                get_ide_not = data.ide_not;
                if (data.editable == true)
                {
                    DialogButtonDisabled('#BtnGuardarEditado');
                    DialogButtonEnabled('#BtnEliminarEvento,#BtnEditarEvento');
                }
                else
                {
                    DialogButtonDisabled('#BtnEliminarEvento,#BtnGuardarEditado,#BtnEditarEvento');
                }
            },
            eventResize: function(event, dayDelta, minuteDelta, revertFunc){
                fch_ini = $.fullCalendar.formatDate(event.end, 'dd-MM-yyyy HH:mm:ss');
                var datos = fch_ini + '*' + event.id;
                $.ajax({
                    url: 'agenda/cambiar_de_hora?datos=' + datos
                });
            }
        });
    }
    function GuardarEvento(){
        var FechaIniFin = $.fullCalendar.formatDate(FechaClick, 'dd-MM-yyyy HH:mm:ss');
        MensajeDialogLoadAjax('#Dlg_Agenda', '.:: Guardando...');
        $.ajax({
            url: 'agenda/guardar_evento', type: 'post',
            data: {
                nota: $('#TxtNota').val(),
                FechaIniFin: FechaIniFin,
                flg_pbl: ($("#RdPublico").is(':checked') ? 1 : 0)
            },
            success: function(agenda){
                var NuevoEvento = new Object();
                NuevoEvento.title = $('#TxtNota').val();
                NuevoEvento.start = agenda.fch_ini;
                NuevoEvento.end = agenda.fch_fin;
                NuevoEvento.allDay = allDayAgenda;
                NuevoEvento.id = agenda.ide_age;
                $('#calendar').fullCalendar('renderEvent', NuevoEvento, true);
                $('#Dlg_Agenda').dialog('close');
                $('#TxtNota').val('');
                $("#RdPrivado").attr('checked', true);
                MensajeDialogLoadAjaxFinish('#Dlg_Agenda');
                location.reload();
            }
        });
    }
    function Salir(){
        $(this).dialog('close');
    }
    function MensajeDialogLoadAjax(IdDialogo, Mensaje){
        $(IdDialogo).parent().block({
            message: "<p class='ClassMsgBlock'>" + Mensaje + "<img style='width: 24px;position: relative;top: 5px;left: 12px;'/></p>",
            css: {border: '1px solid black', background: 'white', wi1dth: '62%'}
        });
    }
    function MensajeDialogLoadAjaxFinish(IdDialogo){
        $(IdDialogo).parent().unblock();
    }
    function EliminarEvento(){
        $.ajax({url: 'agenda/eliminar_agenda?ide_age=' + get_ide_age});
        DialogClose(this);
        $('#calendar').fullCalendar('removeEvents', get_ide_age);
    }
    function EditarEvento(){
        var des_not = $('#des_not');
        des_not.attr('contenteditable', true).focus().css('background-color', '#FCFCFC');
        DialogButtonEnabled('#BtnGuardarEditado');
    }
    function GuardarEditEvento(){
        var des_not = $('#des_not');
        $.ajax({url: 'agenda/guardar_editado', data: {ide_not: get_ide_not, des_not: des_not.text()}});
        des_not.attr('contenteditable', false).css('background-color', 'inherit');
        DialogButtonDisabled('#BtnGuardarEditado');
        $('#calendar').fullCalendar('refetchEvents');
    }
    cont=0;
    function open_informacion_cita(id) {
//        alert(10);
//        $('#calendar').fullCalendar( 'gotoDate', 2014, 8, 29 );////ir a un dia especifico
        cont++;
        var newdiv = document.createElement('div');
        newdiv.id='pac_dina_'+(cont);
        newdiv.innerHTML=
        "<input type='hidden' id='hidden_dina_esp_tip_"+(cont)+"' value='"+tra_esp_tip+"'/>\n\
        <input type='hidden' id='hidden_dina_esp_cod_"+(cont)+"' value='"+tra_esp_cod+"'/>\n\
        <label class='lbl_din'>"+(cont)+"</label><input class='des_din' type='text' value='"+tra_des+"' id='des_dina_"+(cont)+"' style='width:46.5%' disabled/>\n\
        <input class='cos_din' type='text' value='"+tra_cos.toFixed(2)+"' id='cos_dina_"+(cont)+"'/>\n\
        <input type='hidden' id='hidden_seg_id_din_"+(cont)+"' value='"+seg_id+"'/>\n\
        <input type='text' id='seg_id_din_"+(cont)+"' value='"+seguro+"' style='width:12%' disabled />\n\
        <input type='text' id='doc_id_din_"+(cont)+"' value='"+doctor+"' style='width:23%' disabled/>\n\
        <input type='hidden' id='hidden_doc_id_din_"+(cont)+"' value='"+doc_id+"'/>\n\
        <button onclick='btn_borrar_trat("+(cont)+","+seg_id+","+tra_cos+");' class='btn_din' id='btn_eliminar_din_"+(cont)+"' title='Eliminar'> <img src='public/images/x.png' style='width:15px' ></img></button>";            

        document.getElementById('div_consul_dinamico').appendChild(newdiv);  
    }
    letras_global=0;
    function contar_letras_pac(){
        nom_pac=$("#calendar_buscar_pac").val();
        if(nom_pac.length>4 && letras_global==0){
            letras_global=1;
            llenararajaxtodo_paciente('calendar_buscar_pac','agenda/listartodo_paciente?pac='+nom_pac,0); 
        }else if(nom_pac.length==0 && letras_global==1){
            llenararajaxtodo_paciente('calendar_buscar_pac','agenda/listartodo_paciente?pac='+nom_pac,0); 
        }
    }
    function llenararajaxtodo_paciente(textbox,url,val){
    $.ajax({
           type: 'GET',
           url: url,
           success: function(data){               
                var $local_sourcedoctotodo=data;          
                 $("#"+textbox).autocomplete({
                      source: $local_sourcedoctotodo,
                      focus: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);                             
                             $("#hidden"+textbox).val(ui.item.value);
                             $("#"+textbox).attr('maxlength', ui.item.label.length);
                             return false;
                      },
                      select: function(event, ui) {
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value); 
                              return false;
                      }   
                  });             
            }
    });
}
</script>
<style>
    body {
        margin: 0;
        font-size: 12px;
        font-family:Verdana,sans-serif;
        /*                background-image: url('../public/images/bgb.jpg');*/
    }   
   
    #external-events {
        float: left;
        margin-top: 2%;
        padding: 0 10px;
        border: 1px solid #ccc;
        background: #eee;
        text-align: left;
        height: 650px;
        width: 13%;
        margin-left: 16px;
        font-size: 11px;
        font-family: Verdana;
        overflow: auto;
    }

    #external-events h4 {
        font-size: 12px;
        margin-top: 0;
        padding-top: 1em;
        font-family: verdana;
    }

    .external-event { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 5px;
        background: #71A8D2;
        color: white;
        font-size: .85em;
        cursor: pointer;
        /*text-shadow: 0 1px 0 black;*/
        border-radius: 3px;
    }
    .external-event-consulta { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 5px;
        background: none repeat scroll 0 0 #9cae40;
        color: white;
        font-size: .85em;
        cursor: pointer;
        /*text-shadow: 0 1px 0 black;*/
        border-radius: 3px;
    }
    .titulo_evento{
        text-align: center; background: none repeat scroll 0% 0% rgb(65, 139, 195); margin: -3% -3% 1%; font-size: 11px; padding: 2px; border-radius: 3px 3px 0px 0px;
    }
    .titulo_evento_consulta{
        text-align: center; background: none repeat scroll 0 0 #7a9200 ;margin: -3% -3% 1%; font-size: 11px; padding: 2px; border-radius: 3px 3px 0px 0px;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 12px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }
    section{
        /*width: 1010px;
        margin: 0 auto;
        margin-top: 8px;*/
    }
    .ContentCalendar{
        float: right;
        right: 18px;
        position: relative;
        margin-top: 2%;
        width: 84%;
    }
    .TituloDialogos{
        font-weight: bold;
        font-size: 13px;
        text-shadow: 0px 1px 0px white;
    }
    #TxtNota{
        margin: 2px;
        width: 447px;
        height: 51px;
        border: solid 1px gray;
        padding: 5px;
    }
    .fc-header-title h2{
        font-weight: bold;
        font-size: 19px;
        text-shadow: 0 1px 0 white;
        font-family: verdana;
        color: rgb(4, 45, 173);
    }
    /*            #DlgInfoCalendar div {
                    margin: 23px 1px;
                }
                #DlgInfoCalendar div label {
                    width: 108px;
                    float: left;
                    font-family: Verdana;
                    font-size: 11px;
                    font-weight: bold;
                    text-shadow: 0 1px 0 white;
                }
                #DlgInfoCalendar div span {
                    font-family: Verdana;
                    font-size: 11px;
                    text-shadow: 0 1px 0 white;
                }*/
    #des_not{
        position: relative;
        border: solid 1px gray;
        height: 150px;
        width: 466px;
        padding: 7px;
        line-height: 1.5;
        padding-right: 20px;
        text-shadow: 0 1px 0 white;
    }
    .btn_full_act{
        background-color:#DFE8F6;                                  
        color:#0C509D;
        font-weight:bold;
        font-size: 10px;
        padding:2px 2px 1.5px 3px; 
        border: 1px solid #99BCE8;  
        margin-top: -2%;
        float: right;
        margin-right: 0px;
    }
    .btn_full_act:hover{
        color: white;
        background-color: #418BC3;
    }
    .btn_full_act:active{ 
        color: #418BC3;
        background-color: #FFFFFF;
    }
    .btn_full_act[disabled="disabled"]{
        color: #99BCE8;
        background-color: #d1e5f9;//#d1e5f9;
        border: #99BCE8 solid 1px;
    }
</style>


<div class="ContenidoTitulosPanel" style="overflow: hidden;">
    <p style="margin-bottom: 19px;">CLINICA ODONTOLOGICA LA ROCCA</p>
    <section style="margin-bottom: 17px;">
        <div id='external-events'>
            
            <h4>BUSCAR PACIENTE: 
                <button class="btn_full_act" id="calendar_btn_buscar" onClick="open_informacion_cita(1);">
                    <img src="../public/images/buscar.png" style="width:14px">
                         Buscar
                    </img>
                </button>
            <h4>
            <input type="hidden" id="hiddencalendar_buscar_pac" value="" style="width: 100%; text-transform: uppercase; height: 18px; font-size: 10px;"/>
            <input type="text" id="calendar_buscar_pac" onkeypress="contar_letras_pac();" value="" style="width: 100%; text-transform: uppercase; height: 18px; font-size: 10px;"/>
            <!--CONSULTAS DINAMICAS-->
            <div id="div_consul_dinamico"  > 

            </div>
            
            <hr style="background-color: #418BC3; height: 1px; border: 0;"/>
            <h4><center><label style="background: none repeat scroll 0% 0% rgb(204, 222, 244); border: 1px solid rgb(153, 188, 232); padding: 1% 5%; color: rgb(4, 64, 140); font-weight: bold;">CITAS DE HOY</label></center></h4>
            
            
            <?php $pp=1;foreach ($this->agenda_notas_model->get_by_ide_pac() as $pacientes): ?>
                <div class='external-event' onclick="open_informacion_cita(<?php echo $pacientes->ide_not ?>);" ide_not="<?php echo $pacientes->ide_not ?>">                    
                    <div class='titulo_evento'>
                        <?php    $pp++;                         
                            echo utf8_need($pacientes->age_cons) ?>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;<?php echo date('h:i A', strtotime($pacientes->fch_ini));                             
                        ?>                           
                    </div>
                    <?php echo $pacientes->nom_pac ?>
                </div>
            <?php endforeach; ?>  
            
            <?php $cc=1;foreach ($this->agenda_notas_model->get_consultas_dia() as $consultas): ?>
                <div class='external-event-consulta' onclick="open_informacion_cita(<?php echo $consultas->cons_id ?>);" ide_cons="<?php echo $consultas->cons_id ?>">
                    <div class='titulo_evento_consulta'>
                        <?php $cc++;                         
                            echo 'Consulta'; ?>&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;<?php echo $consultas->cons_hora;                             
                        ?>                           
                    </div>
                    <?php echo utf8_need($consultas->pac_nom_com) ?>
                </div>
            <?php endforeach; ?> 
            <input type="hidden" id="total_eventos_del_dia" value="<?php // echo $cc-1;?>">
        </div>
        <div class="ContentCalendar">
            <div id='calendar'></div>
        </div>
    </section>
</div>

<div id="Dlg_Agenda" title=".:: Guardar evento, nota ::." style="display: none;padding: 20px;">
    <p class="TituloDialogos">Guardar evento, nota...</p>            
    <hr style="margin-bottom: 5px;"/>
    <div style="margin-bottom: 10px;">
        <input checked id="RdPrivado" type="radio" name="publicoprivado" value="0"/><label for="RdPrivado"> Privado </label>
        <input id="RdPublico" type="radio" name="publicoprivado" value="1"/><label for="RdPublico"> Publico </label> 
    </div>            
    <div>
        <textarea id="TxtNota">
        </textarea>
    </div>                               
</div>

<!-- Dialogo informacion -->
<div id="DlgInfoCalendar" title=".:: INFORMACION DEL EVENTO ::." style="display: none;">
    <!--<p class="TituloDialogos">Informacion del evento...</p><hr style="margin-bottom: 5px;"/>-->
    <div class="filtros">
        <p class="spanasis">Informacion del evento</p><br/>
        <div class="ctrl_input">             
            <label style="width: 25%; text-align: left; margin-left: 7%;" for="nom_pac">PACIENTE</label> : &nbsp;&nbsp;<span id="nom_pac"></span>            
        </div><br>
        <!--        <div>
                    <label for="nom_pac">Paciente</label> : <span id="nom_pac"></span>
                </div>-->
        <div class="ctrl_input">
            <label style="width: 25%; text-align: left; margin-left: 7%;" for="fch_reg">FECHA CREADA</label> : &nbsp;&nbsp;<span id="fch_reg"></span>
        </div><br>
        <div class="ctrl_input">
            <label style="width: 25%; text-align: left; margin-left: 7%;" for="fch_ini">FECHA DE INICIO</label> : &nbsp;&nbsp;<span id="fch_ini"></span>
        </div><br>
        <div class="ctrl_input">
            <label style="width: 25%; text-align: left; margin-left: 7%;" for="fch_fin">FECHA DE FIN</label> : &nbsp;&nbsp;<span id="fch_fin"></span>
        </div><br>
        <div class="ctrl_input">             
            <label style="width: 25%; text-align: left; margin-left: 7%;" for="consultorio">CONSULTORIO</label> : &nbsp;&nbsp;<span id="consultorio"></span>            
        </div><br>
        <label style="width: 90%; text-align: left; margin-left: 7%;" for="fch_fin">DESCRIPCION DEL EVENTO :</label><br></br>
        <p style="margin: 0% 0% -1% 4%; width: 92%;height: 110px; border: 1px solid rgb(65, 139, 195);" contenteditable="false" id="des_not"></p>
    </div>    
</div>

