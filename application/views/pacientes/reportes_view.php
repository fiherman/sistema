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
    <button class="btn_full_act" id="btn_ver_rep" onClick="ver_rep_cons_dia();"><img src="public/images/ver_cons.png" style="width:20px">Consultas del D&iacute;a</img></button>
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
        <p class="spanasis">RANGO DE FECHA</p><br/>        
        <label style="margin-left: 13%;">Fecha Inicial</label>
        <input type="input" class="ctrl_input_t" style="width: 19%;background-color: #EFFAEE"  id="rep_ing_fch_ini"  onblur="fn_onblur(this);"   maxlength="10" placeholder="fecha inicial">              
        <label>Fecha Final</label>
        <input type="input" class="ctrl_input_t" style="width: 19%;background-color: #EFFAEE"  id="rep_ing_fch_fin"  onblur="fn_onblur(this);"   maxlength="10" placeholder="fecha final"> <br>
<!--        <input type="checkbox" name="vehicle" value="sol">Soles 
        <input type="checkbox" name="vehicle" value="dol">Dolares
        <input type="checkbox" name="vehicle" value="vou">Voucher-->
    </div>
   
    <hr style="background-color: #418BC3; height: 1px; border: 0;">
    <button class="btn_full_act" id="rep_ing_btn_salir" onClick="btn_salir('div_pac_rep_ing');"><img src="public/images/salir.png" style="width:20px">Salir</img></button>
    <button class="btn_full_act" id="rep_ing_btn_gen_rep" onClick="ver_rep_ing();"><img src="public/images/ver_cons.png" style="width:20px">Generar Reporte de Ingresos</img></button>    

</div>