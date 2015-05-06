
function open_administracion() {
    $("#div_adm_all").dialog({
        autoOpen: false, modal: true, height: 400, width: 440, show: {effect: "fade", duration: 300}
    }).dialog('open');
}
function open_doctores() {
    
    btn_salir('div_adm_all');
    $("#div_adm_doc").dialog({
        autoOpen: false, modal: true, height: 548, width: 755, show: {effect: "fade", duration: 500}
    }).dialog('open');
    $("#grid_con_doc").jqGrid("clearGridData", true).trigger("reloadGrid");
    
    jQuery("#grid_con_doc").jqGrid({
        url: 'pacientes/administracion/get_all',
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'NOMBRES', 'APELLIDOS', 'RNE', 'EDITAR', 'VER', 'universidad', 'estado', 'fecha reg'],
        rowNum: 12, sortname: 'doc_id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE DOCTORES', width: '100%', height: '265', align: "center",
        colModel: [
            {name: 'doc_id', index: 'doc_id', width: 70, resizable: true, align: "center"},
            {name: 'doc_nom', index: 'doc_nom_com', width: 200, resizable: true, align: "left"},
            {name: 'doc_ape', index: 'doc_nom_com', width: 200, resizable: true, align: "left"},
            {name: 'doc_cop', index: 'doc_cop', width: 120, resizable: true, align: "center"},
            {name: 'Editar', index: 'Editar', width: 70, resizable: true, align: "center"},
            {name: 'Vista', index: 'Vista', width: 70, resizable: true, align: "center"},
            {name: 'doc_uni', index: 'doc_uni', hidden: true},
            {name: 'doc_hab', index: 'doc_hab', hidden: true},
            {name: 'doc_fch', index: 'doc_fch', hidden: true}
        ],
        rowList: [12, 25],
        pager: '#pager_con_doc',
        gridComplete: function(){
            var rows = $("#grid_con_doc").getDataIDs();
            for (var i = 0; i < rows.length; i++)
            {
                var doc_hab = $("#grid_con_doc").getCell(rows[i], "doc_hab");
                
                if (doc_hab == 0)
                {
                    $("#grid_con_doc").jqGrid('setRowData', rows[i], false, {color: '#FF4444', weightfont: 'bold', background: '#FFDDDD'});
                }
            }
        }
//        onSelectRow: function(Id){
//            ide_trb = $("#grid_con_pac").getCell(Id,"id"); 
//            $("#btn_consulta_pac").attr('disabled',false);
//            $("#btn_plan_trat_pac").attr('disabled',false);
//        },
//        ondblClickRow: function(Id){            
//            btn_ver_pac(Id);
//        }
    });
}

function ver_especialidades(esp_tip, seg_id) {
    btn_salir('div_adm_all');

//    $("#grid_con_especialidad").jqGrid("clearGridData", true).trigger("reloadGrid");
    jQuery("#grid_con_especialidad").jqGrid({
        url: 'pacientes/administracion/get_especialidad_des?seg_id=' + seg_id + '&esp_tip=' + esp_tip,
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'SEG_ID', 'ESP_TIP', 'DESCRIPCION', 'COSTO', 'EDITAR'],
        rowNum: 30, sortname: 'esp_id', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE TRATAMIENTOS', width: '100%', height: '265', align: "center",
        colModel: [
            {name: 'esp_id', index: 'esp_id', width: 80, resizable: true, align: "center"},
            {name: 'seg_id', index: 'seg_id', hidden: true},
            {name: 'esp_tip', index: 'esp_tip', hidden: true},
            {name: 'esp_des', index: 'esp_des', width: 400, resizable: true, align: "left"},
            {name: 'esp_cos_sol', index: 'esp_cos_sol', width: 95, resizable: true, align: "right"},
            {name: 'editar', index: 'editar', width: 90, resizable: true, align: "center"}
        ]
    });
}

function open_especialidades() {
    $("#div_adm_esp").dialog({
        autoOpen: false, modal: true, height: 515, width: 690, show: {effect: "fade", duration: 300},
        close: function() {
            seguro_id_global = 0;
            document.getElementById("div_adm_esp_seg_id").value = "select";
            document.getElementById('div_adm_esp_tipo').options.length = 1;
            $("#grid_con_especialidad").jqGrid("clearGridData", true);
        }
    }).dialog('open');
    ver_especialidades(0, 0);
}

function btn_nuevo_doc(modo) {
    $("#div_nuevo_doc").dialog({
        autoOpen: false, modal: true, height: 310, width: 600, show: {effect: "fade", duration: 300}
    }).dialog('open');
    if (modo == 'INSERTAR') {
        $("#btn_adm_guardar_doc").show();
        $("#btn_adm_editar_doc").hide();
    } else if (modo == 'EDITAR') {
        $("#btn_adm_guardar_doc").hide();
        $("#btn_adm_editar_doc").show();
    }
    limpiar_ctrl('div_nuevo_doc');
    pintar_verde_todo();
}
function btn_editar_doc(Id) {
    nombre = $.trim($("#grid_con_doc").getCell(Id, "doc_nom"));
    apellido = $.trim($("#grid_con_doc").getCell(Id, "doc_ape"));
    universidad = $.trim($("#grid_con_doc").getCell(Id, "doc_uni"));
    rne = $.trim($("#grid_con_doc").getCell(Id, "doc_cop"));
    estado = $.trim($("#grid_con_doc").getCell(Id, "doc_hab"));

    btn_nuevo_doc('EDITAR');
    $("#doc_id").val(Id);
    $("#txtadm_doc_nom").val(nombre);
    $("#txtadm_doc_ape").val(apellido);
    $("#txtadm_doc_uni").val(universidad);
    $("#txtadm_doc_cop").val(rne);
    $("#txtadm_doc_hab").val(estado);
}
function brn_guardar_doc(modo) {
    doc_id = $("#doc_id").val();
    doc_nom = $("#txtadm_doc_nom").val();
    doc_ape = $("#txtadm_doc_ape").val();
    doc_cop = $("#txtadm_doc_cop").val();
    doc_uni = $("#txtadm_doc_uni").val();
    doc_hab = $("#txtadm_doc_hab").val();

    if (doc_nom != "" && doc_ape != "" && doc_cop != "" && doc_uni != "") {
        if (modo == 'INSERTAR') {
            var datos = doc_nom.toUpperCase() + '*' + doc_ape.toUpperCase() + '*' + doc_cop.toUpperCase() + '*' + doc_uni.toUpperCase() + '*' + doc_hab;
            $.ajax({
                url: 'pacientes/administracion/insert_doc?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {
                        mensaje_sis('mensaje', ' DATOS INSERTADOS CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                        btn_salir('div_nuevo_doc');
                        btn_actualizar_cons();
                    }
                }
            });
        } else if (modo == 'EDITAR') {
            var datos = doc_id + '*' + doc_nom.toUpperCase() + '*' + doc_ape.toUpperCase() + '*' + doc_cop.toUpperCase() + '*' + doc_uni.toUpperCase() + '*' + doc_hab;
            $.ajax({
                url: 'pacientes/administracion/update_doc?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {
                        mensaje_sis('mensaje', ' DATOS MODIFICADO CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                        btn_salir('div_nuevo_doc');
                        btn_actualizar_cons();
                    }
                }
            });
        }
        return true;
    } else {
        if (doc_nom == "") {
            $("#txtadm_doc_nom").css({border: "1px solid red"});
        }
        if (doc_ape == "") {
            $("#txtadm_doc_ape").css({border: "1px solid red"});
        }
        if (doc_cop == "") {
            $("#txtadm_doc_cop").css({border: "1px solid red"});
        }
        if (doc_uni == "") {
            $("#txtadm_doc_uni").css({border: "1px solid red"});
        }
        if (doc_hab == "") {
            $("#txtadm_doc_hab").css({border: "1px solid red"});
        }
        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }
}
function btn_nueva_especialidad(modo) {
    $("#div_adm_nueva_esp").dialog({
        autoOpen: false, modal: true, height: 265, width: 650, show: {effect: "fade", duration: 300}
    }).dialog('open');
    if (modo == 'INSERTAR') {
        document.getElementById('div_adm_nueva_esp_seg').disabled = false;
        document.getElementById('div_adm_nueva_esp_tipo').disabled = false;
        $("#btn_adm_nuevo_pac_ins").show();
        $("#btn_adm_nuevo_pac_upd").hide();
    } else if (modo == 'EDITAR') {
        document.getElementById('div_adm_nueva_esp_seg').disabled = true;
        document.getElementById('div_adm_nueva_esp_tipo').disabled = true;
        $("#btn_adm_nuevo_pac_ins").hide();
        $("#btn_adm_nuevo_pac_upd").show();
    }
    limpiar_ctrl('div_adm_nueva_esp');
    pintar_verde_todo();
}
function btn_editar_especialidad(Id) {
    combo_seg_id = document.getElementById("div_adm_esp_seg_id");
    selected_seg_id = combo_seg_id.options[combo_seg_id.selectedIndex].value;
    combo_esp_tipo = document.getElementById("div_adm_esp_tipo");
    selected_esp_tipo = combo_esp_tipo.options[combo_esp_tipo.selectedIndex].value;
//    selected_text = combo_esp_tipo.options[combo_esp_tipo.selectedIndex].text; 

    select_adm_seg_id(selected_seg_id, 1);
//    alert(selected_seg_id+'-'+selected_esp_tipo+'-'+selected_text);
    alert("EDITAR TRATAMIENTO");

    esp_id = $.trim($("#grid_con_especialidad").getCell(Id, "esp_id"));
    esp_des = $.trim($("#grid_con_especialidad").getCell(Id, "esp_des"));
    esp_cos = $.trim($("#grid_con_especialidad").getCell(Id, "esp_cos_sol"));

    btn_nueva_especialidad('EDITAR');
    $("#esp_id").val(Id);
    $("#div_adm_nueva_esp_seg").val(selected_seg_id);
    $("#div_adm_nueva_esp_tipo").val(selected_esp_tipo);
    $("#esp_id").val(esp_id);
    $("#div_adm_nueva_esp_des").val(esp_des);
    $("#div_adm_nueva_esp_cos").val(esp_cos);

}
function brn_guardar_especialidad(modo) {
    combo_1 = document.getElementById("div_adm_nueva_esp_seg");
    selected_val_1 = combo_1.options[combo_1.selectedIndex].value;
    selected_text_1 = combo_1.options[combo_1.selectedIndex].text;

    combo_2 = document.getElementById("div_adm_nueva_esp_tipo");
    selected_val_2 = combo_2.options[combo_2.selectedIndex].value;
    selected_text_2 = combo_2.options[combo_2.selectedIndex].text;

    esp_id = $("#esp_id").val();
    esp_des = $("#div_adm_nueva_esp_des").val();
    esp_cos = $("#div_adm_nueva_esp_cos").val();
    console.log(esp_id + '-' + esp_des + '-' + esp_cos);
    if (selected_val_1 != "select" && selected_val_2 != "select" && esp_des != "" && esp_cos != "") {
        if (modo == 'INSERTAR') {
            var datos = doc_nom.toUpperCase() + '*' + doc_ape.toUpperCase() + '*' + doc_cop.toUpperCase() + '*' + doc_uni.toUpperCase() + '*' + doc_hab;
            $.ajax({
                url: 'pacientes/administracion/insert_doc?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {
                        mensaje_sis('mensaje', ' DATOS INSERTADOS CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                        btn_salir('div_adm_nueva_esp');
                    }
                }
            });
        } else if (modo == 'EDITAR') {
            var datos = esp_id + '*' + esp_des.toUpperCase() + '*' + esp_cos;
            $.ajax({
                url: 'pacientes/administracion/update_esp?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {
                        mensaje_sis('mensaje', ' DATOS MODIFICADO CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                        select_adm_esp_tipo(selected_val_2);
                        btn_salir('div_adm_nueva_esp');
                    }
                }
            });
        }
        return true;
    } else {
        if (esp_des == "") {
            $("#div_adm_nueva_esp_des").css({border: "1px solid red"});
        }
        if (esp_cos == "") {
            $("#div_adm_nueva_esp_cos").css({border: "1px solid red"});
        }
        if (selected_val_1 == "select") {
            $("#div_adm_nueva_esp_seg").css({border: "1px solid red"});
        }
        if (selected_val_2 == "select") {
            $("#div_adm_nueva_esp_tipo").css({border: "1px solid red"});
        }

        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }
}
/////////////////////////////////////////
function btn_actualizar_cons() {
    $("#grid_con_doc").setGridParam({serach: false, searchdata: {}, page: 1}).trigger("reloadGrid");
}
function btn_ver_doc(Id) {
    doc_cop = $.trim($("#grid_con_doc").getCell(Id, "doc_cop"));
    doc_nom = $.trim($("#grid_con_doc").getCell(Id, "doc_nom"));
    doc_ape = $.trim($("#grid_con_doc").getCell(Id, "doc_ape"));
    doc_uni = $.trim($("#grid_con_doc").getCell(Id, "doc_uni"));
    doc_hab = $.trim($("#grid_con_doc").getCell(Id, "doc_hab"));
    doc_fch = $.trim($("#grid_con_doc").getCell(Id, "doc_fch"));

    if (doc_hab == 0) {
        doc_hab = "DESHABILITADO";
    } else if (doc_hab == 1) {
        doc_hab = "HABILITADO";
    }
    vista_previa_doc('vista_previa_doc', Id + '<br>' + doc_cop + '<br>' + doc_nom + '<br>' + doc_ape + '<br>' + doc_uni + '<br>' + doc_fch + '<br>' + doc_hab);
}

function fn_buscar_doc() {
    txtbuscar = $("#txtbuscar_doc").val();
    jQuery("#grid_con_doc").jqGrid('setGridParam', {
        url: "pacientes/administracion/get_buscar_doctor?txtbuscar=" + txtbuscar
    }).trigger('reloadGrid');
}

function formato_numero(numero, decimales, separador_decimal, separador_miles) { // v2007-08-06
    numero = parseFloat(numero);
    if (isNaN(numero)) {
        return "";
    }

    if (decimales !== undefined) {
        // Redondeamos
        numero = numero.toFixed(decimales);
    }
    // Convertimos el punto en separador_decimal
    numero = numero.toString().replace(".", separador_decimal !== undefined ? separador_decimal : ",");

    if (separador_miles) {
        // Añadimos los separadores de miles
        var miles = new RegExp("(-?[0-9]+)([0-9]{3})");
        while (miles.test(numero)) {
            numero = numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }
    return numero;
}
cancelar = 0;
function parpadear(ctrl_parp) {
    for (i = 0; i <= 4; i++) {
        if (i == 4) {
            $('#' + ctrl_parp).fadeOut(100, function() {
                $(this).fadeIn(100);
            });
        } else {
            $('#' + ctrl_parp).fadeIn(80).delay(30).fadeOut(80);
        }
    }
}
function not_parpadear() {
//    $('#'+ctrl_parp).fadeOut(100, function(){ 
//        $(this).fadeIn(100); 
//    });
    cancelar = 1;
}
seguro_id_global = 0;
function select_adm_seg_id(seg_id, sel_2) {
    seguro_id_global = seg_id;
    if (sel_2 === 0) {//cuando se la ventarna de especialidades
        document.getElementById('div_adm_esp_tipo').options.length = 1;
    } else if (sel_2 === 1) {//cuando es nueva especialidad
        document.getElementById('div_adm_nueva_esp_tipo').options.length = 1;
    }
//    else if(sel_2===2){//para editar la especialidad
//         document.getElementById('div_adm_nueva_esp_tipo').options.length = 1;
//    }   
    $.ajax({
        url: 'pacientes/administracion/get_all_esp?seg_id=' + seg_id,
        type: 'GET',
        success: function(data) {
            for (i = 0; i <= data.length - 1; i++) {//carga el combo para seleccionar el tratamiento desde la BD
                if (sel_2 === 0) {
                    $('#div_adm_esp_tipo').append('<option value=' + (i + 1) + '>' + data[i].des + '</option>');
                } else if (sel_2 == 1) {
                    $('#div_adm_nueva_esp_tipo').append('<option value=' + (i + 1) + '>' + data[i].des + '</option>');
                }
//               else if(sel_2===2){
//                   $('#div_adm_nueva_esp_tipo').append('<option value='+(i+1)+'>'+data[i].des+'</option>');
//               }               
            }
        },
        error: function(data) {
            mensaje_sis('mensaje', ' Seleccione un Seguro Valido', 'INFORMACION');
        }
    });

}
function select_adm_esp_tipo(esp_tip) {
    jQuery("#grid_con_especialidad").jqGrid('setGridParam', {
        url: 'pacientes/administracion/get_especialidad_des?seg_id=' + seguro_id_global + '&esp_tip=' + esp_tip
    }).trigger('reloadGrid');
}

////////////////USUARIOS///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function open_usuarios() {
    btn_salir('div_adm_all');
    $("#div_adm_usu").dialog({
        autoOpen: false, modal: true, height: 548, width: 755, show: {effect: "fade", duration: 500}
    }).dialog('open');
    $("#grid_con_usu").jqGrid("clearGridData", true).trigger("reloadGrid");
    jQuery("#grid_con_usu").jqGrid({
        url: 'pacientes/administracion/get_all_usuarios',
        datatype: 'json', mtype: 'GET',
        colNames: ['CODIGO', 'USUARIO', 'NOMBRES Y APELLIDOS', 'EMAIL', 'EDITAR', 'cpass', 'ccpass', 'est'],
        rowNum: 12, sortname: 'user_id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE USUARIOS', width: '100%', height: '265', align: "center",
        colModel: [
            {name: 'user_id', index: 'user_id', width: 70, resizable: true, align: "center"},
            {name: 'usuario', index: 'usuario', width: 100, resizable: true, align: "left"},
            {name: 'nom_com', index: 'nom_com', width: 300, resizable: true, align: "left"},
            {name: 'email', index: 'email', width: 188, resizable: true, align: "left"},
            {name: 'Editar', index: 'Editar', width: 70, resizable: true, align: "center"},
            {name: 'cpassword', index: 'cpassword', hidden: true},
            {name: 'ccpassword', index: 'ccpassword', hidden: true},
            {name: 'estado', index: 'estado', hidden: true}
        ],
        rowList: [12, 25],
        pager: '#pager_con_usu'
    });
}
function btn_nuevo_usu() {
    $("#div_nuevo_usu").dialog({
        autoOpen: false, modal: true, height: 330, width: 600, show: {effect: "fade", duration: 300}
    }).dialog('open');

    limpiar_ctrl('div_nuevo_usu');
    pintar_verde_todo();
}

function btn_editar_usu(Id) {
    $("#div_edit_usu").dialog({
        autoOpen: false, modal: true, height: 330, width: 600, show: {effect: "fade", duration: 300}
    }).dialog('open');
    limpiar_ctrl('div_edit_usu');
    usuario = $.trim($("#grid_con_usu").getCell(Id, "usuario"));
    nom_com = $.trim($("#grid_con_usu").getCell(Id, "nom_com"));
    email = $.trim($("#grid_con_usu").getCell(Id, "email"));
    cpassword = $.trim($("#grid_con_usu").getCell(Id, "cpassword"));

    $("#edit_usuario_id").val(Id);
    $("#div_edit_usu_user").val(usuario);
    $("#div_edit_usu_nom_com").val(nom_com);
    $("#div_edit_usu_email").val(email);
    $("#user_password").val(cpassword);
    $("#div_edit_usu_estado").val($("#grid_con_usu").getCell(Id, "estado"));
}
function btn_guardar_insert_usu() {
    nom_com = $.trim($("#txt_divnuevousu_nomcom").val());
    email = $.trim($("#txt_divnuevousu_email").val());
    usuario = $.trim($("#txt_divnuevousu_user").val());
    pass = $.trim($("#div_nuevo_usu_c").val());
    repass = $.trim($("#div_nuevo_usu_rep_c").val());

    if (nom_com != "" && email != "" && usuario != "" && pass != "") {
        if (email != "") {
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!expr.test(email)) {
                $("#txt_divnuevousu_email").css({border: "1px solid red"});
                mostraralertas('informe', '* email no valido', 'INFORMACION');
                return false;
            } else {
                if (pass === repass) {
                    var datos = nom_com.toUpperCase() + '*' + email + '*' + usuario.toUpperCase() + '*' + pass.toUpperCase();
                    $.ajax({
                        url: 'pacientes/administracion/insert_usu?datos=' + datos,
                        type: 'GET',
                        success: function(data) {
                            if (data == 'si') {
                                mensaje_sis('mensaje', ' USUARIO INSERTADO CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                                btn_salir('div_nuevo_usu');
                                btn_actualizar_usuarios();
                            }
                        }
                    });
                } else {
                    mensaje_sis('mensaje', ' Las Contraseñas No Coinciden', 'MENSAJE DEL SISTEMA');
                }
            }
        }
    } else {
        if (nom_com == "") {
            $("#txt_divnuevousu_nomcom").css({border: "1px solid red"});
        }
        if (email == "") {
            $("#txt_divnuevousu_email").css({border: "1px solid red"});
        }
        if (usuario == "") {
            $("#txt_divnuevousu_user").css({border: "1px solid red"});
        }
        if (pass == "") {
            $("#div_nuevo_usu_c").css({border: "1px solid red"});
        }
        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }


}
function btn_actualizar_usuarios() {
    jQuery("#grid_con_usu").jqGrid('setGridParam', {
        url: 'pacientes/administracion/get_all_usuarios'
    }).trigger('reloadGrid');

}
function btn_guardar_update_usu() {
    pass_usuario = $("#user_password").val();
    pass = $.trim($("#div_edit_usu_c_act").val());
    user_id = $.trim($("#edit_usuario_id").val());
    nom_com = $.trim($("#div_edit_usu_nom_com").val());
    email = $.trim($("#div_edit_usu_email").val());
    usuario = $.trim($("#div_edit_usu_user").val());
    estado = $("#div_edit_usu_estado").val();
    if (user_id != "" && nom_com != "" && email != "" && usuario != "" && pass != "") {
        if (email != "") {
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!expr.test(email)) {
                alert(email);
                $("#div_edit_usu_email").css({border: "1px solid red"});
                mostraralertas('informe', '* email no valido', 'INFORMACION');
                return false;
            } else {
                if (pass === pass_usuario) {
                    var datos = user_id + '*' + nom_com.toUpperCase() + '*' + email + '*' + usuario.toUpperCase() + '*' + estado;
                    $.ajax({
                        url: 'pacientes/administracion/update_usu?datos=' + datos,
                        type: 'GET',
                        success: function(data) {
                            if (data == 'si') {
                                mensaje_sis('mensaje', ' USUARIO INSERTADO CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                                btn_salir('div_edit_usu');
                                btn_actualizar_usuarios();
                            }
                        }
                    });
                } else {
                    mensaje_sis('mensaje', ' Ingrese la contraseña del usuario ' + usuario, 'MENSAJE DEL SISTEMA');
                }
            }
        }
    } else {
        if (nom_com == "") {
            $("#div_edit_usu_nom_com").css({border: "1px solid red"});
        }
        if (email == "") {
            $("#div_edit_usu_email").css({border: "1px solid red"});
        }
        if (usuario == "") {
            $("#div_edit_usu_user").css({border: "1px solid red"});
        }
        if (pass == "") {
            $("#div_edit_usu_c_act").css({border: "1px solid red"});
        }
        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }
}
function fn_buscar_usu() {
    txtbuscar = ($.trim($("#txtbuscar_usu").val())).toUpperCase();
    jQuery("#grid_con_usu").jqGrid('setGridParam', {
        url: "pacientes/administracion/get_buscar_usuarios?txtbuscar=" + txtbuscar
    }).trigger('reloadGrid');
}

function brn_guardar_usu(modo) {
    doc_id = $("#doc_id").val();
    doc_nom = $("#txtadm_doc_nom").val();
    doc_ape = $("#txtadm_doc_ape").val();
    doc_cop = $("#txtadm_doc_cop").val();
    doc_uni = $("#txtadm_doc_uni").val();
    doc_hab = $("#txtadm_doc_hab").val();

    if (doc_nom != "" && doc_ape != "" && doc_cop != "" && doc_uni != "") {
        if (modo == 'INSERTAR') {
            var datos = doc_nom.toUpperCase() + '*' + doc_ape.toUpperCase() + '*' + doc_cop.toUpperCase() + '*' + doc_uni.toUpperCase() + '*' + doc_hab;
            $.ajax({
                url: 'pacientes/administracion/insert_doc?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {
                        mensaje_sis('mensaje', ' DATOS INSERTADOS CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                        btn_salir('div_nuevo_doc');
                        btn_actualizar_cons();
                    }
                }
            });
        } else if (modo == 'EDITAR') {
            var datos = doc_id + '*' + doc_nom.toUpperCase() + '*' + doc_ape.toUpperCase() + '*' + doc_cop.toUpperCase() + '*' + doc_uni.toUpperCase() + '*' + doc_hab;
            $.ajax({
                url: 'pacientes/administracion/update_doc?datos=' + datos,
                type: 'GET',
                success: function(data) {
                    if (data == 'si') {
                        mensaje_sis('mensaje', ' DATOS MODIFICADO CORRECTAMENTE', 'MENSAJE DEL SISTEMA');
                        btn_salir('div_nuevo_doc');
                        btn_actualizar_cons();
                    }
                }
            });
        }
        return true;
    } else {
        if (doc_nom == "") {
            $("#txtadm_doc_nom").css({border: "1px solid red"});
        }
        if (doc_ape == "") {
            $("#txtadm_doc_ape").css({border: "1px solid red"});
        }
        if (doc_cop == "") {
            $("#txtadm_doc_cop").css({border: "1px solid red"});
        }
        if (doc_uni == "") {
            $("#txtadm_doc_uni").css({border: "1px solid red"});
        }
        if (doc_hab == "") {
            $("#txtadm_doc_hab").css({border: "1px solid red"});
        }
        mostraralertas('informe', '* los campos marcados de rojo son requeridos', 'INFORMACION');
        return false;
    }
}

////////////////CONFIGURACION DEL SISTEMA////////////////////////////////////////////////////////////////////////
function open_config_system(){
    
    $.ajax({//trae los datos guardados de la factura y igv
        url: 'pacientes/administracion/get_config_system',
        type: 'GET',
        success: function(data) {
            $("#div_config_system_fac_ini").val(data.fac_ini);//numero inicial de rango la factura
            $("#div_config_system_fac_fin").val(data.fac_fin);//numero final del ranfo de la factura
            $("#div_config_system_igv").val(data.igv);           
        }
    });
    
    $("#div_config_system").dialog({
        autoOpen: false, modal: true, height: 250, width: 500, show: {effect: "fade", duration: 300}
    }).dialog('open');
    
    btn_salir('div_adm_all');   
}
function brn_guardar_system_config(){
    ini=$("#div_config_system_fac_ini").val();
    fin=$("#div_config_system_fac_fin").val();
    igv=$("#div_config_system_igv").val();
    var datos = $.trim(ini) + '*' + $.trim(fin) + '*' + $.trim(igv);
 
    $.ajax({
        url: 'pacientes/administracion/update_config_system?datos=' + datos,
        type: 'GET',
        success: function(data) {
            if (data == 'si') {
                mensaje_sis('mensaje', ' DATOS MODIFICADO CORRECTAMENTE', 'MENSAJE DEL SISTEMA');                
                btn_salir('div_config_system');
            }
        }
    });
}




