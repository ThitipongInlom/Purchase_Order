<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model');
		$this->load->model('Switch_model');
		$this->load->helper('file');
	}
	public function index()
	{
		$data['result'] = $this->Profile_model->get_datauser();
		$data['Switch'] = $this->Switch_model->Checkuser();
		$this->load->view('theme/head');
		$this->load->view('profile', $data);
		$this->load->view('theme/footer');
	}

	public function Chanepassword()
	{
		$data = $this->Profile_model->Get_Passworduser();
		$username = $data->username;
		$passold  = $this->input->post('old');
		$passnew1 = $this->input->post('new1');
		$passnew2 = $this->input->post('new2');
		if ($data->password == $passold) {
			$this->Profile_model->Change_Password($username,$passnew1);
			$status = 'OK';
		}else{
			$status = 'Notsame';
		}

		$array = array(
		'status' => $status);
		echo json_encode($array);
	}

	public function SQLAddprSwitchCheck()
	{ 
		$result = $this->Profile_model->SQLAddprSwitchCheck();
		$array = array('SQLAddprSwitch' => $result);
		echo json_encode($array);
	}

	public function AddprsetSwitchCheck()
	{ 
		$result = $this->Profile_model->AddprsetSwitchCheck();
		$array = array('AddprsetSwitch' => $result);
		echo json_encode($array);
	}

	public function Show_allSwitchCheck()
	{ 
		$result = $this->Profile_model->Show_allSwitchCheck();
		$array = array('Show_allSwitch' => $result);
		echo json_encode($array);
	}

	public function Show_allnewSwitchCheck()
	{ 
		$result = $this->Profile_model->Show_allnewSwitchCheck();
		$array = array('Show_allnewSwitch' => $result);
		echo json_encode($array);
	}

	public function Show_approveSwitchCheck()
	{ 
		$result = $this->Profile_model->Show_approveSwitchCheck();
		$array = array('Show_approveSwitch' => $result);
		echo json_encode($array);
	}	

	public function Show_completedSwitchCheck()
	{ 
		$result = $this->Profile_model->Show_completedSwitchCheck();
		$array = array('Show_completedSwitch' => $result);
		echo json_encode($array);
	}

	public function Show_accountingSwitchCheck()
	{ 
		$result = $this->Profile_model->Show_accountingSwitchCheck();
		$array = array('Show_accountingSwitch' => $result);
		echo json_encode($array);
	}

	public function Show_rejectSwitchCheck()
	{ 
		$result = $this->Profile_model->Show_rejectSwitchCheck();
		$array = array('Show_rejectSwitch' => $result);
		echo json_encode($array);
	}

	public function SettinguserSwitchCheck()
	{ 
		$result = $this->Profile_model->SettinguserSwitchCheck();
		$array = array('SettinguserSwitch' => $result);
		echo json_encode($array);
	}

	public function UpdateSQLAddprSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateSQLAddprSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateSQLAddprSwitch($status);
		}
		echo 'UpdateSQLAddprSwitch = '.$state;
	}

	public function UpdateAddprsetSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateAddprsetSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateAddprsetSwitch($status);
		}
		echo 'UpdateAddprsetSwitch = '.$state;
	}

	public function UpdateShow_allSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateShow_allSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateShow_allSwitch($status);
		}
		echo 'UpdateShow_allSwitch = '.$state;
	}

	public function UpdateShow_allnewSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateShow_allnewSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateShow_allnewSwitch($status);
		}
		echo 'UpdateShow_allnewSwitch = '.$state;
	}

	public function UpdateShow_approveSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateShow_approveSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateShow_approveSwitch($status);
		}
		echo 'UpdateShow_approveSwitch = '.$state;
	}

	public function UpdateShow_completedSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateShow_completedSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateShow_completedSwitch($status);
		}
		echo 'UpdateShow_completedSwitch = '.$state;
	}	

	public function UpdateShow_accountingSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateShow_accountingSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateShow_accountingSwitch($status);
		}
		echo 'UpdateShow_accountingSwitch = '.$state;
	}

	public function UpdateShow_rejectSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateShow_rejectSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateShow_rejectSwitch($status);
		}
		echo 'UpdateShow_rejectSwitch = '.$state;
	}

	public function UpdateSettinguserSwitch()
	{
		$state = $this->input->post('state');
		if ($state=='false') {
			$status = '1';
			$this->Profile_model->UpdateSettinguserSwitch($status);
		}elseif ($state=='true'){
			$status = '0';
			$this->Profile_model->UpdateSettinguserSwitch($status);
		}
		echo 'UpdateSettinguserSwitch = '.$state;
	}

}
/* End of file Proflie.php */
/* Location: ./application/controllers/Proflie.php */
?>