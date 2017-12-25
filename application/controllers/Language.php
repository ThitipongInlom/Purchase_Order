<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Language extends CI_Controller
{
    public function __construct() {
        parent::__construct();  
        $this->lang->load('message','english'); 
        $this->load->library('session');
    }

    function switchLang($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
?>