<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
class Get_data_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$beta = $this->load->database('bo', TRUE);
	}

	public function gettotal($prnoid)
	{
		$this->db->select("(SELECT SUM(PR_Item.prprice * PR_Item.prqty) FROM PR_Item WHERE PR_Item.prno ='$prnoid')", FALSE);
		$query = $this->db->get();
		$row = $query->result_array();
		$result = $row[0][null];
		return $result; 
	}

	public function getUnit($warecode)
	{
		$beta = $this->load->database('bo', TRUE);
		$beta->select('STFC0060.mdesc1');
		$beta->from('STFA0010');
		$beta->join('STFC0060', 'STFA0010.purunit = STFC0060.mcode');
		$beta->where('stcode', $warecode);
		$result = $beta->get()->result_array();
		$mdesc1 = $result[0]['mdesc1'];
		return $mdesc1;
	}

	public function iremark($warecode)
	{	
		$beta = $this->load->database('bo', TRUE);
		$query = $beta->get_where('STFA0010', array('stcode' => $warecode));
		$result = $query->result_array();
		return $result;
	}

	public function beta()
	{
		$beta = $this->load->database('bo', TRUE);
		$query = $beta->get('STFC0070');
		$row = $query->result_array();
		$jsonrow = json_encode($row);
		return $jsonrow;
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
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('chksub1','1');
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
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('chksub1','1');
			$result = $this->db->get()->result_array();
			break;
		}
		return $result;
	}

	public function Get_approve()
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
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('chksub1','1');
			$result = $this->db->get()->result_array();
				break;
			default:
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('dep', $dep);
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('chksub1','1');
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