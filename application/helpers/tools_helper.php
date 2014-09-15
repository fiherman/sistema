<?php
if(!function_exists('protege_ataque'))
{
    function protege_ataque($sql,$frm)
    {   
        
        
        if(strstr(strtoupper($sql),'DROP ')||strstr(strtoupper($sql),'SCHEMA ')||strstr(strtoupper($sql),'TABLE')||strstr(strtoupper($sql),"CREATE ")||strstr(strtoupper($sql),"INSERT "||strstr(strtoupper($sql),";"))||strstr(strtoupper($sql),"SELECT ")||strstr(strtoupper($sql),"UPDATE ") )
        {   $ip= 'IP: '.$_SERVER['REMOTE_ADDR'];
            $fecha=date("d/m/Y H:i:s");
            $sql=str_replace("'", " ", $sql);
            $CI =&get_instance();
            $CI->load->model('usuariosmodel');
            $CI->usuariosmodel->guardaip($ip,$fecha,$sql,$frm);
            return "ataque";
        }
        else
        {   //$sql=str_replace("'", "-", $sql); 
            return $sql;
        }
        //$this->usuariosmodel->guardaip($ip,$fecha,$sql,$frm);
      
    }
}
if(!function_exists('trim_th'))
{
    function trim_th($str)
    {
	 return trim($str);
    }
}
if(!function_exists('formato_fecha'))
{
    function formato_fecha($fecha1)
    {   
        $fecha1=str_replace("/", "-", $fecha1);
        return date("d/m/Y",strtotime($fecha1));
   }
}
if(!function_exists('corregir_utf8_pdf'))
{
    function corregir_utf8_pdf($cadena)
    {   $cadena=trim($cadena);
        $cadena=str_replace("Ñ","&Ntilde;",$cadena);
        $cadena=str_replace("ñ","&ntilde;",$cadena);
        $cadena=str_replace("Ü","&Uuml;",$cadena);
        $cadena=str_replace("´", "'",$cadena);
        
        return $cadena;
    }
}
if(!function_exists('formato_fecha_param'))
{
    function formato_fecha_param($date,$format)
    {   
        $date=str_replace("/", "-", $date);
        return date($format,strtotime($date));
   }
}
if(!function_exists('format_guion'))
{
    function format_guion($date)
    {   
        $date = str_replace("/", "-", $date);
        return date('d-m-Y',strtotime($date));
   }
}
if(!function_exists('format_datetime'))
{
    function format_datetime($DateTime)
    {   
        $DateTime = str_replace("/", "-", $DateTime);
        $Date = date("d/m/Y H:i:s",strtotime($DateTime));        
        $DateTimeCreate = new DateTime($DateTime);      
        $Time = $DateTimeCreate->format('H:i:s');
        return $Date." ".$Time;
   }
}

if(!function_exists('set_format_datetime'))
{
    function set_format_datetime($DateTime)
    {   
        //return date_format(date_create($DateTime),'d/m/Y H:i:s');
        return $DateTime;
    }
}

if(!function_exists('utf8_encode_trim'))
{
    function utf8_encode_trim($str)
    {
	 return utf8_encode_trim(trim($str));
    }
}
if(!function_exists('utf8_need'))
{
    function utf8_need($String)
    {
	$Permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";
        for ($i = 0; $i < strlen($String); $i++)
        {
            if(strpos($Permitidos, substr($String, $i, 1)) === false)
            {
                return trim($String);
            }
            else
            {
                return utf8_encode(trim($String));
            }
        }
    }
}
if(!function_exists('utf8_string'))
{
    function utf8_string($String)
    {
        return utf8_encode(trim($String));
    }
}
if(!function_exists('is_date'))//if(is_date(12/12/2013))
{
    function is_date($Date)
    {
        if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $Date))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
if(!function_exists('NameMonthSpanish'))//Retorna un nombre de mes en español
{
    function NameMonthSpanish($Month)
    {
	 switch($Month)
	 {
	     case "January":
		  return "Enero";
		  break;
	     case "February":
		  return "Febrero";
		  break;
	     case "March":
		  return "Marzo";
		  break;
	     case "April":
		  return "Abril";
		  break;
	     case "May":
		  return "Mayo";
		  break;
	     case "June":
		  return "Junio";
		  break;
	     case "July":
		  return "Julio";
		  break;
	     case "August":
		  return "Agosto";
		  break;
	     case "September":
		  return "Septiembre";
		  break;
	     case "October":
		  return "Ocutbre";
		  break;
	     case "November":
		  return "Noviembre";
		  break;
	     case "December":
		  return "Diciembre";
		  break;
	 }
    }
}
if(!function_exists('NameMonthSpanishbynumber'))//Retorna un nombre de mes en español
{
    function NameMonthSpanishbynumber($Month)
    {
	 switch($Month)
	 {
	     case "1":
		  return "Enero";
		  break;
	     case "2":
		  return "Febrero";
		  break;
	     case "3":
		  return "Marzo";
		  break;
	     case "4":
		  return "Abril";
		  break;
	     case "5":
		  return "Mayo";
		  break;
	     case "6":
		  return "Junio";
		  break;
	     case "7":
		  return "Julio";
		  break;
	     case "8":
		  return "Agosto";
		  break;
	     case "9":
		  return "Septiembre";
		  break;
	     case "10":
		  return "Ocutbre";
		  break;
	     case "11":
		  return "Noviembre";
		  break;
	     case "12":
		  return "Diciembre";
		  break;
	 }
    }
}
if ( ! function_exists('character_limiter_calendar'))
{
    function character_limiter_calendar($str, $n = 500, $end_char = '...')
    {
        if (strlen($str) < $n)
        {
                return $str;
        }

        $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

        if (strlen($str) <= $n)
        {
                return $str;
        }

        $out = "";
        foreach (explode(' ', trim($str)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $n)
            {
                    $out = trim($out);
                    return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
            }
        }
    }
}


