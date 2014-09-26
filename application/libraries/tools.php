<?php
class tools
{
    function trim_tools($string)
    {
	 return trim($string);
    }
    function trim_utf8_encode($string)
    {
	 return trim(utf8_encode($string));
    }

    /**
    * Funcion que limipia y decodifica una cadena a utf8
    *
    * @param integer $string Cadena a transformar
    */
    function trim_utf8_decode($string)
    {
	 return trim(utf8_decode($string));
    }
}