<?php //tramite.agenda
class agenda_model extends CI_Model
{
    function get_agendas()
    {
        return $this->db->query("SELECT * FROM tramite.agenda")->result();
    }
    function get_notas()//$ide_per
    {      
        return $this->db->query("
            select a.ide_not,a.ide_age,a.fch_ini,a.fch_fin,a.fch_reg,b.des_not,b.ide_per,(c.nombre || ' ' || c.apellido) as nom_pac,a.age_cons FROM agenda a 
            LEFT JOIN agenda_notas b 
            on a.ide_not = b.ide_not 
            LEFT JOIN pacientes c 
            ON b.ide_per= c.id 
            where a.ano_eje = '2014' and a.flg_pbl = 1
        ")->result();
    }
    
    function get_consultas(){
        date_default_timezone_set('America/Lima');         
        return $this->db->query(" 
            select * from consulta where cons_fch like '%".date('m/Y')."' 
        ")->result();
    }
    
    function change_days($fch_ini,$fch_fin,$ide_age){
        $this->db->query("UPDATE agenda SET fch_ini = '$fch_ini', fch_fin = '$fch_fin' WHERE ide_age = '$ide_age'");
        
        $this->db->query("update evolucion set evo_pro_acti_fch='$fch_ini' where ide_age=$ide_age ");
    }
    
    function change_hours_minutes($fch_fin,$ide_age){
        $this->db->query("UPDATE agenda SET fch_fin = '$fch_fin' WHERE ide_age = '$ide_age'");
    }
    
    function get_paciente($paciente) {
        $this->db->query("set names 'utf8';");
        return $this->db->query("select id,(nombre || ' ' || apellido)as nombre from pacientes where cad_lar like'%$paciente%'")->result();
    }
    
    function get_cita_paciente($pac_id){
        $this->db->query("set names 'utf8';");
        $citas= $this->db->query("
            select a.*,(c.nombre || ' ' || c.apellido) as nom_com,b.des_not from agenda a left join agenda_notas b on a.ide_not=b.ide_not 
            left join pacientes c on b.ide_per=c.id
            where b.ide_per=$pac_id
            order by a.fch_ini desc limit 1
        ")->result();
        if($citas){
            return $citas;            
        }
    }
    function get_primera_cita($pac_id){
        $this->db->query("set names 'utf8';");       
       
        $primera_cita = $this->db->query("select * from consulta where pac_id=$pac_id order by 7 desc limit 1")->result();
        if($primera_cita){
            return $primera_cita;
        }
    }
    
//    function get_notas_publicas($ano_eje)
//    {      
//        return $this->db->query("SELECT a.ide_not,a.ide_age,a.fch_ini,a.fch_fin,a.fch_reg,b.des_not,b.ide_per,c.nom_tra FROM tramite.agenda a LEFT JOIN tramite.agenda_notas b on a.ide_not = b.ide_not LEFT JOIN personal.vw_trabajador200 c ON b.ide_per = c.ide_per WHERE a.flg_pbl = 1 AND a.ano_eje = '$ano_eje'")->result();
//    }
//    function get_agendas_para_el_publico($ide_per,$ano_eje)
//    {
//        return $this->db->query("select a.ide_not,a.ide_age,a.fch_ini,a.fch_fin,a.fch_reg,b.des_not,b.ide_per,c.nom_tra FROM tramite.agenda a LEFT JOIN tramite.agenda_notas b on a.ide_not = b.ide_not LEFT JOIN personal.vw_trabajador200 c ON b.ide_per = c.ide_per where b.ide_per = $ide_per and a.ano_eje = '$ano_eje' and a.flg_pbl = 1")->result();
//    }
//    function llenar_trabajadores_public()
//    {
//        return $this->db->query("select ide_per,nom_tra from personal.vw_trabajador200 where ide_per in(147548)")->result();
//    }
//    function save_agenda($ide_not,$fch_ini,$fch_fin,$fch_reg,$ano_eje,$flg_pbl)
//    {      
//        $this->db->query("INSERT INTO tramite.agenda(ide_not,fch_ini,fch_fin,fch_reg,ano_eje,flg_pbl)VALUES($ide_not,'$fch_ini','$fch_fin','$fch_reg','$ano_eje',$flg_pbl)");
//    }
//    function save_agenda_arrastre($ide_not,$fch_ini,$fch_fin,$fch_reg,$ano_eje)
//    {      
//        $this->db->query("INSERT INTO tramite.agenda(ide_not,fch_ini,fch_fin,fch_reg,ano_eje,flg_pbl)VALUES($ide_not,'$fch_ini','$fch_fin','$fch_reg','$ano_eje',0)");
//    }
    
//    function Delete($ide_age)
//    {
//        $this->db->query("DELETE FROM tramite.agenda WHERE ide_age = $ide_age");
//    }
//    function get_info_user_agenda($ide_per)
//    {
//        return $this->db->query("select nom_tra from personal.vw_trabajador200 where ide_per = $ide_per")->result();
//    }
}