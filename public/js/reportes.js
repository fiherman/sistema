ide_trb_rep=0;
function fn_open_pac_rep(){
    $("#div_pac_reporte").dialog({
        autoOpen: false, modal: true, height: 585, width: 880, show: {effect: "fade", duration: 500} 
    }); 
    $("#grid_con_pac_rep").jqGrid("clearGridData", true).trigger("reloadGrid");
    jQuery("#grid_con_pac_rep").jqGrid({
        url: 'pacientes/reportes/get_all_pac_rep',
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'NOMBRE', 'APELLIDOS', 'DIRECCION', 'DNI', 'dis', 'EMAIL', 'REPORTE', 'sex', 'tel', 'mov', 'cla', 'fnac', 'dep', 'seg', 'est','seguro'],
        rowNum: 13, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE PACIENTES', width: '100%', height: '297', align: "center",
        colModel: [
            {name: 'id', index: 'id', width: 60, resizable: true, align: "center"},
            {name: 'nombre', index: 'nombre', width: 210, resizable: true, align: "left"},
            {name: 'apellido', index: 'apellido', width: 210, resizable: true, align: "left"},
            {name: 'direccion', index: 'direccion', width: 210, resizable: true, align: "left"},
            {name: 'dni', index: 'dni', width: 90, resizable: true, align: "center"},
            {name: 'distrito', index: 'distrito', hidden: true},
            {name: 'email', index: 'email',  hidden: true},
            {name: 'Reporte', index: 'Reporte', width: 70, resizable: true, align: "center"},            
            {name: 'sexo', index: 'sexo', hidden: true},
            {name: 'telefono', index: 'telefono', hidden: true},
            {name: 'movistar', index: 'movistar', hidden: true},
            {name: 'claro', index: 'claro', hidden: true},
            {name: 'fec_nac', index: 'fec_nac', hidden: true},
            {name: 'dependiente', index: 'dependiente', hidden: true},
            {name: 'seg_id', index: 'seg_des', hidden: true},
            {name: 'estado', index: 'estado', hidden: true},
            {name: 'seguro', index: 'seguro', hidden: true}
        ],
        rowList: [13, 26, 35],
        pager: '#pager_con_pac_rep',
        onSelectRow: function(Id){
            ide_trb_rep = $("#grid_con_pac_rep").getCell(Id,"id"); 
        }        
    });    
    $("#div_pac_reporte").dialog('open');  
}

function fn_buscar_pac_rep() {
    txtbuscar = $("#txtbuscar_pac_rep").val();
    jQuery("#grid_con_pac_rep").jqGrid('setGridParam', {
        url: "pacientes/reportes/get_buscar_paciente_rep?txtbuscar=" + txtbuscar
    }).trigger('reloadGrid');
}

function btn_rep_trat(Id){ 
    nombre = $.trim($("#grid_con_pac_rep").getCell(Id,"nombre"));  
    apellido = $.trim($("#grid_con_pac_rep").getCell(Id,"apellido")); 
    nom_com=nombre+ ' '+apellido;
    $.ajax({                   
        url: 'pacientes/pacientes/get_num_trat?ide_trb='+Id,
        type: 'GET',
        success: function(data){
            if(data=='no'){
                mensaje_sis('mensaje','EL PACIENTE NO TIENE TRATAMIENTOS','MENSAJE DEL SISTEMA');
                return false; 
            }            
            $("#div_rep_trat_select").empty();
            
            $("#div_pac_rep_seleccionar_trat").dialog({
                autoOpen: false, modal: true, height: 210, width: 600, show: {effect: "fade", duration: 300} 
            }).dialog('open');
            for(i=0;i<=data.length-1;i++){//carga el combo para seleccionar el tratamiento desde la BD
                $('#div_rep_trat_select').append('<option value='+data[i].trat+'>'+'<b>nro: '+data[i].trat+'</b></option>');
            }
            $("#rep_nombre").val(nom_com);
            $("#hiddenrep_nombre").val(Id);
        },
        error:function(data){
            mensaje_sis('mensaje','EL PACIENTE NO TIENE TRATAMIENTOS','MENSAJE DEL SISTEMA');
        }
    });
    
    
}

function ver_rep_resumen_pag(){
    pac_id=$("#hiddenrep_nombre").val();
    trat_num=$("#div_rep_trat_select").val();
    var iframe = $('<div><iframe src="pacientes/reportes/saludo/'+pac_id+'/'+trat_num+'" style="width:100%;height:100%" /></div>');
    crearframe(iframe);
}
function crearframe(iframe)
{
    img="public/images/cargando.gif";
    $.blockUI(
    { message: '<img width=100px src="'+img+'"/><br/>Espere por favor',
      css:{border: 'none', padding: '15px',   backgroundColor: '#000',  'border-radius': '10px',  opacity: .5,   color: '#fff' }
    });
    iframe.dialog(
    {   autoOpen: false, modal: true, title: "Reporte -  Resumen de Pagos", resizable: false, width: '95%', height: 700,
        show: {effect: "blind", duration: 300},
        hide: {effect: "blind", duration: 200},
        close: function (e) {
            $(this).empty();
            $(this).dialog('destroy');
        }
    });
    iframe.dialog('open');
    $('iframe').load(function(){ setTimeout($.unblockUI, 500);}).show();
}
