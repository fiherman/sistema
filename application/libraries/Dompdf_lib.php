<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once("dompdf/dompdf_config.inc.php");
 
class Dompdf_lib extends Dompdf{
     
        function createPDF($html, $filename='', $stream=TRUE){  
            $this->load_html($html);
            $this->render();
            if ($stream) {
                $this->stream($filename.".pdf");
            } else {
                return $this->output();
            }
        }
 
}
?>