<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('public/css/reset.css'); ?>" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('public/css/temaazul/jquery-ui-1.10.3.custom.min.css') ?>" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('public/js/fullcalendar/fullcalendar.css') ?>" />
        
        <script src="<?php echo base_url('public/js/jquery-1.10.2.min.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/js/jquery-ui-1.10.3.custom.min.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/js/fullcalendar/fullcalendar.min.js') ?>" type="text/javascript"></script>
        <script>
//            function getUrlVars() {
//                var vars = {};
//                var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
//                    vars[key] = value;
//                });
//                return vars;
//            }

//            var get_ide_per = getUrlVars()["ide_per"];
            $(document).ready(function() {
                $('#calendar').fullCalendar({
                    theme: true,
                    events: "llenar_calendario_para_el_publico",
                    
                    allDaySlot: false,
                    height: 650,
                    defaultView: "agendaWeek",
                    /*minTime: '06:00:00',
                    maxTime: '23:00:00',*/
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'resourceDay,month,agendaWeek,agendaDay'                       
                    },
                    select: function(data) {
                        $('#nom_tra').html(data.nom_tra);
                        $('#fch_reg').html(data.fch_reg);
                        $('#fch_ini').html(data.fch_ini);
                        $('#fch_fin').html(data.fch_fin);
                        $('#des_not').html(data.des_not);
                        $('#DlgInfoCalendar').dialog('open');
                    },
                    resources: [
                        {
                            name: 'Resource 1',
                            id: 1
                        },
                        {
                            name: 'Resource 2',
                            id: 2
                        },
                         {
                            name: 'Resource 3',
                            id: 3
                        }
                    ]
                });

                $('#DlgInfoCalendar').dialog({modal: true, autoOpen: false, width: 577, height: 335, buttons: [
                        {text: "Salir", click: Salir}]
                });

//                $.ajax({
//                    url: 'mostrar_nombre?ide_per=' + get_ide_per,
//                    success: function(name) {
//                        $('#SpanNomUser').html(name);
//                    }
//                });
            });
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
                background-image: url('../../../images/bgb.jpg');
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

            #external-events p input {
                margin: 0;
                vertical-align: middle;
            }

            .ContentCalendar{
                float: right;
                right: 18px;
                position: relative;
                width: 97.5%;
            }
            .TituloDialogos{
                font-weight: bold;
                font-size: 13px;
                text-shadow: 0px 1px 0px white;
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
            .InfoPer{
                height: 14px;
                margin-bottom: 10px;
                padding: 10px;
                text-align: center
            }
            #SpanNomUser{
                font-weight: bold;
                border-bottom: dotted 1px black;
                width: 325px;
                display: inline-block;
                padding-bottom: 5px;
            }
        </style>
    </head>
    <body>

        <div class="ContenidoTitulosPanel" style="overflow: hidden;background-image: url('../../../images/bgb.jpg');">
            <p class="TitulosMenusPanel" style="margin-bottom: 10px;">Agenda publica...</p>
            <div class="InfoPer">
                <span id="SpanNomUser">VLADI</span>
            </div>
            <section>
                <div class="ContentCalendar">
                    <div id='calendar'></div>
                </div>
            </section>
        </div>
         Dialogo informacion 
        <div id="DlgInfoCalendar" title=".:: Informacion del calendario, evento ::." style="display: none;padding: 20px;">
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
            <div>
                <label for="des_not">Evento</label> : <span id="des_not"></span>
            </div>
        </div>
    </body>
</html>

