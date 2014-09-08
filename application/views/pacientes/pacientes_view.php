<style type="text/css">
    .btn_full{
        background-color:#DFE8F6;                                  
        color:#0C509D;      
        font-weight:bold;
        padding:3px 12px; 
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
        padding:1px 8px;
        margin-left: 1%;
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
        margin-top: 0.3%;
        margin-left: 1%;
        width: 55%;//38
    }
    .cos_din{
        margin-left: 0%;
        width: 9%;
        text-align: right;        
    }
    .lbl_din{
        margin-left: 1%;
        width: 1.5%;
    }
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
            &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_full" id="btn_buscar" onClick="fn_buscar_pac();">Buscar</button>            
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_pac"></table>
        <div id="pager_con_pac"></div>
    </div>  
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_salir" onClick="btn_salir('div_pac_reg');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_nuevo_pac" onClick="btn_nuevo_pac('INSERTAR');"><img src="public/images/paciente.png" style="width:20px">Nuevo Paciente</img></button>
    <button class="btn_full_act" id="btn_consulta_pac" onClick="btn_rea_consulta();"><img src="public/images/cita.png" style="width:20px">Realizar Consulta</img></button>
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
            <input type="text" class="ctrl_input_t" style="width: 19%" id="dni"  onkeypress="return soloNumeroTab(event);" tabindex="4" maxlength="8" placeholder="Ingrese DNI">               
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
    <button class="btn_full_act"  id="btn_guardar_registro" onClick="brn_guardar_pac('INSERTAR');"><img src="public/images/guardar.png" tabindex="14"  style="width:20px">Guardar Paciente</img></button>
    <button class="btn_full_act"  id="btn_editar_registro" onClick="brn_guardar_pac('EDITAR');"><img src="public/images/guardar.png" style="width:20px"> Editar Paciente</img></button>


</div>
<!--REALIZAR CONSULTA-->
<div id="div_consulta" style="display: none; font-size: 12px" title="SEPARAR CONSULTA">
    <div class="filtros">
        <p class="spanasis">CITA</p><br/>       
        <div class="ctrl_input">               
            <input type="hidden" id="pac_id_cons" value="">
            <label class="ctrl_lavel_1">Paciente:</label>
            <input type="text" class="ctrl_input_t" style="width: 85%;background-color: #EFFAEE" id="div_cons_pac" onblur="fn_onblur(this);" disabled >             
        </div>       
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1">Costo</label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE" id="div_cons_cos" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);" placeholder="S/."maxlength="2">
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
            <div style="margin:-1% 0 0;width: 100%; background-color: #CCDEF4; font-weight: bold">
                <div style="margin-left: 18%; float: left">DESCRIPCION</div>
                <div style="margin-left: 26.5%; float: left">COSTO</div>
                <div style="margin-left: 4%; float: left">SEGURO</div>
                <div style="margin-left: 84%">DOCTOR</div>
            </div>
            <div id="div_tra_dinamico"  > 

            </div>
            <div style="margin:1% 48%;border-top: 1px solid;width: 16%;">
                <label class="ctrl_lavel_1" style="width:40%;">TOTAL</label>
                <input type="text" style="width:56%;border: 0 none;text-align: right;font-size:12px;font-weight:bold;width:50%;" id="div_trat_total" disabled/>                
            </div>
            <div style="margin:-3.5% 0% 0.5% 76%">
                <button class="btn_full" id="btn_dscto_trat"  onClick="btn_dscto_trat();">Descuento</button>
            </div>
        </div>        
        <div class="ctrl_input"> 
            <input type="hidden" id="hiddendiv_trat_tip" value=""/>
            <!--<label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>-->
            <input type="hidden" class="ctrl_input_t" style="width: 50%;background-color: #EFFAEE" id="div_trat_tip" placeholder="tratamiento" disabled/>            
        </div>
        <div class="ctrl_input"> 
            <input type="hidden" id="hiddendiv_trat_des" value="">
            <label class="ctrl_lavel_1" style="width:12%">Descripcion</label>
            <input type="text" class="ctrl_input_t" style="width: 50%;background-color: #EFFAEE" id="div_trat_des" onblur="fn_onblur(this);" placeholder="descripcion" >
            <label class="ctrl_lavel_1" style="width:7%">Costo</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_trat_cos" disabled>
            &nbsp;&nbsp;<button class="btn_full" id="btn_agregar_insertar" onClick="btn_agregar_insertar();">Agregar / Insertar</button>
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
            <label class="ctrl_lavel_1" style="width:13%">Paciente</label>
            <input type="text" class="ctrl_input_t" style="width: 55%;background-color: #EFFAEE" id="div_ver_trat_pac" disabled/> 
            <label class="ctrl_lavel_1" style="width:12%">Tratamiento</label>            
            <select class="ctrl_input_t" id="div_ver_trat_select" onchange="select_ver_trat(this.value);" style="background-color: #EFFAEE;width: 13.7%">

            </select>           
        </div>
        <div class="ctrl_input" style="margin:2% 0 -1.5% 2%">
            <label class="ctrl_lavel_1" style="width:10.5%">Costo Total</label>
            <input type="text" class="ctrl_input_t" style="width: 11%;background-color: #EFFAEE" id="div_ver_trat_ttotal" disabled/>
            <label class="ctrl_lavel_1" style="width:5%">Dscto</label>
            <input type="text" class="ctrl_input_t" style="width: 11%;background-color: #EFFAEE" id="div_ver_trat_dscto"  disabled/> 
            <label class="ctrl_lavel_1" style="width:9%">Total pago</label>
            <input type="text" class="ctrl_input_t" style="width: 11%;background-color: #EFFAEE" id="div_ver_trat_tot_pag"  disabled/>
            <label class="ctrl_lavel_1" style="width:7%">Pagado</label>
            <input type="text" class="ctrl_input_t" style="width: 11%;background-color: #EFFAEE" id="div_ver_trat_pagado"  disabled/>
            <label class="ctrl_lavel_1" style="width:5%">Saldo</label>
            <input type="text" class="ctrl_input_t" style="width: 11%;background-color: #EFFAEE" id="div_ver_trat_saldo"  disabled/>
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
    <button class="btn_full_act" id="btn_ver_trat_pago" onClick="btn_pago_pac();"><img src="public/images/pago2.png" style="width:20px">Realizar Pago</img></button>
    <button class="btn_full_act" id="btn_ver_trat_pago_his" onClick="open_historial_pagos();"><img src="public/images/pago2.png" style="width:20px">Historial de Pagos</img></button>
    <button class="btn_full_act" id="btn_evolucion" onClick="btn_evolucion();"><img src="public/images/evolucion.png" style="width:20px">Evolucion</img></button>

</div>
<!--DESCUENTO-->
<div id="div_pac_dscto" style="display: none; font-size: 12px" title="DESCUENTO">
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
            <label class="ctrl_lavel_1" style="width:60%">Descuento:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_dscto" onblur="fn_onblur(this);" onkeypress="return justNumbers(event);" placeholder="S/. 0.00" /> 
            <label class="ctrl_lavel_1" style="width:60%">Total:</label>
            <input type="text" class="ctrl_input_t" style="width: 37%;background-color: #EFFAEE" id="div_dscto_tot"  placeholder="S/. 0.00" disabled/>           
        </div> 
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_dscto_salir" onClick="btn_salir('div_pac_dscto');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_dscto_guardar" onClick="btn_insert_dscto();"><img src="public/images/guardar.png" style="width:20px">Guardar</img></button>

</div>

<!--REALIZAR PAGO-->
<div id="div_pac_realizar_pago" style="display: none; font-size: 12px" title="PAGO DE TRATAMIENTO">
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
        <div class="ctrl_input" style="margin:2% 0 -1.5% 2%">           
            <label class="ctrl_lavel_1" style="width:12%">Costo Total</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_realizar_pago_cos_tot"  disabled/>
            <label class="ctrl_lavel_1" style="width:5%">Dscto</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_realizar_pago_dscto"  disabled/> 
            <label class="ctrl_lavel_1" style="width:10%">Total pago</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_realizar_pago_tot_pago"  disabled/>
            <label class="ctrl_lavel_1" style="width:7%">Pagado</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_realizar_pago_pagado"  disabled/> 
            <label class="ctrl_lavel_1" style="width:6%">Saldo</label>
            <input type="text" class="ctrl_input_t" style="width: 10%;background-color: #EFFAEE" id="div_realizar_pago_saldo"  disabled/> 
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
            <input type="text" class="ctrl_input_t" style="width: 66%;background-color: #EFFAEE" maxlength="11" id="div_pac_rea_pago_num_fac_bol" onblur="fn_onblur(this);" onkeypress="return soloNumeroTab(event);"  placeholder="Numero de factura o boleta">              
        </div>
        <div class="ctrl_input"> 
            <label class="ctrl_lavel_1" style="width:25%">Observacion</label>
            <textarea rows="2" class="ctrl_input_t" style="width: 66%;height: 42px;background-color: #EFFAEE"  id="div_pac_rea_pago_obs" placeholder="Observacion"></textarea>
        </div>        
    </div>

    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_pac_realizar_pago_salir" onClick="btn_salir('div_pac_realizar_pago');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="div_pac_realizar_pago_guardar" onClick="btn_guardar_pago();"><img src="public/images/editar.png" style="width:20px">Guardar Pago</img></button>

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
            <input type="text" class="ctrl_input_t" style="width: 28.5%;background-color: #EFFAEE"  id="div_pac_evol_fch_act" onkeyup="mascara(this, '/', patron, true);" onblur="fn_onblur(this);" onkeypress="return justNumbers(event);"  maxlength="10" placeholder="Fecha" value="">            
            <br>
            <label class="ctrl_lavel_1" style="width:16%">Descripcion</label>
            <textarea rows="2" class="ctrl_input_t" style="margin-top: 0.5%;width: 78%;height: 42px;background-color: #EFFAEE" id="div_pac_evol_act_des" onblur="fn_onblur(this);" placeholder="actividad"></textarea>
        </div>
    </div>
    <div class="filtros">
        <p class="spanasis">PROXIMA ACTIVIDAD</p><br/>
        <div class="ctrl_input" style="margin:-1%">
            <label class="ctrl_lavel_1" style="width:16%">Fecha</label>
            <input type="text" class="ctrl_input_t" style="width: 28.5%;background-color: #EFFAEE"  id="div_pac_evol_pro_acti_fch" onkeyup="mascara(this, '/', patron, true);" onblur="fn_onblur(this);" onkeypress="return justNumbers(event);"  maxlength="10" placeholder="Fecha" value="">                          
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
<div id="div_historial_pagos" style="display: none; font-size: 12px" title="HISTORIAL DE PAGOS">
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
    <div style="position: absolute; z-index: 1; left: 77%; top: 20%;">
        <label class="ctrl_lavel_1" style="width:26%; color: white">SALDO</label>
        <input type="text" style="background-color: rgb(224, 242, 255); border: 1px solid rgb(131, 203, 255); width: 52%; height: 18px; text-align: right; font-size: 13px; color: rgb(55, 118, 166);" id="div_historial_pagos_saldo" /> 
    </div> 
    <div style="margin: 0% 1.5%;position: relative">        
        <table id="grid_ver_historial_pagos">

        </table>
    </div>
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_historial_pagos_salir" onClick="btn_salir('div_historial_pagos');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
</div>









