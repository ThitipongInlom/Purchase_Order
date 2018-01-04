<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Get_data_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function Get_all()
	{
		$dep = $this->session->dep;
		$leve = $this->session->type;
		switch ($leve) {
			case 'admin':
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('Vendor IS NOT NULL',null, false);
			$this->db->where('Vendor_name IS NOT NULL',null, false);
			$this->db->where('HdApprove IS NULL',null, false);
			$this->db->where('PRApprove IS NULL',null, false);
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$result = $this->db->get()->result_array();
				break;
			default:
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('dep', $dep);
			$this->db->where('Vendor IS NOT NULL',null, false);
			$this->db->where('Vendor_name IS NOT NULL',null, false);
			$this->db->where('HdApprove IS NULL',null, false);
			$this->db->where('PRApprove IS NULL',null, false);
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$result = $this->db->get()->result_array();
			break;
		}
		return $result;
	}

	public function modal_head_open()
	{
		$prnoopen = $this->input->post("primary");
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(1000);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('PR.prno', $prnoopen);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function modal_body_open()
	{
		$prnoopen = $this->input->post("primary");
		$this->db->select('*');
		$this->db->from('PR_Item');
		$this->db->limit(1000);
		$this->db->where('prno', $prnoopen);
		$this->db->order_by("seq");
		$result = $this->db->get()->result_array();
		return $result;
	}


	

}

/* End of file Get_data.php */
/* Location: ./application/models/Get_data.php */
?>