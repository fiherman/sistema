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