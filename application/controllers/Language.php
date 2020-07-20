<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Language extends CI_Controller
{
    public function __construct() {
        parent::__construct();  
        $this->load->model('Profile_model');
        $this->lang->load('message','english'); 
        $this->load->library('session');
    }

    function switchLang($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function switchLanguser($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('lang', $language);
        $this->Profile_model->set_lang($language);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
?>