<style type="text/css">  
    .btn_full{
        background-color:#DFE8F6;                                  
        color:#0C509D;      
        font-weight:bold;
        padding:3px 10px; 
        border: 1px solid #99BCE8;  
    }
    .btn_full:hover{
        color: white;
        background-color: #418BC3;
    }
    .btn_full:active{ 
        color: #418BC3;
        background-color: #FFFFFF;
    }
    .btn_full[disabled="disabled"]{
        color: #99BCE8;
        background-color: #d1e5f9;//#d1e5f9;
        border: #99BCE8 solid 1px;
    }
    .btn_din{
        background-color:#DFE8F6;                                  
        color:#0C509D;       
        font-weight:bold;
        padding:1px 5px;
        margin-left: 0;
        border: 1px solid #99BCE8;  
    }
    .btn_din:hover{
        color: white;
        background-color: #418BC3;
    }
    .btn_din:active{ 
        color: #418BC3;
        background-color: #FFFFFF;
    }
    .btn_full_act{
        background-color:#DFE8F6;                                  
        color:#0C509D;    
        font-weight:bold;
        padding:4px 12px; 
        border: 1px solid #99BCE8;  
        margin-top: -1%;
        float: right;
        margin-right: 15px;
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
    .info{
        color: #006699;
        margin: 10px;
    }
    .des_din{
        margin-top: 0%;margin-left: 1%;
    }
    .cos_din{
        margin-left: 0%; width: 7%; text-align: right; height: 21px;
    }
    .lbl_din{
        margin-left: 0.6%; width: 1.2%; text-align: right;        
    }
    .conta_deudas_pagos{
        background-color: rgb(224, 242, 255); border: 1px solid rgb(131, 203, 255); width: 52%; height: 20px; text-align: right; font-size: 13px; color: rgb(55, 118, 166);
    }
    .conta_deudas_pagos_dol{
        background-color: #DEE8DE; border: 1px solid #85AA84; width: 52%; height: 20px; text-align: right; font-size: 13px; color: #648063;
    }
    .btn_navi{
        background-color: #418bc3;
        border: 0 none;
        border-radius: 5px;
        float: left;
        margin-left: 3%;
        padding: 0;       
    }
    .btn_navi:hover{        
        background-color:#DFE8F6;
    }
.ui-jqgrid tr.jqgrow td {font-size:0.8em}
/*    .btn_navi:active{ 
        color: #418BC3;
        background-color: #FFFFFF;
    }
    .btn_navi[disabled="disabled"]{
        color: #99BCE8;
        background-color: #d1e5f9;//#d1e5f9;
        border: #99BCE8 solid 1px;
    }*/
</style>
<script src="<?php echo base_url('public/js/pacientes.js'); ?>" type="text/javascript" charset="UTF-8"></script> 
<script src="<?php echo base_url('public/js/pagos.js'); ?>" type="text/javascript" charset="UTF-8"></script>
<script src="<?php echo base_url('public/js/evolucion.js'); ?>" type="text/javascript" charset="UTF-8"></script>
<!--BUSCAR -->
<div id="div_pac_reg" style="display: none; font-size: 12px" title="LISTA DE PACIENTES">
    <div class="filtros">
        <p class="spanasis">BUSCAR PACIENTE</p><br/>        
        <div style="margin: -5px 0px -12px 20px">
            Buscar: <input type="text" id="txtbuscar_pac" style="text-transform:uppercase;padding: 3px 10px;width:50%; height: 23px; border-radius: 6px;border: 1px solid #C0CDF6;margin-bottom: 5px;"/>
            &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_full" id="btn_buscar" onClick="fn_buscar_pac();" title="Enter">Buscar</button>            
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_pac"></table>
        <div id="pager_con_pac"></div>
    </div>  
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_salir" onClick="btn_salir('div_pac_reg');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_nuevo_pac" onClick="btn_nuevo_pac('INSERTAR');"><img src="public/images/paciente.png" style="width:20px">Nuevo Paciente</img></button>
    <button class="btn_full_act" id="btn_consulta_pac" onClick="btn_rea_consulta();"><img src="public/images/cita.png" style="width:20px">Consulta</img></button>
    <button class="btn_full_act" id="btn_actualizar_pac" onClick="btn_actualizar();"><img src="public/images/actualizar.png" style="width:20px">Actualizar</img></button>
    <button class="btn_full_act" id="btn_plan_trat_pac" onClick="btn_plan_tratamiento();"><img src="public/images/tratamiento.png" style="width:20px">Tratamiento</img></button>

<!--<button class="btn_full_act" id="btn_pago_pac" onClick="btn_pago_pac();"><img src="public/images/pago2.png" style="width:20px">Realizar Pago</img></button>-->
</div>

<!--registro de paciente-->
<div id="div_reg_pac_nuevo" title="AGREGAR NUEVO PACIENTE" style="display: none"> 
    <div class="filtros">
        <p class="spanasis">DATOS PERSONALES </p><br/>   
        <div class="ctrl_input">               
            <input type="hidden" id="pac_id" value="" >
            <label class="ctrl_lavel_0">Nombres</label>
            <input type="text" class="ctrl_input_t" style="width: 89%;background-color: #EFFAEE" id="nombre" onblur="fn_onblur(this);" tabindex="1" placeholder="Ingrese Nombres">             
        </div>       
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_0">Apellidos</label>
            <input type="text" class="ctrl_input_t" style="width: 89%;background-color: #EFFAEE" id="apellidos" onblur="fn_onblur(this);" tabindex="2" placeholder="Ingrese Apellidos">
        </div>         
        <div class="ctrl_input">    
            <label class="ctrl_lavel_0">Direccion</label>
            <input type="text" class="ctrl_input_t" style="width: 60%;background-color: #EFFAEE" id="direccion" onblur="fn_onblur(this);" tabindex="3" placeholder="Ingrese Direccion">                                      
            <label class="ctrl_lavel_0">Dni</label>
            <input type="text" class="ctrl_input_t" style="width: 19%" id="dni"  onkeypress="return soloDNI(event);" tabindex="4" maxlength="8" placeholder="Ingrese DNI">               
        </div>           
        <div class="ctrl_input">
            <label class="ctrl_lavel_0">Distrito</label>
            <input type="text" class="ctrl_input_t" style="width: 40%;background-color: #EFFAEE" id="distrito"  onblur="fn_onblur(this);" tabindex="5" placeholder="Distrito">           
            <label class="ctrl_lavel_0">Sexo</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="sexo"  onblur="fn_onblur(this);" tabindex="6" placeholder="M / F" maxlength="1"> 
            <label class="ctrl_lavel_0">Fch. Nac.</label>
            <input type="input" class="ctrl_input_t" style="width: 19%;background-color: #EFFAEE"  id="fec_nac"  tabindex="7" onblur="fn_onblur(this);"   maxlength="10" placeholder="Fecha de Nacimiento">              
        </div>          
        <div class="ctrl_input">
            <label class="ctrl_lavel_0">Telefono</label>
            <input type="text" class="ctrl_input_t" style="width: 23.3%" id="telefono" tabindex="8"  maxlength="11" placeholder="# Telefono">
            <label class="ctrl_lavel_0">Movistar</label>
            <input type="text" class="ctrl_input_t" style="width: 23.3%" id="movistar" tabindex="9"  maxlength="11" placeholder="# Celular Movistar">
            <label class="ctrl_lavel_0">Claro</label>
            <input type="text" class="ctrl_input_t" style="width: 22.3%" id="claro" tabindex="10" maxlength="11" placeholder="# Celular Claro">
        </div>          
        <div class="ctrl_input">
            <label class="ctrl_lavel_0">Email</label>
            <input type="text" class="" style="width: 89%;background-color: #EFFAEE;background-image: none;height: 27px;  padding: 3px 10px;  font-size: 12px;  color: #555555;  vertical-align: middle; border: 1px solid #83CBFF;  border-radius: 3px;"id="email" name="email" onblur="fn_onblur(this);" tabindex="11" value="" placeholder="Ingrese Correo electronico">
        </div> 
    </div>
    <div class="filtros">
        <p class="spanasis">SEGURO</p><br/>
        <div class="ctrl_input">
            <label class="ctrl_lavel_1">Dependiente</label>
            <input type="text" class="ctrl_input_t" style="width: 85%" id="dependiente" tabindex="12" placeholder="Ingrese Apoderado (menor de edad)">
        </div>       
        <div class="ctrl_input">
            <label class="ctrl_lavel_1">Seguro</label>
            <select class="ctrl_input_t" id="seg_id" tabindex="13" style="background-color: #EFFAEE">
                <option value="1">SIN SEGURO</option>
                <option value="2">LA POSITIVA</option>
                <option value="3">CERRO VERDE</option>
            </select>
            <!--<input type="text" class="ctrl_input_t" style="width: 85%" id="seguro" placeholder="Ingrese Datos de Seguro Medico">-->
        </div> 
    </div>
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act"  id="btn_salir_registro" onClick="btn_salir('div_reg_pac_nuevo');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act"  id="btn_guardar_registro" onClick="brn_guardar_pac('INSERTAR');" title="Enter"><img src="public/images/guardar.png" tabindex="14"  style="width:20px">Guardar Paciente</img></button>
    <button class="btn_full_act"  id="btn_editar_registro" onClick="brn_guardar_pac('EDITAR');" title="Ctrl+A"><img src="public/images/guardar.png" style="width:20px"> Editar Paciente</img></button>


</div>
<!--REALIZAR CONSULTA-->
<div id="div_consulta" style="display: none; font-size: 12px" title="SEPARAR CONSULTA">
    <div class="filtros">
        <p class="spanasis">CITA</p><br/>       
        <div class="ctrl_input">               
            <input type="hidden" id="pac_id_cons" value="">
            <label class="ctrl_lavel_1">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 85%;background-color: #EFFAEE" id="div_cons_pac" disabled >             
        </div>       
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1">Costo</label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE" id="div_cons_cos" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/."maxlength="5">
            <label style="margin-left:12.7%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE" id="div_cons_trat_num" value="" disabled>
        </div>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1">Fecha</label>
            <input type="text" class="ctrl_input_t" style="width: 32%;background-color: #EFFAEE"  id="div_cons_fch" onblur="fn_onblur(this);"  maxlength="10" placeholder="Fecha de consulta">              
            <label class="ctrl_lavel_1"><i class="glyphicon glyphicon-time">Hora</i></label>
            <input type="text" class="ctrl_input_t" style="width: 32%;background-color: #EFFAEE"  id="div_cons_hora" onblur="fn_onblur(this);" maxlength="9" placeholder="00:00am/pm"> 
        </div>       
    </div>     
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_salir_consulta" onClick="btn_salir('div_consulta');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_guardar_consulta" onClick="btn_guardar_consuta();"><img src="public/images/guardar.png" style="width:20px">Guardar Consulta</img></button>    
</div>
<!--PLAN DE TRATAMIENTO-->
<div id="div_plan_tratamiento" style="display: none; font-size: 12px" title="NUEVO PLAN DE TRATAMIENTO">
    <div class="filtros" style="">
        <p class="spanasis">DATOS DE PACIENTE</p><br/>       
        <div style="margin:-1%">               
            <input type="hidden" id="div_trat_id" value="">
            <label class="ctrl_lavel_1" style="width:11%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 52.5%;background-color: #EFFAEE" id="div_trat_pac" disabled> 
            <label class="ctrl_lavel_1" style="width:11%">Seguro</label>
            <!--<input type="text" class="ctrl_input_t" style="width: 22%;background-color: #EFFAEE" id="div_trat_seg_id" disabled>-->
            <select class="ctrl_input_t" id="div_trat_seg_id" onchange="fn_load_seguro(this.value);" style="background-color: #EFFAEE">
                <option value="1">SIN SEGURO</option>
                <option value="2">LA POSITIVA</option>
                <option value="3">CERRO VERDE</option>
            </select>
        </div> 
    </div>
    <div class="filtros">
        <p class="spanasis">PLAN DE TRATAMIENTO</p><br/>
        <div style="margin:-1% 1.5% 2%;padding: 0.5%;background: #D9E6F7">             
            <label>DOCTOR ENCARGADO:</label>
            <input type="hidden" id="hiddendiv_trat_doctor" value=""/>
            <input type="text" class="ctrl_input_t" id="div_trat_doctor" onblur="fn_onblur(this);" style="width:44%">&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Nº TRATAMIENTO</label>
            <input type="text" id="div_trat_numero"  style="width:10%;border:0px;background: #D9E6F7;font-weight: bold" disabled/>
        </div>
        <div class="filtros" style="margin-top: -1%; padding:1% 0 0">
            <div style="margin:-1% 0 3px;width: 100%; background-color: #CCDEF4; font-weight: bold">
                <div style="margin-left: 18%; float: left">DESCRIPCION</div>
                <div style="margin-left: 15.5%; float: left">Cant</div>
                <div style="margin-left: 2%; float: left">Soles</div>
                <div style="margin-left: 4%; float: left">Dol</div>
                <div style="margin-left: 5%; float: left">SEGURO</div>
                <div style="margin-left: 83%">DOCTOR</div>
            </div>            
            <div id="div_tra_dinamico">
                <!--div de la consulta por defecto-->
                <div id="div_dina_1">
                    <input type="hidden" value="0" id="hidden_dina_esp_tip_1">
                    <input type="hidden" value="0" id="hidden_dina_esp_cod_1">
                    <label class="lbl_din">1</label><input type="text" disabled="" style="width:42%;height: 20px;font-size: 11px;" id="des_dina_1" value="CONSULTA" class="des_din">
                    <input type="text" value="1" style="width: 2.5%;height: 20px;font-size: 11px;text-align:right" id="cant_1" disabled="">
                    <input type="text" style="font-size: 11px; background: none repeat scroll 0% 0% rgb(224, 242, 255); border: 1px solid rgb(131, 203, 255);" id="cos_sol_1" value="" class="cos_din" disabled="">
                    <input type="text" style="font-size: 11px; background: none repeat scroll 0% 0% rgb(222, 232, 222); border: 1px solid rgb(133, 170, 132);" id="cos_dol_1" value="0.00" class="cos_din" disabled="disabled">
                    <input type="hidden" value="1" id="hidden_seg_id_din_1">                    
                    <input type="text" disabled="" style="width:12%;height: 20px;font-size: 11px;" value="0" id="seg_id_din_1">
                    <input type="text" disabled="" style="width:20%;height: 20px;font-size: 11px;" value="0" id="doc_id_din_1">                    
                    <input type="hidden" value="0" id="hidden_doc_id_din_1">                   
                    
                </div>
                
            </div>
            <div style="border-top: 1px solid; width: 25%; margin: 1% 40%;">
                <label class="ctrl_lavel_1" style="float: left; width: 27%; margin-right: 1%;">TOTAL</label>
                <input type="text" style="text-align: right;color: white; font-size: 12px; float: left; border: 0px none; width: 32%;background: #6FADD9" onclick="calc(0);" value="0.00" id="div_trat_total" title="click para calcular" readonly/>
                <input type="text" style="text-align: right;color: white; font-size: 12px; border: 0px none; width: 32%; margin-left: 2%;background: #85AA84" onclick="calc(1);" value="0.00" id="div_trat_total_dol" title="click para calcular" readonly/>                
            </div>
            <div style="margin:-3.5% 0% 0.5% 76%">
                <button class="btn_full" id="btn_dscto_trat"  onClick="btn_dscto_trat();">Dscto S/.</button>
                <button class="btn_full" id="btn_dscto_trat_dol"  onClick="btn_dscto_trat_dol();">Dscto $.</button>
            </div>
        </div>        
        <div class="ctrl_input"> 
            <input type="hidden" id="hiddendiv_trat_tip" value=""/>
            <!--<label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>-->
            <input type="hidden" class="ctrl_input_t" style="width: 50%;background-color: #EFFAEE" id="div_trat_tip" placeholder="tratamiento" disabled/>            
        </div>
        <div class="ctrl_input"> 
            <input type="hidden" id="hiddendiv_trat_des" value="">
            <label class="ctrl_lavel_1" style="width:10%">Descripcion</label>
            <input type="text" class="ctrl_input_t" style="width: 45%;background-color: #EFFAEE" id="div_trat_des" onblur="fn_onblur(this);" placeholder="descripcion" >
            <label class="ctrl_lavel_1" style="width:3%">Sol</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_trat_cos_sol" disabled>
            <label class="ctrl_lavel_1" style="width:3%">Dol</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_trat_cos_dol" disabled>
            &nbsp;&nbsp;<button class="btn_full" id="btn_agregar_insertar" onClick="btn_agregar_insertar();">Agregar/Insertar</button>
        </div>
    </div>
    <hr style="background-color: #418BC3; height: 1px; border: 0;">    
    <button class="btn_full_act" id="btn_salir_trat" onClick="btn_salir('div_plan_tratamiento');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_guardar_trat" onClick="btn_guardar_trat_tot();"><img src="public/images/guardar.png" style="width:20px">Guardar Tratamiento</img></button>    
    <button class="btn_full_act" id="btn_limpiar_trat" onClick="fn_close_tratamiento('todo');"><img src="public/images/limpiar.png" style="width:20px">Limpiar Plan de Tratamiento</img></button>
</div>
<!--ver tratamiento del paciente-->
<div id="div_ver_tratamiento" style="display: none; font-size: 12px" title="TRATAMIENTO DEL PACIENTE">
    <div class="filtros" style="">
        <p class="spanasis">DATOS DE PACIENTE</p><br/>       
        <div style="margin:-1%">
            <input type="hidden" id="hiddendiv_ver_trat_pac" value="">
            <label class="ctrl_lavel_1" style="width:12%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 45%;background-color: #EFFAEE" id="div_ver_trat_pac" disabled/> 
            <label class="ctrl_lavel_1" style="width:5%">Edad</label>
            <input type="text" class="ctrl_input_t" style="width: 7%;background-color: #EFFAEE" id="div_ver_trat_edad" disabled/>
            <label class="ctrl_lavel_1" style="width:11%">Tratamiento</label>            
            <select class="ctrl_input_t" id="div_ver_trat_select" onchange="select_ver_trat(this.value);" style="background-color: #EFFAEE;width: 13.7%">

            </select>           
        </div>
        <div class="ctrl_input" style="margin: 2% 0px -1.5% 1%;">
            <div style="float: left; background: #6FADD9; color: white; text-align: center; width: 9.5%;height: 21px;">Soles</div>
            <div style=" margin-left: 10%; margin-right: 1%;">                
                &nbsp;Costo Total <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_ver_trat_ttotal" disabled/>
                &nbsp;Dscto <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_ver_trat_dscto"  disabled/> 
                &nbsp;Pago total <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_ver_trat_tot_pag"  disabled/>
                &nbsp;Pagado <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_ver_trat_pagado"  disabled/>
                &nbsp;Saldo <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_ver_trat_saldo"  disabled/>
            </div>            
        </div>
        <div class="ctrl_input" style="margin: 2% 0px -1.5% 1%;">
            <div style="float: left; background: #85AA84; color: white; text-align: center; width: 9.5%;height: 21px;">Dolares</div>
            <div style="margin-left: 10%; margin-right: 1%;">                
                &nbsp;Costo Total <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_ver_trat_ttotal_dol" disabled/>
                &nbsp;Dscto <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_ver_trat_dscto_dol" disabled/> 
                &nbsp;Pago total <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_ver_trat_tot_pag_dol"  disabled/>
                &nbsp;Pagado <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_ver_trat_pagado_dol"  disabled/>
                &nbsp;Saldo <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_ver_trat_saldo_dol"  disabled/>
            </div>            
        </div>
            
    </div>
    <!--<div class="filtros" style="">-->
        <!--<p class="spanasis">DOCTOR</p><br/>--> 
    <div style="margin: 0% 1.5%;">
        <table id="grid_ver_trat_pac"></table>
<!--            <div id="1_0" style="float:left ;margin-top: -39%;margin-left: 5.5%;"><input type="text" id="txt_ver_trat_doc" style="width:255%; height: 21px; border-radius: 2px;border: 1px solid #C0CDF6;margin-bottom: 5px; text-align: left; " disabled /></div>-->
<!--            <div id="1_1" style="float:left ;margin-top: -39%;margin-left: 45.6%;">Costo Total: <input type="text" placeholder="0.00" id="txt_ver_trat_subtot" style="width:75px; height: 21px; border-radius: 2px;border: 1px solid #C0CDF6;margin-bottom: 5px; text-align: right " disabled /></div>
        <div id="1_2" style="float:left ;margin-top: -39%;margin-left: 66%;">Dscto: <input type="text" placeholder="0.00" id="txt_ver_trat_dscto" style="width:70px; height: 21px; border-radius: 2px;border: 1px solid #C0CDF6;margin-bottom: 5px; text-align: right " disabled /></div>                
        <div id="1_3" style="float:left ;margin-top: -39%;margin-left: 81%;">Pago Total: <input type="text" placeholder="0.00" id="txt_ver_trat_tot" style="width:75px; height: 21px; border-radius: 2px;border: 1px solid #C0CDF6;margin-bottom: 5px; text-align: right " disabled /></div>
        -->
        <!--<div id="pager_ver_trat_pac"></div>-->
    </div>
    <!--</div>-->
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_ver_trat_salir" onClick="btn_salir('div_ver_tratamiento');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_ver_trat_dscto" onClick="btn_ver_vista_previa_dscto();"><img src="public/images/dscto.png" style="width:20px">Ver Descuento</img></button>
    <!--<button class="btn_full_act" id="btn_ver_trat_pago" onClick="factura();"><img src="public/images/print.png" style="width:20px">Factura</img></button>-->
    <button class="btn_full_act" id="btn_ver_trat_pago_dol" onClick="open_elegir_moneda();"><img src="public/images/dol.png" style="width:20px">Pagar</img></button>
    <button class="btn_full_act" id="btn_ver_trat_pago_his" onClick="open_historial_pagos();"><img src="public/images/pago2.png" style="width:20px">Historial de Pagos</img></button>
    <button class="btn_full_act" id="btn_evolucion" onClick="btn_evolucion();"><img src="public/images/evolucion.png" style="width:20px">Evolucion</img></button>
    <button class="btn_full_act" id="btn_eliminar_trat" onClick="del_trat();"><img src="public/images/delete.png" style="width:20px">Eliminar Tratamiento</img></button><!--pagos.js -->

</div>
<!--DESCUENTO SOLES-->
<div id="div_pac_dscto" style="display: none; font-size: 12px" title="DESCUENTO SOLES">
    <div class="filtros">
        <p class="spanasis">PACIENTE</p><br/>                
        <div class="ctrl_input">
            <input type="hidden" id="hiddendiv_dscto_pac" value="">
            <label class="ctrl_lavel_1" style="width:16%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 55.5%;background-color: #EFFAEE" id="div_dscto_pac"  disabled/>           
            <label class="ctrl_lavel_1" style="width:16%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 8%;background-color: #EFFAEE" id="div_dscto_trat_num"  disabled/> 
        </div> 
        <div class="ctrl_input">
            <label class="ctrl_lavel_1" style="width:16%">Descripcion</label>
            <textarea rows="2" class="ctrl_input_t" style="width: 81%;height: 42px;background-color: #EFFAEE" id="div_dscto_des" onblur="fn_onblur(this);" placeholder="motivo de descuento"></textarea>
        </div>
        <div class="ctrl_input">            
            <label class="ctrl_lavel_1" style="width:60%">Subtotal:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_subtot"  disabled/>           
            <label class="ctrl_lavel_1" style="width:60%">Porcentaje:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_porcent" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/. 0.00" /> 
            <label class="ctrl_lavel_1" style="width:60%">Descuento:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_dscto" disabled="" placeholder="S/. 0.00" /> 
            <label class="ctrl_lavel_1" style="width:60%">Total:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_tot"  placeholder="S/. 0.00" disabled/>           
        </div> 
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_dscto_salir" onClick="btn_salir('div_pac_dscto');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_dscto_guardar" onClick="btn_insert_dscto();"><img src="public/images/guardar.png" style="width:20px">Guardar</img></button>

</div>
<!--DESCUENTO DOLARES-->
<div id="div_pac_dscto_dol" style="display: none; font-size: 12px" title="DESCUENTO DOLARES">
    <div class="filtros">
        <p class="spanasis">PACIENTE</p><br/>                
        <div class="ctrl_input">
            <input type="hidden" id="hiddendiv_dscto_pac_dol" value="">
            <label class="ctrl_lavel_1" style="width:16%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 55.5%;background-color: #EFFAEE" id="div_dscto_pac_dol"  disabled/>           
            <label class="ctrl_lavel_1" style="width:16%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 8%;background-color: #EFFAEE" id="div_dscto_trat_num_dol"  disabled/> 
        </div> 
        <div class="ctrl_input">
            <label class="ctrl_lavel_1" style="width:16%">Descripcion</label>
            <textarea rows="2" class="ctrl_input_t" style="width: 81%;height: 42px;background-color: #EFFAEE" id="div_dscto_des_dol" onblur="fn_onblur(this);" placeholder="motivo de descuento"></textarea>
        </div>
        <div class="ctrl_input">            
            <label class="ctrl_lavel_1" style="width:60%">Subtotal:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_subtot_dol"  disabled/>
            <label class="ctrl_lavel_1" style="width:60%">Porcentaje:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_porcent_dol" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/. 0.00" /> 
            <label class="ctrl_lavel_1" style="width:60%">Descuento:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_dscto_dol" disabled="" placeholder="S/. 0.00" /> 
            <label class="ctrl_lavel_1" style="width:60%">Total:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_tot_dol"  placeholder="S/. 0.00" disabled/>           
        </div> 
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_dscto_salir" onClick="btn_salir('div_pac_dscto_dol');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_dscto_guardar" onClick="btn_insert_dscto_dol();"><img src="public/images/guardar.png" style="width:20px">Guardar</img></button>

</div>

<!--ELEGIR EL TIPO DE MONEDA-->
<div id="div_elegir_moneda" style="display: none; font-size: 12px;" title="TIPO DE MONEDA">
    <div class="filtros" style="">
        <p class="spanasis">MONEDA</p><br/>       
        <div class="ctrl_input">             
            <label class="ctrl_lavel_1" style="width:45%">Seleccione Moneda</label>            
            <select class="ctrl_input_t" id="div_elegir_moneda_mon" style="background-color: #EFFAEE;width: 30%">
                <option value="0">Soles</option>
                <option value="1">Dolares</option>
            </select>           
        </div> 
        <div class="ctrl_input">
            <label class="ctrl_lavel_1" style="width:45%">Doc. de Facturacion</label>
            <select class="ctrl_input_t" style="background-color: #EFFAEE; width: 25%;"  id="div_elegir_moneda_doc_fac">
                <option value="1">BOLETA</option>
                <option value="2">RECIBO</option>
                <option value="3">FACTURA</option>
            </select> 
        </div>
    </div>
    
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_elegir_moneda_salir" onClick="btn_salir('div_elegir_moneda');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="siguiente" onClick="moneda();"><img src="public/images/mm.png" style="width:20px;transform: rotate(90deg)">Siguiente</img></button>
</div>

<!--REALIZAR PAGO SOLES  = 0--> 
<div id="div_pac_realizar_pago" style="display: none; font-size: 12px" title="PAGO EN SOLES">
    <div class="filtros">
        <p class="spanasis">PACIENTE</p><br/>                
        <div class="ctrl_input" style="margin:-1%">
            <input type="hidden" id="hiddendiv_usuario" value="<?php echo trim($_SESSION['doctor']); ?>">
            <input type="hidden" id="hiddendiv_pac_realizar_pago" value="">
            <label class="ctrl_lavel_1" style="width:14.5%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 58%;background-color: #EFFAEE" id="div_realizar_pago_pac"  disabled/>
            <label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 8%;background-color: #EFFAEE" id="div_realizar_pago_trat_num"  disabled/> 
        </div>
        <div class="ctrl_input" style="margin: 2% 0px -1.5% 0%;">            
            <div style="margin-right: 1%;">                
                &nbsp;Costo Total <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_cos_tot" disabled/>
                &nbsp;Dscto <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_dscto"  disabled/> 
                &nbsp;Total pago <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_tot_pago"  disabled/>
                &nbsp;Pagado <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_pagado"  disabled/>
                &nbsp;Saldo <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_saldo"  disabled/>
            </div>            
        </div>
    </div>
    <div class="filtros">
        <p class="spanasis">REALIZAR PAGO</p><br/>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Doc. de Facturacion</label>
            <select class="ctrl_input_t" style="background-color: #EFFAEE; width: 25%;"  id="div_pac_rea_pago_doc_fac">
                <option value="1">BOLETA</option>
                <option value="2">RECIBO</option>
                <option value="3">FACTURA</option>
            </select> 
            <label class="ctrl_lavel_1" style="width:15%">Forma de Pago</label>
            <select class="ctrl_input_t" style="background-color: #EFFAEE; width: 25%;" id="div_pac_rea_pago_for_pago">
                <option value="1">EFECTIVO</option>
                <option value="2">TARJ. CREDITO</option>
            </select>                       
        </div>

        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Fecha de emision</label>
            <input type="text" class="ctrl_input_t" style="width: 25%;background-color: #EFFAEE"  id="div_pac_rea_pago_fch"  onblur="fn_onblur(this);"  maxlength="10" placeholder="Fecha de Pago">              
            <label class="ctrl_lavel_1" style="width:15%">Monto</label>
            <input type="text" class="ctrl_input_t" style="width: 25%;background-color: #EFFAEE" id="div_pac_rea_pago_cos" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/." maxlength="8">            
        </div>
        <div class="ctrl_input">             
            <label class="ctrl_lavel_1" style="width:25%">Nº de Factura o Boleta</label>
            <input type="text" class="ctrl_input_t" style="width: 66%;background-color: #EFFAEE" maxlength="11" id="div_pac_rea_pago_num_fac_bol" onblur="fn_onblur(this);"  maxlength="15"  placeholder="Numero de factura o boleta">              
        </div>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Observacion</label>
            <textarea rows="2" class="ctrl_input_t" style="width: 66%;height: 42px;background-color: #EFFAEE"  id="div_pac_rea_pago_obs" placeholder="Observacion"></textarea>
        </div>        
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_pac_realizar_pago_salir" onClick="btn_salir('div_pac_realizar_pago');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="div_pac_realizar_pago_guardar" onClick="btn_guardar_pago(0);"><img src="public/images/editar.png" style="width:20px">Guardar Pago</img></button>

</div>

<!--REALIZAR PAGO SOLES CON FACTURA------> 
<div id="div_pac_realizar_pago_factura" style="display: none; font-size: 12px" title="PAGO EN SOLES">
    <div class="filtros">
        <p class="spanasis">PACIENTE</p><br/>        
        <div class="ctrl_input" style="margin:-1%">
            <input type="hidden" id="hiddendiv_usuario_fac" value="<?php echo trim($_SESSION['doctor']); ?>">
            <input type="hidden" id="hiddendiv_pac_realizar_pago_fac" value="">
            <label class="ctrl_lavel_1" style="width:14.5%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 58%;background-color: #EFFAEE" id="div_realizar_pago_pac_fac"  disabled/>
            <label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 8%;background-color: #EFFAEE" id="div_realizar_pago_trat_num_fac"  disabled/> 
        </div>
        <div class="ctrl_input" style="margin: 2% 0px -1.5% 0%;">            
            <div style="margin-right: 1%;">                
                &nbsp;Costo Total <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_cos_tot_fac" disabled/>
                &nbsp;Dscto <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_dscto_fac"  disabled/> 
                &nbsp;Total pago <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_tot_pago_fac"  disabled/>
                &nbsp;Pagado <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_pagado_fac"  disabled/>
                &nbsp;Saldo <input type="text" class="conta_deudas_pagos" style="width: 11%;" id="div_realizar_pago_saldo_fac"  disabled/>
            </div>            
        </div>
    </div>
    <div class="filtros">
        <p class="spanasis">FACTURA</p><br/>
        <div class="ctrl_input" style="background: #CCDEF4"> 
            
            <label class="ctrl_lavel_1" style="width: 25%;">N°. RUC</label>
            <input type="hidden" id="hiddendiv_pac_realizar_pago_factura_ruc" value="">
            <input type="text" class="ctrl_input_t" style="width: 25%;background-color: #EFFAEE"  id="div_pac_realizar_pago_factura_ruc" maxlength="11" onkeypress="return soloNumeroTab(event);" onblur="fn_onblur(this);"   placeholder="Numero de Ruc"/>
            <label class="ctrl_lavel_1" style="width: 15%; font-size: 19px;">N°.</label>
            <input type="text" style="width: 24.7%; border: 0px none; font-weight: bold; font-size: 18px; color: black; height: 20px; background: none repeat scroll 0% 0% transparent;" id="div_pac_realizar_pago_factura_serie" disabled/>            
        </div>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">RAZON SOCIAL</label>
            
            <input type="text" class="ctrl_input_t" style="width: 66%;background-color: #EFFAEE"  id="div_razon_soc_factura" onchange="fn_onblur(this);"  onblur="fn_onblur(this);" >
                                  
        </div>
        
<!--        <div style="margin:-1% 1.5% 2%;padding: 0.5%;background: #D9E6F7">             
            <label>RAZON SOCIAL</label>
            <input type="hidden" id="hiddendiv_razon_soc_factura" value=""/>
            <input type="text" class="ctrl_input_t" id="div_razon_soc_factura" onblur="fn_onblur(this);" style="width:44%">&nbsp;&nbsp;&nbsp;&nbsp;
            
        </div>-->

        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Fecha de emision</label>
            <input type="text" class="ctrl_input_t" style="width: 25%;background-color: #EFFAEE"  id="div_pac_realizar_pago_factura_fch"  onblur="fn_onblur(this);"  maxlength="10" placeholder="Fecha de Pago"/>              
            <label class="ctrl_lavel_1" style="width:15%">Monto</label>
            <input type="text" class="ctrl_input_t" style="width: 24.7%;background-color: #EFFAEE" id="div_pac_realizar_pago_factura_monto" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/." maxlength="8"/>            
        </div>        
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Observacion</label>
            <textarea rows="2" class="ctrl_input_t" style="width: 66%;height: 42px;background-color: #EFFAEE"  id="div_pac_realizar_pago_factura_obs" placeholder="Observacion"></textarea>
        </div>        
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_pac_realizar_pago_salir_fac" onClick="btn_salir('div_pac_realizar_pago_factura');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="div_pac_realizar_pago_guardar_fac" onClick="btn_guardar_pago('factura');"><img src="public/images/editar.png" style="width:20px">Guardar Pago</img></button>

</div>

<!--REALIZAR PAGO DOLARES   = 1-->
<div id="div_pac_realizar_pago_dol" style="display: none; font-size: 12px" title="PAGO EN DOLARES">
    <div class="filtros">
        <p class="spanasis">PACIENTE</p><br/>                
        <div class="ctrl_input" style="margin:-1%">
            <input type="hidden" id="hiddendiv_usuario_dol" value="<?php echo trim($_SESSION['doctor']); ?>">
            <input type="hidden" id="hiddendiv_pac_realizar_pago_dol" value="">
            <label class="ctrl_lavel_1" style="width:14.5%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 58%;background-color: #EFFAEE" id="div_realizar_pago_pac_dol"  disabled/>
            <label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 8%;background-color: #EFFAEE" id="div_realizar_pago_trat_num_dol"  disabled/> 
        </div>
        <div class="ctrl_input" style="margin: 2% 0px -1.5% 0%;">            
            <div style="margin-right: 1%;">                
                &nbsp;Costo Total <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_realizar_pago_cos_tot_dol" disabled/>
                &nbsp;Dscto <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_realizar_pago_dscto_dol" disabled/> 
                &nbsp;Total pago <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_realizar_pago_tot_pago_dol"  disabled/>
                &nbsp;Pagado <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_realizar_pago_pagado_dol"  disabled/>
                &nbsp;Saldo <input type="text" class="conta_deudas_pagos_dol" style="width: 11%;" id="div_realizar_pago_saldo_dol"  disabled/>
            </div>            
        </div>
    </div>
    <div class="filtros">
        <p class="spanasis">REALIZAR PAGO</p><br/>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Doc. de Facturacion</label>
            <select class="ctrl_input_t" style="background-color: #EFFAEE; width: 25%;"  id="div_pac_rea_pago_dol_fac">
                <option value="1">BOLETA</option>
                <option value="2">RECIBO</option>
                <option value="3">FACTURA</option>
            </select> 
            <label class="ctrl_lavel_1" style="width:15%">Forma de Pago</label>
            <select class="ctrl_input_t" style="background-color: #EFFAEE; width: 25%;" id="div_pac_rea_pago_dol_for_pago">
                <option value="1">EFECTIVO</option>
                <option value="2">TARJ. CREDITO</option>
            </select>                       
        </div>

        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Fecha de emision</label>
            <input type="text" class="ctrl_input_t" style="width: 25%;background-color: #EFFAEE"  id="div_pac_rea_pago_dol_fch"  onblur="fn_onblur(this);"  maxlength="10" placeholder="Fecha de Pago">              
            <label class="ctrl_lavel_1" style="width:15%">Monto</label>
            <input type="text" class="ctrl_input_t" style="width: 25%;background-color: #EFFAEE" id="div_pac_rea_pago_dol_cos" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/." maxlength="8">            
        </div>
        <div class="ctrl_input">             
            <label class="ctrl_lavel_1" style="width:25%">Nº de Factura o Boleta</label>
            <input type="text" class="ctrl_input_t" style="width: 66%;background-color: #EFFAEE" maxlength="11" id="div_pac_rea_pago_dol_num_fac_bol" onblur="fn_onblur(this);"  maxlength="15" placeholder="Numero de factura o boleta">              
        </div>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Observacion</label>
            <textarea rows="2" class="ctrl_input_t" style="width: 66%;height: 42px;background-color: #EFFAEE"  id="div_pac_rea_pago_dol_obs" placeholder="Observacion"></textarea>
        </div>        
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_pac_realizar_pago_salir" onClick="btn_salir('div_pac_realizar_pago_dol');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="div_pac_realizar_pago_guardar" onClick="btn_guardar_pago(1);"><img src="public/images/editar.png" style="width:20px">Guardar Pago</img></button>

</div>

<!--evolucion--> 
<div id="div_pac_evolucion" style="display: none; font-size: 12px" title="EVOLUCION">
    <div class="filtros">
        <p class="spanasis">PACIENTE</p><br/>                
        <div class="ctrl_input" style="margin:-1%">
            <input type="hidden" id="hiddendiv_evol_pac" value="">
            <label class="ctrl_lavel_1" style="width:13%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 55.5%;background-color: #EFFAEE" id="div_evol_pac"  disabled/>           
            <label class="ctrl_lavel_1" style="width:16%">Tratamiento</label>
            <input type="text" class="ctrl_input_t" style="width: 8%;background-color: #EFFAEE" id="div_pac_evol_trat_num"  disabled/> 
        </div>      
    </div>
    <div class="filtros">
        <p class="spanasis">ACTIVIDAD REALIZADA</p><br/> 
        <div class="ctrl_input" style="margin:-1%">
            <label class="ctrl_lavel_1" style="width:16%">Fecha</label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE"  id="div_pac_evol_fch_act" onblur="fn_onblur(this);"  maxlength="10" placeholder="Fecha" value="">            
            <label class="ctrl_lavel_1"><i class="glyphicon glyphicon-time">Hora</i></label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE"  id="div_pac_evol_hora_act" onblur="fn_onblur(this);" maxlength="9" placeholder="00:00am/pm"> 
            <br>
            <label class="ctrl_lavel_1" style="width:16%">Descripcion</label>
            <textarea rows="2" class="ctrl_input_t" style="margin-top: 0.5%;width: 78%;height: 42px;background-color: #EFFAEE" id="div_pac_evol_act_des" onblur="fn_onblur(this);" placeholder="actividad"></textarea>
        </div>
    </div>
    <div class="filtros">
        <p class="spanasis">PROXIMA ACTIVIDAD - CITA</p><br/>
        <div class="ctrl_input" style="margin:-1%">
            <label class="ctrl_lavel_1" style="width:16%">Fecha</label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE"  id="div_pac_evol_pro_acti_fch" onblur="fn_onblur(this);" maxlength="10" placeholder="Fecha" value="">                          
            <label class="ctrl_lavel_1"><i class="glyphicon glyphicon-time">Hora</i></label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE"  id="div_pac_evol_pro_hora_act" onblur="fn_onblur(this);" maxlength="9" placeholder="00:00am/pm">
            <label class="ctrl_lavel_1">Consultorio</label>
            <select class="ctrl_input_t" style="background-color: #EFFAEE; width: 20%;" id="div_pac_evolucion_consult">
                <option value="0">--Seleccione--</option>
                <option value="C1">Consultorio 1</option>
                <option value="C2">Consultorio 2</option>
                <option value="C3">Consultorio 3</option>
                <option value="C4">Consultorio 4</option>
                <option value="C5">Consultorio 5</option>
                <option value="C6">Consultorio 6</option>
                <option value="C7">Consultorio 7</option>
                <option value="C8">Consultorio 8</option>
                <option value="C9">Consultorio 9</option>
                <option value="C10">Consultorio 10</option>
            </select> 
            <br>
            <label class="ctrl_lavel_1" style="width:16%">Descripcion</label>
            <textarea rows="2" class="ctrl_input_t" style="margin-top: 0.5%;width: 78%;height: 42px;background-color: #EFFAEE" id="div_pac_evol_pro_acti_des" onblur="fn_onblur(this);" placeholder="actividad"></textarea>
        </div>
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_evol_salir" onClick="btn_salir('div_pac_evolucion');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_evol_guardar" onClick="btn_insert_evol();"><img src="public/images/guardar.png" style="width:20px">Guardar</img></button>

</div>

<!--HISTORIAL DE PAGOS-->
<div id="div_historial_pagos" style="display: none; font-size: 12px;" title="HISTORIAL DE PAGOS">
    <div class="filtros" style="">
        <p class="spanasis">DATOS DE PACIENTE</p><br/>       
        <div style="margin:-1%">
            <input type="hidden" id="hiddendiv_historial_pagos_nom_pac" value="">
            <label class="ctrl_lavel_1" style="width:13%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 55%;background-color: #EFFAEE" id="div_historial_pagos_nom_pac" disabled/> 
            <label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>            
            <select class="ctrl_input_t" id="div_historial_pagos_select" onchange="select_ver_historial_pagos(this.value);" style="background-color: #EFFAEE;width: 13.7%">

            </select>           
        </div>        
    </div>
    <div style="position: absolute; top: 16.4%; z-index: 1; left: 71%;">
        <label class="ctrl_lavel_1" style="color: white; float: left; width: 37%;">Saldo S/.</label>
        <input type="text" class="conta_deudas_pagos" style="float: left; width: 48%; margin-left: 2%;" id="div_historial_pagos_saldo" disabled/> 
        <!--javascript pagos-->
        <button class="btn_navi" id="btn_historial_pagos_sol" onClick="navegacion(0);">
            <img src="public/images/mm.png" style="width:20px"></img>
        </button>
    </div>
    <div style="position: absolute; top: 56%; z-index: 1; left: 72%;" id="div_his_pagos_mov">
        <label class="ctrl_lavel_1" style="color: white; float: left; width: 36%;">Saldo $.</label>
        <input type="text" class="conta_deudas_pagos_dol" style="float: left; width: 48%; margin-left: 2%;" id="div_historial_pagos_saldo_dol" disabled/> 
        <!--javascript pagos-->
        <button class="btn_navi" id="btn_historial_pagos_dol" onClick="navegacion(1);">
            <img src="public/images/mm.png" style="width:20px;transform: scaleY(-1);"></img>
        </button>
    </div>
    <div style="margin: 0% 1.5%;position: relative">        
        <table id="grid_ver_historial_pagos"></table>
        <div id="grid_ver_historial_pagos_pager"></div>
        <br>
        <table id="grid_ver_historial_pagos_dol"></table>
        <div id="grid_ver_historial_pagos_dol_pager"></div>
    </div>
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_historial_pagos_salir" onClick="btn_salir('div_historial_pagos');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
</div>

<!--EDITAR TRATAMIENTO UNO POR UNO-->
<div id="div_editar_trat" style="display: none; font-size: 12px" title="EDITAR TRATAMIENTO">
    <div class="filtros">
        <p class="spanasis">TRATAMIENTO</p><br/>       
        <div class="ctrl_input">               
            <input type="hidden" id="div_editar_trat_pac_id" value="">
            <input type="hidden" id="div_editar_trat_trat_num" value="">
            <input type="hidden" id="div_editar_trat_codigo" value="">
            
            <label class="ctrl_lavel_1" style="width: 17.5%;">Descripcion</label>
            <input type="text" class="ctrl_input_t" style="width: 78%;background-color: #EFFAEE" id="div_editar_trat_des"  onblur="fn_onblur(this);"> 
            <input type="hidden" id="hiddendiv_editar_trat_des" value="">
            <input type="hidden" id="hiddendiv_editar_trat_tip" value="">
        </div>       
        <div class="ctrl_input">       
            <label class="ctrl_lavel_1" style="width: 17.5%;">Cantidad</label>
            <input type="text" class="ctrl_input_t" style="width: 32.5%;background-color: #EFFAEE" id="div_editar_trat_cant" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="Cantidad" maxlength="2"> 
           
        </div> 
        <div class="ctrl_input">       
            <label class="ctrl_lavel_1" style="width: 17.5%;">Soles</label>
            <input type="text" class="ctrl_input_t" style="width: 32.5%;background-color: #EFFAEE" id="div_editar_trat_sol"  onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/."> 
            <label class="ctrl_lavel_1" style="width: 11.5%;">Dolares</label>
            <input type="text" class="ctrl_input_t" style="width: 32.5%;background-color: #EFFAEE" id="div_editar_trat_dol"  onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="$."> 
        </div> 
        <div class="ctrl_input">       
            <label class="ctrl_lavel_1" style="width: 17.5%;">Fecha</label>
            <input type="text" class="ctrl_input_t" style="width: 32.5%;background-color: #EFFAEE" id="div_editar_trat_fch" onblur="fn_onblur(this);" > 
            <label class="ctrl_lavel_1" style="width: 11.5%;">Seguro</label>             
            <select class="ctrl_lavel_t" id="div_editar_trat_seguro" style="width: 32.5%;background-color: #EFFAEE">
                <option value="1">SIN SEGURO</option>
                <option value="2">LA POSITIVA</option>
                <option value="3">CERRO VERDE</option>
            </select>
        </div>
        <div class="ctrl_input">       
            <label class="ctrl_lavel_1" style="width: 17.5%;">Doctor</label>
            <input type="text" class="ctrl_input_t" style="width: 78%;background-color: #EFFAEE" id="div_editar_trat_doctor"  onblur="fn_onblur(this);"> 
            <input type="hidden" id="div_editar_trat_doc_id" value="">
        </div> 
    </div>     
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_salir_consulta" onClick="btn_salir('div_editar_trat');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_guardar_consulta" onClick="btn_editar_trat();"><img src="public/images/guardar.png" style="width:20px">Editar</img></button>    
</div>


<!--RUC-->
<div id="div_reg_ruc" style="display: none; font-size: 12px;" title="REGISTRO DE RUC"> 
    <div class="filtros">
        <p class="spanasis">DATOS DEL PACIENTE</p><br/>       
        <div class="ctrl_input" style="margin-top: -1%; margin-bottom: -1.5%">
            <input type="hidden" id="hiddendiv_reg_ruc_nom_pac" value="">
            <label class="ctrl_lavel_1" style="width:16%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 81.5%;background-color: #EFFAEE" id="div_reg_ruc_nom_pac" disabled/> 
        </div>        
    </div>
    <div class="filtros" style="">
        <p class="spanasis">DATOS DEL RUC</p><br/> 
        <div class="ctrl_input">
            <input type="hidden" id="div_reg_ruc_pac_id_hidden" value="">
            <label class="ctrl_lavel_1" style="width: 19%;">Razon Social</label>
            <input type="text" class="ctrl_input_t" style="width: 78%; " id="div_reg_ruc_raz_soc" maxlength="150" onblur="fn_onblur(this);"/>        
        </div>
        <div class="ctrl_input">
            <label class="ctrl_lavel_1" style=" width: 19%;">Numero Ruc</label>
            <input type="text" class="ctrl_input_t" style="width: 78%;" id="div_reg_ruc_num_ruc" maxlength="11" onblur="fn_onblur(this);" onkeypress="return soloDNI(event);"/>
        </div>
        <div class="ctrl_input">
            <label class="ctrl_lavel_1" style="width: 19%;">Direccion</label>
            <input type="text" class="ctrl_input_t" style="width: 78%;" id="div_reg_ruc_dir" maxlength="200" onblur="fn_onblur(this);" />
        </div>        
        <div class="ctrl_input">
            <label class="ctrl_lavel_1" style="width: 19%;">Etado</label>
            <select class="ctrl_input_t" id="div_reg_ruc_est" style="background-color: #EFFAEE">
                <option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>                
            </select>
        </div> 
    </div>      
    
    <hr style="background-color: #418BC3; height: 1px; border: 0;">    
    <button class="btn_full_act" id="div_reg_ruc_salir" onClick="btn_salir('div_reg_ruc');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="div_reg_ruc_guardar" onClick="brn_guardar_ruc('INSERTAR');" title="Enter"><img src="public/images/guardar.png" style="width:20px">Guardar Ruc</img></button>
</div>




