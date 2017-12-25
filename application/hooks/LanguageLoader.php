<?php  
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->library('session');
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('message',$siteLang);
        } else {
            $ci->session->set_userdata('site_lang', 'english');
            $ci->lang->load('message','english');
        }
    }
}
?>