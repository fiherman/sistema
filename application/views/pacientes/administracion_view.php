<style type="text/css">
    .btn_full{
        background-color:#DFE8F6;                                  
        color:#0C509D;
        /*    font-family:arial;
            font-size:13px;*/
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
/*    .btn_din{
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
    }*/
    .btn_full_act{
        background-color:#DFE8F6;                                  
        color:#0C509D;
        /*    font-family:arial;
            font-size:19px;*/
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
/*    .des_din{
        margin-top: 0.3%;
        margin-left: 1%;
        width: 38%;
    }
    .cos_din{
        margin-left: 1%;
        width: 7%;
        text-align: right;
    }
    .lbl_din{
        margin-left: 1%;
    }*/
</style>
<script src="<?php echo base_url('public/js/administracion.js'); ?>" type="text/javascript" charset="UTF-8"></script>
<!--menu administracion del sistema-->
<div id="div_adm_all" style="display: none; font-size: 12px" title="ADMINISTRACION DEL SISTEMA">
        <div style="height: 67%;padding: 3% 5% 0% 6%">
            <div style="float: left;margin-right: 2%;width: 30%;border: 1px solid #418BC3;border-radius: 3px">
                <a href="#" onclick="open_doctores();" class="list_group_item" style="opacity: 0.8"><center><b>DOCTORES</b></center>
                    <img src="public/images/doctor.png" class="img-rounded img-responsive" style="width: 60%;margin-left: 22%">
                </a>                       
            </div> 
            <div style="float: left;margin: 0 2%;;width: 30%;border: 1px solid #418BC3;border-radius: 3px">
                <a href="#" onclick="open_usuarios();" class="list_group_item" style="opacity: 0.8;"><center><b>USUARIOS</b></center>
                    <img src="public/images/configurar.png" class="img-rounded img-responsive" style="width: 60%;margin-left: 22%">
                </a>                       
            </div>
            <div style="float: left;margin-left: 2%;width: 30%;border: 1px solid #418BC3;border-radius: 3px">
                <a href="#" onclick="open_especialidades();" class="list_group_item" style="opacity: 0.8;"><center><b>ESPECIALIDADES</b></center>
                    <img src="public/images/especialidades.png" class="img-rounded img-responsive" style="width: 60%;margin-left: 22%">
                </a>                       
            </div>            
        </div>
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_adm_salir" onClick="btn_salir('div_adm_all');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>    
</div>
<!--DOCTORES-->
<div id="div_adm_doc" style="display: none; font-size: 12px" title="LISTA DE DOCTORES">
    <div class="filtros">
        <p class="spanasis">BUSCAR DOCTOR</p><br/>        
        <div style="margin: -5px 0px -12px 20px">
            Buscar: <input type="text" id="txtbuscar_doc" style="text-transform:uppercase;padding: 3px 10px;width:70%; height: 23px; border-radius: 6px;border: 1px solid #C0CDF6;margin-bottom: 5px;"/>
            &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_full" id="btn_adm_buscar" onClick="fn_buscar_doc();"><img src="public/images/buscar.png" style="width:20px">Buscar</img></button>
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_doc"></table>
        <div id="pager_con_doc"></div>
    </div>  
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_adm_salir" onClick="btn_salir('div_adm_doc');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_adm_nuevo_pac" onClick="btn_nuevo_doc('INSERTAR');"><img src="public/images/paciente.png" style="width:20px">Nuevo Doctor</img></button>    
    <button class="btn_full_act" id="btn_adm_actualizar_pac" onClick="btn_actualizar_cons();"><img src="public/images/actualizar.png" style="width:20px">Actualizar</img></button>    
</div>
<!--NUEVO DOCTOR-->
<div id="div_nuevo_doc" title="AGREGAR NUEVO DOCTOR" style="display: none"> 
    <div class="filtros">
        <p class="spanasis">DATOS PERSONALES </p><br/>   
        <div class="ctrl_input">               
            <input type="hidden" id="doc_id" value="" >
            <label style="text-align: right;width: 14.5%;">Nombres</label>
            <input type="text" class="ctrl_input_t" style="width: 84%;background-color: #EFFAEE" id="txtadm_doc_nom" onblur="fn_onblur(this);" placeholder="Ingrese Nombres">             
        </div>       
        <div class="ctrl_input"> 
            <label style="text-align: right;width: 14.5%;">Apellidos</label>
            <input type="text" class="ctrl_input_t" style="width: 84%;background-color: #EFFAEE" id="txtadm_doc_ape" onblur="fn_onblur(this);" placeholder="Ingrese Apellidos">
        </div>
        <div class="ctrl_input">
            <label style="text-align: right;width: 14.5%;">Universidad</label>
            <input type="text" class="ctrl_input_t" style="width: 84%;background-color: #EFFAEE" id="txtadm_doc_uni" name="email" onblur="fn_onblur(this);" value="" placeholder="Universidad">
        </div>
        <div class="ctrl_input">    
            <label style="text-align: right;width: 14.5%;">RNE</label>
            <input type="text" class="ctrl_input_t" style="width: 48%;background-color: #EFFAEE" id="txtadm_doc_cop" onblur="fn_onblur(this);" placeholder="codigo del doctor">                                      
            <label style="text-align: right;width: 10%;">Estado</label>
            <select class="ctrl_input_t" id="txtadm_doc_hab" style="background-color: #EFFAEE">
                <option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>                
            </select>
        </div>         
    </div>    
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act"  id="btn_adm_salir_registro" onClick="btn_salir('div_nuevo_doc');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act"  id="btn_adm_guardar_doc" onClick="brn_guardar_doc('INSERTAR');"><img src="public/images/guardar.png" style="width:20px">Guardar Doctor</img></button>
    <button class="btn_full_act"  id="btn_adm_editar_doc" onClick="brn_guardar_doc('EDITAR');"><img src="public/images/guardar.png" style="width:20px"> Editar Doctor</img></button>
</div>

<!--ESPECIALIDADES-->
<div id="div_adm_esp" style="display: none; font-size: 12px" title="ESPECIALIDADES">
    <div class="filtros">
        <p class="spanasis">FILTROS</p><br/>        
        <div style="margin: -5px 0px -12px 20px">
            <label class="ctrl_lavel_0">SEGURO</label>
            <select id="div_adm_esp_seg_id" class="ctrl_input_t" onchange="select_adm_seg_id(this.value,0);">
                <option value="select">--SELECCIONE--</option>
                <option value="1">SIN SEGURO</option>
                <option value="2">PACIFICO</option>
                <option value="3">CERRO VERDE</option>
            </select>
            <label class="ctrl_lavel_0" style="width:16%">ESPECIALIDAD</label>
            <select class="ctrl_input_t" id="div_adm_esp_tipo" onchange="select_adm_esp_tipo(this.value);">
               <option value="select">--SELECCIONE--</option>
            </select>  
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_especialidad"></table>
        <!--<div id="pager_con_doc"></div>-->
    </div>  
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_adm_salir" onClick="btn_salir('div_adm_esp');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_adm_nuevo_pac" onClick="btn_nueva_especialidad('INSERTAR');"><img src="public/images/paciente.png" style="width:20px">Nuevo Tratamiento</img></button>    
    <!--<button class="btn_full_act" id="btn_adm_nuevo_pac" onClick=""><img src="public/images/paciente.png" style="width:20px">Nuevo Especialidad</img></button>-->    
    
</div>

<!--NUEVA ESPECIALIDAD-->
<div id="div_adm_nueva_esp" style="display: none; font-size: 12px" title="NUEVA ESPECIALIDAD">  
    <div class="filtros">
        <br>
        <div class="ctrl_input">
            <label class="ctrl_lavel_0" style="width:17%">SEGURO</label>
            <select id="div_adm_nueva_esp_seg" class="ctrl_input_t" onchange="select_adm_seg_id(this.value,1);">
                <option value="select">--SELECCIONE--</option>
                <option value="1">SIN SEGURO</option>
                <option value="2">PACIFICO</option>
                <option value="3">CERRO VERDE</option>
            </select>
            <label class="ctrl_lavel_0" style="width:17%">ESPECIALIDAD</label>
            <select class="ctrl_input_t" id="div_adm_nueva_esp_tipo">
               <option value="select">--SELECCIONE--</option>
            </select>             
        </div>
        <div class="ctrl_input">
            <input type="hidden" id="esp_id" value="" >
            <label class="ctrl_lavel_0" style="width:17%">TRATAMIENTO</label>
            <textarea rows="2" class="ctrl_input_t" style="margin-top: 0.5%;width: 78%;height: 42px;background-color: #EFFAEE" id="div_adm_nueva_esp_des" onblur="fn_onblur(this);" placeholder="descripcion de tratamiento"></textarea>                       
        </div>
        <div class="ctrl_input">
            <label class="ctrl_lavel_0" style="width:17%">COSTO</label>
            <input type="text" class="ctrl_input_t" style="width: 15%;background-color: #EFFAEE" id="div_adm_nueva_esp_cos" onblur="fn_onblur(this);" placeholder="S/.">             
        </div>    
    </div>
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="div_adm_nueva_esp_salir" onClick="btn_salir('div_adm_nueva_esp');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_adm_nuevo_pac_ins" onClick="brn_guardar_especialidad('INSERTAR');"><img src="public/images/nuevo.png" style="width:20px">Guardar Tratamiento</img></button>    
    <button class="btn_full_act" id="btn_adm_nuevo_pac_upd" onClick="brn_guardar_especialidad('EDITAR');"><img src="public/images/editar.png" style="width:20px">Editar Tratamiento</img></button>    
    
</div>



<!--USUARIOS USUARIOS USUARIOS USUARIOS USUARIOS-->
<div id="div_adm_usu" style="display: none; font-size: 12px" title="LISTA DE USUARIOS">
    <div class="filtros">
        <p class="spanasis">BUSCAR USUARIO</p><br/>        
        <div style="margin: -5px 0px -12px 20px">
            Buscar: <input type="text" id="txtbuscar_usu" style="text-transform:uppercase;padding: 3px 10px;width:70%; height: 23px; border-radius: 6px;border: 1px solid #C0CDF6;margin-bottom: 5px;"/>
            &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_full" id="btn_adm_buscar_usu" onClick="fn_buscar_usu();"><img src="public/images/buscar.png" style="width:20px">Buscar</img></button>
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_usu"></table>
        <div id="pager_con_usu"></div>
    </div>  
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_adm_salir_usu" onClick="btn_salir('div_adm_usu');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_adm_nuevo_usu" onClick="btn_nuevo_usu();"><img src="public/images/paciente.png" style="width:20px">Nuevo Usuario</img></button>    
    <button class="btn_full_act" id="btn_adm_actualizar_usu" onClick="btn_actualizar_usuarios();"><img src="public/images/actualizar.png" style="width:20px">Actualizar</img></button>    
</div>
<!--NUEVO USUARIOS-->
<div id="div_nuevo_usu" title="AGREGAR NUEVO USUARIO" style="display: none"> 
    <div class="filtros">
        <p class="spanasis">DATOS DE USUARIO </p><br/>   
        <div class="ctrl_input">               
            <input type="hidden" id="user_id" value="" >
            <label style="text-align: right;width: 25%;">Nombres y Apellidos</label>
            <input type="text" class="ctrl_input_t" style="width: 73%;" id="txt_divnuevousu_nomcom" onblur="fn_onblur(this);" placeholder="Nombres y apellidos">             
        </div>       
        <div class="ctrl_input"> 
            <label style="text-align: right;width: 25%;">Email</label>
            <input type="text" class="ctrl_input_t_email" style="width: 73%;" id="txt_divnuevousu_email" onblur="fn_onblur(this);" placeholder="email">
        </div>
        <div class="ctrl_input">
            <label style="text-align: right;width: 25%;">Usuario</label>
            <input type="text" class="ctrl_input_t" style="width: 73%;" id="txt_divnuevousu_user" onblur="fn_onblur(this);" placeholder="usuario">
        </div>
         <div class="ctrl_input"> 
            <label style="text-align: right;width: 25%;">Contraseña</label>
            <input type="password" class="ctrl_input_t" style="width: 73%;" id="div_nuevo_usu_c" onblur="fn_onblur(this);" placeholder="contraseña nueva">
        </div>
        <div class="ctrl_input">
            <label style="text-align: right;width: 25%;">Repita Contraseña</label>
            <input type="password" class="ctrl_input_t" style="width: 73%;" id="div_nuevo_usu_rep_c" onblur="fn_onblur(this);" placeholder="repita contraseña">
        </div>                  
    </div>    
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act"  id="div_nuevo_usu_btn_salir" onClick="btn_salir('div_nuevo_usu');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>    
    <button class="btn_full_act"  id="div_nuevo_usu_btn_edit" onClick="btn_guardar_insert_usu();"><img src="public/images/guardar.png" style="width:20px"> Guardar Usuario</img></button>
</div>
<!--EDITAR USUARIO-->
<div id="div_edit_usu" title="EDITAR USUARIO" style="display: none"> 
    <div class="filtros">
        <p class="spanasis">DATOS DE USUARIO </p><br/>
        <div class="ctrl_input"> 
            <input type="hidden" id="user_password" value="" >
            <input type="hidden" id="edit_usuario_id" value="" >
            <label style="text-align: right;width: 25%;">Contraseña Actual</label>
            <input type="password" class="ctrl_input_t" style="width: 73%;background-color: #EFFAEE" id="div_edit_usu_c_act" onblur="fn_onblur(this);" placeholder="contraseña actual">
        </div>
        <div class="ctrl_input">               
            <input type="hidden" id="user_id" value="" >
            <label style="text-align: right;width: 25%;">Nombres y Apellidos</label>
            <input type="text" class="ctrl_input_t" style="width: 73%;background-color: #EFFAEE" id="div_edit_usu_nom_com" onblur="fn_onblur(this);" placeholder="Nombres y apellidos">             
        </div>       
        <div class="ctrl_input"> 
            <label style="text-align: right;width: 25%;">Email</label>
            <input type="text" class="ctrl_input_t_email" style="width: 73%;background-color: #EFFAEE" id="div_edit_usu_email" onblur="fn_onblur(this);" placeholder="email">
        </div>
        <div class="ctrl_input">
            <label style="text-align: right;width: 25%;">Usuario</label>
            <input type="text" class="ctrl_input_t" style="width: 73%;background-color: #EFFAEE" id="div_edit_usu_user" onblur="fn_onblur(this);" placeholder="usuario">
        </div>
        <div class="ctrl_input">
            <label style="text-align: right;width: 25%;">Estado</label>
            <select class="ctrl_input_t" id="div_edit_usu_estado" style="background-color: #EFFAEE">
                <option value="1">HABILITADO</option>
                <option value="0">DESHABILITADO</option>                
            </select>
        </div>                 
    </div>    
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act"  id="div_nuevo_usu_btn_salir" onClick="btn_salir('div_edit_usu');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>    
    <button class="btn_full_act"  id="div_nuevo_usu_btn_edit" onClick="btn_guardar_update_usu();"><img src="public/images/guardar.png" style="width:20px"> Editar Usuario</img></button>
</div>
<!--<div class="ctrl_input"> 
            <label style="text-align: right;width: 25%;">Contraseña Actual</label>
            <input type="password" class="ctrl_input_t" style="width: 73%;background-color: #EFFAEE" id="div_nuevo_usu_c_act" onblur="fn_onblur(this);" placeholder="contraseña actual">
        </div>
        <div class="ctrl_input"> 
            <label style="text-align: right;width: 25%;">Contraseña Nueva</label>
            <input type="password" class="ctrl_input_t" style="width: 73%;background-color: #EFFAEE" id="div_nuevo_usu_c" onblur="fn_onblur(this);" placeholder="contraseña nueva">
        </div>
        <div class="ctrl_input">
            <label style="text-align: right;width: 25%;">Repita Contraseña</label>
            <input type="password" class="ctrl_input_t" style="width: 73%;background-color: #EFFAEE" id="div_nuevo_usu_rep_c" onblur="fn_onblur(this);" placeholder="repita contraseña">
        </div> -->
