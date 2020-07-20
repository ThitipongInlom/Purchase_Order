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

	public function openedititem($prno,$seq)
	{
		$query = $this->db->get_where('PR_Item', array('prno' => $prno, 'seq' => $seq));
		$result = $query->result();
		return $result;
	}

	public function CheckPrcodeNoOne($productcode,$prno)
	{
		$query = $this->db->get_where('PR_Item', array('prno' => $prno, 'prdcode' => $productcode));
		$result = $query->num_rows();
		return $result;
	}

	public function deleteitem($prno,$seq,$prdcode)
	{
		$this->db->delete('PR_Item', array('prno' => $prno,'seq' => $seq,'prdcode' => $prdcode));
		$this->db->select('*');
		$this->db->select("(SELECT COUNT(seq) FROM PR_Item WHERE PR_Item.prno='".$prno."') AS aa", FALSE);
		$this->db->where('prno', $prno);
		$this->db->from('PR_Item');
		$query = $this->db->get();
	    $Num=1;
		while ($row = $query->unbuffered_row())
		{
			$this->db->set('seq', $Num);
			$this->db->where('prno', $prno);
			$this->db->where('prdcode', $row->prdcode);
			//$this->db->update('PR_Item');
			$Num++;
		}
	}

	public function showtabledataitem()
	{
		$prno = $this->input->post('checkitemid');
		$this->db->order_by("seq", "asc");
		$query = $this->db->get_where('PR_Item', array('prno' => $prno));
		$result = $query->result();
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


	public function newpradd($prno,$ref,$prdate)
	{
		$type = $this->session->type;
		$dep  = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$dep1 = strstr($dep, ",", true);
		$depa = $dep1;
		}else{
			$depa = $dep;
		}
		$fname = $this->session->fname;
		$depname1 = $this->setdepartment();
		$sqldepname1 = $depname1->depname1;
		// Add Coss Pr
		$query = $this->db->get_where('Coss_PR', array('prno' => $prno));
		$countCoss = $query->num_rows();
		if ($countCoss == '0') {
			$data = array(
				'prno' => $prno,
				'refno' => $ref);
    $this->db->insert('Coss_PR', $data);
		}
		// User // Admin
		if ($type =='user' OR $type =='admin') {
		$PR = array(
        'comid' => '0001',
        'prno' => $prno,
        'prdate' => $prdate,
        'dep' => $depa,
        'refno' => $ref,
    	'conflag' => 'N',
    	'zzuser' => $fname,
    	'zzstrdate' => $prdate,
    	'chksub1' => '1');
		$this->db->insert('PR', $PR);
		$PR_ref = array(
        'prno' => $prno,
    	'Dep_name' => $sqldepname1);
		$this->db->insert('PR_ref', $PR_ref);
		}
		// Hod
		elseif($type =='hod'){
		$PR = array(
        'comid' => '0001',
        'prno' => $prno,
        'prdate' => $prdate,
        'dep' => $depa,
        'refno' => $ref,
    	'conflag' => 'N',
    	'zzuser' => $fname,
    	'zzstrdate' => $prdate,
    	'chksub1' => '1');
		$this->db->insert('PR', $PR);
		$PR_ref = array(
        'prno' => $prno,
    	'Dep_name' => $sqldepname1);
		$this->db->insert('PR_ref', $PR_ref);
		}
		// accounting0
		elseif($type =='accounting0' OR $type =='accounting'){
		$PR = array(
        'comid' => '0001',
        'prno' => $prno,
        'prdate' => $prdate,
        'dep' => $depa,
        'refno' => $ref,
    	'conflag' => 'N',
    	'zzuser' => $fname,
    	'zzstrdate' => $prdate,
    	'chksub1' => '1');
		$this->db->insert('PR', $PR);
		$PR_ref = array(
        'prno' => $prno,
    	'Dep_name' => $sqldepname1);
		$this->db->insert('PR_ref', $PR_ref);
		}
		// approval
		elseif($type =='approval'){
		$PR = array(
        'comid' => '0001',
        'prno' => $prno,
        'prdate' => $prdate,
        'dep' => $depa,
        'refno' => $ref,
    	'conflag' => 'N',
    	'zzuser' => $fname,
    	'zzstrdate' => $prdate,
    	'chksub1' => '1');
		$this->db->insert('PR', $PR);
		$PR_ref = array(
        'prno' => $prno,
    	'Dep_name' => $sqldepname1);
		$this->db->insert('PR_ref', $PR_ref);
		}
	}

	public function updatepr($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$express)
	{
		if ($warecode=='null' OR $depname=='' OR $div=='null') {
			$Data = 'กรุณาเลือกข้อมูลสำคัญ';
			$Code = '1';
		}else{
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => $warecode,
				'dep' => $depcode,
				'express' => $express);
			$this->db->where('prno', $prno);
			$this->db->update('PR', $PR);
			$PR_ref = array(
				'DC' => $dc,
				'DC_A' => $dc_a,
				'Vat' => $vat,
				'Vendor' => $vendor,
				'Vendor_name' => $vendorname,
				'Dep_name' => $depname);
			$type = $this->session->type;
			$prdatehod = date('Ymd');
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			// Update Total Price Item
			$totalget = $this->Get_data_model->gettotal($prno);
			if ($dc > 0) {
				$total_discount_c = ($dc*$totalget)/100;
			}else{
				$total_discount_c = "0";
			}
			if ($dc_a > 0) {
				$total_discount_a = $dc_a;
			}else{
				$total_discount_a = "0";
			}
			if ($vat == 'Y') {
				$DV_VA = $total_discount_c + $total_discount_a;
				$total_vat = (7/100)*($totalget - $DV_VA);
			}else{
				$total_vat = "0";
			}
			if ($vat == 'Y' OR $dc_a > 0 OR $dc > 0) {
				if ($dc_a > 0) {
					$total_discount_c = $dc_a;
				}else{
					$total_discount_c = "0";
				}
				if($dc > 0){
					$total_discount_a = (($dc * $totalget)/100);
				}else{
					$total_discount_a = "0";
				}
				$DV_V = $total_discount_c + $total_discount_a;
				if ($vat == 'Y') {
					$res_p2 = (7/100)*($totalget - $DV_V);
				}elseif($vat == 'N'){
					$res_p2 = 0;
				}
				$total_gobal = $totalget - $DV_V + $res_p2;			
			}else{
				$total_gobal = "0";
			}
			if ($totalget != '') {
				$all_discount = $total_discount_c + $total_discount_a;
				$newtotalget = $totalget - $all_discount;
			}
			$PR_priceup = array(
				'totalprice' => $newtotalget,
				'total_vat' => $total_vat,
				'total_discount_c' => $total_discount_c,
				'total_discount_a' => $total_discount_a,
				'total_gobal' => $total_gobal);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_priceup);
			// Return
			$Data = 'บันทึกสำเร็จ';
			$Code = '2';
		}
		$arrt = array(
			'Data' => $Data, 'Code' => $Code);
		echo json_encode($arrt);

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

	public function golistmodel3()
	{
		$vgolist = $this->input->post('value');
		$dep = $this->session->dep;
		$username = $this->session->username;
		if ($vgolist=='') {
		if ($dep =='AC' OR $username =='Somkhit' OR $username == 'Nuntaporn') {
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(100);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->order_by("PR.prno", "desc");
		$result = $this->db->get()->result_array();
		}else{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(100);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('PR.dep', $dep);
		$this->db->order_by("PR.prno", "desc");
		$result = $this->db->get()->result_array();
		}
		}else{
		if ($dep =='AC' OR $username =='Somkhit') {
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(100);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->like('PR.prno', $vgolist);
		$this->db->or_like('PR.refno', $vgolist);
		$this->db->or_like('PR_ref.Vendor_name', $vgolist);
		$this->db->order_by("PR.prno", "desc");
		$result = $this->db->get()->result_array();
		}else{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(100);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('PR.dep', $dep);
		$this->db->like('PR.prno', $vgolist);
		$this->db->or_like('PR.refno', $vgolist);
		$this->db->where('PR.dep', $dep);
		$this->db->or_like('PR_ref.Vendor_name', $vgolist);
		$this->db->where('PR.dep', $dep);
		$this->db->or_like('PR_ref.Vendor', $vgolist);
		$this->db->where('PR.dep', $dep);
		$this->db->order_by("PR.prno", "desc");
		$result = $this->db->get()->result_array();
		}
		}
		return $result;
	}

	public function golistmodelv()
	{
		$vgolistv = $this->input->post('value');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(100);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->like('Vendor_name', $vgolistv);
		$this->db->order_by("prdate", "desc");
		$result = $this->db->get()->result_array();
		return $result;
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
		$renum = $num+1;
		return $renum;
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

	public function setproductoldpr()
	{
		$v_id = $this->input->post('v_id');
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->from('PR_Item');
		$this->db->join('PR', 'PR_Item.prno = PR.prno');
		$this->db->where('PR_Item.prdcode', $v_id);
		$this->db->order_by('PR_Item.prno', 'desc');
		$result = $this->db->get()->result_array();
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
