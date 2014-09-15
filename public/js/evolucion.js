
function btn_evolucion() {
//    pac_id = $.trim($("#grid_con_pac").getCell(ide_trb, "id"));
//    nom = $.trim($("#grid_con_pac").getCell(ide_trb, "nombre"));
//    ape = $.trim($("#grid_con_pac").getCell(ide_trb, "apellido"));
    $("#div_pac_evolucion").dialog({
        autoOpen: false, modal: true, height: 455, width: 750, show: {effect: "fade", duration: 500}, close: function() {
        }
    }).dialog('open');

    $("#div_pac_evol_fch_act").mask("99/99/9999");
    $("#div_pac_evol_pro_acti_fch").mask("99/99/9999");

    datepiker('div_pac_evol_fch_act', '-1Y', '+1Y');
    datepiker('div_pac_evol_pro_acti_fch', '-1Y', '+1Y');

    timepiker('div_pac_evol_hora_act');
    timepiker('div_pac_evol_pro_hora_act');

    pintar_verde_todo();
    limpiar_ctrl('div_pac_evolucion');

    $("#hiddendiv_evol_pac").val($("#hiddendiv_ver_trat_pac").val());
    $("#div_evol_pac").val($("#div_ver_trat_pac").val());
    $("#div_pac_evol_trat_num").val($("#div_ver_trat_select").val());

    var f = new Date();
    $("#div_pac_evol_fch_act").val(("0" + f.getDate()).slice(-2) + "/" + ("0" + (f.getMonth() + 1)).slice(-2) + "/" + f.getFullYear());
    $("#div_pac_evol_act_des").focus();

}

function btn_insert_evol() {
    
    pac_id = $("#hiddendiv_evol_pac").val();
    trat_num = $("#div_pac_evol_trat_num").val();
    fch_act = $("#div_pac_evol_fch_act").val();
    fch_des = $("#div_pac_evol_act_des").val();
    act_hora = $("#div_pac_evol_hora_act").val();
    fch_pro_act = $("#div_pac_evol_pro_acti_fch").val();
    fch_pro_des = $("#div_pac_evol_pro_acti_des").val();
    pro_act_hora = $("#div_pac_evol_pro_hora_act").val();
    consult=$("#div_pac_evolucion_consult").val();

    if (pac_id != "" && trat_num != "" && act_hora != "" && fch_act != "" && fch_des != "" && fch_pro_act != "" && fch_pro_des != "" && pro_act_hora != "" && consult!='0') {
//        evo_act_fch=fch_act + " "+MilitaryTime(act_hora.split(':')).join(':');
//        evo_pro_acti_fch=fch_pro_act+" " + MilitaryTime(pro_act_hora.split(':')).join(':');
        evo_act_fch=fch_act+"."+act_hora;
        evo_pro_acti_fch=fch_pro_act+"."+pro_act_hora;
//        evo_act_fch=evo_act_fch.substring(0, evo_act_fch.length - 3)+":00";
//        evo_pro_acti_fch=evo_pro_acti_fch.substring(0, evo_pro_acti_fch.length - 3)+":00";
        
        datos = fch_des.toUpperCase()+ '*'+ fch_pro_des.toUpperCase() + '*' + pac_id + '*' + trat_num + '*' + evo_act_fch + '*' + evo_pro_acti_fch+ '*'+consult;
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
        alert(3);
       
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
