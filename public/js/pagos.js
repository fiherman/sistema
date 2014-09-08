
function btn_pago_pac() {
//    pac_id=$("#hiddendiv_ver_trat_pac").val();
    saldo = $("#div_ver_trat_saldo").val();

    if (saldo == 0.00) {
        mensaje_sis('mensaje', ' EL TRATAMIENTO YA ESTA CANCELADO', 'MENSAJE DEL SISTEMA');
    } else {
        pac = $("#div_ver_trat_pac").val();

        trat = $("#div_ver_trat_select").val();

        $("#div_pac_realizar_pago").dialog({
            autoOpen: false, modal: true, height: 430, width: 750, show: {effect: "fade", duration: 500}, close: function() {
            }
        }).dialog('open');
        limpiar_ctrl('div_pac_realizar_pago');
        $("#div_pac_rea_pago_fch").mask("99/99/9999");//para autocompletar la fecha
        datepiker('div_pac_rea_pago_fch', '-1Y', '+1Y');
        $("#hiddendiv_pac_realizar_pago").val($("#hiddendiv_ver_trat_pac").val());
        $("#div_realizar_pago_pac").val(pac);
        $("#div_realizar_pago_trat_num").val(trat);
        $("#div_realizar_pago_cos_tot").val($("#div_ver_trat_ttotal").val());
        $("#div_realizar_pago_dscto").val($("#div_ver_trat_dscto").val());
        $("#div_realizar_pago_tot_pago").val($("#div_ver_trat_tot_pag").val());
        $("#div_realizar_pago_pagado").val($("#div_ver_trat_pagado").val());
        $("#div_realizar_pago_saldo").val($("#div_ver_trat_saldo").val());
        pintar_verde_todo();
    }


}

function btn_guardar_pago() {
    pac_id = $.trim($("#hiddendiv_pac_realizar_pago").val());
    trat_num = $.trim($("#div_realizar_pago_trat_num").val());
    codigo = $.trim($("#div_pac_rea_pago_num_fac_bol").val());
    monto = $.trim($("#div_pac_rea_pago_cos").val());
    fch = $.trim($("#div_pac_rea_pago_fch").val());
    forma_pag = $.trim($("#div_pac_rea_pago_for_pago").val());
    doc_fac = $.trim($("#div_pac_rea_pago_doc_fac").val());
    obs = $.trim($("#div_pac_rea_pago_obs").val());
    usuario = $.trim($("#hiddendiv_usuario").val());
    if (pac_id != "" && trat_num != "" && codigo != "" && monto != "" && fch != "" && usuario != "") {
        datos = pac_id + '*' + trat_num + '*' + codigo + '*' + monto + '*' + fch + '*' + forma_pag + '*' + doc_fac + '*' + obs + '*' + usuario;
        $.ajax({
            url: 'pacientes/Pago/insert_pago_paciente?datos=' + datos,
            type: 'GET',
            success: function(data) {
                if (data == 'si') {
                    mensaje_sis('mensaje', ' PAGO REALIZADO CON EXITO', 'MENSAJE DEL SISTEMA');
                    btn_salir('div_pac_realizar_pago');
                    trat_saldo(pac_id, trat_num,0);
                } else {
                    mensaje_sis('mensaje', ' ERROR AL REALIZAR EL PAGO', 'MENSAJE DEL SISTEMA');
                }
            }
        });
    } else {
        if (monto == "") {
            $("#div_pac_rea_pago_cos").css({border: "1px solid red"});
        }
        if (fch == "") {
            $("#div_pac_rea_pago_fch").css({border: "1px solid red"});
        }
        if (codigo == "") {
            $("#div_pac_rea_pago_num_fac_bol").css({border: "1px solid red"});
        }
        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////

function trat_saldo(Id, trat_num, flag) {

//    pac_id=$("#hiddendiv_ver_trat_pac").val();
//    trat_num=$("#div_ver_trat_select").val();
//    cos_total=$("#div_ver_trat_ttotal").val();
    datos = Id + '*' + trat_num;
    $.ajax({
        url: 'pacientes/Pago/get_saldo?datos=' + datos,
        type: 'GET',
        success: function(data) {
            $("#div_ver_trat_ttotal").val(data[0].ttotal);
            $("#div_ver_trat_dscto").val(data[0].dscto);
            $("#div_ver_trat_tot_pag").val(data[0].pago_total);
            $("#div_ver_trat_pagado").val(data[0].pagado);
            $("#div_ver_trat_saldo").val(data[0].saldo);
            if (flag===1){
                $("#div_historial_pagos_saldo").val("S/. " + formato_numero(data[0].saldo,2,'.','.'));
            }
        },
        error: function(data) {
            mensaje_sis('mensaje', ' no se puede calcular el saldo', 'MENSAJE DEL SISTEMA');
        }
    });
}

//////////////////HISTORIAL DE PAGOS //////////////////////////////////////////////////////////////////////
cargar_his_pagos=0;
function open_historial_pagos() {
    Id = $("#hiddendiv_ver_trat_pac").val();
    saldo= $("#div_ver_trat_saldo").val();
    nom_pac = $("#div_ver_trat_pac").val();
    $.ajax({
        url: 'pacientes/pacientes/get_num_trat?ide_trb=' + Id,
        type: 'GET',
        success: function(data) {
            if (data == 0) {
                mensaje_sis('mensaje', 'EL PACIENTE NO REALIZO NINGUN PAGO', 'MENSAJE DEL SISTEMA');
                return false;
            }
            $("#div_historial_pagos_select").empty();

            $("#div_historial_pagos").dialog({
                autoOpen: false, modal: true, height: 510, width: 810, show: {effect: "fade", duration: 500}, close: function(event,ui) {
                    $("#grid_ver_historial_pagos").jqGrid("clearGridData", true).trigger("reloadGrid");
                }
            }).dialog('open');

            for (i = 1; i <= data; i++) {//carga el combo para seleccionar el tratamiento desde la BD
                $('#div_historial_pagos_select').append('<option value=' + i + '>' + '<b>nro: ' + i + '</b></option>');
            }
            $("#div_historial_pagos_nom_pac").val(nom_pac);
            $("#hiddendiv_historial_pagos_nom_pac").val(Id);
            $("#div_historial_pagos_saldo").val("S/. " + formato_numero(saldo,2,'.','.'));
            
            if (cargar_his_pagos===0){
                cargar_his_pagos=1;
                ver_grid_historial_pagos(Id,$('#div_historial_pagos_select').val());///CARGA GRID PO PRIMERA VEZ
            }
            else{
                select_ver_historial_pagos($('#div_historial_pagos_select').val());
            }
//            
            
        },
        error: function(data) {
            alert('error');
        }
    });
}
function ver_grid_historial_pagos(Id, h_p_trat_num) {

    jQuery("#grid_ver_historial_pagos").jqGrid({
        url: 'pacientes/pago/get_historial_pagos?pac_id=' + Id + '&trat_num=' + h_p_trat_num,
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'MONTO', 'FECH. PAGO', 'DOCUMENTO','Nº DOCUMENTO' ,'OBSERVACION'],
        rowNum: 10, sortname: 'pag_id', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE PAGOS', width: '100%', height: '265', align: "center",
        colModel: [
            {name: 'pag_id', index: 'pag_id', width: 70, resizable: true, align: "left"},
            {name: 'pag_monto', index: 'pag_monto', width: 100, resizable: true, align: "right"},
            {name: 'pag_fch', index: 'pag_fch', width: 100, resizable: true, align: "left"},
            {name: 'documento', index: 'documento', width: 100, resizable: true, align: "left"},
            {name: 'pag_codigo', index: 'pag_codigo', width: 117, resizable: true, align: "left"},
            {name: 'pag_obs', index: 'pag_obs', width: 295, resizable: true, align: "left"}
        ],
        rowList: [10, 25]
    });
    
}
function select_ver_historial_pagos(cbo_trat) {
    Id = $("#hiddendiv_historial_pagos_nom_pac").val();
    trat_saldo(Id,cbo_trat,1);

    jQuery("#grid_ver_historial_pagos").jqGrid('setGridParam', {
        url: 'pacientes/pago/get_historial_pagos?pac_id=' + Id + '&trat_num=' + cbo_trat
    }).trigger('reloadGrid');


//    limpiar_ctrl_c_u('div_historial_pagos','txt_ver_trat_subtot*txt_ver_trat_dscto*txt_ver_trat_tot');

//    get_dscto_all(ver_trat_pac_id,cbo_trat,0);
//    trat_saldo(ver_trat_pac_id,$('#div_ver_trat_select').val());
}

