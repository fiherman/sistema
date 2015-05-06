<?php
class administracion_model extends CI_Model{    
    
    function insert_doctores($doc_nom,$doc_ape,$doc_cop,$doc_uni,$doc_hab){

            $this->db->query("set names 'utf8';");
      
            $insert = $this->db->query(
            "INSERT INTO doctores(doc_nom, doc_ape,doc_cop,doc_uni,doc_fch,doc_hab)"
            ."values"
            ."('$doc_nom','$doc_ape','$doc_cop','$doc_uni','".date('d/m/Y')."','$doc_hab')");

           if($insert){   
               $this->db->query("update doctores set cad_lar=(doc_nom ||' '|| doc_ape ||' '|| doc_cop ||' '||doc_id) where doc_cop='$doc_cop'");
               return true; 
           }else{
               return FALSE;
           }              
    }
    
    function update_doctores($id,$doc_nom,$doc_ape,$doc_cop,$doc_uni,$doc_hab){
      
        $this->db->query("set names 'utf8';");

        $update = $this->db->query(
        "update doctores set "
        ." doc_nom='$doc_nom',doc_ape='$doc_ape',doc_cop='$doc_cop',doc_fch='".date('d/m/Y')."',doc_uni='$doc_uni',doc_hab='$doc_hab'"
        ." where doc_id=$id");
       if($update){
           $this->db->query("update doctores set cad_lar=(doc_nom ||' '|| doc_ape ||' '|| doc_cop ||' '||doc_id) where doc_id=$id");
           return true; 
       }else{
           return FALSE;
       }              
    }
    
    function get_cont_by_date(){
        $this->db->query("set names 'utf8';");
        return $this->db->query("select doc_id from doctores")->result();
    }
    
    function get_all_doctores($sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select doc_id,doc_nom,doc_ape,doc_cop,doc_uni,doc_hab,doc_fch from doctores order by $sidx $sord limit $limit offset $start
        ")->result();
    }
    
    function get_cont_buscar_doctor($txtbuscar){
        $this->db->query("set names 'utf8';");
        $laPalabras = @split(" ",$txtbuscar);
        $lsBus="";
	for($i=0;$i<=count($laPalabras)-1;$i++){
            if($i==0){
                $lsBus=" cad_lar LIKE Upper('%".$laPalabras[$i]."%')";
            }else{
                $lsBus.=" AND cad_lar LIKE Upper('%".$laPalabras[$i]."%')";
            }            
	} 
        return $this->db->query("select * from doctores where $lsBus")->result();
    }
    
    function get_buscar_doctor($txtbuscar,$sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        $laPalabras = @split(" ",$txtbuscar);
        $lsBus="";
	for($i=0;$i<=count($laPalabras)-1;$i++){
            if($i==0){
                $lsBus=" cad_lar LIKE UPPER('%".$laPalabras[$i]."%')";
            }else{
                $lsBus.=" AND cad_lar LIKE UPPER('%".$laPalabras[$i]."%')";
            }            
	}
        return $this->db->query("select * from doctores where $lsBus order by $sidx $sord limit $limit offset $start")->result();
    }
  
    function get_ver_all_esp($seg_id){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            SELECT distinct(esp_tip), trim(esp_tip_des)as des FROM especialidad where seg_id=$seg_id order by 1
        ")->result();
    }
    ////////////especilalidades////////////////////////////////
    function get_cont_especialidades($seg_id,$esp_tip){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select esp_id,seg_id,esp_tip,esp_des,esp_cos_sol from especialidad where seg_id=$seg_id and esp_tip=$esp_tip
        ")->result();
    }
    
    function get_all_especialidades($seg_id,$esp_tip,$sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            select esp_id,seg_id,esp_tip,esp_des,esp_cos_sol from especialidad 
            where seg_id=$seg_id and esp_tip=$esp_tip order by $sidx $sord limit $limit offset $start
        ")->result();
    }
    
    function update_especialidad($esp_id,$esp_des,$des_cos){      
        $this->db->query("set names 'utf8';");
        $update = $this->db->query("
            update especialidad set esp_cos_sol=$des_cos, esp_des='$esp_des' where esp_id=$esp_id
        "); 
        if($update){          
            return true; 
        }else{
            return FALSE;
        }  
    }
    
    /////////////////USUARIOS////////////////////////////////////////////////////////////////////////////////////////
    function get_cont_usuarios(){
        $this->db->query("set names 'utf8';");
        return $this->db->query("SELECT user_id, usuario, nom_com, email,cpassword, ccpassword FROM usuarios")->result();
    }
    
    function get_all_usuarios($sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        return $this->db->query("
            SELECT user_id, usuario, nom_com, email,cpassword, ccpassword,estado FROM usuarios order by $sidx $sord limit $limit offset $start
        ")->result();
    }
    
    function get_cont_buscar_usuario($txtbuscar){
        $this->db->query("set names 'utf8';");
        $laPalabras = @split(" ",$txtbuscar);
        $lsBus="";
	for($i=0;$i<=count($laPalabras)-1;$i++){
            if($i==0){
                $lsBus=" cad_lar LIKE Upper('%".$laPalabras[$i]."%')";
            }else{
                $lsBus.=" AND cad_lar LIKE Upper('%".$laPalabras[$i]."%')";
            }            
	} 
        return $this->db->query("select * from usuarios where $lsBus")->result();
    }
    
    function get_buscar_usuario($txtbuscar,$sidx,$sord,$start,$limit){
        $this->db->query("set names 'utf8';");
        $laPalabras = @split(" ",$txtbuscar);
        $lsBus="";
	for($i=0;$i<=count($laPalabras)-1;$i++){
            if($i==0){
                $lsBus=" cad_lar LIKE UPPER('%".$laPalabras[$i]."%')";
            }else{
                $lsBus.=" AND cad_lar LIKE UPPER('%".$laPalabras[$i]."%')";
            }            
	}
        return $this->db->query("select * from usuarios where $lsBus order by $sidx $sord limit $limit offset $start")->result();
    }
    
    function insert_usuarios($nom_com,$email,$user,$pass){
        $this->db->query("set names 'utf8';");      
        $insert = $this->db->query("
            INSERT INTO usuarios(nom_com, email,usuario,cpassword, ccpassword,estado) VALUES ('$nom_com', '$email', '$user', '$pass', md5('$pass'),1);
        ");
        if($insert){ 
            $this->db->query("update usuarios set cad_lar=(user_id || ' ' || usuario || ' ' || nom_com) where usuario='$user' and cpassword='$pass'");
            return true; 
        }else{
            return FALSE;
        }              
    }
    function update_usuarios($user_id,$nom_com,$email,$user,$estado){      
        $this->db->query("set names 'utf8';");
        $update = $this->db->query("
        update usuarios set usuario='$user', nom_com='$nom_com', email='$email', estado=$estado WHERE user_id=$user_id
        ");
        if($update){   
            $this->db->query("update usuarios set cad_lar=(user_id || ' ' || usuario || ' ' || nom_com) WHERE user_id=$user_id");
            return true; 
        }else{
            return FALSE;
        }              
    }
    
    ////////////////////configuracion del sistema////////////////////////////////////////////////
    function get_configuracion_sistema(){      
        $this->db->query("set names 'utf8';");                   
        return $this->db->query("select * from system")->result()[0]; 
    }
    function update_configuracion_sistema($rango_fac_ini,$rango_fac_fin,$igv){      
        $this->db->query("set names 'utf8';");
        $update = $this->db->query("
            UPDATE system SET sys_fac_ini=$rango_fac_ini, sys_fac_fin=$rango_fac_fin, sys_igv=$igv WHERE id=1;
        "); 
        if($update){          
            return true; 
        }else{
            return FALSE;
        }  
    }
    
    //////////////////////////////factura///////////
    function get_system_igv() {
        $this->db->query("set names 'utf8';");        
        return $this->db->query("select sys_igv from system")->result()[0];
    }
}