<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_datauser()
	{
		$query = $this->db->get_where('PR_Users', array('username' => $this->session->username));
		$result = $query->result();
		return $result;
	}

	public function set_lang($language)
	{
		$user = $this->session->username;
		$this->db->where('username', $user);
		$data = array(
        'lang' => $language
		);
		$this->db->update('PR_Users', $data);
		return;
	}

	public function Get_Passworduser()
	{
		$username = $this->session->username;
		$Getdatauser = $this->db->get_where('PR_Users', array('username' => $username));

		$result = $Getdatauser->row();
		return $result;
	}

	public function Change_Password($username,$passnew1)
	{
		$this->db->where('username', $username);
		$data = array('password' => $passnew1);
		$this->db->update('PR_Users', $data);
		return;
	}

	public function SQLAddprSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '1'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function AddprsetSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '2'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function Show_allSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '3'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function Show_allnewSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '4'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function Show_approveSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '5'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function Show_completedSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '6'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function Show_accountingSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '7'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function Show_rejectSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '8'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function SettinguserSwitchCheck()
	{
		$QuerySQLAddpr = $this->db->get_where('a', array('a_id' => '9'));
		$ResultSQLAddpr = $QuerySQLAddpr->row();
		return $ResultSQLAddpr->a_s;
	}

	public function UpdateSQLAddprSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '1');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateAddprsetSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '2');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateShow_allSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '3');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateShow_allnewSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '4');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateShow_approveSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '5');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateShow_completedSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '6');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateShow_accountingSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '7');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateShow_rejectSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '8');
		$this->db->update('a', $data);
		return;
	}

	public function UpdateSettinguserSwitch($status)
	{
		$data = array('a_s' => $status);
		$this->db->where('a_id', '9');
		$this->db->update('a', $data);
		return;
	}	

}

/* End of file Proflie_model.php */
/* Location: ./application/models/Proflie_model.php */
?>