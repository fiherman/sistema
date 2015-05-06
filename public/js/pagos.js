
function btn_pago_pac(tip,documento) {
//    pac_id=$("#hiddendiv_ver_trat_pac").val();
    saldo = $("#div_ver_trat_saldo").val();
    
    if(tip=='s' && (documento=='1' || documento=='2')){
        
        if (saldo == 0.00) {
            mensaje_sis('mensaje', ' EL PAGO EN SOLES ESTA CANCELADO', 'MENSAJE DEL SISTEMA');
        } else {
            pac = $("#div_ver_trat_pac").val();
            trat = $("#div_ver_trat_select").val();

            $("#div_pac_realizar_pago").dialog({
                autoOpen: false, modal: true, height: 430, width: 750, show: {effect: "fade", duration: 500}, close: function() {
                }
            }).dialog('open');
            
            limpiar_ctrl('div_pac_realizar_pago');
            $("#div_pac_rea_pago_fch").mask("99/99/9999");//para autocompletar la fecha
            //datepiker('div_pac_rea_pago_fch', '-1Y', '+1Y');
            $("#hiddendiv_pac_realizar_pago").val($("#hiddendiv_ver_trat_pac").val());
            $("#div_realizar_pago_pac").val(pac);
            $("#div_realizar_pago_trat_num").val(trat);
            $("#div_realizar_pago_cos_tot").val($("#div_ver_trat_ttotal").val());
            $("#div_realizar_pago_dscto").val($("#div_ver_trat_dscto").val());
            $("#div_realizar_pago_tot_pago").val($("#div_ver_trat_tot_pag").val());
            $("#div_realizar_pago_pagado").val($("#div_ver_trat_pagado").val());
            $("#div_realizar_pago_saldo").val($("#div_ver_trat_saldo").val());
//            $("#div_realizar_pago_saldo").val(formato_numero(parseFloat($("#div_ver_trat_saldo").val()),2,'.',','));    
            pintar_verde_todo();
        }
    }else if(tip=='s' && documento=='3'){//dialogo para realizar el pago con factura
        
        if (saldo == 0.00) {
            mensaje_sis('mensaje', ' EL PAGO EN SOLES ESTA CANCELADO', 'MENSAJE DEL SISTEMA');
        } else {
            pac = $("#div_ver_trat_pac").val();
            trat = $("#div_ver_trat_select").val();
            
            $("#div_pac_realizar_pago_factura").dialog({
                autoOpen: false, modal: true, height: 445, width: 750, show: {effect: "fade", duration: 500}, close: function() {
                }
            }).dialog('open');
            
            limpiar_ctrl('div_pac_realizar_pago_factura');
            $("#div_pac_realizar_pago_factura_fch").mask("99/99/9999");//para autocompletar la fecha
            
            $.ajax({
                url: 'pacientes/Pago/get_serie_factura',
                type: 'GET',
                success: function(data) {                    
                    $("#div_pac_realizar_pago_factura_serie").val(data.serie_nueva);
                },
                error: function(data){
                    mensaje_sis('mensaje', ' ERROR  DE SERIE DE FACTURA', 'MENSAJE DEL SISTEMA');
                }
            });
            $("#hiddendiv_pac_realizar_pago_fac").val($("#hiddendiv_ver_trat_pac").val());
            $("#div_realizar_pago_pac_fac").val(pac);
            $("#div_realizar_pago_trat_num_fac").val(trat);
            $("#div_realizar_pago_cos_tot_fac").val($("#div_ver_trat_ttotal").val());
            $("#div_realizar_pago_dscto_fac").val($("#div_ver_trat_dscto").val());
            $("#div_realizar_pago_tot_pago_fac").val($("#div_ver_trat_tot_pag").val());
            $("#div_realizar_pago_pagado_fac").val($("#div_ver_trat_pagado").val());
            $("#div_realizar_pago_saldo_fac").val($("#div_ver_trat_saldo").val());  
            pintar_verde_todo();
            var f = new Date();
            $("#div_pac_realizar_pago_factura_fch").val(("0" + f.getDate()).slice(-2) + "/" + ("0" + (f.getMonth() + 1)).slice(-2) + "/" + f.getFullYear());
            llenararajaxtodo_ruc('div_pac_realizar_pago_factura_ruc','pacientes/pacientes/listartodo_ruc',0); 
        }
    }
    
    
    if(tip=='d'){
        saldo = $("#div_ver_trat_saldo_dol").val();

        if (saldo == 0.00) {
            mensaje_sis('mensaje', ' EL PAGO EN DOLARES ESTA CANCELADO', 'MENSAJE DEL SISTEMA');
        } else {
            pac = $("#div_ver_trat_pac").val();
            trat = $("#div_ver_trat_select").val();

            $("#div_pac_realizar_pago_dol").dialog({
                autoOpen: false, modal: true, height: 430, width: 750, show: {effect: "fade", duration: 500}, close: function() {
                }
            }).dialog('open');
            limpiar_ctrl('div_pac_realizar_pago_dol');
            $("#div_pac_rea_pago_dol_fch").mask("99/99/9999");//para autocompletar la fecha
            //datepiker('div_pac_rea_pago_dol_fch', '-1Y', '+1Y');
            $("#hiddendiv_pac_realizar_pago_dol").val($("#hiddendiv_ver_trat_pac").val());
            $("#div_realizar_pago_pac_dol").val(pac);
            $("#div_realizar_pago_trat_num_dol").val(trat);
            $("#div_realizar_pago_cos_tot_dol").val($("#div_ver_trat_ttotal_dol").val());
            $("#div_realizar_pago_dscto_dol").val($("#div_ver_trat_dscto_dol").val());
            $("#div_realizar_pago_tot_pago_dol").val($("#div_ver_trat_tot_pag_dol").val());
            $("#div_realizar_pago_pagado_dol").val($("#div_ver_trat_pagado_dol").val());
            $("#div_realizar_pago_saldo_dol").val($("#div_ver_trat_saldo_dol").val());
            
            pintar_verde_todo();
        }
    }
    
}

function btn_guardar_pago(tip) {
    
    if(tip=='factura'){//soles - factura
        pac_id = $.trim($("#hiddendiv_pac_realizar_pago_fac").val());
        trat_num = $.trim($("#div_realizar_pago_trat_num_fac").val());
        num_factura = $.trim($("#div_pac_realizar_pago_factura_serie").val());
        monto = $.trim($("#div_pac_realizar_pago_factura_monto").val());
        fch = $.trim($("#div_pac_realizar_pago_factura_fch").val());
        forma_pag=1;
        doc_fac = 3;
        obs = $.trim($("#div_pac_realizar_pago_factura_obs").val());
        usuario = $.trim($("#hiddendiv_usuario_fac").val());
        ruc=$.trim($("#div_pac_realizar_pago_factura_ruc").val());
        if (pac_id != "" && trat_num != "" && num_factura != "" && monto != "" && fch != "" && usuario != "" && ruc != "") {
            datos = pac_id+'*'+trat_num+'*'+num_factura+'*'+monto+'*'+fch+'*'+forma_pag+'*'+doc_fac+'*'+obs+'*'+usuario+'*'+ruc;
            $.ajax({
                url: 'pacientes/Pago/insert_pago_paciente_factura?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {                                              
                        trat_saldo(pac_id, trat_num,0);
                        btn_salir('div_pac_realizar_pago_factura');
                        factura(doc_fac,fch,monto);//realiza la factura
                        mensaje_sis('mensaje', ' PAGO REALIZADO CON EXITO', 'MENSAJE DEL SISTEMA');  
                    } else {
                        mensaje_sis('mensaje', ' ERROR AL REALIZAR EL PAGO', 'MENSAJE DEL SISTEMA');
                    }
                },
                error: function(data){
                    mensaje_sis('mensaje', ' ERROR AL REALIZAR EL PAGO 2', 'MENSAJE DEL SISTEMA');
                }
            });
        } else {
            if (monto == "") {
                $("#div_pac_realizar_pago_factura_monto").css({border: "1px solid red"});
            }
            if (fch == "") {
                $("#div_pac_realizar_pago_factura_fch").css({border: "1px solid red"});
            }
            if (ruc == "") {
                $("#div_pac_realizar_pago_factura_ruc").css({border: "1px solid red"});
            }
            mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
            return false;
        }
    }
    
//    if(tip==0){//soles
//        pac_id = $.trim($("#hiddendiv_pac_realizar_pago").val());
//        trat_num = $.trim($("#div_realizar_pago_trat_num").val());
//        codigo = $.trim($("#div_pac_rea_pago_num_fac_bol").val());
//        monto = $.trim($("#div_pac_rea_pago_cos").val());
//        fch = $.trim($("#div_pac_rea_pago_fch").val());
//        forma_pag = $.trim($("#div_pac_rea_pago_for_pago").val());
//        doc_fac = $.trim($("#div_pac_rea_pago_doc_fac").val());
//        obs = $.trim($("#div_pac_rea_pago_obs").val());
//        usuario = $.trim($("#hiddendiv_usuario").val());
//        if (pac_id != "" && trat_num != "" && codigo != "" && monto != "" && fch != "" && usuario != "") {
//            datos = pac_id + '*' + trat_num + '*' + codigo + '*' + monto + '*' + fch + '*' + forma_pag + '*' + doc_fac + '*' + obs + '*' + usuario;
//            $.ajax({
//                url: 'pacientes/Pago/insert_pago_paciente?datos=' + datos,
//                type: 'GET',
//                success: function(data) {
//                    if (data == 'si') {
//                        mensaje_sis('mensaje', ' PAGO REALIZADO CON EXITO', 'MENSAJE DEL SISTEMA');
//                        btn_salir('div_pac_realizar_pago');
//                        trat_saldo(pac_id, trat_num,0);                        
//                    } else {
//                        mensaje_sis('mensaje', ' ERROR AL REALIZAR EL PAGO', 'MENSAJE DEL SISTEMA');
//                    }
//                }
//            });
//        } else {
//            if (monto == "") {
//                $("#div_pac_rea_pago_cos").css({border: "1px solid red"});
//            }
//            if (fch == "") {
//                $("#div_pac_rea_pago_fch").css({border: "1px solid red"});
//            }
//            if (codigo == "") {
//                $("#div_pac_rea_pago_num_fac_bol").css({border: "1px solid red"});
//            }
//            mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
//            return false;
//        }
//    }
//    else{
//        pac_id = $.trim($("#hiddendiv_pac_realizar_pago_dol").val());
//        trat_num = $.trim($("#div_realizar_pago_trat_num_dol").val());
//        codigo = $.trim($("#div_pac_rea_pago_dol_num_fac_bol").val());
//        monto = $.trim($("#div_pac_rea_pago_dol_cos").val());
//        fch = $.trim($("#div_pac_rea_pago_dol_fch").val());
//        forma_pag = $.trim($("#div_pac_rea_pago_dol_for_pago").val());
//        doc_fac = $.trim($("#div_pac_rea_pago_dol_fac").val());
//        obs = $.trim($("#div_pac_rea_pago_dol_obs").val());
//        usuario = $.trim($("#hiddendiv_usuario_dol").val());
//        if (pac_id != "" && trat_num != "" && codigo != "" && monto != "" && fch != "" && usuario != "") {
//            datos = pac_id + '*' + trat_num + '*' + codigo + '*' + monto + '*' + fch + '*' + forma_pag + '*' + doc_fac + '*' + obs + '*' + usuario;
//            $.ajax({
//                url: 'pacientes/Pago/insert_pago_dol_paciente?datos=' + datos,
//                type: 'GET',
//                success: function(data) {
//                    if (data == 'si') {
//                        mensaje_sis('mensaje', ' PAGO REALIZADO CON EXITO', 'MENSAJE DEL SISTEMA');
//                        btn_salir('div_pac_realizar_pago_dol');
//                        trat_saldo(pac_id, trat_num,0);
//                    } else {
//                        mensaje_sis('mensaje', ' ERROR AL REALIZAR EL PAGO', 'MENSAJE DEL SISTEMA');
//                    }
//                }
//            });
//        } else {
//            if (monto == "") {
//                $("#div_pac_rea_pago_dol_cos").css({border: "1px solid red"});
//            }
//            if (fch == "") {
//                $("#div_pac_rea_pago_dol_fch").css({border: "1px solid red"});
//            }
//            if (codigo == "") {
//                $("#div_pac_rea_pago_dol_num_fac_bol").css({border: "1px solid red"});
//            }
//            mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
//            return false;
//        }
//    }    
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
            //alert(data[0].ttotal);
            if (flag===1){
                var a1 = data[0].saldo;
                var b1 = parseFloat(a1.replace(',',''));
                
                var a2 = data[1].saldo;
                var b2 = parseFloat(a2.replace(',',''));
                
                $("#div_historial_pagos_saldo").val("S/. " + formato_numero(b1,2,'.','.'));
                $("#div_historial_pagos_saldo_dol").val("$. " + formato_numero(b2,2,'.','.'));
            }else{
                $("#div_ver_trat_ttotal").val(data[0].ttotal);
                $("#div_ver_trat_dscto").val(data[0].dscto);
                $("#div_ver_trat_tot_pag").val(data[0].pago_total);
                $("#div_ver_trat_pagado").val(data[0].pagado);
                $("#div_ver_trat_saldo").val(data[0].saldo);
                ////////dolares
                $("#div_ver_trat_ttotal_dol").val(data[1].ttotal);
                $("#div_ver_trat_dscto_dol").val(data[1].dscto);
                $("#div_ver_trat_tot_pag_dol").val(data[1].pago_total);
                $("#div_ver_trat_pagado_dol").val(data[1].pagado);
                $("#div_ver_trat_saldo_dol").val(data[1].saldo); 
            }
        },
        error: function(data) {
            mensaje_sis('mensaje', ' no se puede calcular el saldo', 'MENSAJE DEL SISTEMA');
        }
    });
}

function del_trat(){//boton eliminar .. muestra el mensaje antes de eliminar todo el tratamiento
    pac_id=$("#hiddendiv_ver_trat_pac").val();
    trat_num=$("#div_ver_trat_select").val();
    
    mensaje_eliminar_trat('eliminar', '* Esta seguro de eliminar el tratamiento<br>* Los cambios no se podran revertir', 'ELIMINAR TRATAMIENTO',pac_id,trat_num);
}
function del_trat_unidad(trat_id,sol,dol){//boton eliminar .. muestra el mensaje antes de eliminar el tratamiento seleccionado
    
    var a = $("#div_ver_trat_saldo").val();        
    var b = a.replace(',','');
    saldo=parseFloat(b);
    soles=parseFloat(sol).toFixed(2);
    //alert(soles+'--'+saldo);
    if(soles<=saldo){
        mensaje_eliminar_trat_unidad('eliminar', '* Esta seguro de eliminar este tratamiento', 'ELIMINAR TRATAMIENTO',trat_id);
    }else{
        mostraralertas('informe','*No se puede Eliminar<br>* El costo del tratamiento es mayor al saldo','INFORMACION');
    }
    
}

function open_elegir_moneda(){
    $("#div_elegir_moneda").dialog({
        autoOpen: false, modal: true, height: 240, width: 440, show: {effect: "fade", duration: 500},close: function(event, ui) {         
            
        }
    }).dialog('open');
}
function moneda(){    
    mon=$("#div_elegir_moneda_mon").val();
    documento=$("#div_elegir_moneda_doc_fac").val();
    
    if (mon==0){
        btn_pago_pac('s',documento);
    }else{
        btn_pago_pac('d',documento);
    }
    btn_salir('div_elegir_moneda');
}

function eliminar_tratatamiento(pac_id,trat_num){
    
    $.ajax({
        url: 'pacientes/Pago/eliminar_tratamiento?pac_id=' + pac_id+'&trat_num='+trat_num,
        type: 'GET',
        success: function(date) {
            if (date == 'si') {
                mensaje_sis('mensaje', ' TRATAMIENTO ELIMINADO', 'MENSAJE DEL SISTEMA');  
                $.ajax({                   
                    url: 'pacientes/pacientes/get_num_trat?ide_trb='+pac_id,
                    type: 'GET',
                    success: function(data){
                        if(data==0){
                            mensaje_sis('mensaje','EL PACIENTE NO TIENE TRATAMIENTOS','MENSAJE DEL SISTEMA');
                            return false; 
                        }else{
                            $("#div_ver_trat_select").empty();
                        
                            for(i=0;i<=data.length-1;i++){//carga el combo para seleccionar el tratamiento desde la BD
                                $('#div_ver_trat_select').append('<option value='+data[i].trat+'>'+'<b>nro: '+data[i].trat+'</b></option>');
                            }
                            if(trat_global==0){//carga por primera ves el grid
                                trat_global=1;                
                                grid_ver_tratamiento(pac_id,data[0].trat); 
                                trat_saldo(pac_id,$('#div_ver_trat_select').val());
                            }else if(trat_global==1){//solo actualiza el grid 
                                select_ver_trat(data[0].trat);                 
                            }
                        }
                    },
                    error:function(data){
                        alert('error');
                    }
                }); 
                
            } else {
                mensaje_sis('mensaje', ' ERROR AL ELIMINAR EL TRATAMIENTO', 'MENSAJE DEL SISTEMA');
            }
        }
    });
    
}
//////////////////HISTORIAL DE PAGOS //////////////////////////////////////////////////////////////////////
cargar_his_pagos=0;
function open_historial_pagos() {
    Id = $("#hiddendiv_ver_trat_pac").val();
    trat_num=$("#div_ver_trat_select").val();
    saldo= $("#div_ver_trat_saldo").val();
    saldo_dol= $("#div_ver_trat_saldo_dol").val();
    
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

            $("#div_historial_pagos").dialog({///abre el dialigo de historial de pagos
                autoOpen: false, modal: true, height: 600, width: 820, show: {effect: "fade", duration: 500}, close: function(event,ui) {
                    $("#grid_ver_historial_pagos").jqGrid("clearGridData", true);
                    $("#grid_ver_historial_pagos_dol").jqGrid("clearGridData", true);
//                    cargar_his_pagos=0;
                }
            }).dialog('open');

            for (i = 0; i <= data.length-1; i++) {//carga el combo para seleccionar el tratamiento desde la BD
                $('#div_historial_pagos_select').append('<option value=' + data[i].trat + '>' + '<b>nro: ' + data[i].trat + '</b></option>');
            }
            $("#div_historial_pagos_nom_pac").val(nom_pac);
            $("#hiddendiv_historial_pagos_nom_pac").val(Id);
            $("#div_historial_pagos_saldo").val("S/. " + saldo);//saldo soles
            $("#div_historial_pagos_saldo_dol").val("S/. " + saldo_dol);//saldo dolares
            
            
            if (cargar_his_pagos==0){
                cargar_his_pagos=1;                
                ver_grid_historial_pagos(Id,trat_num);///CARGA GRID PO PRIMERA VEZ
                $("#div_historial_pagos_select").val(trat_num);
            }
            else{
                select_ver_historial_pagos($('#div_historial_pagos_select').val());
            } 
            
        },
        error: function(data) {
            alert('error');
        }
    });
}
function ver_grid_historial_pagos(Id, h_p_trat_num) {
    /////GRID SOLES///////////////////////////////////////////
    jQuery("#grid_ver_historial_pagos").jqGrid({
        url: 'pacientes/pago/get_historial_pagos?pac_id=' + Id + '&trat_num=' + h_p_trat_num,
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'MONTO', 'FECH. PAGO', 'DOCUMENTO','Nº DOCUMENTO' ,'OBSERVACION','impr','tipo'],
        rowNum: 10, sortname: 'pag_id', sortorder: 'desc', viewrecords: true, caption: 'PAGOS EN SOLES', width: '100%', height: '135', align: "center",
        colModel: [
            {name: 'pag_id', index: 'pag_id', width: 70, resizable: true, align: "center"},
            {name: 'pag_monto', index: 'pag_monto', width: 80, resizable: true, align: "right"},
            {name: 'pag_fch', index: 'pag_fch', width: 90, resizable: true, align: "center"},
            {name: 'documento', index: 'documento', width: 95, resizable: true, align: "center"},
            {name: 'pag_codigo', index: 'pag_codigo', width: 117, resizable: true, align: "left"},
            {name: 'pag_obs', index: 'pag_obs', width: 230, resizable: true, align: "left"},
            {name: 'genera', index: 'genera', width: 100, resizable: true, align: "center"},
            {name: 'pag_dog_fac', index: 'pag_dog_fac', hidden: true}
        ],
        rowList: [9, 25],
        pager: '#grid_ver_historial_pagos_pager'        
    });
    ///////////////////GRID   DOLARES ///////////////////////////////////////////////
    jQuery("#grid_ver_historial_pagos_dol").jqGrid({
        url: 'pacientes/pago/get_historial_pagos_dol?pac_id=' + Id + '&trat_num=' + h_p_trat_num,
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'MONTO', 'FECH. PAGO', 'DOCUMENTO','Nº DOCUMENTO' ,'OBSERVACION'],
        rowNum: 10, sortname: 'pag_id', sortorder: 'desc', viewrecords: true, caption: 'PAGOS EN DOLARES', width: '100%', height: '100', align: "center",
        colModel: [
            {name: 'pag_id', index: 'pag_id', width: 70, resizable: true, align: "left"},
            {name: 'pag_monto', index: 'pag_monto', width: 100, resizable: true, align: "right"},
            {name: 'pag_fch', index: 'pag_fch', width: 100, resizable: true, align: "left"},
            {name: 'documento', index: 'documento', width: 100, resizable: true, align: "left"},
            {name: 'pag_codigo', index: 'pag_codigo', width: 117, resizable: true, align: "left"},
            {name: 'pag_obs', index: 'pag_obs', width: 295, resizable: true, align: "left"}
        ],
        rowList: [9, 25],
        pager: '#grid_ver_historial_pagos_dol_pager'
//        hiddengrid: true// inicia el grid en hide
    });
    
//    $("#grid_ver_historial_pagos").jqGrid('setGridState', 'hidden');
//    $(".ui-jqgrid-titlebar-close",$("list")[0].grid.cDiv).click();
//        $("#grid_ver_historial_pagos").jqGrid("GridUnload"); //oculta toda la grilla    
}
function select_ver_historial_pagos(cbo_trat) {
    Id = $("#hiddendiv_historial_pagos_nom_pac").val();
    trat_saldo(Id,cbo_trat,1);

    jQuery("#grid_ver_historial_pagos").jqGrid('setGridParam', {
        url: 'pacientes/pago/get_historial_pagos?pac_id=' + Id + '&trat_num=' + cbo_trat
    }).trigger('reloadGrid');
    
    jQuery("#grid_ver_historial_pagos_dol").jqGrid('setGridParam', {
        url: 'pacientes/pago/get_historial_pagos_dol?pac_id=' + Id + '&trat_num=' + cbo_trat
    }).trigger('reloadGrid');


//    limpiar_ctrl_c_u('div_historial_pagos','txt_ver_trat_subtot*txt_ver_trat_dscto*txt_ver_trat_tot');

//    get_dscto_all(ver_trat_pac_id,cbo_trat,0);
//    trat_saldo(ver_trat_pac_id,$('#div_ver_trat_select').val());
}

sol=1;dol=0;flag=0;
function navegacion(tip){    
    if(tip==0)
    { 
        $(".HeaderButton", $('#grid_ver_historial_pagos_dol')[0].grid.cDiv).trigger("click");
        $(".HeaderButton", $('#grid_ver_historial_pagos')[0].grid.cDiv).trigger("click");
        if(flag==0){
//            sol=0;dol=1;
            flag=1;
            $("#div_his_pagos_mov").css({ top: "26.5%"});
        }else{
//            sol=1;dol=0;
            flag=0;
            $("#div_his_pagos_mov").css({ top: "80%"});
        }
        
    }
    else
    {
        $(".HeaderButton", $('#grid_ver_historial_pagos_dol')[0].grid.cDiv).trigger("click");
        $(".HeaderButton", $('#grid_ver_historial_pagos')[0].grid.cDiv).trigger("click");
        if(flag==0){
//            sol=0;dol=1;
            flag=1;
            $("#div_his_pagos_mov").css({ top: "26.5%", transition:'all 0.2s'});
//            element.style['-webkit-transition'] = 'opacity 1s';
            
        }else{
//            sol=1;dol=0;
            flag=0;
            $("#div_his_pagos_mov").css({ top: "80%", transition:'all 0.2s'});
            
        }
    }
}

function llenararajaxtodo_ruc(textbox,url,val){
    $.ajax({
           type: 'GET',
           url: url,
           success: function(data){                
                var $local_sourcedoctotodo=data;                  
                 $("#"+textbox).autocomplete({
                      source: $local_sourcedoctotodo,
                      focus: function(event, ui) {                             
                             $("#"+textbox).val(ui.item.label);                             
                             $("#hidden"+textbox).val(ui.item.value);                             
                             $("#"+textbox).attr('maxlength', ui.item.num_ruc.length);
                             return false;
                      },
                      select: function(event, ui) {                              
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value); 
                              $("#div_pac_realizar_pago_factura_ruc").val(ui.item.num_ruc);
                              $("#div_razon_soc_factura").val(ui.item.raz_soc);
                              $("#div_razon_soc_factura").attr('maxlength', ui.item.raz_soc.length);
                              return false;
                      }   
                  });             
            },
            error: function(data){
                mensaje_sis('mensaje',' ERROR AL CREAR CONSULTA','MENSAJE DEL SISTEMA');
            }
    });
}

