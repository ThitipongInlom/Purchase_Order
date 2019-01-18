<?php  
// Sany
$CI =& get_instance();
$beta = $CI->load->database('default', TRUE);
// 0 = NO // 1 = OFF
$QuerySQLAddpr = $beta->get_where('a', array('a_id' => '1'));
$ResultSQLAddpr = $QuerySQLAddpr->row();
$config['SQLAddpr']        = $ResultSQLAddpr->a_s;
//
$QueryAddprset = $beta->get_where('a', array('a_id' => '2'));
$ResultAddprset = $QueryAddprset->row();
$config['Addprset']        = $ResultAddprset->a_s;
//
$Queryshow_all = $beta->get_where('a', array('a_id' => '3'));
$Resultshow_all = $Queryshow_all->row();
$config['show_all']        = $Resultshow_all->a_s;
//
$Queryshow_allnew = $beta->get_where('a', array('a_id' => '4'));
$Resultshow_allnew = $Queryshow_allnew->row();
$config['show_allnew']     = $Resultshow_allnew->a_s;
//
$Queryshow_approve = $beta->get_where('a', array('a_id' => '5'));
$Resultshow_approve = $Queryshow_approve->row();
$config['show_approve']    = $Resultshow_approve->a_s;
//
$Queryshow_completed = $beta->get_where('a', array('a_id' => '6'));
$Resultshow_completed = $Queryshow_completed->row();
$config['show_completed']  = $Resultshow_completed->a_s;
//
$QueryShow_accounting = $beta->get_where('a', array('a_id' => '7'));
$ResultShow_accounting = $QueryShow_accounting->row();
$config['Show_accounting'] = $ResultShow_accounting->a_s;
//
$Queryshow_reject = $beta->get_where('a', array('a_id' => '8'));
$Resultshow_reject = $Queryshow_reject->row();
$config['show_reject']     = $Resultshow_reject->a_s;
//
$Querysettinguser = $beta->get_where('a', array('a_id' => '9'));
$Resultsettinguser = $Querysettinguser->row();
$config['settinguser']     = $Resultsettinguser->a_s;
?>