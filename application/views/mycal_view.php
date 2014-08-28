<!--<!DOCTYPE HTML>
<html>
    <head>
        <title>Calendario</title>
        <meta charset="UTF-8">
        <script src="<?php echo base_url('public/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/dist/js/jquery.js');?>" type="text/javascript"></script>-->
        <style type="text/css">
            .calendar{
                font-family: Arial; font-size: 12px;
                background: #428BCA;text-align: center;
                padding: 10px;margin: auto;
            }
            table.calendar{
                margin: auto;border-collapse: collapse;
            }
            .calendar .days td{
                width: 100px; height: 80px; padding:4px;
                border: 1px solid #428BCA;
                vertical-align: top;
                background-color: #CFE2F1;
            }
            .calendar .days td:hover{
                background-color: #F3F7FB;
            }
            .calendar .highlight{
                font-weight: bold; color: red;
            }
        </style>
        
    <!--</head>-->
    <!--<body>-->
        <?php echo $calendar;?>
       
    <!--</body>-->
     <script type="text/javascript">
            $(document).ready(function(){               
                $('.calendar .day').click(function(){                   
                   dia = $(this).find('.day_num').html();
                   eventos = prompt('Ingrese Evento');
                   if(eventos != null){
                       $.ajax({
                           url: 'http://localhost/sistema/mycal/display',
                           type: 'POST',
                           data:{
                               dia:dia,
                               evento:eventos
                           },
                           success: function(msg){                               
                               location.reload();
                           }
                       });
                   }
                });
            });
        </script>
<!--</html>-->


