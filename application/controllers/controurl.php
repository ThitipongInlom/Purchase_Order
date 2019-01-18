<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controurl extends CI_Controller {

public function url()
{
	$protocol = "";
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {  $protocol = "https"; } else {  $protocol = "http"; }
	$server_root  = $protocol."://".$_SERVER['HTTP_HOST'];
	$server_root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	$arry = array(
		'urlweb' => $server_root.'',
		'opendata' => $server_root.'index.php/Show_data/modal_opendata',
		'edit' => $server_root.'index.php/edit/',
		'deletedata' => $server_root.'index.php/Show_data/deletedata',
		'receive' => $server_root.'index.php/receive/',
		'editprice' => $server_root.'index.php/editprice/',
		'openwindowimg' => $server_root.'assets/photo_storage/',
		'login' => $server_root.'index.php/Welcome/login',
		'logout' => $server_root.'index.php/Welcome/logout',
		'editupper' => $server_root.'index.php/Edit_Pr/editupper',
		'editupper2' => $server_root.'index.php/Edit_Pr/editupper2',
		'receiveupper' => $server_root.'index.php/Edit_Pr/receiveupper',
		'updataitem' => $server_root.'index.php/Add_Pr/updataitem',
		'windowsdata' => $server_root.'index.php/Add_Pr/viewhistory/',
		'ajaxopenproduct' => $server_root.'index.php/Add_Pr/listitem',
		'ajaxopenproduct2' => $server_root.'index.php/Add_Pr/listitem2',
		'ajaxopenproduct3' => $server_root.'index.php/Add_Pr/listitem3',
		'ajaxopenproductv' => $server_root.'index.php/Add_Pr/listitemv',
		'openedititem' => $server_root.'index.php/Add_Pr/openedititem',
		'formatdateitemlastpurdate' => $server_root.'index.php/Add_Pr/formatdateitem',
		'formatdateitemitemusedate' => $server_root.'index.php/Add_Pr/formatdateitem',
		'editsetptoductcode' => $server_root.'index.php/Add_Pr/setproductcode',
		'golist' => $server_root.'index.php/Add_Pr/golist',
		'golist3' => $server_root.'index.php/Add_Pr/golist3',
		'golist2' => $server_root.'index.php/Add_Pr/golist2',
		'golistv' => $server_root.'index.php/Add_Pr/golistv',
		'getvender' => $server_root.'index.php/Add_Pr/getvender',
		'getwarehouse' => $server_root.'index.php/Add_Pr/getwarehouse',
		'getdivision' => $server_root.'index.php/Add_Pr/getdivision',
		'getdepartment' => $server_root.'index.php/Add_Pr/getdepartment',
		'setwarehouse' => $server_root.'index.php/Add_Pr/setwarehouse',
		'setvendor' => $server_root.'index.php/Add_Pr/setvendor',
		'setdivision' => $server_root.'index.php/Add_Pr/setdivision',
		'setdepartment' => $server_root.'index.php/Add_Pr/setdepartment',
		'checkitemid' => $server_root.'index.php/Add_Pr/checkitemid',
		'showtabledataitem' => $server_root.'index.php/Add_Pr/showtabledataitem',
		'doupload' => $server_root.'index.php/Add_Pr/doupload',
		'deleteitem' => $server_root.'index.php/Add_Pr/deleteitem',
		'addupdatepr' => $server_root.'index.php/Add_Pr/updatepr',
		'setproductoldpr' => $server_root.'index.php/Add_Pr/setproductoldpr',
		'getopenpr' => $server_root.'index.php/Dashboard/getopenpr',
		'getapprovepr' => $server_root.'index.php/Dashboard/getapprovepr',
		'getreject' => $server_root.'index.php/Dashboard/getreject',
		'getcompleted' => $server_root.'index.php/Dashboard/getcompleted',
		'statusapp' => $server_root.'index.php/Show_data/setstatusapp',
		'approve' => $server_root.'index.php/Show_data/approveY',
		'approvex' => $server_root.'index.php/Show_data/approveX',
		'completedY' => $server_root.'index.php/Show_data/completedY',
		'completedY_No_Po' => $server_root.'index.php/Show_data/completedY_No_Po',
		'completedY_AC' => $server_root.'index.php/Show_data/completedY_AC',
		'showwindowsmodelprview' => $server_root.'index.php/Showprview/showwindowsmodelprview/',
		'blackupallpr' => $server_root.'index.php/Show_data/show_all',
		'blackupacpr' => $server_root.'index.php/Show_data/Show_accounting?i=All',
		'blackupapprove' => $server_root.'index.php/Show_data/show_approve',
		'blackupcompleted' => $server_root.'index.php/Show_data/show_completed',
		'blackupreject' => $server_root.'index.php/Show_data/show_reject',
		'edituseradata' => $server_root.'index.php/Usersetting/edituseradata',
		'updatedata' => $server_root.'index.php/Usersetting/updatedata',
		'CheckPrcodeNoOne' => $server_root.'index.php/Add_Pr/CheckPrcodeNoOne',
		'SQLAddprSwitchCheck' => $server_root.'index.php/Profile/SQLAddprSwitchCheck',
		'AddprsetSwitchCheck' => $server_root.'index.php/Profile/AddprsetSwitchCheck',
		'Show_allSwitchCheck' => $server_root.'index.php/Profile/Show_allSwitchCheck',
		'Show_allnewSwitchCheck' => $server_root.'index.php/Profile/Show_allnewSwitchCheck',
		'Show_approveSwitchCheck' => $server_root.'index.php/Profile/Show_approveSwitchCheck',
		'Show_completedSwitchCheck' => $server_root.'index.php/Profile/Show_completedSwitchCheck',
		'Show_accountingSwitchCheck' => $server_root.'index.php/Profile/Show_accountingSwitchCheck',
		'Show_rejectSwitchCheck' => $server_root.'index.php/Profile/Show_rejectSwitchCheck',
		'SettinguserSwitchCheck' => $server_root.'index.php/Profile/SettinguserSwitchCheck',
		'UpdateSQLAddprSwitch' => $server_root.'index.php/Profile/UpdateSQLAddprSwitch',
		'UpdateAddprsetSwitch' => $server_root.'index.php/Profile/UpdateAddprsetSwitch',
		'UpdateShow_allSwitch' => $server_root.'index.php/Profile/UpdateShow_allSwitch',
		'UpdateShow_allnewSwitch' => $server_root.'index.php/Profile/UpdateShow_allnewSwitch',
		'UpdateShow_approveSwitch' => $server_root.'index.php/Profile/UpdateShow_approveSwitch',
		'UpdateShow_completedSwitch' => $server_root.'index.php/Profile/UpdateShow_completedSwitch',
		'UpdateShow_accountingSwitch' => $server_root.'index.php/Profile/UpdateShow_accountingSwitch',
		'UpdateShow_rejectSwitch' => $server_root.'index.php/Profile/UpdateShow_rejectSwitch',
		'UpdateSettinguserSwitch' => $server_root.'index.php/Profile/UpdateSettinguserSwitch',
		'savesetvenderpr' => $server_root.'index.php/Show_data/savesetvenderpr',
		'Chanepassword' => $server_root.'index.php/Profile/Chanepassword',
		'imgpra253' => $server_root.'assets/photo_storage/',
		'API_Print' => $server_root.'index.php/API_Print/',
		'Imghodup' => $server_root.'index.php/Usersetting/uploadimghod',
		'Imghoddelete' => $server_root.'index.php/Usersetting/deleteimghod',
		'RC_modal_opendata' => $server_root.'index.php/Show_data/RC_modal_opendata',
		'Setvalue' => $server_root.'index.php/Show_data/Show_accounting',
		'FAXSAVE' => $server_root.'index.php/Show_data/FAXSAVE',
		'ACappovecheck_submit' => $server_root.'index.php/Show_data/acapproveaction');
	echo json_encode($arry);
}


}

/* End of file controurl.php */
/* Location: ./application/controllers/controurl.php */
?>
