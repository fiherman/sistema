<?php
class agenda_notas_model extends CI_Model
{
    
    function get_by_ide_pac(){//$ide_per    ano_eje
      date_default_timezone_set('America/Lima');
//        return $this->db->query("select * from agenda_notas WHERE ano_eje = '$ano_eje' AND ide_per = $ide_per ORDER BY ide_not DESC")->result();
      $this->db->query("set names 'utf8';");
        return $this->db->query(" 
            select a.*,(b.nombre || ' ' || b.apellido) as nom_pac,c.age_cons,c.fch_ini from agenda_notas a 
            left join pacientes b on a.ide_per=b.id
            left join agenda c on a.ide_not=c.ide_not 
            WHERE c.fch_ini between '".date('Y-m-d')." 06:00:00' and '".date('Y-m-d')." 19:00:00' 
            ORDER BY ide_not DESC
        ")->result();
    }
    
    function get_consultas_dia(){
        date_default_timezone_set('America/Lima');         
        return $this->db->query(" 
            select * from consulta where cons_fch='".date('d/m/Y')."' 
        ")->result();
    }
    function SaveNota($ide_per,$des_not,$ano_eje,$fch_reg)
    {
        $this->db->query("INSERT INTO tramite.agenda_notas(ide_per,des_not,ano_eje,fch_reg)VALUES($ide_per,'$des_not','$ano_eje','$fch_reg')");
    }
    function show_tool_tip($ide_not)
    {
        return $this->db->query("select ide_per,des_not,fch_reg from tramite.agenda_notas where ide_not = $ide_not")->result();
    }
    function save_edit($ide_not,$des_not)
    {
        $this->db->query("UPDATE tramite.agenda_notas SET des_not = '$des_not' WHERE ide_not = $ide_not");
    }
}
