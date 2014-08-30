<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html html lang="es-Es" xmlns="http://www.w3.org/1999/xhtml">
<head>
   <style type="text/css">
      body {
        background-image:url('public/images/bg.jpg');
        padding-top: 75px;
        padding-bottom: 40px;
        /*background:#049cdb;*/
        /*background-size: 1440px 800px;*/
        background-repeat:no-repeat; display: compact;
        background-size: cover;
      }     
      .fecha {
        color: #428BCA;
        bottom: 20px;        
        /*left: 50%;*/
        /*position: absolute;*/        
        font-size: 25px;
        text-align: right;
        font-weight: bold;
/*        height: 10%;
        background-color: #4578D4;*/
      }
      #content {
        width: 100%; 
        height: 100%; 
      }
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <!--<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=ISO-8859-1">-->
    <!--<link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo base_url('public/css/jquery_ui/css/redmond/jquery-ui-1.10.4.custom.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('public/css/jquery_ui/css/redmond/jquery-ui-1.10.4.custom.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('public/js/jqgrid/css/ui.jqgrid.css'); ?>"/>
    <link rel="stylesheet" href="<?php // echo base_url('public/js/timepiker/jquery.ui.timepicker.css'); ?>"/>
    <!--<link rel="stylesheet" href="<?php // echo base_url('public/js/jquery-ui/css/start/jquery-ui-1.10.4.custom.min.css'); ?>"/>-->
    <!--<link rel="stylesheet" href="<?php // echo base_url('public/js/jquery-ui/css/start/jqgrid/css/ui.jqgrid.css'); ?>"/>-->
    <!--<link rel="stylesheet" href="<?php // echo base_url('public/css/jqGrid.bootstrap.css'); ?>"/>-->
    <link rel="stylesheet" href="<?php echo base_url('public/css/estilo.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('public/dist/css/bootstrap.css'); ?>"/> 
    <!--<script src="<?php // echo base_url('public/js/pacientes.js');?>" type="text/javascript"></script>-->
    <script src="<?php echo base_url('public/dist/js/jquery.js');?>" type="text/javascript"></script>
    <!--<script src="<?php // echo base_url('public/dist/js/bootstrap.js');?>" type="text/javascript"></script>-->    
    <script src="<?php echo base_url('public/js/metas.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/js/jquery-ui/js/jquery-1.10.2.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js');?>" type="text/javascript"></script>      
    <script src="<?php echo base_url('public/js/inicio.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/js/jquery.blockUI.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/js/jqgrid/js/jquery.jqGrid.src.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('public/js/jqgrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>    
    <script src="<?php echo base_url('public/js/jqgrid/js/i18n/grid.locale-es.js');?>"></script>    
    <script src="<?php echo base_url('public/js/timepiker/jquery.ui.timepicker.js');?>"></script>  
    <script src="<?php echo base_url('public/js/jquery.maskedinput.js');?>" type="text/javascript"></script><!--para fechas-->
    
    
    
</head>
<body onload="">
<div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url('principal');?>"><span class="glyphicon glyphicon-home"></span></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!--<li><a href="<?php echo base_url('pacientes/registro');?>">PACIENTES</a></li>-->
<!--          <li><a href="<?php echo base_url('presupuestos');?>">PRESUPUESTOS</a></li>
          <li><a href="<?php echo base_url('evoluciones');?>">EVOLUCIONES</a></li>
          <li><a href="<?php echo base_url('pacientes');?>">PAGOS</a></li>-->
          <li><a href="<?php echo base_url('mycal/display');?>"><b>CALENDARIO</b></a></li>
        </ul>                 
        <ul class="nav navbar-nav navbar-right">
          <li><a ><b><?php echo 'BIENVENIDO: '.$_SESSION['doctor'];?></b></a></li> 
          <li><a href="<?php echo base_url('logout');?>"><span class="glyphicon glyphicon-log-out"></span><b>CERRAR SESSION</b></a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>

