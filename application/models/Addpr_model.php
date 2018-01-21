<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Addpr_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$beta = $this->load->database('bo', TRUE);
	}

	public function getvender()
	{
		$beta = $this->load->database('bo', TRUE);
		$query = $beta->get('APFA0010');
		$result = $query->result_array();
		return $result;
	}

	public function getnewpr()
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(1);
		$this->db->order_by('prno', 'DESC');
		$result = $this->db->get()->result_array();
		$prno = $result[0]['prno'];
		$newpr = substr($prno,4)+1;
		if (strlen($newpr)<2) {
			$newpr ="000000".$newpr;
		}elseif(strlen($newpr)<3) {	
			$newpr ="00000".$newpr;
		}
		elseif(strlen($newpr)<4) {	
			$newpr ="0000".$newpr;
		}
		elseif(strlen($newpr)<5) {	
			$newpr ="000".$newpr;
		}
		elseif(strlen($newpr)<6) {	
			$newpr ="00".$newpr;
		}
		elseif(strlen($newpr)<7) {	
			$newpr ="0".$newpr;
		}
		$newpr = "PR-".$newpr;
		return $newpr;
	}

	public function getnewref()
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(1);
		$this->db->order_by('prno', 'DESC');
		$result = $this->db->get()->result_array();
		$refno = $result[0]['refno'];
		$newrefno = $refno+1;
		return $newrefno;
	}
	

}

/* End of file Addpr_model.php */
/* Location: ./application/models/Addpr_model.php */
?>