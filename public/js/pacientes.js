shorcut_enter=0;// atajo de tecla para guardar... desactivado 0 desactivado, 1 inserta, 2 buscar paciente,3 multiplica tratamiento
shortcut.add("enter",function() {
    if(shorcut_enter==1){
        $("#btn_guardar_registro").click();        
    }
    if(shorcut_enter==2 && $('#txtbuscar_pac').val()!=""){
        $("#btn_buscar").click();       
    }
    if(shorcut_enter==3){
        $("#div_trat_des").focus();
        $("#div_trat_total").click();        
        $("#div_trat_total_dol").click();
    }
});

function brn_guardar_pac(modo) {    
    pac_id=$("#pac_id").val();
    nombre = $("#nombre").val();
    apellidos = $("#apellidos").val();
    direccion = $("#direccion").val();
    dni = $("#dni").val();
    distrito = $("#distrito").val();
    sexo = $("#sexo").val();
    fec_nac = $("#fec_nac").val();
    telefono = $("#telefono").val();
    movistar = $("#movistar").val();
    claro = $("#claro").val();
    email = $("#email").val();
    dependiente = $("#dependiente").val();
    seg_id = $("#seg_id").val();

    if (nombre != "" && apellidos != "" && direccion != "" && sexo != "" && fec_nac != "") {

//        if (email != "") {
//            expr = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
//            if (!expr.test(email)) {
//                $("#email").css({border: "1px solid red"});
//                mostraralertas('informe','* email no valido','INFORMACION');
//                return false;
//            }else{
           if(modo=='INSERTAR'){                   
               var datos=nombre.toUpperCase()+'*'+apellidos.toUpperCase()+'*'+direccion.toUpperCase()+'*'+dni+'*'+distrito.toUpperCase()+'*'+sexo.toUpperCase()+'*'+fec_nac+'*'+telefono+'*'+movistar+'*'+claro+'*'+email+'*'+dependiente.toUpperCase()+'*'+seg_id;
                $.ajax({                   
                    url: 'pacientes/pacientes/insert_pac?datos='+datos,
                    type: 'GET',
                    success: function(data){
                        if(data=='si'){
                            mensaje_sis('mensaje',' DATOS INSERTADOS CORRECTAMENTE','MENSAJE DEL SISTEMA');
                            shorcut_enter=0;
                            btn_salir('div_reg_pac_nuevo');
                            btn_actualizar();
                        }
                    }
                });
            }else if(modo=='EDITAR'){                    
               var datos=pac_id+'*'+nombre.toUpperCase()+'*'+apellidos.toUpperCase()+'*'+direccion.toUpperCase()+'*'+dni+'*'+distrito.toUpperCase()+'*'+sexo.toUpperCase()+'*'+fec_nac+'*'+telefono+'*'+movistar+'*'+claro+'*'+email+'*'+dependiente.toUpperCase()+'*'+seg_id;
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
//        if (distrito == "") { $("#distrito").css({border: "1px solid red"}); }
        if (sexo == "") { $("#sexo").css({border: "1px solid red"}); }
        if (fec_nac == "") { $("#fec_nac").css({border: "1px solid red"}); }
//        if (email == "") { $("#email").css({border: "1px solid red"}); }

        mostraralertas('informe','* los campos marcados de rojo son requeridos','INFORMACION');
        return false;
        shorcut_enter=1;
    }
}

ide_trb=0;
function btn_editar_pac(Id){
    shorcut_enter=0;
    nombre = $.trim($("#grid_con_pac").getCell(Id,"nombre"));  
    apellido = $.trim($("#grid_con_pac").getCell(Id,"apellido"));  
    direccion = $.trim($("#grid_con_pac").getCell(Id,"direccion"));
    dni = $.trim($("#grid_con_pac").getCell(Id,"dni"));
    distrito = $.trim($("#grid_con_pac").getCell(Id,"distrito"));
    email = $.trim($("#grid_con_pac").getCell(Id,"email"));
    sexo = $.trim($("#grid_con_pac").getCell(Id,"sexo"));
    telefono = $.trim($("#grid_con_pac").getCell(Id,"telefono"));
    movistar = $.trim($("#grid_con_pac").getCell(Id,"movistar"));
    claro = $.trim($("#grid_con_pac").getCell(Id,"claro"));
    fec_nac = $.trim($("#grid_con_pac").getCell(Id,"fec_nac"));
    dependiente = $.trim($("#grid_con_pac").getCell(Id,"dependiente"));
    seg_id = $.trim($("#grid_con_pac").getCell(Id,"seg_id"));
//    alert(nombre+' '+apellido+' '+direccion+' '+dni+' '+distrito+' '+email+' '+sexo+' '+telefono+' '+movistar+' '+claro+' '+fec_nac+' '+seg_id);
    btn_nuevo_pac('EDITAR');
    $("#pac_id").val(Id);
    $("#nombre").val(nombre);
    $("#apellidos").val(apellido);
    $("#direccion").val(direccion);
    $("#dni").val(dni);
    $("#distrito").val(distrito);
    $("#sexo").val(sexo);
    $("#fec_nac").val(fec_nac);
    $("#telefono").val(telefono);
    $("#movistar").val(movistar);
    $("#claro").val(claro);
    $("#email").val(email);
    $("#dependiente").val(dependiente);
    $("#seg_id").val(seg_id);
}

function fn_open_pac(){
    shorcut_enter=2;
    $("#div_pac_reg").dialog({
        autoOpen: false, modal: true, height: 585, width: 990, show: {effect: "fade", duration: 500},close: function(event, ui) {         
            shorcut_enter=0;
            $('#txtbuscar_pac').val("");
        } 
    }); 
    $("#grid_con_pac").jqGrid("clearGridData", true).trigger("reloadGrid");
    jQuery("#grid_con_pac").jqGrid({
        url: 'pacientes/pacientes/get_all',
        datatype: 'json', mtype: 'GET',
        colNames: ['COD', 'NOMBRE', 'APELLIDOS','EDAD', 'DIRECCION', 'DNI', 'dis', 'EMAIL', 'EDITAR','TTO.','CITA', 'sex', 'tel', 'mov', 'cla', 'fnac', 'dep', 'seg', 'est','seguro'],
        rowNum: 13, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE PACIENTES', width: '100%', height: '297', align: "center",
        colModel: [
            {name: 'id', index: 'id', width: 55, resizable: true, align: "center"},
            {name: 'nombre', index: 'nombre', width: 200, resizable: true, align: "left"},
            {name: 'apellido', index: 'apellido', width: 200, resizable: true, align: "left"},
            {name: 'edad', index: 'edad', width: 45, resizable: true, align: "center"},
            {name: 'direccion', index: 'direccion', width: 200, resizable: true, align: "left"},
            {name: 'dni', index: 'dni', width: 80, resizable: true, align: "center"},
            {name: 'distrito', index: 'distrito', hidden: true},
            {name: 'email', index: 'email',  hidden: true},
            {name: 'Editar', index: 'Editar', width: 70, resizable: true, align: "center"},
            {name: 'Trat', index: 'Trat', width: 55, resizable: true, align: "center"},
            {name: 'cita', index: 'cita', width: 55, resizable: true, align: "center"},
            {name: 'sexo', index: 'sexo', hidden: true},
            {name: 'telefono', index: 'telefono', hidden: true},
            {name: 'movistar', index: 'movistar', hidden: true},
            {name: 'claro', index: 'claro', hidden: true},
            {name: 'fec_nac', index: 'fec_nac', hidden: true},
            {name: 'dependiente', index: 'dependiente', hidden: true},
            {name: 'seg_id', index: 'seg_des', hidden: true},
            {name: 'estado', index: 'estado', hidden: true},
            {name: 'seguro', index: 'seg_des', hidden: true}
        ],
        rowList: [13, 26, 35],
        pager: '#pager_con_pac',
        onSelectRow: function(Id){
            ide_trb = $("#grid_con_pac").getCell(Id,"id"); 
//            $("#btn_consulta_pac").attr('disabled',false);
//            $("#btn_plan_trat_pac").attr('disabled',false);
            deshabilitar_ctrl('div_pac_reg','btn_consulta_pac*btn_plan_trat_pac*btn_evolucion',false);
        },
        ondblClickRow: function(Id){            
            btn_ver_pac(Id);
        }
    });    
    $("#div_pac_reg").dialog('open');   
//    $("#btn_consulta_pac").attr('disabled',true);   
//    $("#btn_plan_trat_pac").attr('disabled',true);
    deshabilitar_ctrl('div_pac_reg','btn_consulta_pac*btn_plan_trat_pac*btn_evolucion',true);
}

function fn_buscar_pac() {
    txtbuscar = $("#txtbuscar_pac").val();
    jQuery("#grid_con_pac").jqGrid('setGridParam', {
        url: "pacientes/pacientes/get_buscar_paciente?txtbuscar=" + txtbuscar
    }).trigger('reloadGrid');
}

function btn_salir(dialogo){
    $("#"+dialogo).dialog("close");
}

function btn_nuevo_pac(modo){
    $("#div_reg_pac_nuevo").dialog({
        autoOpen: false, modal: true, height: 510, width: 800, show: {effect: "fade", duration: 300},close: function(event, ui) {         
            shorcut_enter=2;  
            document.getElementById('seg_id').options.length = 1;
        } 
    }).dialog('open'); 
    $("#fec_nac").mask("99/99/9999");//para autocompletar la fecha
    
    if(modo=='INSERTAR'){
        shorcut_enter=1;
        $("#btn_guardar_registro").show();
        $("#btn_editar_registro").hide();
    }else if(modo=='EDITAR'){
        shorcut_enter=0;
        $("#btn_guardar_registro").hide();
        $("#btn_editar_registro").show();
    }
    limpiar_ctrl('div_reg_pac_nuevo');
    pintar_verde_todo(1);
    llenar_combo_seguros(3);
}

function btn_rea_consulta(){  
//    Id  = $.trim($("#grid_con_pac").getCell(ide_trb, "id"));
    nom = $.trim($("#grid_con_pac").getCell(ide_trb, "nombre"));
    ape = $.trim($("#grid_con_pac").getCell(ide_trb, "apellido"));
    nom_com=nom+' '+ape;
    
    $("#div_consulta").dialog({
        autoOpen: false, modal: true, height: 300, width: 500, show: {effect: "fade", duration: 500} 
    }).dialog('open'); 
//    $('#div_cons_fch').datetimepicker({
//        controlType: 'select',
//        timeFormat: 'hh:mm tt'
//    });     
    $("#div_cons_fch").mask("99/99/9999");
//    datepiker('div_cons_fch','-10D','+4M +10D');
    timepiker('div_cons_hora');
    
    $("#div_cons_pac").val(nom_com);
    $("#pac_id_cons").val(ide_trb);
    $.ajax({                   
        url: 'pacientes/pacientes/get_num_trat?ide_trb='+ide_trb,
        type: 'GET',
        success: function(data){
            if(data=='no'){                
                $("#div_cons_trat_num").val(1);
            }else{
                var pos=data.pop().trat;
                $("#div_cons_trat_num").val(parseInt(pos)+1);                
            }
            
        }
    });
    pintar_verde_todo(2);
    
    limpiar_ctrl('div_consulta'); 
    
    llenararajaxtodo_doctor('div_consulta_doct','pacientes/pacientes/listartodo_doc',3);
}

function btn_guardar_consuta(){
    cons_id=$.trim($("#pac_id_cons").val());
    cons_pac=$.trim($("#div_cons_pac").val());
    cons_cos=$.trim($("#div_cons_cos").val());
    cons_fch=$.trim($("#div_cons_fch").val());
    cons_hora=$.trim($("#div_cons_hora").val());
    trat_num=$.trim($("#div_cons_trat_num").val());
    doctor=$.trim($("#hiddendiv_consulta_doct").val());
    if(cons_pac != "" && cons_cos != "" && cons_fch != "" && cons_hora != "" && cons_id != ""  && trat_num != "" && doctor != ""){
        datos=cons_cos+'*'+cons_fch+'*'+cons_hora+'*'+cons_id+'*'+cons_pac+'*'+trat_num+'*'+doctor;
        $.ajax({                   
            url: 'pacientes/pacientes/insert_consulta_pac?datos='+datos,
            type: 'GET',
            success: function(data){
                if(data=='si'){
                    mensaje_sis('mensaje',' CONSULTA CREADA CORRECTAMENTE','MENSAJE DEL SISTEMA');
                    btn_salir('div_consulta');                       
                }else{mensaje_sis('mensaje',' ERROR AL CREAR CONSULTA','MENSAJE DEL SISTEMA');}
            },
            error: function(data){
                mensaje_sis('mensaje',' ERROR AL CREAR CONSULTA','MENSAJE DEL SISTEMA');
            }
        });
    }else {
        if (cons_pac == "") { $("#div_cons_pac").css({border: "1px solid red"}); }
        if (cons_cos == "") { $("#div_cons_cos").css({border: "1px solid red"}); }
        if (cons_fch == "") { $("#div_cons_fch").css({border: "1px solid red"}); }
        if (cons_hora == "") { $("#div_cons_hora").css({border: "1px solid red"}); }      
        if (doctor == "") { $("#div_consulta_doct").css({border: "1px solid red"}); }  
        mostraralertas('informe','* los campos marcados de rojo son requeridos','INFORMACION');
        return false;
    }
    
}

function btn_ver_pac(Id){
    
    nombre = $.trim($("#grid_con_pac").getCell(Id,"nombre"));  
    apellido = $.trim($("#grid_con_pac").getCell(Id,"apellido"));  
    direccion = $.trim($("#grid_con_pac").getCell(Id,"direccion"));
    dni = $.trim($("#grid_con_pac").getCell(Id,"dni"));
    distrito = $.trim($("#grid_con_pac").getCell(Id,"distrito"));
    email = $.trim($("#grid_con_pac").getCell(Id,"email"));
    sexo = $.trim($("#grid_con_pac").getCell(Id,"sexo"));
    telefono = $.trim($("#grid_con_pac").getCell(Id,"telefono"));
    movistar = $.trim($("#grid_con_pac").getCell(Id,"movistar"));
    claro = $.trim($("#grid_con_pac").getCell(Id,"claro"));
    fec_nac = $.trim($("#grid_con_pac").getCell(Id,"fec_nac"));
    dependiente = $.trim($("#grid_con_pac").getCell(Id,"dependiente"));
    seg_id = $.trim($("#grid_con_pac").getCell(Id,"seg_id"));
    seguro="";
    if(seg_id==1){
        seguro="SIN SEGURO";
    }else if(seg_id==2){
        seguro="LA POSITIVA";
    }else if(seg_id==3){
        seguro="CERRO VERDE";
    }
    
    vista_previa_pac('vista_previa_pac',Id+'<br>'+nombre+'<br>'+apellido+'<br>'+direccion+'<br>'+dni+'<br>'+distrito+'<br>'+sexo+'<br>'+fec_nac+'<br>'+telefono+'<br>'+movistar+'<br>'+claro+'<br>'+email+'<br>'+dependiente+'<br>'+seguro);
}

function btn_plan_tratamiento(){
    nom = $.trim($("#grid_con_pac").getCell(ide_trb, "nombre"));
    ape = $.trim($("#grid_con_pac").getCell(ide_trb, "apellido"));
    seg_id = $.trim($("#grid_con_pac").getCell(ide_trb, "seg_id"));
    //trae el numero del tratamiento
    $.ajax({                   
        url: 'pacientes/pacientes/get_num_trat?ide_trb='+ide_trb,
        type: 'GET',
        success: function(data){
            var trat=0;
            if(data=='no'){                
                trat=1;
            }else{
                var pos=data.pop().trat;
                trat = parseInt(pos)+1;                
            }   
            $("#div_trat_numero").val(trat);
            $.ajax({                   
                url: 'pacientes/pacientes/get_consulta_costo?ide_trb='+ide_trb+'&trat_num='+trat,
                type: 'GET',
                success: function(dato){            
                    ///abre el dialogo de crear tratamiento             
                    $("#div_plan_tratamiento").dialog({
                        autoOpen: false, modal: true, height: 510, width: 920, show: {effect: "fade", duration: 500},close: function(event, ui) {         
                            fn_close_tratamiento('todo');
                            cont=1;
                            shorcut_enter=2;
                            document.getElementById('div_trat_seg_id').options.length = 0;
                        }
                    }).dialog('open');
                    nom_com=nom+' '+ape;

                    deshabilitar_ctrl('div_plan_tratamiento','btn_dscto_trat*btn_dscto_trat_dol',true);
                    deshabilitar_ctrl('div_plan_tratamiento','btn_guardar_trat*btn_salir_trat*btn_agregar_insertar',false);
                    limpiar_ctrl('div_plan_tratamiento');
                    llenararajaxtodo_tip_trat('div_trat_des','pacientes/pacientes/listartodo_trat',seg_id,0);
                    llenararajaxtodo_doctor('div_trat_doctor','pacientes/pacientes/listartodo_doc',0); 
                    llenar_combo_seguros(4);
//                    llenararajaxtodo_doctor('div_trat_doctor','pacientes/pacientes/listartodo_ruc',0); 
                    
                    $("#div_trat_pac").val(nom_com);
                    $("#div_trat_id").val(ide_trb);
                    $("#div_trat_seg_id").val(seg_id);
                    $("#div_trat_tip").attr('disabled',true);
                    $("#div_trat_cos").attr('disabled',true);    
                //    $("#btn_dscto_trat_dol").attr('disabled',true);
                    pintar_verde_todo(3);

                    $("#cos_sol_1").val(dato.costo);//coloca el costo de la consulta en el tratamiento
                    $("#div_trat_total").val(dato.costo); 
                    total=parseFloat(dato.costo);
                    shorcut_enter=3;
                },
                error:function(dato){            
                    mensaje_sis('mensaje','NECESITA CREAR UNA CONSULTA NUEVA AL PACIENTE','MENSAJE DEL SISTEMA');            
                }
            });       
        }
    });
    //verifica si el paciente tiene una consulta con el codigo y numero de tratamiento
      
        
}
ver_trat_pac_id=0;
function ver_tratamiento_pac(Id,edad){    
    ver_trat_pac_id=Id;
    nom = $.trim($("#grid_con_pac").getCell(Id, "nombre"));
    ape = $.trim($("#grid_con_pac").getCell(Id, "apellido"));
//    seg_id = $.trim($("#grid_con_pac").getCell(Id, "seg_id"));seg="";   
    nom_com=nom+' '+ape;    
    
    $.ajax({                   
        url: 'pacientes/pacientes/get_num_trat?ide_trb='+Id,
        type: 'GET',
        success: function(data){
            if(data=='no'){
                mensaje_sis('mensaje','EL PACIENTE NO TIENE TRATAMIENTOS','MENSAJE DEL SISTEMA');
                return false; 
            }            
            $("#div_ver_trat_select").empty();
            
            $("#div_ver_tratamiento").dialog({
                autoOpen: false, modal: true, height: 540, width: 900, show: {effect: "fade", duration: 500},close: function() { ver_trat_pac_id=0; }
            }).dialog('open');
            for(i=0;i<=data.length-1;i++){//carga el combo para seleccionar el tratamiento desde la BD
                $('#div_ver_trat_select').append('<option value='+data[i].trat+'>'+'<b>nro: '+data[i].trat+'</b></option>');
            }
            if(trat_global==0){//carga por primera ves el grid
                trat_global=1;                
                grid_ver_tratamiento(Id,data[0].trat); 
                trat_saldo(Id,$('#div_ver_trat_select').val());
            }else if(trat_global==1){//solo actualiza el grid 
                select_ver_trat(data[0].trat);                 
            }
            $("#btn_ver_trat_dscto").hide();////////boton de descuento.........
            $("#hiddendiv_ver_trat_pac").val(Id);
            $("#div_ver_trat_pac").val(nom_com);            
            $("#div_ver_trat_edad").val(edad); 
//            get_dscto_all(Id,1,0);
        },
        error:function(data){
            mensaje_sis('mensaje','EL PACIENTE NO TIENE TRATAMIENTOS','MENSAJE DEL SISTEMA');
        }
    });  
}
var trat_global=0;/// 0 carga por 1ra ves el grid del tratamiento
function grid_ver_tratamiento(pac_id,num_trat){  
    limpiar_ctrl_c_u('div_ver_tratamiento','txt_ver_trat_doc*txt_ver_trat_subtot*txt_ver_trat_dscto*txt_ver_trat_tot');
      
    jQuery("#grid_ver_trat_pac").jqGrid({
            url: 'pacientes/pacientes/get_ver_tratamiento?pac_id='+pac_id+'&num_trat='+num_trat,
            datatype: 'json', mtype: 'GET',
            colNames: ['COD.','NºTRAT', 'DESCRIPCION','Cant.','Cost S/.','Cost $.', 'FECHA','SEGURO','seg_id','DOCTOR','doc_id','esp_tip','esp_cod','Edit','Elim','tot'],
            rowNum: 10, sortname: 'trat_esp_tip', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE TRATAMIENTOS', width: '100%', height: '230', align: "center",
            colModel: [
                {name: 'trat_id', index: 'trat_id', width: 57, resizable: true, align: "center"},
                {name: 'trat_num', index: 'trat_num',hidden:true},
                {name: 'trat_esp_des', index: 'trat_esp_des', width: 280, resizable: true, align: "left"},           
                {name: 'trat_cant', index: 'trat_cant', width: 57, resizable: true, align: "center"},
                {name: 'trat_esp_cos_sol', index: 'trat_esp_cos_sol', width: 60, resizable: true, align: "right"},
                {name: 'trat_esp_cos_dol', index: 'trat_esp_cos_dol', width: 60, resizable: true, align: "right"},
                {name: 'trat_fch', index: 'trat_fch', width: 80, resizable: true, align: "center"}, 
                {name: 'seguro', index: 'seguro', width: 95, resizable: true, align: "left"},
                {name: 'trat_seg_id', index: 'trat_seg_id',hidden:true},
                {name: 'doctor', index: 'doctor',  width: 113, resizable: true, align: "left"},
                {name: 'trat_doc_id', index: 'trat_doc_id',hidden:true},                
                {name: 'trat_esp_tip', index: 'trat_esp_tip',hidden:true},
                {name: 'trat_esp_cod', index: 'trat_esp_cod',hidden:true},                
                {name: 'editar', index: 'eliminar',  width: 35, resizable: true, align: "center"},
                {name: 'eliminar', index: 'eliminar',  width: 35, resizable: true, align: "center"},
                {name: 'ttotal', index: 'ttotal', hidden:true}
            ],
            gridComplete: function () {                       
                //$("#div_ver_trat_ttotal").val($("#grid_ver_trat_pac").getCell(1,"ttotal"));            
            }      
        });
}
cont=1;
total=0;
total_dol=0;
function btn_agregar_insertar(){  
    doc_id=$("#hiddendiv_trat_doctor").val();
    doctor=$("#div_trat_doctor").val();
    tra_des=$("#div_trat_des").val();
    seguro=$("#div_trat_seg_id option:selected").text();
    seg_id=$("#div_trat_seg_id").val();
    
    if(tra_des=="" || doctor==""){
        if (doctor == "") { $("#div_trat_doctor").css({border: "1px solid red"}); }
        if (tra_des == "") { $("#div_trat_des").css({border: "1px solid red"}); }
        mostraralertas('informe','* los campos marcados de rojo son requeridos','INFORMACION');
        return false;
    }else{
        $("#btn_dscto_trat").attr('disabled',false);
        cos_sol=parseFloat($("#div_trat_cos_sol").val());
        cos_dol=parseFloat($("#div_trat_cos_dol").val());
        
        tra_esp_tip=$("#hiddendiv_trat_tip").val();
        tra_esp_cod=$("#hiddendiv_trat_des").val();    
        cont++;   
        if(cont>=5){        
            he=document.getElementById('div_plan_tratamiento').offsetHeight;    
            $("#div_plan_tratamiento").height((he+24)+"px");
        }    
        var newdiv = document.createElement('div');
        newdiv.id='div_dina_'+(cont);
        newdiv.innerHTML=
        "<input type='hidden' id='hidden_dina_esp_tip_"+(cont)+"' value='"+tra_esp_tip+"'/>\n\
        <input type='hidden' id='hidden_dina_esp_cod_"+(cont)+"' value='"+tra_esp_cod+"'/>\n\
        <label class='lbl_din'>"+(cont)+"</label><input class='des_din' type='text' value='"+tra_des+"' id='des_dina_"+(cont)+"' style='width:42%;height: 20px;font-size: 11px;' disabled/>\n\
        <input type='text' id='cant_"+(cont)+"' style='width: 2.5%;height: 20px;font-size: 11px;text-align:right' value='1' onblur='fn_onblur(this);' />\n\
        <input type='hidden' value='"+cos_sol.toFixed(2)+"' id='pre_uni_sol_"+(cont)+"' />\n\
        <input class='cos_din' type='text' value='"+cos_sol.toFixed(2)+"' id='cos_sol_"+(cont)+"' style='font-size: 11px;' />\n\
        <input type='hidden' value='"+cos_dol.toFixed(2)+"' id='pre_uni_dol_"+(cont)+"'/>\n\
        <input class='cos_din' type='text' value='"+cos_dol.toFixed(2)+"' id='cos_dol_"+(cont)+"' style='font-size: 11px;' />\n\
        <input type='hidden' id='hidden_seg_id_din_"+(cont)+"' value='"+seg_id+"'/>\n\
        <input type='text' id='seg_id_din_"+(cont)+"' value='"+seguro+"' style='width:12%;height: 20px;font-size: 11px;' disabled />\n\
        <input type='text' id='doc_id_din_"+(cont)+"' value='"+doctor+"' style='width:20%;height: 20px;font-size: 11px;' disabled/>\n\
        <input type='hidden' id='hidden_doc_id_din_"+(cont)+"' value='"+doc_id+"'/>\n\
        <button onclick='btn_borrar_trat("+(cont)+","+seg_id+","+cos_sol+","+cos_dol+");' class='btn_din' id='btn_eliminar_din_"+(cont)+"' title='Eliminar'> <img src='public/images/x.png' style='width:14px' ></img></button>";            
        document.getElementById('div_tra_dinamico').appendChild(newdiv);          
    //    llenararajaxtodo_doctor('doc_dina_'+(cont),'pacientes/pacientes/listartodo_doc',0); 
    //    <input type='hidden' id='hiddendoc_dina_"+(cont)+"' value=''/>\n\   
    //<label class='lbl_din'>Doctor</label><input style='width:23%;margin-left:1%;' type='text' value='' id='doc_dina_"+(cont)+"'>\n\
    
//        if(cos_dol!=0.00){//habilita edicion texto dolares
//            $("#btn_dscto_trat_dol").attr('disabled',false);
//            $("#cos_sol_"+cont).attr('disabled',true);
//        }else{//habilita edicion soles
//            $("#cos_dol_"+cont).attr('disabled',true);
//        }
    
        for(i=2; i<=cont; i++){ 
            if (i==cont){                
                $("#btn_eliminar_din_"+i).show();
            }else{                
                $("#btn_eliminar_din_"+i).hide();
            }            
        }
//        alert(total +' + '+ cos_sol+ ' = '+(total + cos_sol));
//        alert(total_dol +' + '+ cos_dol+ ' = '+(total_dol + cos_dol));
        
        total=(total + cos_sol); 
        total_dol=(total_dol + cos_dol); 
        
        if(seg_id==1){//pinta de AZUL Y VERDE cuando es SIN SEGURO    
            $("#cos_sol_"+cont).css({ background: "#E0F2FF", border: "1px solid #83CBFF"});
            $("#cos_dol_"+cont).css({ background: "#DEE8DE", border: "1px solid #85AA84"});
        }else{///pinta de rojo (CERRO VERDE/LA POSITIVA)
            $("#cos_sol_"+cont).css({ background: "#FFD0D0", border: "1px solid #FF8080"});
            $("#cos_dol_"+cont).css({ background: "#FFD0D0", border: "1px solid #FF8080"});
        }        
           
        $("#div_trat_tip").val("");
        $("#div_trat_des").val("");
        $("#div_trat_cos_sol").val("");        
        $("#div_trat_cos_dol").val("");      
        $("#div_trat_total").val(total.toFixed(2));
        $("#div_trat_total_dol").val(total_dol.toFixed(2));
        $("#div_trat_des").focus();
    }
}
function btn_borrar_trat(num,seg_id,sol,dol){///borrar los tratamientos 
    var d = document.getElementById("div_tra_dinamico");
    var d_borrar = document.getElementById("div_dina_"+num);
    var throwawayNode = d.removeChild(d_borrar);
    cont--;
     if(seg_id==1){//resta el costo del tratamiento eliminado .. SOLO SIN SEGURO         
        if(dol=="0"){
            total=(total - sol); 
            $("#div_trat_total").val(total.toFixed(2));
        }else{
            total_dol=(total_dol - dol); 
            $("#div_trat_total_dol").val(total_dol.toFixed(2));            
        }
    }
    $("#btn_eliminar_din_"+cont).show();
}

function btn_guardar_tratamiento(num){
    
    trat_num=$.trim($("#div_trat_numero").val());
    pac_id=$.trim($("#div_trat_id").val());
    
    esp_tip=$.trim($("#hidden_dina_esp_tip_"+num).val());
    esp_cod=$.trim($("#hidden_dina_esp_cod_"+num).val());
    esp_des=$.trim($("#des_dina_"+num).val());
    esp_cos=$.trim($("#cos_sol_"+num).val());
    esp_cos_dol=$.trim($("#cos_dol_"+num).val());
    seg_id=$.trim($("#hidden_seg_id_din_"+num).val());
    doc_id=$.trim($("#hidden_doc_id_din_"+num).val());
    cant=$.trim($("#cant_"+num).val());
    
    
    if(pac_id != "" && seg_id != "" && doc_id != "" && esp_des != "" && esp_cos != "" && esp_cos_dol != "" && cant != ""){
        datos=trat_num+'*'+pac_id+'*'+seg_id+'*'+esp_tip+'*'+esp_cod+'*'+esp_des+'*'+esp_cos+'*'+doc_id+'*'+esp_cos_dol+'*'+cant;
        
        $.ajax({                   
            url: 'pacientes/pacientes/insert_tratamiento_pac?datos='+datos,
            type: 'GET',
            success: function(data){  },
            error: function (data) {
                mensaje_sis('mensaje',' ERROR AL GUARDAR TRATAMIENTO','MENSAJE DEL SISTEMA');
            }
        });
//        fn_close_tratamiento('unidad');
    }
}
function btn_guardar_trat_tot(){
    div_dinamico = document.getElementById('div_dina_2');
    if (!div_dinamico){        
        mensaje_sis('mensaje',' NO HAY TRATAMIENTOS PARA GUARDAR','MENSAJE DEL SISTEMA');
    }else{
        for(i=1;i<=cont;i++){
            btn_guardar_tratamiento(i);        
        }
        fn_close_tratamiento('todo');
        $("#div_plan_tratamiento").closest('.ui-dialog').find('.ui-dialog-titlebar-close').show();
        deshabilitar_ctrl('div_plan_tratamiento','btn_limpiar_trat*btn_salir_trat*btn_agregar_insertar',false);
        btn_salir('div_plan_tratamiento');
//        $("#div_trat_doctor").val("");
        
    }    
}
editar_trat_global=0;  // variable que guarda el id del trataminto que se va a editar
function btn_open_editar_trat(trat_id,sol,dol){//esitar el tratamiento uno por uno 
    editar_trat_global=trat_id;
//    pac_id = $.trim($("#div_editar_trat_pac_id").getCell(trat_id,"trat_esp_des"));
    descripcion = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_des"));
    cant = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_cant"));
    sol = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_cos_sol"));
    dol = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_cos_dol"));
    fch = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_fch"));
    seguro = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_seg_id"));
    doc_id = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_doc_id"));
    doctor = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"doctor"));
    
    esp_tip = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_tip"));
    esp_cod = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_cod"));
    $("#div_editar_trat").dialog({
        autoOpen: false, modal: true, height: 320, width: 600, show: {effect: "fade", duration: 500} 
    }).dialog('open');
    
    var a = sol.replace(',','');
    pre_uni_sol=(parseFloat(a)/parseFloat(cant));    
    $("#div_editar_trat_pre_uni_sol").val(pre_uni_sol.toFixed(2));
    
    var b = dol.replace(',','');
    pre_uni_dol=(parseFloat(b)/parseFloat(cant));
    $("#div_editar_trat_pre_uni_dol").val(pre_uni_dol.toFixed(2));
    
    $("#div_editar_trat_codigo").val(trat_id);
    $("#div_editar_trat_trat_num").val($("#div_ver_trat_select").val());
    $("#div_editar_trat_pac_id").val($("#hiddendiv_ver_trat_pac").val());
    $("#div_editar_trat_des").val(descripcion);
    $("#div_editar_trat_cant").val(cant);
    $("#div_editar_trat_sol").val(sol);
    $("#div_editar_trat_dol").val(dol);
    $("#div_editar_trat_fch").val(fch);
    $("#div_editar_trat_seguro").val(seguro);
    $("#div_editar_trat_doctor").val(doctor);
    $("#div_editar_trat_doc_id").val(doc_id);
    
    $("#hiddendiv_editar_trat_tip").val(esp_tip);
    $("#hiddendiv_editar_trat_des").val(esp_cod);
    
    llenararajaxtodo_editar_trat('div_editar_trat_des','pacientes/pacientes/listartodo_trat',seguro,0);
    llenararajaxtodo_doctor('div_editar_trat_doctor','pacientes/pacientes/listartodo_doc',0);
    $("#div_editar_trat_fch").mask("99/99/9999");  
    $("#div_editar_trat_seguro").css({ border: "1px solid #00C000"});
}
function btn_editar_trat(tip){//0 tratamiento / 1 consulta
    if (tip==0){
        fch=$("#div_editar_trat_fch").val();
        codigo=$("#div_editar_trat_codigo").val();
        trat_num=$.trim($("#div_editar_trat_trat_num").val());
        pac_id=$.trim($("#div_editar_trat_pac_id").val());

        esp_tip=$.trim($("#hiddendiv_editar_trat_tip").val());
        esp_cod=$.trim($("#hiddendiv_editar_trat_des").val());
        esp_des=$.trim($("#div_editar_trat_des").val());
        esp_cos=$.trim($("#div_editar_trat_sol").val());
        esp_cos_dol=$.trim($("#div_editar_trat_dol").val());
        seg_id=$.trim($("#div_editar_trat_seguro").val());
        doc_id=$.trim($("#div_editar_trat_doc_id").val());
        cant=$.trim($("#div_editar_trat_cant").val());


        if(pac_id != "" && seg_id != "" && doc_id != "" && esp_des != "" && esp_cos != "" && esp_cos_dol != "" && cant != ""){
            datos=trat_num+'*'+pac_id+'*'+seg_id+'*'+esp_tip+'*'+esp_cod+'*'+esp_des+'*'+esp_cos+'*'+doc_id+'*'+esp_cos_dol+'*'+cant+'*'+codigo+'*'+fch;

            $.ajax({                   
                url: 'pacientes/pacientes/editar_tratamiento?datos='+datos,
                type: 'GET',
                success: function(data){ 
                    select_ver_trat(trat_num);//actualizar grilla ver tratamiento
                    btn_salir('div_editar_trat');
                },
                error: function (data) {
                    mensaje_sis('mensaje',' ERROR AL EDITAR TRATAMIENTO','MENSAJE DEL SISTEMA');
                }
            });    
        }
    }else if(tip==1){
        
        codigo=$("#div_editar_trat_consulta_codigo").val();
        trat_num=$.trim($("#div_editar_trat_consulta_trat_num").val());
        esp_des=$.trim($("#div_editar_trat_consulta_des").val());
        esp_cos=$.trim($("#div_editar_trat_consulta_sol").val());
        fch=$("#div_editar_trat_consulta_fch").val();
        
        if( fch != "" && esp_cos != "" && esp_des != "" ){
            datos=codigo+'*'+trat_num+'*'+esp_des+'*'+esp_cos+'*'+fch;

            $.ajax({                   
                url: 'pacientes/pacientes/editar_trat_consulta?datos='+datos,
                type: 'GET',
                success: function(data){ 
                    select_ver_trat(trat_num);//actualizar grilla ver tratamiento
                    btn_salir('div_editar_trat_consulta');
                },
                error: function (data) {
                    mensaje_sis('mensaje',' ERROR AL EDITAR CONSULTA','MENSAJE DEL SISTEMA');
                }
            });    
        }
    }
    
}

function btn_open_editar_consulta(trat_id){
    descripcion = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_des"));
    fch = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_fch"));
    sol = $.trim($("#grid_ver_trat_pac").getCell(trat_id,"trat_esp_cos_sol"));
    $("#div_editar_trat_consulta").dialog({
        autoOpen: false, modal: true, height: 280, width: 500, show: {effect: "fade", duration: 500} 
    }).dialog('open');
    $("#div_editar_trat_consulta_codigo").val(trat_id);
    $("#div_editar_trat_consulta_trat_num").val($("#div_ver_trat_select").val());
    $("#div_editar_trat_consulta_pac_id").val($("#hiddendiv_ver_trat_pac").val());
    $("#div_editar_trat_consulta_des").val(descripcion);
    $("#div_editar_trat_consulta_sol").val(sol);
    $("#div_editar_trat_consulta_fch").val(fch);
    $("#div_editar_trat_consulta_fch").mask("99/99/9999"); 
}

function btn_eliminar_trat(trat_id){
    trat_num=$("#div_ver_trat_select").val();
    $.ajax({                   
        url: 'pacientes/pacientes/eliminar_tratamiento?trat_id='+trat_id,
        type: 'GET',
        success: function(data){
            if(data=='si'){
                select_ver_trat(trat_num); //actualiza la grilla despues de eliminar el tratamiento 
            }else{mensaje_sis('mensaje',' ERROR AL ELIMINAR TRATAMIENTO','MENSAJE DEL SISTEMA');}
        },
        error: function(data){
            mensaje_sis('mensaje',' ERROR AL ELIMINAR TRATAMIENTO','MENSAJE DEL SISTEMA');
        }
    });
    
}

function btn_dscto_trat_dol(){
    
    nom = $.trim($("#grid_con_pac").getCell(ide_trb, "nombre"));
    ape = $.trim($("#grid_con_pac").getCell(ide_trb, "apellido"));
    nom_com=nom+' '+ape;
    trat_num=$("#div_trat_numero").val();
    subtot =$("#div_trat_total_dol").val();
     
        $("#div_pac_dscto_dol").dialog({
            autoOpen: false, modal: true, height: 360, width: 550, show: {effect: "fade", duration: 500} 
        }).dialog('open');
        
        limpiar_ctrl_c_u('div_pac_dscto_dol','div_dscto_des_dol*div_dscto_dscto_dol*div_dscto_tot_dol');
        $("#div_dscto_pac_dol").val(nom_com);
        $("#hiddendiv_dscto_pac_dol").val(ide_trb);
        $("#div_dscto_trat_num_dol").val(trat_num);
        $("#div_dscto_subtot_dol").val(subtot);
}
function btn_dscto_trat(){//0 soles / 1 dolares
    nom = $.trim($("#grid_con_pac").getCell(ide_trb, "nombre"));
    ape = $.trim($("#grid_con_pac").getCell(ide_trb, "apellido"));
    nom_com=nom+' '+ape;
    trat_num=$("#div_trat_numero").val();
    
    subtot =$("#div_trat_total").val();
    $("#div_pac_dscto").dialog({
        autoOpen: false, modal: true, height: 360, width: 550, show: {effect: "fade", duration: 500} 
    }).dialog('open');
    limpiar_ctrl_c_u('div_pac_dscto','div_dscto_des*div_dscto_dscto*div_dscto_tot');
    $("#div_dscto_pac").val(nom_com);
    $("#hiddendiv_dscto_pac").val(ide_trb);
    $("#div_dscto_trat_num").val(trat_num);
    $("#div_dscto_subtot").val(subtot);
           
}
not_close_plan_trat=1;// variable para no poder cerrar el dialogo sin guardar antes el tratamiento
function btn_insert_dscto(){
    pac_id=$("#hiddendiv_dscto_pac").val();
    trat_num=$("#div_dscto_trat_num").val();
    trat_subtot=$("#div_dscto_subtot").val();
    dscto=$("#div_dscto_dscto").val();
    trat_tot=$("#div_dscto_tot").val();
    des=$("#div_dscto_des").val();
    porcent=$("#div_dscto_porcent").val();
    if(pac_id != "" && trat_num != "" && trat_subtot != "" && dscto != "" && trat_tot != "" && des != "" && porcent != ""){
        datos=pac_id+'*'+trat_num+'*'+trat_subtot+'*'+dscto+'*'+trat_tot+'*'+des.toUpperCase()+'*'+porcent;
        $.ajax({                   
            url: 'pacientes/pacientes/insert_dscto_trat?datos='+datos,
            type: 'GET',
            success: function(data){ 
                 if(data=='si'){ 
                     deshabilitar_ctrl('div_plan_tratamiento','btn_dscto_trat*btn_limpiar_trat*btn_salir_trat*btn_agregar_insertar',true);
                     deshabilitar_ctrl('div_plan_tratamiento','btn_guardar_trat',false);
                     not_close_plan_trat=0;
                     $("#div_plan_tratamiento").closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
//                     mensaje_sis('mensaje',' DESCUENTO GUARDADO <br> AHORA GUARDE EL TRATAMIENTO','MENSAJE DEL SISTEMA'); 
                     btn_salir('div_pac_dscto');   
                     parpadear('btn_guardar_trat');}                     
            },
            error: function (data) {
                mensaje_sis('mensaje',' ERROR AL GUARDAR TRATAMIENTO','MENSAJE DEL SISTEMA');
            }
        });
    }
    
}
function btn_insert_dscto_dol(){
    pac_id=$("#hiddendiv_dscto_pac_dol").val();
    trat_num=$("#div_dscto_trat_num_dol").val();
    trat_subtot=$("#div_dscto_subtot_dol").val();
    dscto=$("#div_dscto_dscto_dol").val();
    trat_tot=$("#div_dscto_tot_dol").val();
    des=$("#div_dscto_des_dol").val();
    porcent=$("#div_dscto_porcent_dol").val();
    if(pac_id != "" && trat_num != "" && trat_subtot != "" && dscto != "" && trat_tot != "" && des != ""  && porcent != ""){
        datos=pac_id+'*'+trat_num+'*'+trat_subtot+'*'+dscto+'*'+trat_tot+'*'+des.toUpperCase()+'*'+porcent;
        $.ajax({                   
            url: 'pacientes/pacientes/insert_dscto_trat_dol?datos='+datos,
            type: 'GET',
            success: function(data){ 
                 if(data=='si'){ 
                     deshabilitar_ctrl('div_plan_tratamiento','btn_dscto_trat*btn_limpiar_trat*btn_salir_trat*btn_agregar_insertar',true);
                     deshabilitar_ctrl('div_plan_tratamiento','btn_dscto_trat_dol',false);
                     not_close_plan_trat=0;
                     $("#div_plan_tratamiento").closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
//                     mensaje_sis('mensaje',' DESCUENTO GUARDADO <br> AHORA GUARDE EL TRATAMIENTO','MENSAJE DEL SISTEMA'); 
                     btn_salir('div_pac_dscto_dol');   
                     parpadear('btn_guardar_trat');}                     
            },
            error: function (data) {
                mensaje_sis('mensaje',' ERROR AL GUARDAR TRATAMIENTO','MENSAJE DEL SISTEMA');
            }
        });
    }
    
}

function btn_ver_vista_previa_dscto(){    
    pac_id=$.trim($("#hiddendiv_ver_trat_pac").val());
    nom_com=$.trim($("#div_ver_trat_pac").val());
    trat_num=$("#div_ver_trat_select").val();
    
    $("#div_pac_dscto").dialog({
        autoOpen: false, modal: true, height: 340, width: 550, show: {effect: "fade", duration: 500} 
    }).dialog('open');
    limpiar_ctrl_c_u('div_pac_dscto','div_dscto_des*div_dscto_dscto*div_dscto_tot');
    $("#div_dscto_pac").val(nom_com);
    $("#hiddendiv_dscto_pac").val(pac_id);
    $("#div_dscto_trat_num").val(trat_num);
    get_dscto_all(pac_id,trat_num,1);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function llenararajaxtodo_tip_trat(textbox,url,seg_id,val){
    $.ajax({
           type: 'GET',
           url: url+'?seg_id='+seg_id,
           success: function(data){
                var $local_sourcedoctotodo=data;          
                 $("#"+textbox).autocomplete({
                      source: $local_sourcedoctotodo,
                      focus: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);
                             $("#hidden"+textbox).val(ui.item.value);
                             $("#"+textbox).attr('maxlength', ui.item.label.length);
                             $("#div_trat_cos_sol").val(ui.item.sol);
                             $("#div_trat_cos_dol").val(ui.item.dol);
                             $("#div_trat_tip").val(ui.item.esp_tip_des);
                             $("#hiddendiv_trat_tip").val(ui.item.esp_tip); 
                             return false;
                      },
                      select: function(event, ui) {
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value); 
                              $("#div_trat_cos_sol").val(ui.item.sol);
                              $("#div_trat_cos_dol").val(ui.item.dol);                              
                              $("#div_trat_tip").val(ui.item.esp_tip_des);
                              $("#hiddendiv_trat_tip").val(ui.item.esp_tip);
                              return false;
                      }   
                  });             
            }
    });
}

function llenararajaxtodo_editar_trat(textbox,url,seg_id,val){
    $.ajax({
           type: 'GET',
           url: url+'?seg_id='+seg_id,
           success: function(data){
                var $local_sourcedoctotodo=data;          
                 $("#"+textbox).autocomplete({
                      source: $local_sourcedoctotodo,
                      focus: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);
                             $("#hidden"+textbox).val(ui.item.value);
                             $("#"+textbox).attr('maxlength', ui.item.label.length);
                             $("#div_editar_trat_sol").val(ui.item.sol);
                             $("#div_editar_trat_dol").val(ui.item.dol);
                             //$("#div_trat_tip").val(ui.item.esp_tip_des);
                             $("#hiddendiv_editar_trat_tip").val(ui.item.esp_tip); 
                             return false;
                      },
                      select: function(event, ui) {
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value); 
                              $("#div_editar_trat_sol").val(ui.item.sol);
                              $("#div_editar_trat_dol").val(ui.item.dol);                              
                              //$("#div_trat_tip").val(ui.item.esp_tip_des);
                              $("#hiddendiv_trat_tip").val(ui.item.esp_tip);
                              $("#div_editar_trat_cant").val(1);
                              $("#div_editar_trat_pre_uni_sol").val(ui.item.sol);
                              $("#div_editar_trat_pre_uni_dol").val(ui.item.dol);
                              return false;
                      }   
                  });             
            }
    });
}

function llenararajaxtodo_doctor(textbox,url,val){
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
                             $("#"+textbox).attr('maxlength', ui.item.label.length);
                             $("#div_editar_trat_doc_id").val(ui.item.value);
                             $("#hiddennew_evol").val(ui.item.value);
                             switch(val){
                                 case 3: //consulta
                                     $("#hiddendiv_consulta_doct").val(ui.item.value);
                                     
                             }
                             
                             return false;
                      },
                      select: function(event, ui) {
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value);
                              $("#div_editar_trat_doc_id").val(ui.item.value);
                              $("#hiddennew_evol").val(ui.item.value);
                              switch(val){
                                 case 3: //consulta
                                     $("#hiddendiv_consulta_doct").val(ui.item.value);
                                     
                             }
                              return false;
                      }   
                  });             
            }
    });
}

function fn_close_tratamiento(tipo){
    if(tipo=='todo'){
        for(i=2;i<=cont;i++){
            delete_div = document.getElementById('div_dina_'+i);
            if (!delete_div){
                alert("El elemento selecionado no existe");
            } else {
                padre = delete_div.parentNode;
                padre.removeChild(delete_div);
            }
        }
        cont=0;total=0;total_dol=0;
        $("#div_trat_total").val("");
        $("#div_trat_total_dol").val("");
    }else if(tipo=='unidad'){
        
    }    
}

function btn_actualizar(){
    $("#txtbuscar_pac").val("");
    $("#grid_con_pac").setGridParam({serach:false,searchdata: {},page:1}).trigger("reloadGrid");
//    $("#btn_consulta_pac").attr('disabled',true);  
//    $("#btn_plan_trat_pac").attr('disabled',true);
    deshabilitar_ctrl('div_pac_reg','btn_consulta_pac*btn_plan_trat_pac*btn_evolucion',true);
//    deshabilitar_ctrl('div_pac_reg','btn_actualizar_pac*btn_consulta_pac*btn_nuevo_pac');  
    fn_buscar_pac();
    
//    jQuery("#grid_con_especialidad").jqGrid('setGridParam', {
//        url: 'pacientes/administracion/get_especialidad_des?seg_id=' + seguro_id_global + '&esp_tip=' + esp_tip
//    }).trigger('reloadGrid');
   
}

function pintar_verde_todo(tip){
    switch (tip) {
        case 1://registro            
            $("#nombre").css({ border: "1px solid #7DCE73"});
            $("#apellidos").css({ border: "1px solid #7DCE73"});
            $("#direccion").css({ border: "1px solid #7DCE73"});
            $("#dni").css({ border: "1px solid #7DCE73"});
        //    $("#distrito").css({ border: "1px solid #7DCE73"});
            $("#sexo").css({ border: "1px solid #7DCE73"});
            $("#fchnac").css({ border: "1px solid #7DCE73"});
        //    $("#email").css({ border: "1px solid #7DCE73"});
            $("#seguro").css({ border: "1px solid #7DCE73"});
           break
        case 2:///consulta            
            $("#div_cons_cos").css({ border: "1px solid #7DCE73"});
            $("#div_cons_fch").css({ border: "1px solid #7DCE73"});
            $("#div_cons_hora").css({ border: "1px solid #7DCE73"});
            $("#div_consulta_doct").css({ border: "1px solid #7DCE73"});            
           break
        case 3:// nuevo tratamiento para llenar
            $("#div_trat_doctor").css({ border: "1px solid #7DCE73"});
            $("#div_trat_des").css({ border: "1px solid #7DCE73"});
            $("#div_trat_seg_id").css({ border: "1px solid #7DCE73"});
            $("#btn_agregar_insertar").css({ border: "1px solid #7DCE73"});
           break
        case 4:

           break
        case 5:

           break
        case 6:
        case 7:

           break
        case 15: ///// nueva evolucion 15
            $("#new_evol_fch").css({ border: "1px solid #7DCE73"});
            $("#new_evol_hora").css({ border: "1px solid #7DCE73"});
            $("#new_evol_des").css({ border: "1px solid #7DCE73"});
            $("#new_evol_doctor").css({ border: "1px solid #7DCE73"});
            $("#new_evol_pro_fch").css({ border: "1px solid #7DCE73"});
            $("#new_evol_prox_hora").css({ border: "1px solid #7DCE73"});
            $("#new_evol_prox_des").css({ border: "1px solid #7DCE73"});
         break;
        default:
          
    } 
    
    
    ///doctores
    $("#txtadm_doc_nom").css({ border: "1px solid #7DCE73"});
    $("#txtadm_doc_ape").css({ border: "1px solid #7DCE73"});
    $("#txtadm_doc_uni").css({ border: "1px solid #7DCE73"});
    $("#txtadm_doc_cop").css({ border: "1px solid #7DCE73"});
    
    $("#txtadm_doc_dir").css({ border: "1px solid #7DCE73"});
    $("#txtadm_doc_email").css({ border: "1px solid #7DCE73"});
    $("#txtadm_doc_cel").css({ border: "1px solid #7DCE73"});
    $("#txtadm_doc_fijo").css({ border: "1px solid #7DCE73"});
    ///realizar pago
    $("#div_pac_rea_pago_cos").css({ border: "1px solid #7DCE73"});
    $("#div_pac_rea_pago_fch").css({ border: "1px solid #7DCE73"});
    $("#div_pac_rea_pago_num_fac_bol").css({ border: "1px solid #7DCE73"});
    ///realizar pago en dolares
    $("#div_pac_rea_pago_dol_cos").css({ border: "1px solid #7DCE73"});
    $("#div_pac_rea_pago_dol_fch").css({ border: "1px solid #7DCE73"});
    $("#div_pac_rea_pago_dol_num_fac_bol").css({ border: "1px solid #7DCE73"});
    /// evaluacion
    $("#div_pac_evol_fch_act").css({ border: "1px solid #7DCE73"});
    $("#div_pac_evol_act_des").css({ border: "1px solid #7DCE73"});
    $("#div_pac_evol_pro_acti_fch").css({ border: "1px solid #7DCE73"});
    $("#div_pac_evol_pro_acti_des").css({ border: "1px solid #7DCE73"});
    //nueva tratamiento
    $("#div_adm_nueva_esp_des").css({ border: "1px solid #7DCE73"});
    $("#div_adm_nueva_esp_cos").css({ border: "1px solid #7DCE73"});
    //nuevo usuario
    $("#txt_divnuevousu_nomcom").css({ border: "1px solid #7DCE73"});
    $("#txt_divnuevousu_email").css({ border: "1px solid #7DCE73"});
    $("#txt_divnuevousu_user").css({ border: "1px solid #7DCE73"});
    $("#div_nuevo_usu_c").css({ border: "1px solid #7DCE73"});
    $("#div_nuevo_usu_rep_c").css({ border: "1px solid #7DCE73"});
    //nuevo ruc
    $("#div_reg_ruc_raz_soc").css({ border: "1px solid #7DCE73"});
    $("#div_reg_ruc_num_ruc").css({ border: "1px solid #7DCE73"});
    $("#div_reg_ruc_dir").css({ border: "1px solid #7DCE73"});
    //pagar con factura////
    $("#div_pac_realizar_pago_factura_ruc").css({ border: "1px solid #7DCE73"});
    $("#div_razon_soc_factura").css({ border: "1px solid #7DCE73"});
    $("#div_pac_realizar_pago_factura_fch").css({ border: "1px solid #7DCE73"});
    
    $("#div_adm_nueva_esp_seg").css({ border: "1px solid #7DCE73"});
    $("#div_adm_nueva_esp_tipo").css({ border: "1px solid #7DCE73"});
    
    
   
    
    
    
}

function limpiar_ctrl(div){
        $(':input', '#' + div).each(function() {
            if (this.type === 'text') {  
                if ( $(this).attr('disabled') ) {
                    //no hase nada
                }else{ this.value = '';  }
                    
            }else if ($(this).is('select')){
//                if ($(this).is(':hidden')) {
                    this.value = '1';
                    this.value = 'select';
//                }
            }else if (this.type === 'radio'){
                this.checked = false;
            }else if (this.type === 'textarea'){
                this.value = '';
            }else if (this.type === 'password'){
                this.value = '';
            }
            
        });
}
function limpiar_ctrl_c_u(div,noctrl){
    var crtls = noctrl.split("*");
    
     $(':input', '#' + div).each(function(){
        for(i=0;i<=crtls.length-1;i++){                   
            if($(this).attr("id")===crtls[i]){   
                $("#"+crtls[i]).val("");                         
            }
        }   
    });
}
    
function deshabilitar_ctrl(div,noctrl,act){
    var crtls = noctrl.split("*");
    
     $(':input', '#' + div).each(function() 
     {
            if (this.type === 'submit') 
            {  
                for(i=0;i<=crtls.length-1;i++){                   
                    if($(this).attr("id")===crtls[i]){                           
                        $("#"+crtls[i]).attr('disabled',act);                        
                    }
//                    else if($(this).attr("id")!==crtls[i]){
//                        $("#"+crtls[i]).attr('disabled',false); 
//                    }
                }                   
            }           
    });
}

function datepiker(ide_input_datepiker,ini,fin){
    $.datepicker.regional['es'] =
	  {
	  closeText: 'Cerrar',
	  prevText: 'Previo',
	  nextText: 'Próximo',
	   
	  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
	  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	  monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
	  monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
	  dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
	  dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
	  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
	  dateFormat: 'dd/mm/yy', firstDay: 1,
	  initStatus: 'Selecciona la fecha', isRTL: false
      };
	 $.datepicker.setDefaults($.datepicker.regional['es']);

	 //miDate: fecha de comienzo D=días | M=mes | Y=año
	 //maxDate: fecha tope D=días | M=mes | Y=año
	 $("#"+ide_input_datepiker).datepicker({ minDate: ini, maxDate: fin});
         $("#"+ide_input_datepiker).css({ border: "1px solid #7DCE73"}); 
}

function timepiker(ide_input_timepiker){
    $('#'+ide_input_timepiker).timepicker({
        showPeriod: true,
        onHourShow: OnHourShowCallback,
        onMinuteShow: OnMinuteShowCallback
    });
}
function OnHourShowCallback(hour) {
    if ((hour > 20) || (hour < 6)) {
        return false; // not valid
    }
    return true; // valid
}
function OnMinuteShowCallback(hour, minute) {
    if ((hour == 20) && (minute >= 30)) { return false; } // not valid
    if ((hour == 6) && (minute < 30)) { return false; }   // not valid
    return true;  // valid
}
function fn_onblur(input) {
    
    
    if (input.value == "" || !input.value) {
//        mostraralertas('* campo requerido'); 
//        $('body').animate({
//            'background-color': '#00C000',
//            'position' : 'absolute'
//        }, 900);

        $("#" + input.id).css({border: "1px solid red"});
        $("#" + input.id).focus();
//        $("#registrar").attr("disabled", true);
    } else {
        $("#" + input.id).css({border: "1px solid #00C000"});
//        $("#registrar").attr("disabled", false);
    }
    
//    if (input.id == "email" || input.id=="txt_divnuevousu_email") {
//        expr = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
//        if (!expr.test($.trim(input.value))) {
//            $("#" + input.id).css({border: "1px solid red"});
//            mostraralertas('informe','* email no valido','INFORMACION');
//        }
//    }//para valida el email..
//    
//    if(input.id == "div_dscto_dscto"){       
//        subtot =$("#div_trat_total").val();
//        dscto = parseFloat(input.value);
//        total = (subtot-dscto).toFixed(2);
//        $("#" + input.id).val(dscto.toFixed(2));
//        $("#div_dscto_tot").val(total);
//    }
//    if(input.id == "div_dscto_dscto_dol"){       
//        subtot =$("#div_trat_total_dol").val();
//        dscto = parseFloat(input.value);
//        total = (subtot-dscto).toFixed(2);
//        $("#" + input.id).val(dscto.toFixed(2));
//        $("#div_dscto_tot_dol").val(total);
//    }
    if(input.id == "div_pac_rea_pago_cos"){ 
        var a = $("#div_realizar_pago_saldo").val();        
        var b = a.replace(',','');        
        
        saldo=parseFloat(b);          
        monto=parseFloat(input.value).toFixed(2);

        if(monto <= saldo){
            pag_monto = formato_numero(input.value,2,'.',',');        
            $("#" + input.id).val(pag_monto);
        }else{
            mostraralertas('informe','* monto excedido <br>* El saldo es de '+formato_numero(saldo,2,'.',',')+' soles','INFORMACION');
            $("#" + input.id).val("");
        }       
    }
    if(input.id == "div_pac_rea_pago_dol_cos"){ 
        var a = $("#div_realizar_pago_saldo_dol").val();
        var b = a.replace(',','');
        
        saldo=parseFloat(b);          
        monto=parseFloat(input.value).toFixed(2);

        if(monto <= saldo){
            pag_monto = formato_numero(input.value,2,'.',',');        
            $("#" + input.id).val(pag_monto);
        }else{
            mostraralertas('informe','* monto excedido <br>* El saldo es de '+formato_numero(saldo,2,'.',',')+' soles','INFORMACION');
            $("#" + input.id).val("");
        }       
    }
    if(input.id == "div_adm_nueva_esp_cos" || input.id=="div_cons_cos" || input.id=="div_editar_trat_sol" || input.id=="div_editar_trat_dol" || input.id=="div_adm_nueva_esp_cos"){ 
        
        var a = $("#"+input.id).val(); 
        
        var b = a.replace(',',''); 
            bb= parseFloat(b).toFixed(2);
        $("#" + input.id).val(bb);
    }
    
    if(input.id == "div_dscto_porcent"){   
        monto=parseFloat($("#div_dscto_subtot").val());
        porc=input.value;
        des=(monto*porc)/100;
        $("#div_dscto_dscto").val(des.toFixed(2));
        $("#div_dscto_tot").val((monto-des).toFixed(2));
        
    }
    if(input.id == "div_dscto_porcent_dol"){   
        monto=parseFloat($("#div_dscto_subtot_dol").val());
        porc=input.value;
        des=(monto*porc)/100;
        $("#div_dscto_dscto_dol").val(des.toFixed(2));
        $("#div_dscto_tot_dol").val((monto-des).toFixed(2));
        
    }
    if(input.id == "div_pac_realizar_pago_factura_monto"){ //validar monto para la factura
        var a = $("#div_realizar_pago_saldo_fac").val();
        var b = a.replace(',','');
        
        saldo=parseFloat(b);          
        monto=parseFloat(input.value).toFixed(2);

        if(monto <= saldo){
            pag_monto = formato_numero(input.value,2,'.',',');        
            $("#" + input.id).val(pag_monto);
        }else{
            mostraralertas('informe','* monto excedido <br>* El saldo es de '+formato_numero(saldo,2,'.',',')+' soles','INFORMACION');
            $("#" + input.id).val("");
        }       
    }
    
    if(input.id == "div_editar_trat_cant"){//para multiplicar al editar el tratamiento
        sol=$("#div_editar_trat_pre_uni_sol").val();
        dol=$("#div_editar_trat_pre_uni_dol").val();
        cant = input.value;
        var b = sol.replace(',','');
        var bb = dol.replace(',','');
        
        $("#div_editar_trat_sol").val((b*cant).toFixed(2));
        $("#div_editar_trat_dol").val((bb*cant).toFixed(2));
        
    }
   
    multi=(input.id).substring(0,5); 
    
    if(multi == "cant_"){ 
         
         num=(input.id).substring(5);
         cant=input.value;
         
         var a = $("#pre_uni_sol_"+num).val();      
         var b = a.replace(',','');       
         pre_uni_sol=parseFloat(b);        
         precio=(pre_uni_sol*parseInt(cant));
         
                 
         var aa = $("#pre_uni_dol_"+num).val();        
         var bb = aa.replace(',','');       
         pre_uni_dol=parseFloat(bb);         
         precio_d=(pre_uni_dol*parseInt(cant));
         
         $("#cos_sol_"+num).val(formato_numero(precio,2,'.',','));
         $("#cos_dol_"+num).val(formato_numero(precio_d,2,'.',','));
         
    }
}

function fn_load_seguro(seg_id){
    llenararajaxtodo_tip_trat('div_trat_des','pacientes/pacientes/listartodo_trat',seg_id,0);
}

function select_ver_trat(cbo_trat){  
    jQuery("#grid_ver_trat_pac").jqGrid('setGridParam', {
        url: 'pacientes/pacientes/get_ver_tratamiento?pac_id='+ver_trat_pac_id+'&num_trat='+cbo_trat
    }).trigger('reloadGrid');
    limpiar_ctrl_c_u('div_ver_tratamiento','txt_ver_trat_subtot*txt_ver_trat_dscto*txt_ver_trat_tot');
//    get_dscto_all(ver_trat_pac_id,cbo_trat,0);
    trat_saldo(ver_trat_pac_id,$('#div_ver_trat_select').val());
}
//0 para llenar cajas de grid
//1 para llenar la vista previa al hacer click en ver descuentos
function get_dscto_all(pac_id,num_trat,num_type){
    datos=pac_id+'*'+num_trat;
    $.ajax({                   
        url: 'pacientes/pacientes/get_ver_dscto?datos='+datos,
        type: 'GET',
        success: function(data){
            if(num_type==0){
                if(data[0]){//si hay datos que mostrar llena las cajas de texto
                    $("#txt_ver_trat_subtot").val(data[0].subtot);
                    $("#txt_ver_trat_dscto").val(data[0].dscto);
                    $("#txt_ver_trat_tot").val(data[0].tot);
                    $("#btn_ver_trat_dscto").show();
                }else{
                    $("#btn_ver_trat_dscto").hide();
                } 
            }else if(num_type==1){
                if(data[0]){
                    $("#div_dscto_subtot").val(data[0].subtot);
                    $("#div_dscto_dscto").val(data[0].dscto);
                    $("#div_dscto_tot").val(data[0].tot);
                    $("#div_dscto_des").val(data[0].des);
                    $("#btn_dscto_guardar").hide();
                }
            }                       
        }
    });
}

function calc(tip){    
    
    if(tip==0){
        sum_sol=0;
        for(i=1; i<=cont; i++){   
//            seg = $("#hidden_seg_id_din_"+i).val();//calcula la suma SOLES de todo el tratamiento SIN DISTINCION DE SEGUROS      
            var a = $("#cos_sol_"+i).val();      
            var b = a.replace(',','');           
            sum_sol+= parseFloat(b);
        }
        $("#div_trat_total").val(formato_numero(sum_sol,2,'.',','));
//        total=parseFloat(sum_sol.toFixed(2));
    }else{
        sum_dol=0;
        for(i=1; i<=cont; i++){                                     
//            seg = $("#hidden_seg_id_din_"+i).val();// calcula la suma  de todo el tratamiento SIN DISTINCION DE SEGUROS  
            var a = $("#cos_dol_"+i).val();      
            var b = a.replace(',','');           
            sum_dol+= parseFloat(b);
                        
        }
        $("#div_trat_total_dol").val(formato_numero(sum_dol,2,'.',','));
//        total_dol=parseFloat(sum_dol.toFixed(2));
    }
}



    ///abre el dialogo de crear tratamiento             
//            $("#div_plan_tratamiento").dialog({
//                autoOpen: false, modal: true, height: 510, width: 920, show: {effect: "fade", duration: 500},close: function(event, ui) { 
//        //            if(not_close_plan_trat==1){
//                        fn_close_tratamiento('todo');
//        //            }else if(not_close_plan_trat==0){
//        //                $("#div_plan_tratamiento").dialog({
//        //                    beforeClose: function (event, ui) { false; },
//        //                    closeOnEscape: false 
//        //                });                
//        //                mensaje_sis('mensaje',' DEVE GUARDAR EL TRATAMIENTO PARA CERRAR','MENSAJE DEL SISTEMA');                 
//        //            } 
//                }
//            }).dialog('open');