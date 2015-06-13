<script src="<?php echo base_url('public/js/reportes.js'); ?>" type="text/javascript" charset="UTF-8"></script> 

<div id="div_pac_reporte" style="display: none; font-size: 12px" title="REPORTES">
    <div class="filtros">
        <p class="spanasis">BUSCAR PACIENTE</p><br/>        
        <div style="margin: -5px 0px -12px 20px">
            Buscar: <input type="text" id="txtbuscar_pac_rep" style="text-transform:uppercase;padding: 3px 10px;width:50%; height: 23px; border-radius: 6px;border: 1px solid #C0CDF6;margin-bottom: 5px;"/>
            &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_full" id="btn_buscar_rep" onClick="fn_buscar_pac_rep();">Buscar</button>            
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_pac_rep"></table>
        <div id="pager_con_pac_rep"></div>
    </div>  
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_salir" onClick="btn_salir('div_pac_reporte');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_ver_rep" onClick="cons_dia();"><img src="public/images/ver_cons.png" style="width:20px">Consultas del D&iacute;a</img></button>
    <button class="btn_full_act" id="btn_ver_rep" onClick="citas_dia();"><img src="public/images/ver_cons.png" style="width:20px">Citas del D&iacute;a</img></button>
    <button class="btn_full_act" id="btn_ver_rep_ing" onClick="ver_rep_ingresos();"><img src="public/images/ingresos.png" style="width:20px">Reporte Ingresos</img></button>

</div>

<!--seleccion tratamiento reporte-->

<div id="div_pac_rep_seleccionar_trat" style="display: none; font-size: 12px" title="SELECCIONAR TRATAMIENTO">
    <div class="filtros">   
        <p class="spanasis">SELECCIONE EL TRATAMIENTO PARA REALIZAR EL REPORTE DE PAGOS</p><br/>   
        <div style="margin: 0px 0px -5px 22px;">
           <label>Paciente</label>
           <input type="hidden" id="hiddenrep_nombre" />
           <input type="text" class="ctrl_input_t" style="width: 56%;background-color: #EFFAEE" id="rep_nombre" disabled="">             
           <label style="width:14%">Tratamiento</label>            
           <select class="ctrl_input_t" id="div_rep_trat_select" onchange="select_ver_trat(this.value);" style="background-color: #EFFAEE;width: 13.7%">

           </select> 
        </div>
    </div>    
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="btn_salir_rep" onClick="btn_salir('div_pac_rep_seleccionar_trat');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="btn_ver_rep" onClick="ver_rep_resumen_pag();"><img src="public/images/reporte.png" style="width:20px">Reporte Resumen de Pagos</img></button>
</div>

<!--reporte de igresos-->
<div id="div_pac_rep_ing" style="display: none; font-size: 12px" title="REPORTE INGRESOS">
    <div class="filtros">
        <p class="spanasis">FILTROS</p><br/>        
<!--        <label style="margin-left: 13%;">Fecha Inicial</label>
        <input type="input" class="ctrl_input_t" style="width: 19%;background-color: #EFFAEE"  id="rep_ing_fch_ini"  onblur="fn_onblur(this);"   maxlength="10" placeholder="fecha inicial">              
        <label>Fecha Final</label>
        <input type="input" class="ctrl_input_t" style="width: 19%;background-color: #EFFAEE"  id="rep_ing_fch_fin"  onblur="fn_onblur(this);"   maxlength="10" placeholder="fecha final"> <br>-->
        <div style="margin: -6px 0px -5px 14%;">
            <label><input type="radio" name="rb_rep_ing" id="rb_mes" value="mes" onclick="rep_ing_filtro();">MENSUAL</label>
            <select id="rep_ing_mes" style="margin-left: 7%;border: 1px solid #7dce73">
                <option value="00">--Seleccione--</option>
                <option value="01">ENERO</option>
                <option value="02">FEBRERO</option>
                <option value="03">MARZO</option>
                <option value="04">ABRIL</option>
                <option value="05">MAYO</option>
                <option value="06">JUNIO</option>
                <option value="07">JULIO</option>
                <option value="08">AGOSTO</option>
                <option value="09">SEPTIEMBRE</option>
                <option value="10">OCTUBRE</option>
                <option value="11">NOVIEMBRE</option>
                <option value="12">DICIEMBRE</option>
            </select>
            
            <br>
            <label><input type="radio" name="rb_rep_ing" id="rb_dia" value="dia" onclick="rep_ing_filtro();">DIARIO</label>
            <input type="input" style="margin-left: 11%; width: 34%; height: 20px;"  id="rep_ing_dia"  maxlength="10">
        </div>
        
    </div>
   
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="rep_ing_btn_salir" onClick="btn_salir('div_pac_rep_ing');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="rep_ing_btn_gen_rep" onClick="ver_rep_ing();"><img src="public/images/ver_cons.png" style="width:20px">Generar Reporte de Ingresos</img></button>    

</div>


<!--reporte de evoluciones-->
<div id="div_citas_evolucion" style="display: none; font-size: 12px" title="CITAS PENDIENTES">
    <div class="filtros">
        <p class="spanasis">FILTROS</p><br/>        

        <div style="margin: -6px 0px -5px 14%;">
            <label class="ctrl_lavel_0">DIA</label>
            <input type="input" style="margin-left: 11%; width: 34%; height: 20px;"  id="div_citas_evolucion_fch"  maxlength="10">
        </div>
        
    </div>
   
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="rep_ing_btn_salir" onClick="btn_salir('div_citas_evolucion');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="rep_ing_btn_gen_rep" onClick="ver_citas_evolucion();"><img src="public/images/ver_cons.png" style="width:20px">Ver Citas</img></button>    

</div>

