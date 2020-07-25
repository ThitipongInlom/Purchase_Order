<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function query_today(){
		$today = date('Ymd');
		$query = $this->db->get_where('PR', array('prdate' => $today));
		$result = $query->num_rows();
		return $result;
	}

	public function query_ac_apv_noapp()
	{
		$this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->join('PR_item', 'PR_item.prno = PR.prno');
		$this->db->where('PR_ref.PRApprove is null');
		$this->db->where('PR_ref.HdApprove','Y');
		$this->db->Group_by ('PR.prno');

		$result = $this->db->get()->num_rows();
		return $result;
	}


	public function query_gm_apv_noapp()
	{
		$this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		//$this->db->join('PR_item', 'PR_item.prno = PR.prno');
		$this->db->where('PR_ref.GMApprove is null');
		$this->db->where('PR_ref.PRApprove','Y');
		$this->db->where('PR_ref.HDApprove','Y');
		$this->db->where('PR_ref.completed IS NULL');
		$this->db->where('PR_ref.completed IS NULL');

		$this->db->Group_by ('PR.prno');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_efc_apv_noapp()
	{
		$this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
	//	$this->db->join('PR_item','PR_item.prno = PR.prno');
		$this->db->where('PR_ref.EfcApprove is null');
		$this->db->where('PR_ref.GMApprove','Y');
		$this->db->where('PR_ref.PRApprove','Y');
		$this->db->where('PR_ref.completed IS NULL');
		$this->db->Group_by ('PR.prno');
	
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function Table_call_back()
	{
		$username  = $this->session->username;
		$depname = $this->setdepartment();
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		if ($username == 'Somkhit' OR $username == 'somkid') {
			$this->db->where('PR_ref.statusby', 'GM');
		}else{
			$this->db->where('PR_ref.Dep_name', $depname->depname1);
		}
		$this->db->where('PR_ref.statusapp !=', '');
		$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
		$this->db->where($where);
		$this->db->where('PR_ref.completed IS NULL',null, false);
		$this->db->order_by("statusdatetime", "desc");
		$result = $this->db->get()->result_object();
		return $result;
	}

	public function setdepartment()
	{
		$dep  = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
			$dep1 = strstr($dep, ",", true);
		}else{
			$dep1 = $dep;
		}
		$beta = $this->load->database('bo', TRUE);
		$info = $beta->select("*")
						->from("ZZFC0020")
						->where("depcode",$dep1)
						->get()
						->row();
		return $info;
	}


}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */
?>