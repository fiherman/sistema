<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">        
        
        <link href="<?php echo base_url('public/src/main.css');?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url('public/src/common/common.css');?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url('public/src/basic/basic.css');?>" type="text/css" rel="stylesheet"/>
        <link href="<?php echo base_url('public/src/agenda/agenda.css');?>" type="text/css" rel="stylesheet"/>
        <link media="print" href="<?php echo base_url('public/src/common/print.css');?>" type="text/css" rel="stylesheet"/>
        
        <script src="<?php echo base_url('public/src/lib/jquery-1.8.1.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/lib/jquery-ui-1.8.23.custom.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/defaults.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/main.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/Calendar.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/Header.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/EventManager.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/ResourceManager.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/date_util.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/util.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/basic/MonthView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/basic/BasicWeekView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/basic/BasicDayView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/basic/BasicView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/basic/BasicEventRenderer.js');?>" type="text/javascript"></script>        
        <script src="<?php echo base_url('public/src/resource/ResourceDayView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/resource/ResourceView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/resource/ResourceEventRenderer.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/agenda/AgendaWeekView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/agenda/AgendaDayView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/agenda/AgendaView.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/agenda/AgendaEventRenderer.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/View.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/DayEventRenderer.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/SelectionManager.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/OverlayManager.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/CoordinateGrid.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/HoverListener.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/src/common/HorizontalPositionCache.js');?>" type="text/javascript"></script>
        
        
<!--        <link rel="stylesheet" type="text/css" media="screen" href="<?php // echo base_url('public/css/reset.css'); ?>" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php // echo base_url('public/css/temaazul/jquery-ui-1.10.3.custom.min.css') ?>" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php // echo base_url('public/js/fullcalendar/fullcalendar.css') ?>" />
        
        <script src="<?php // echo base_url('public/js/jquery-1.10.2.min.js');?>" type="text/javascript"></script>
        <script src="<?php // echo base_url('public/js/jquery-ui-1.10.3.custom.min.js') ?>" type="text/javascript"></script>
        <script src="<?php // echo base_url('public/js/fullcalendar/fullcalendar.min.js') ?>" type="text/javascript"></script>-->
        
        <script>
            $(document).ready(function() {
	
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
		
                var calendar = $('#calendar').fullCalendar({
                    height: 650,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'resourceDay,month,agendaWeek,agendaDay'
                    },
//                    titleFormat: 'ddd, MMM dd, yyyy',
                    defaultView: 'agendaWeek',
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay, event, resourceId) {
                        
//                        var title = prompt('Event Title:');
//                        if (title) {
//                            console.log("@@ adding event " + title + ", start " + start + ", end " + end + ", allDay " + allDay + ", resource " + resourceId);
//                            calendar.fullCalendar('renderEvent',
//                            {
//                                title: title,
//                                start: start,
//                                end: end,
//                                allDay: allDay,
//                                resourceId: resourceId
//                            },
//                            true // make the event "stick"
//                        );
//                        }
//                        calendar.fullCalendar('unselect');
                    },
                    eventResize: function(event, dayDelta, minuteDelta) {
                        console.log("@@ resize event " + event.title + ", start " + event.start + ", end " + event.end + ", resource " + event.resourceId);
                    },
                    eventDrop: function( event, dayDelta, minuteDelta, allDay) {
                        console.log("@@ drag/drop event " + event.title + ", start " + event.start + ", end " + event.end + ", resource " + event.resourceId);
                    },
                    editable: true,
                    resources: 'get_consultorios',
                    events: ''
                });
            });
//            function EliminarEvento()
//            {
//                $.ajax({url:'agenda/eliminar_agenda?ide_age='+get_ide_age});                
//                DialogClose(this);
//                $('#calendar').fullCalendar('removeEvents', get_ide_age); 
//            }
//            function EditarEvento()
//            {
//                var des_not = $('#des_not');
//                des_not.attr('contenteditable',true).focus().css('background-color','#FCFCFC');                
//                DialogButtonEnabled('#BtnGuardarEditado');
//            }
//            function GuardarEditEvento()
//            {
//                var des_not = $('#des_not');
//                $.ajax({url:'agenda/guardar_editado',data:{ide_not:get_ide_not,des_not:des_not.text()}});
//                des_not.attr('contenteditable',false).css('background-color','inherit');                
//                DialogButtonDisabled('#BtnGuardarEditado');
//                $('#calendar').fullCalendar('refetchEvents');
//            }
            function open_dlg_evento(){

            }
            function Salir()
            {
                $(this).dialog('close');
            }
        </script>
        <style>
            body {
                margin: 0;
                font-size: 12px;
                font-family:Verdana,sans-serif;
                background-image: url('public/images/bg.jpg');
            }
            #external-events {
                float: left;
                /*width: 150px;*/
                padding: 0 10px;
                border: 1px solid #ccc;
                background: #eee;
                text-align: left;
                height: 598px;
                width: 10%;
                margin-left: 16px;
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
                background: #3a87ad;
                color: #fff;
                font-size: .85em;
                cursor: pointer;
                text-shadow: 0 1px 0 black;
                border-radius: 5px;
            }

            #external-events p {
                margin: 1.5em 0;
                font-size: 11px;
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
                right: 8%;
                position: relative;
/*                width: 780px;*/
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
            #DlgInfoCalendar div {
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
            }
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
        </style>
    </head>
    <body>   
        <div class="ContenidoTitulosPanel" style="overflow: hidden;background-image: url('../../../images/bgb.jpg');">
            <p class="spanasis" style="margin-bottom: 10px;">CLINICA ODONTOLOGIA LA ROCCA </p>
            <div class="InfoPer">
                <span id="SpanNomUser">VLADY</span>
            </div>
            <section>
                <div class="ContentCalendar">
                    <div id='calendar'></div>
                </div>
            </section>
        </div>
        
        <div id="div_guardar_evento" title=".:: GUARDAR EVENTO, NOTA ::." style="display: none;padding: 20px;">
            <p class="TituloDialogos">Guardar evento, nota...</p>            
            <hr style="margin-bottom: 5px;"/>
                      
            <div>
                <textarea id="TxtNota">
                </textarea>
            </div>                               
        </div>
        
        <!-- Dialogo informacion -->
        <div id="div_" title=".:: Informacion del calendario, evento ::." style="display: none;padding: 20px;padding-bottom: 0px;">
            <p class="TituloDialogos">Informacion del evento...</p><hr style="margin-bottom: 5px;"/>
            <div>
                <label for="nom_tra">Creado por</label> : <span id="nom_tra"></span>
            </div>
            <div>
                <label for="fch_reg">Fecha creada</label> : <span id="fch_reg"></span>
            </div>
            <div>
                <label for="fch_ini">Fecha de Inicio</label> : <span id="fch_ini"></span>
            </div>
            <div>
                <label for="fch_fin">Fecha Fin</label> : <span id="fch_fin"></span>
            </div>
            <p contenteditable="false" id="des_not"></p>
        </div>
    </body>
</html>

