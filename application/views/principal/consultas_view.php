<!--<style type="text/css">
    
</style>
<script type="text/javascript">
function create_grid_pacientes(){
    
}
function fn_open_pac(){
    $("#div_pac_reg").dialog({
        autoOpen: false, modal: true, height: 560, width: 973, show: {effect: "fade", duration: 800},
        class:'btn_full',
        buttons: [         
            {text: "Actualizar y Mostrar Todo", click: btn_actualizar_mon_suc, id: 'btn_monitor_sucesos'},
            {text: "Salir", click: function() { $(this).dialog("close"); }}
        ]
    }); 
    jQuery("#grid_con_pac").jqGrid({
        url: 'pacientes/pacientes/get_all',
        datatype: 'json', mtype: 'GET',
        colNames: ['Cod.', 'NOMBRE', 'APELLIDOS', 'DIRECCION', 'DNI', 'dis', 'EMAIL', 'EDITAR', 'sex', 'tel', 'mov', 'cla', 'fnac', 'dep', 'seg', 'est'],
        rowNum: 12, sortname: 'id', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE PACIENTES', width: '100%', height: '273', align: "center",
        colModel: [
            {name: 'id', index: 'id', width: 45, resizable: true, align: "center"},
            {name: 'nombre', index: 'nombre', width: 240, resizable: true, align: "left"},
            {name: 'apellido', index: 'apellido', width: 240, resizable: true, align: "left"},
            {name: 'direccion', index: 'direccion', width: 210, resizable: true, align: "left"},
            {name: 'dni', index: 'dni', width: 110, resizable: true, align: "center"},
            {name: 'distrito', index: 'distrito', hidden: true},
            {name: 'email', index: 'email',  hidden: true},
            {name: 'Editar', index: 'Editar', width: 95, resizable: true, align: "center"}, /////
            {name: 'sexo', index: 'sexo', hidden: true},
            {name: 'telefono', index: 'telefono', hidden: true},
            {name: 'movistar', index: 'movistar', hidden: true},
            {name: 'claro', index: 'claro', hidden: true},
            {name: 'fec_nac', index: 'fec_nac', hidden: true},
            {name: 'dependiente', index: 'dependiente', hidden: true},
            {name: 'seg_des', index: 'seg_des', hidden: true},
            {name: 'estado', index: 'estado', hidden: true}

        ],
        rowList: [12, 20, 30],
        pager: '#pager_con_pac',
        onSelectRow: function(Id){
                ide_trb = $("#grid_con_pac").getCell(Id,"ide_trb");  
                $("#btn_rea_con_pac").show();
       }
    });
    $('#grid_con_pac').find('.ui-button').addClass('cancelButton');
    $("#div_pac_reg").dialog('open');
    $("#btn_rea_con_pac").hide();
}
function fn_buscar_pac() {
    txtbuscar = $("#txtbuscar_pac").val();
    jQuery("#grid_con_pac").jqGrid('setGridParam', {
        url: "pacientes/pacientes/get_buscar_paciente?txtbuscar=" + txtbuscar
    }).trigger('reloadGrid');
}
function btn_actualizar_mon_suc(){
    alert('actualia');
}
</script>
<div id="div_pac_reg" style="display: none; font-size: 12px" title="PACIENTES">
    <div class="filtros">
        <p class="spanasis">FILTROS</p><br/>
        <div>
            <div style="margin: -5px 0px -12px 20px">
                Buscar: <input type="text" id="txtbuscar_pac" style="text-transform:uppercase;padding: 3px 10px;width:50%; height: 23px; border-radius: 6px;border: 1px solid #C0CDF6;margin-bottom: 5px;" onkeyup=""/>
                &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn_full" onClick="fn_buscar_pac();">Buscar</button>
            </div>           
        </div>
    </div>
    <div style="margin: 1.5% 1.5% 1%;">
        <table id="grid_con_pac"></table>
        <div id="pager_con_pac"></div>
    </div>  
    <button class="btn_full" id="btn_rea_con_pac" style="margin-left: 80%;position: absolute" onClick="">Buscar</button>
</div>-->