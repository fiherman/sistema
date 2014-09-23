var patron = new Array(2, 2, 4);
function mascara(d, sep  )//nums  pat
{
    if (d.valant !== d.value) {
        val = d.value;
        largo = val.length;
        val = val.split(sep);
        val2 = '';
        for (r = 0; r < val.length; r++)
        {
            val2 += val[r];
        }
//        if (nums) {
//            for (z = 0; z < val2.length; z++) {
//                if (isNaN(val2.charAt(z))) {
//                    letra = new RegExp(val2.charAt(z), "g");
//                    val2 = val2.replace(letra, "");
//                }
//            }
//        }
        val = '';
        val3 = new Array();
//        for (s = 0; s < pat.length; s++)
//        {
//            val3[s] = val2.substring(0, pat[s]);
//            val2 = val2.substr(pat[s]);
//        }
        for (q = 0; q < val3.length; q++) {
            if (q === 0)
            {
                val = val3[q];
            }
            else
            {
                if (val3[q] !== "")
                {
                    val += sep + val3[q];
                }
            }
        }
        d.value = val;
        d.valant = val;
    }
}
function justNumbers(e)
{

    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum === 8) || (keynum === 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}



function soloNumeroTab(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) &&  charCode == 190 && charCode == 110 &&  charCode != 123 &&  charCode != 116)
        return false;

    return true;
}
function mostraralertas(div, texto, tit) {

//    $("#ojo").show();
//    $("#ojo").html('<p><b>'+texto+'</b></p>'+'<button class="btn_alert_close" onclick="fn_close_alert(0);">Aceptar</button>');
//        $("#"+type).html('<button onclick="">Aceptar</button>');
    $("#" + div).dialog({
        autoOpen: false, modal: true, title: tit, height: 180, width: 400, show: {effect: "fade", duration: 300},
        buttons: [
            {text: "Aceptar", click: function() {
                    $(this).dialog("close");
                }}
        ]
    }).dialog('open');
    $("#" + div).html('<p class="info"><b>' + texto + '</b></p>');
}
function mensaje_sis(div, texto, tit) {

//    $("#ojo").show();
//    $("#ojo").html('<p><b>'+texto+'</b></p>'+'<button class="btn_alert_close" onclick="fn_close_alert(0);">Aceptar</button>');
//        $("#"+type).html('<button onclick="">Aceptar</button>');
    $("#" + div).dialog({
        autoOpen: false, modal: true, title: tit, height: 150, width: 350, show: {effect: "fade", duration: 300},
        buttons: [
            {text: "Aceptar", click: function() {
                    $(this).dialog("close");
                }}
        ]
    }).dialog('open');
    $("#" + div).html('<p class="info"><b>' + texto + '</b></p>');
}
function vista_previa_pac(div, texto) {

//    $("#ojo").show();
//    $("#ojo").html('<p><b>'+texto+'</b></p>'+'<button class="btn_alert_close" onclick="fn_close_alert(0);">Aceptar</button>');
//        $("#"+type).html('<button onclick="">Aceptar</button>');
    $("#" + div).dialog({
        autoOpen: false, modal: true, height: 390, width: 480, show: {effect: "fade", duration: 300},
        buttons: [
            {text: "Cerrar", click: function() {
                    $(this).dialog("close");
                }}
        ]
    }).dialog('open');
    $("#texto_paciente").html('<p>' + texto + '</p>');
}
function vista_previa_doc(div, texto) {
    $("#" + div).dialog({
        autoOpen: false, modal: true, height: 270, width: 550, show: {effect: "fade", duration: 300},
        buttons: [
            {text: "Cerrar", click: function() {
                    $(this).dialog("close");
                }}
        ]
    }).dialog('open');
    $("#texto_doctor").html('<p>' + texto + '</p>');
}
function vista_previa_cita(div, texto) {
    $("#" + div).dialog({
        autoOpen: false, modal: true, height: 250, width: 570, show: {effect: "fade", duration: 300},
        buttons: [
            {
                text: "Cerrar", click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    }).dialog('open');
    $("#texto_cita").html('<p>' + texto + '</p>');
}
function confirmar() {

    $("#confirmar").show();
    $("#confirmar").html('<p style="margin-top: 5%;"><b>Esta seguro de completar esta accion..¡</b></p>' + '<button style="margin-right: 3%;" class="btn_confirm" onclick="fn_aceptar_confirm();">Aceptar</button>' + '<button style="margin-left: 3%;" class="btn_confirm" onclick="fn_close_alert(1);">Cancelar</button>');
//        $("#"+type).html('<button onclick="">Aceptar</button>');
}
var focoglobal = "";
function mostraralertasconfoco(texto, foco) {
    $("#alertdialog").html('<p>' + texto + '</p>');
    $("#alertdialog").dialog('open');
    focoglobal = foco;
}
function tildes_unicode(rp) {

    rp = rp.replace(/[á]/g, '&aacute;');
    rp = rp.replace(/[é]/g, '&eacute;');
    rp = rp.replace(/[í]/g, '&iacute;');
    rp = rp.replace(/[ó]/g, '&oacute;');
    rp = rp.replace(/[ú]/g, '&uacute;');
    rp = rp.replace(/[ñ]/g, '&ntilde;');
    rp = rp.replace(/[ü]/g, '&uuml;');
    //
    rp = rp.replace(/[Á]/g, '&Aacute;');
    rp = rp.replace(/[É]/g, '&Eacute;');
    rp = rp.replace(/[Í]/g, '&Iacute;');
    rp = rp.replace(/[Ó]/g, '&Oacute;');
    rp = rp.replace(/[Ú]/g, '&Uacute;');
    rp = rp.replace(/[Ñ]/g, '&Ntilde;');
    rp = rp.replace(/[Ü]/g, '&Uuml;');

    return rp;

}
function accentDecode(tx)
{
    var rp = String(tx);
    //
    rp = rp.replace(/&aacute;/g, 'á');
    rp = rp.replace(/&eacute;/g, 'é');
    rp = rp.replace(/&iacute;/g, 'í');
    rp = rp.replace(/&oacute;/g, 'ó');
    rp = rp.replace(/&uacute;/g, 'ú');
    rp = rp.replace(/&ntilde;/g, 'ñ');
    rp = rp.replace(/&uuml;/g, 'ü');
    //
    rp = rp.replace(/&Aacute;/g, 'Á');
    rp = rp.replace(/&Eacute;/g, 'É');
    rp = rp.replace(/&Iacute;/g, 'Í');
    rp = rp.replace(/&Oacute;/g, 'Ó');
    rp = rp.replace(/&Uacute;/g, 'Ú');
    rp = rp.replace(/&Ntilde;/g, 'Ñ');
    rp = rp.replace(/&Üuml;/g, 'Ü');
    //
    return rp;
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

function focusNext(form, elemName, evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode :
            ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 3) {
        document.getElementById(elemName).focus();
        alert("entro");
        return false;
    }
    return true;
}