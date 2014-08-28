<div class="container" style="text-align: center;margin-top: 2%;">
    <div class="row" >
        <!--MENU--> 
        <div class="col-sm-3" >
            <img src="../public/images/logo.png" class="img-circle img-responsive" width="258"><br/>
            <div class="list-group">
                <a href="<?php echo base_url('pacientes/registro'); ?>" class="list_group_item_0" id="list_group_item_0"><center><b>REGISTRO</b></center>
                    <img src="../public/images/registro_pacientes.jpg" class="img-rounded img-responsive">
                </a>
                <br>
                <a href="<?php echo base_url('pacientes/lista'); ?>" class="list_group_item_1" id="list_group_item_1"><center><b>LISTA</b></center>
                    <img src="../public/images/registro_presupuestos.jpg" class="img-rounded img-responsive">
                </a>
            </div>
        </div>
        <!--FORMULARIO--> 
        <div class="col-sm-9" id="col_sm_9" style="text-align: center; margin-top: 0%; width: 74%;padding: 0% 5% 0% 2%;;background-color: #d9edf7;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 ><span class="label label-primary">Lista de Pacientes</span></h3>
                    <br>
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="color: #006699">BUSCAR PACIENTE:</label>
                            <input type="text" id="txtbuscar" placeholder="Nombres / Apellidos / DNI" style=" width: 60%;height: 25px;text-transform: uppercase;border: 1px solid #ABADB3; border-radius: 5px;padding: 2px 4px 2px 4px;">
                            <button type="submit" name="btnbuscar" id="btnbuscar" onclick="fn_buscar_pac();" class="btn btn-info btn-sm" style="margin-bottom: 3px;padding: 0px 9px 0px 9px;height: 26px;background-color: #0088CC">Buscar</button>
                        </div>
                    </div>
                    <div id="content">                                    
                        <table id="jqGrid01"></table>
                        <div id="jqGridPager01"></div>
                        <br><br>
                    </div> 
                </div>
            </div>                  
        </div>
    </div>
</div>
</div> 
<table id="grid_vw_pacientes"></table>
<div id="pager_pacientes"></div>
<script type="text/javascript">
    
    $(document).ready(function() {
        document.getElementById('list_group_item_1').style.background = '#83CBFF';
        document.getElementById('list_group_item_1').style.border = '2px solid #4040FF';
        document.getElementById('col_sm_9').style.background = '#83CBFF';
        create_grid_pacientes();
    });
   
   
</script>


