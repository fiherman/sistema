<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <br><br><br><br><br>
            <div class="row clearfix" style="text-align: center;height: 150%">                
                <div class="col-md-4 column">
                    <a href="#" onclick="open_administracion();" class="list_group_item" style="opacity: 0.8;"><center><h1><b>ADMINISTRACION</b></h1></center>
                        <img src="public/images/configurar.png" class="img-rounded img-responsive" style="width: 60%;margin-left: 22%">
                    </a>
                </div>
                <div class="col-md-4 column">
                    <a href="#<?php // echo base_url('pacientes/registro');?>" onclick="fn_open_pac();" style="opacity: 0.8;" class="list_group_item"><center><h1><b>PACIENTES</b></h1></center>
                        <img src="public/images/paciente.png" class="img-rounded img-responsive" style="width: 60%;margin-left: 22%">
                    </a>
                </div>
                <div class="col-md-4 column">
                    <a href="#" onclick="fn_open_pac();" style="opacity: 0.8;" class="list_group_item"><center><h1><b>REPORTES</b></h1></center>
                        <img src="public/images/consulta.png" class="img-rounded img-responsive" style="width: 60%;margin-left: 22%">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
//include_once 'consultas_view.php'; 
include_once 'pacientes/pacientes_view.php'; 
include_once 'pacientes/administracion_view.php'; 
include_once 'dialogos.php'; 

