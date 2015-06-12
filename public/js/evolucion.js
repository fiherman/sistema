
function btn_evolucion() {
    pac_id=$("#hiddendiv_ver_trat_pac").val();
    num_trat= $("#div_ver_trat_select").val();
   
    $("#div_pac_evolucion").dialog({
        autoOpen: false, modal: true, height: 500, width: 760, show: {effect: "fade", duration: 500}, close: function() {
        }
    }).dialog('open');
    $("#grid_evolucion_pac").jqGrid("clearGridData", true).trigger("reloadGrid");
    jQuery("#grid_evolucion_pac").jqGrid({
            url: 'pacientes/pacientes/get_ver_evolucion?pac_id='+pac_id+'&num_trat='+num_trat,
            datatype: 'json', mtype: 'GET',
            colNames: ['id','ACTIVIDAD','DOCTOR','FECHA','Prox. Cita','Cons.'],
            rowNum: 10, sortname: 'evo_ide', sortorder: 'desc', viewrecords: true, caption: 'EVOLUCION DEL PACIENTE', width: '100%', height: '230', align: "center",
            colModel: [
                {name: 'evo_ide', index: 'evo_ide', hidden:true},
                {name: 'evo_act_des', index: 'evo_act_des',width: 340, resizable: true, align: "left"},
                {name: 'nom_doc', index: 'nom_doc', width: 140, resizable: true, align: "left"},           
                {name: 'fecha', index: 'fecha', width: 135, resizable: true, align: "center"},
                {name: 'sig_cita', index: 'sig_cita', width: 75, resizable: true, align: "center"},
                {name: 'evo_cons', index: 'evo_cons', width: 45, resizable: true, align: "center"}
            ],
            rowList: [10, 20, 30],
            pager: '#pager_evolucion_pac',
            gridComplete: function () { }      
        });
    
//    $.ajax({
//        url: 'pacientes/pacientes/get_evolucion_anterior?pac_id='+pac_id, 
//        type: 'get',       
//        success: function(data) {
//            if(data=='no'){
//               alert('o hay evolucion anterior');
//            }else{
//                $("#div_pac_evol_fch_act").val(data[0].evo_fch);
//                $("#div_pac_evol_hora_act").val(data[0].evo_hra);
//                $("#div_pac_evol_act_des").val(data[0].evo_des);
//            }
//        }
//    });
  
    $("#hiddendiv_evol_pac").val($("#hiddendiv_ver_trat_pac").val());
    $("#div_evol_pac").val($("#div_ver_trat_pac").val());
    $("#div_pac_evol_trat_num").val($("#div_ver_trat_select").val());

//    var f = new Date();
    //$("#div_pac_evol_fch_act").val(("0" + f.getDate()).slice(-2) + "/" + ("0" + (f.getMonth() + 1)).slice(-2) + "/" + f.getFullYear());
    //$("#div_pac_evol_act_des").focus();

}
function btn_ins_nue_actividad(){
    $("#new_evol").dialog({
        autoOpen: false, modal: true, height: 375, width: 650, show: {effect: "fade", duration: 500}, close: function() {
        }
    }).dialog('open');
    llenararajaxtodo_doctor('new_evol_doctor','pacientes/pacientes/listartodo_doc',0);
    
    $("#new_evol_fch").mask("99/99/9999");
    $("#new_evol_pro_fch").mask("99/99/9999"); 
    
    timepiker('new_evol_hora');
    timepiker('new_evol_prox_hora');
    limpiar_ctrl('new_evol');
    pintar_verde_todo(15);
}

function btn_insert_evol() {
    
    pac_id = $("#hiddendiv_evol_pac").val();
    trat_num = $("#div_pac_evol_trat_num").val();
    
    fch = $("#new_evol_fch").val();
    hora = $("#new_evol_hora").val();
    des = $("#new_evol_des").val();
    doct = $("#new_evol_doctor").val();
    consult=$("#new_evol_consu").val();
    
    fch_pro_act = $("#new_evol_pro_fch").val();    
    pro_act_hora = $("#new_evol_prox_hora").val();
    

    if (pac_id != "" && trat_num != "" && hora != "" && fch != "" && des != "" && doct != "" && fch_pro_act != "" && pro_act_hora != "" && consult!='0') {
//        evo_act_fch=fch_act + " "+MilitaryTime(act_hora.split(':')).join(':');
//        evo_pro_acti_fch=fch_pro_act+" " + MilitaryTime(pro_act_hora.split(':')).join(':');
        evo_act_fch=fch+"."+hora;
        evo_pro_acti_fch=fch_pro_act+"."+pro_act_hora;
//        evo_act_fch=evo_act_fch.substring(0, evo_act_fch.length - 3)+":00";
//        evo_pro_acti_fch=evo_pro_acti_fch.substring(0, evo_pro_acti_fch.length - 3)+":00";
        
        datos = pac_id+'*'+des.toUpperCase()+'*'+trat_num+'*'+evo_act_fch+'*'+evo_pro_acti_fch+'*'+doct+'*'+consult;
        $.ajax({
            url: 'pacientes/Evolucion/insert_evolucion_pac?datos=' + datos,
            type: 'GET',
            success: function(data) {
                if (data == 'si') {
                    mensaje_sis('mensaje', ' DATOS INSERTADOS CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                    btn_salir('div_pac_evolucion');
                }
            }
        });
    } else {      
       
        if (fch_act == "") {
            $("#div_pac_rea_pago_cos").css({border: "1px solid red"});
        }
        if (fch_des == "") {
            $("#div_pac_evol_act_des").css({border: "1px solid red"});
        }
        if (fch_pro_act == "") {
            $("#div_pac_rea_pago_num_fac_bol").css({border: "1px solid red"});
        }
        if (fch_pro_des == "") {
            $("#div_pac_evol_pro_acti_des").css({border: "1px solid red"});
        }
        if (consult=='0'){
            $("#div_pac_evolucion_consult").css({border: "1px solid red"});
        }
        if(fch_pro_act==""){
            $("#div_pac_evol_pro_acti_fch").css({border: "1px solid red"});
        }
        if (act_hora==""){
            $("#div_pac_evol_hora_act").css({border: "1px solid red"});            
        }
        if (pro_act_hora==""){
            $("#div_pac_evol_pro_hora_act").css({border: "1px solid red"});
        }
        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }

}

function ver_cita_pac(pad_id){
    $.ajax({
        url: 'pacientes/pacientes/get_cita_pac', 
        type: 'get', 
        data: {
            ide: pad_id 
            },
        success: function(data) {
            if(data.modo=='no'){
                mensaje_sis('mensaje',' EL PACIENTE NO TIENE CITAS','MENSAJE DEL SISTEMA');
            }else if(data[0].modo=='cita'){                
                vista_previa_cita('vista_previa_cita', ': '+pad_id + '<br>' + ': '+data[0].nom_com + '<br>' + ': '+data[0].fch_ini + '<br>' + ': '+data[0].fch_hora + '<br>' + ': '+data[0].des_not);                
            }else if(data[0].modo=='primera'){                
                vista_previa_cita('vista_previa_cita', ': '+pad_id + '<br>' + ': '+data[0].nom_com + '<br>' + ': '+data[0].fch_ini + '<br>' + ': '+data[0].fch_hora + '<br>' + ': '+data[0].des_not);                
            }
        }
    });
}
