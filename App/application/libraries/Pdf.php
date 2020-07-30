<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }
 
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
        $dompdf = new Dompdf\DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if($download)
            $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename.'.pdf', array('Attachment' => 0));
    }

     function createPDFEmail($html, $filename='', $stream=TRUE){  
            $this->CI->load->helper('file'); 
            $this->CI->load->helper('url'); 
            $dompdf = new Dompdf\DOMPDF();
            $dompdf->load_html($html);
            $dompdf->render();
            $dompdf->set_paper('a4', 'potratit');
            if ($stream) {
              $output = $dompdf->output();
              $path = 'invoices';
              if (!is_dir('uploads/'.$path)) {
                   mkdir('uploads/'.$path, 0777, TRUE);
              }
               file_put_contents("uploads/".$path.'/'.$filename, $output);
            } else {
                return $dompdf->output();
            }
        }
}
?>