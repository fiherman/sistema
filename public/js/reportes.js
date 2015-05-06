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
    window.open("pacientes/reportes/estado_cta/"+pac_id+"/"+trat_num);
//    var iframe = $('<div><iframe src="pacientes/reportes/saludo/'+pac_id+'/'+trat_num+'" style="width:100%;height:100%" /></div>');
//    crearframe(iframe);
}
function crearframe(iframe)
{
    img="public/images/cargando.gif";
    $.blockUI(
    { message: '<img width=100px src="'+img+'"/><br/>Espere por favor',
      css:{border: 'none', padding: '15px',   backgroundColor: '#000',  'border-radius': '10px',  opacity: .5,   color: '#fff' }
    });
    iframe.dialog(
    {   autoOpen: false, modal: true, title: "Reporte -  Resumen de Pagos", resizable: false, width: '95%',height: 650,
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

function ver_rep_ingresos(){
    $("#div_pac_rep_ing").dialog({
        autoOpen: false, modal: true, height: 220, width: 350, show: {effect: "fade", duration: 300} 
    }).dialog('open');
    $("#rep_ing_dia").mask("99/99/9999");
//    $("#rep_ing_fch_fin").mask("99/99/9999");
//    datepiker('rep_ing_dia','-2Y','+2Y');
//    datepiker('rep_ing_fch_fin','-2Y','+2Y');
    $("#rb_mes").attr("checked" , false );
    $("#rb_dia").attr("checked" , false );
    $("#rep_ing_mes").attr('disabled',true);
    $("#rep_ing_dia").attr('disabled',true);
    $("#rep_ing_mes").val("00");
    $("#rep_ing_dia").val("");
}

function rep_ing_filtro(){
    var radio = $('input:radio[name=rb_rep_ing]:checked').val();
    if(radio=="mes"){
        $("#rep_ing_mes").attr('disabled',false);
        $("#rep_ing_dia").attr('disabled',true);
        $("#rep_ing_dia").val("");
    }else{
        $("#rep_ing_mes").attr('disabled',true);
        $("#rep_ing_dia").attr('disabled',false);
        $("#rep_ing_mes").val("00");
    }

}
function ver_rep_ing(){
    var radio = $('input:radio[name=rb_rep_ing]:checked').val();
    if(radio=="mes"){
        
        mes=$("#rep_ing_mes").val();
        if(mes=="00"){
            mostraralertas('informe','* Seleccion un Año','INFORMACION');
        }else{
            window.open("pacientes/reportes/ingresos_mes/"+mes);
        }
        
    }else{
        dia=$("#rep_ing_dia").val();
        if(dia==""){
            mostraralertas('informe','* Introdusca una fecha','INFORMACION');
        }else{
            window.open("pacientes/reportes/ingresos_dia?fch="+dia);
        }
        
    }
    
}

function cons_dia(){
    window.open("pacientes/reportes/consultas_dia");
}

function factura(tip,fch,monto){
    Id=$('#hiddendiv_pac_realizar_pago_factura_ruc').val();
//    fch=$.trim($("#grid_ver_historial_pagos").getCell(pag_id,"pag_fch"));//obtiene la fecha de pago de l grilla historial de pagos
//    monto=$.trim($("#grid_ver_historial_pagos").getCell(pag_id,"pag_monto"));
    fecha=fch.replace('/','-');
    
    if (tip==3){//si es factura
        $.ajax({                   
            url: 'pacientes/pacientes/get_ruc/'+Id,
            type: 'GET',
            success: function(data){//si esta registrado su ruc
                trat_num=$("#div_ver_trat_select").val(); 
                raz_soc=data.ruc_raz_soc;
                ruc_num=data.ruc_num;
                window.open("pacientes/reportes/factura/"+Id+"/"+trat_num+"/"+raz_soc+"/"+ruc_num+"/"+fecha.replace('/','-')+"/"+monto); //crea la factura si ya esta registrado el ruc     

            },
            error:function(data){//si no tiene ruc abre un dialigo para registrarlo        
                $("#div_reg_ruc").dialog({//abre el dialogo para registrar el ruc
                    autoOpen: false, modal: true, height: 370, width: 550, show: {effect: "fade", duration: 300} 
                }).dialog('open');
                pintar_verde_todo();
                limpiar_ctrl_c_u('div_reg_ruc','div_reg_ruc_raz_soc*div_reg_ruc_num_ruc*div_reg_ruc_dir');
                $("#hiddendiv_reg_ruc_nom_pac").val(Id);
                $("#div_reg_ruc_nom_pac").val($("#div_ver_trat_pac").val());
            }
        }); 
    }
        
}

function brn_guardar_ruc(modo){
    pac_id=$("#hiddendiv_reg_ruc_nom_pac").val();
    raz_soc=$("#div_reg_ruc_raz_soc").val();
    num_ruc=$("#div_reg_ruc_num_ruc").val();
    dir=$("#div_reg_ruc_dir").val();
    est=$("#div_reg_ruc_est").val();
    
    
    if (pac_id != "" && raz_soc != "" && num_ruc != "" && dir != "") {

           if(modo=='INSERTAR'){                   
               var datos= pac_id+'*'+raz_soc.toUpperCase()+'*'+num_ruc+'*'+dir.toUpperCase()+'*'+est;
                $.ajax({                   
                    url: 'pacientes/pacientes/insert_ruc?datos='+datos,
                    type: 'GET',
                    success: function(data){
                        if(data=='si'){
                            mensaje_sis('mensaje',' DATOS INSERTADOS CORRECTAMENTE','MENSAJE DEL SISTEMA');
                            shorcut_enter=0;
                            btn_salir('div_reg_ruc');                            
                        }
                    }
                });
            }else if(modo=='EDITAR'){                    
               var datos=pac_id+'*'+nombre.toUpperCase()+'*'+apellidos.toUpperCase()+'*'+direccion.toUpperCase()+'*'+dni+'*'+distrito.toUpperCase()+'*'+sexo.toUpperCase();
                $.ajax({                   
                    url: 'pacientes/pacientes/update_pac?datos='+datos,
                    type: 'GET',
                    success: function(data){
                        if(data=='si'){
                            mensaje_sis('mensaje',' DATOS MODIFICADO CORRECTAMENTE','MENSAJE DEL SISTEMA');
                            btn_salir('div_reg_pac_nuevo');
                            btn_actualizar();
                        }
                    }
                }); 
            }                
            return true;
//            }
//        }
    } else {
        if (nombre == "") { $("#nombre").css({border: "1px solid red"}); }
        if (apellidos == "") { $("#apellidos").css({border: "1px solid red"}); }
        if (direccion == "") { $("#direccion").css({border: "1px solid red"}); }
        if (sexo == "") { $("#sexo").css({border: "1px solid red"}); }
        if (fec_nac == "") { $("#fec_nac").css({border: "1px solid red"}); }

        mostraralertas('informe','* los campos marcados de rojo son requeridos','INFORMACION');
        return false;
        shorcut_enter=1;
    }
}
