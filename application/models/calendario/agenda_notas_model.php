<?php
class agenda_notas_model extends CI_Model
{
    function get_by_ide_pac($ano_eje){//$ide_per    
//        return $this->db->query("select * from agenda_notas WHERE ano_eje = '$ano_eje' AND ide_per = $ide_per ORDER BY ide_not DESC")->result();
        return $this->db->query(" 
            select a.*,(b.nombre || ' ' || b.apellido) as nom_pac from agenda_notas a 
            left join pacientes b on a.ide_per=b.id
            WHERE ano_eje = '$ano_eje' 
            ORDER BY ide_not DESC
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
