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

	public function newpradd($prno,$ref,$prdate)
	{
		$type = $this->session->type;
		$dep  = $this->session->dep;
		$fname = $this->session->fname;
		// User // Admin
		if ($type =='user' OR $type =='admin') {
		$PR = array(
        'comid' => '0001',
        'prno' => $prno,
        'prdate' => $prdate,
        'dep' => $dep,
        'refno' => $ref,
    	'conflag' => 'N',
    	'zzuser' => $fname,
    	'chksub1' => '1');
		$this->db->insert('PR', $PR);
		$PR_ref = array(
        'prno' => $prno);
		$this->db->insert('PR_ref', $PR_ref);
		}
		// Hod
		elseif($type =='hod'){
		$PR = array(
        'comid' => '0001',
        'prno' => $prno,
        'prdate' => $prdate,
        'dep' => $dep,
        'refno' => $ref,
    	'conflag' => 'N',
    	'zzuser' => $fname,
    	'chksub1' => '1');
		$this->db->insert('PR', $PR);
		$PR_ref = array(
        'prno' => $prno,
    	'HdApprove' => 'Y',
    	'HdApprove_Date' => $prdate);
		$this->db->insert('PR_ref', $PR_ref);	
		}
	}

	public function golistmodel()
	{
		$beta = $this->load->database('bo', TRUE);
		$vgolist = $this->input->post('value');
		if ($vgolist=='') {
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->limit(100);
		$beta->join('STFC0060', 'STFA0010.purunit = STFC0060.mcode');
		$beta->order_by("stcode", "asc");
		$result = $beta->get()->result_array();
		return $result;
		}else{
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->limit(100);
		$beta->join('STFC0060', 'STFA0010.purunit = STFC0060.mcode');
		$beta->like('stcode', $vgolist);
		$beta->or_like('stname1', $vgolist);
		$beta->or_like('stname2', $vgolist);
		$beta->order_by("stcode", "asc");
		$result = $beta->get()->result_array();
		return $result;
		}
	}

	public function checkoldata($prno)
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(10);
		$this->db->join('PR_Item', 'PR.prno = PR_Item.prno');
		$this->db->where('prdcode', $prno);
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function checkitemid()
	{
		$prno = $this->input->post('checkitemid');
		$query = $this->db->get_where('PR_Item', array('prno' => $prno));
		$num = $query->num_rows();
		return $num;
	}

	public function setproductcode()
	{
		$beta = $this->load->database('bo', TRUE);
		$v_id = $this->input->post('v_id');
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->join('STFC0060', 'STFA0010.purunit = STFC0060.mcode');
		$beta->where('stcode', $v_id);
		$result = $beta->get()->result_array();
		return $result;
	}

	public function titleviewhistory($stcode)
	{
		$beta = $this->load->database('bo', TRUE);
		$query = $beta->get_where('STFA0010', array('stcode' => $stcode));
		$result = $query->result();
		return $result;
	}

	public function dataviewhistory($stcode)
	{
		$this->db->select('PR_Item.comid, PR_Item.prdcode, PR_Item.seq, PR_Item.prno, PR_Item.prqty, PR_Item.prprice_old, PR_Item.prprice, PR_Item.lastpurdate, PR_Item.poqty,                       PR_Item.usedate, PR_Item.selected, PR_Item.iremark, PR_Item.ifileupd,pr_ref.completed');
		$this->db->from('PR_Item');
		$this->db->join('PR_ref', 'PR_Item.prno = PR_ref.prno');
		$this->db->where('PR_item.prdcode', $stcode);
		$this->db->where('pr_ref.completed', 'Y');
		$this->db->order_by("usedate", "desc");
		$result = $this->db->get()->result_array();
		return $result;
	}

	

}

/* End of file Addpr_model.php */
/* Location: ./application/models/Addpr_model.php */
?>