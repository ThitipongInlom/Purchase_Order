<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Get_data_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$beta = $this->load->database('bo', TRUE);
	}

	public function statusapp($prid,$statusappval,$userby)
	{
		if ($statusappval!='') {
		$renewuserby = $statusappval.' '.$userby;
		$data = array(
        'statusapp' => $renewuserby);
		}else{
		$renewuserby = "";
		$data = array(
        'statusapp' => $renewuserby);
		}
		$this->db->where('prno', $prid);
		$this->db->update('PR_ref', $data);
		return $renewuserby;
	}

	public function updatestatustime($prid,$datetimeupdate,$statusappval)
	{
		if ($this->session->username=='Somkhit') {
			$userby = 'GM';
		}elseif ($this->session->username=='Nalinee') {
			$userby = 'EFC';
		}elseif ($this->session->dep=='AC') {
			$userby = 'AC';
		}else{
			$userby = ''.$this->session->dep;
		}
		if ($statusappval!='') {
		$data = array(
			'statusdatetime' => $datetimeupdate,
			'statusby' => $userby);
		}else{
		$data = array(
			'statusdatetime' => NULL,
			'statusby' => '');
		}
		$this->db->where('prno', $prid);
		$this->db->update('PR_ref', $data);
		return;
	}

	public function gettotal($prnoid)
	{
		$this->db->select("(SELECT SUM(PR_Item.prprice * PR_Item.prqty) FROM PR_Item WHERE PR_Item.prno ='$prnoid')", FALSE);
		$query = $this->db->get();
		$row = $query->result_array();
		$result = $row[0][null];
		return $result;
	}

	public function deletedata($id)
	{
		$this->db->delete('PR', array('prno' => $id));
		$this->db->delete('PR_ref', array('prno' => $id));
		$this->db->delete('PR_Item', array('prno' => $id));
		return;
	}

	public function getUnit($warecode)
	{
		$beta = $this->load->database('bo', TRUE);
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->join('STFC0060', 'STFA0010.purunit = STFC0060.mcode');
		$beta->where('stcode', $warecode);
		$result = $beta->get()->result_array();
		$mdesc1 = $result[0]['stunit1'];
		return $mdesc1;
	}

	public function getUniten($warecode)
	{
		$beta = $this->load->database('bo', TRUE);
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->join('STFC0060', 'STFA0010.purunit = STFC0060.mcode');
		$beta->where('stcode', $warecode);
		$result = $beta->get()->result_array();
		$mdesc1 = $result[0]['stunit1'];
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

	public function Get_all($dateforstart,$dateforend)
	{
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}
		$leve = $this->session->type;
		if ($leve=='admin' OR $dep=='AC') {
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('GMApprove IS NULL',null, false);
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);
			$this->db->order_by("PR.prno", "desc");
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$result = $this->db->get()->result_array();
		}else{
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where_in('dep', $depa);
			$this->db->where('GMApprove IS NULL',null, false);
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null) and chksub1='1')";
			$this->db->where($where);
			$this->db->order_by("PR.prno", "asc");
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function Get_approve($dateforstart,$dateforend)
	{
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}
		$leve = $this->session->type;
		$username = $this->session->username;
		if ($leve=='admin' OR $dep=='AC') {
			$this->db->select("*,row_number() OVER (ORDER BY PR_ref.prno desc) AS 'NO'");
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by("PR.prno", "desc");
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$result = $this->db->get()->result_array();
		}elseif($username=='Somkhit'){
			$this->db->select("*,row_number() OVER (ORDER BY PRApprove_Date desc, PR_ref.prno desc) AS 'NO'");
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('HdApprove','Y');
			$this->db->where('PRApprove','Y');
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			//$this->db->order_by("PRApprove_Date", "desc");
			$this->db->order_by("NO", "asc");
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$result = $this->db->get()->result_array();
		}elseif($username=='Nalinee'){
			$this->db->select("*,row_number() OVER (ORDER BY GMApprove_Date desc, PR_ref.prno desc) AS 'NO'");
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('PRApprove IS NOT NULL',null, false);
			$this->db->where('GMApprove IS NOT NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by("NO", "asc");
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$result = $this->db->get()->result_array();
		}elseif ($dep=='EXC' AND $leve=='user' OR $dep=='EXC' AND $leve=='hod') {
			$this->db->select("*,row_number() OVER (ORDER BY  PR_ref.prno desc) AS 'NO'");
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by("PR.prno", "desc");
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$result = $this->db->get()->result_array();
		}else{
			$this->db->select("*,row_number() OVER (ORDER BY  PR_ref.prno desc) AS 'NO'");
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			//$depwhere = "";
			$this->db->where_in('dep', $depa);
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.GMApprove_Date", "desc");
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function Get_accounting($dateforstart,$dateforend,$i)
	{
		if ($i=='All') {
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(300);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
		$this->db->where('HdApprove','Y');
		if ($dateforstart !='N' AND $dateforend !='N') {
		$this->db->where('prdate >=', $dateforstart);
		$this->db->where('prdate <=', $dateforend);
		}
		$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (PRApprove is null OR PRApprove<>'N') AND (completed is null))";
		$this->db->where($where);
		$this->db->order_by("PR_ref.prno", "desc");
		$result = $this->db->get()->result_array();
		return $result;
		}else{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(300);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
		$this->db->where('HdApprove','Y');
		$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (PRApprove is null OR PRApprove<>'N') AND (completed is null))";
		$this->db->where('dep', $i);
		$this->db->where($where);
		if ($dateforstart !='N' AND $dateforend !='N') {
		$this->db->where('prdate >=', $dateforstart);
		$this->db->where('prdate <=', $dateforend);
		}
		$this->db->order_by("PR_ref.prno", "desc");
		$result = $this->db->get()->result_array();
		return $result;
		}
	}

	public function Get_completed($dateforstart,$dateforend,$searchpraa)
	{
		$beta = $this->load->database('bo', TRUE);
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}
		$leve = $this->session->type;
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(200);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
			$this->db->where('completed','Y');
			//$this->db->where('chkre IS NULL',null, false);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			if ($searchpraa != 'N') {
			$this->db->like('PR_ref.prno', $searchpraa);
			$this->db->or_like('PR_ref.Vendor', $searchpraa);
			$this->db->or_like('PR.refno', $searchpraa);
			$this->db->or_like('PR.dep', $searchpraa);
			$this->db->or_like('PR.warecode', $searchpraa);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}else{
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(200);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
			$this->db->where_in('dep', $depa);
			$this->db->where('completed','Y');
			//$this->db->where('chkre IS NULL',null, false);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			if ($searchpraa != 'N') {
			$this->db->like('PR_ref.prno', $searchpraa);
			$this->db->or_like('PR_ref.Vendor', $searchpraa);
			$this->db->or_like('PR.refno', $searchpraa);
			$this->db->or_like('PR.dep', $searchpraa);
			$this->db->or_like('PR.warecode', $searchpraa);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function Get_completed2($dateforstart,$dateforend)
	{
		$beta = $this->load->database('bo', TRUE);
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}
		$leve = $this->session->type;
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(200);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
			$this->db->where('completed','Y');
			$this->db->where('chkre','Y');
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}else{
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(200);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
			$this->db->where_in('dep', $depa);
			$this->db->where('completed','Y');
			$this->db->where('chkre','Y');
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function Get_completedrc($dateforstart,$dateforend)
	{
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}
		$leve = $this->session->type;
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(200);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$where = "((PR_ref.GMApprove<>'N' OR PR_ref.GMApprove is null) AND (PR_ref.EFCApprove<>'N' OR PR_ref.EFCApprove is null) AND (PR_ref.PRApprove is null OR PR_ref.PRApprove<>'N') AND (chkre is null) AND (PR.warecode is not null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}else{
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(200);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where_in('dep', $depa);
			$where = "((PR_ref.GMApprove<>'N' OR PR_ref.GMApprove is null) AND (PR_ref.EFCApprove<>'N' OR PR_ref.EFCApprove is null) AND (PR_ref.PRApprove is null OR PR_ref.PRApprove<>'N') AND (chkre is null) AND (PR.warecode is not null))";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function Get_reject($dateforstart,$dateforend)
	{
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
		$depa = array();
		$dep1 = strstr($dep, ",", true);
		$dep2 = strstr($dep, ",");
		$dep2 = str_replace(",","",$dep2);
		array_push($depa, $dep1);
		array_push($depa, $dep2);
		}else{
			$depa = $dep;
		}
		$leve = $this->session->type;
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(400);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$where = "(HDApprove='N' OR PRApprove='N' OR GMApprove='N' OR EFCApprove='N')";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}else{
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(400);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where_in('dep', $depa);
			$where = "(HDApprove='N' OR PRApprove='N' OR GMApprove='N' OR EFCApprove='N')";
			$this->db->where($where);
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}
			$this->db->order_by("PR_ref.prno", "desc");
			$result = $this->db->get()->result_array();
		}
		return $result;
	}

	public function modal_head_open($prnoopen)
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(1000);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('PR.prno', $prnoopen);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function RC_modal_head_open($prnoarray)
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(1000);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where_in('PR.prno', $prnoarray);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function Get_pono_model($prno)
	{
		$query_Coss = $this->db->get_where('Coss_PR', array('prno' => $prno));
		$result = $query_Coss->result();
		return $result;
	}

	public function modal_body_open($prnoopen)
	{
		$this->db->select('*');
		$this->db->from('PR_Item');
		$this->db->limit(1000);
		$this->db->where('prno', $prnoopen);
		$this->db->order_by("seq");
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function RC_modal_body_open($prnoarray)
	{
		$this->db->select('*');
		$this->db->from('PR_Item');
		$this->db->limit(1000);
		$this->db->where_in('prno', $prnoarray);
		$this->db->order_by("seq");
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function approveY($primary,$approvedata,$type,$date,$username)
	{
		if ($type=='hod' OR $username=='Somkid') {
			$signature_img = $this->session->signature_img;
			if ($signature_img=='') {
				$signature = '';
			}else{
				$signature = $username;
			}
			if ($type=='hod') {
			$PR_ref = array(
			'HdApprove' => $approvedata,
			'HdApprove_Date' => $date,
			'Hd_signature' => $signature);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			}elseif ($username=='Somkid') {
			$query = $this->db->get_where('PR_ref', array('prno' => $primary));
			$result = $query->result_array();
			$signatureref = $result[0]['Hd_signature'];
			$namedep = $result[0]['Dep_name'];
			// signature Null
			if ($signatureref == '' AND $namedep == 'Accounting') {
			$PR_ref = array(
			'HdApprove' => $approvedata,
			'HdApprove_Date' => $date,
			'Hd_signature' => $signature);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			}else{
			$PR_ref = array(
			'HdApprove' => $approvedata,
			'HdApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			}
			}
			$array = array(
				'data' => 'HOD approve');
			echo json_encode($array);
		}
		if ($type=='approval' AND $username=='Somkhit') {
			$PR_ref = array(
			'GMApprove' => $approvedata,
			'GMApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$PR_Item = array(
			'selected' => 'Y');
			$this->db->where('prno', $primary);
			$this->db->update('PR_Item', $PR_Item);
			$array = array(
				'data' => 'GM approve');
			echo json_encode($array);
		}
		if ($type=='approval' AND $username=='Nalinee') {
			$PR_ref = array(
			'EFCApprove' => $approvedata,
			'EFCApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$array = array(
				'data' => 'EFC approve');
			echo json_encode($array);
		}
		if ($type=='accounting' OR $type=='accounting0') {
			$PR_ref = array(
			'PRApprove' => $approvedata,
			'PRApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$array = array(
				'data' => 'AC approve');
			echo json_encode($array);
		}
	}

	public function approveX($primary,$approvedata,$type,$date,$username)
	{
		if ($type=='hod') {
			$signature_img = $this->session->signature_img;
			$username = $this->session->username;
			if ($signature_img=='') {
				$signature = '';
			}else{
				$signature = $username;
			}
			$PR_ref = array(
			'HdApprove' => $approvedata,
			'HdApprove_Date' => $date,
			'Hd_signature' => $signature);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$array = array(
				'data' => 'HOD approve');
			echo json_encode($array);
		}
		if ($type=='approval' AND $username=='Somkhit') {
			$PR_ref = array(
			'GMApprove' => $approvedata,
			'GMApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$PR_Item = array(
			'selected' => 'N');
			$this->db->where('prno', $primary);
			$this->db->update('PR_Item', $PR_Item);
			$array = array(
				'data' => 'GM approve');
			echo json_encode($array);
		}
		if ($type=='approval' AND $username=='Nalinee') {
			$PR_ref = array(
			'EFCApprove' => $approvedata,
			'EFCApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$array = array(
				'data' => 'EFC approve');
			echo json_encode($array);
		}
		if ($type=='accounting' OR $type=='accounting0') {
			$PR_ref = array(
			'PRApprove' => $approvedata,
			'PRApprove_Date' => $date);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$array = array(
				'data' => 'AC approve');
			echo json_encode($array);
		}
	}

	public function completedY($primary,$approvedata)
	{
			$PR_ref = array(
			'completed' => $approvedata);
			$this->db->where('prno', $primary);
			$this->db->update('PR_ref', $PR_ref);
			$array = array(
				'data' => 'Completed');
			echo json_encode($array);
	}

	public function savesetvenderpr($vendorcode,$vendorname,$prno)
	{
			$PR_ref = array(
			'Vendor' => $vendorcode,
			'Vendor_name' => $vendorname);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			return;
	}

	public function get_tokenbot()
	{
			$query = $this->db->get('Bot');
			$result = $query->row();
			return $result->Bot_token;
	}

	public function Getimg_hod($userhodapp)
	{
			$this->db->select('*');
			$this->db->from('PR_Users');
			$this->db->join('PR_ref', 'PR_ref.Hd_signature = PR_Users.username');
			$this->db->where('PR_Users.username', $userhodapp);
			$this->db->limit(1);
			$result = $this->db->get()->result_array();
			return $result;
	}

	public function Faxsave($data)
	{
		$this->db->insert('Fax', $data);
	}

	public function FaxCount()
	{
		$count = $this->db->count_all('Fax');
		return $count;
	}

	public function Faxdata()
	{
		$query = $this->db->get('Fax');
		$result = $query->result_array();
		return $result;
	}

	public function Check_BO_number($primary)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->select('*');
		$beta->from('POFE0020');
		$beta->where('run_code', 'PO3');
		$result = $beta->get()->result_array();
		$Old_pono = $result[0]['runno'];
		$newpr = substr($Old_pono,0)+1;
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
		$newpr = "PO3-".$newpr;
		return $newpr;
	}

	public function Get_Pono_primary($prno)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$query = $this->db->get_where('PR', array('prno' => $prno));
		$result = $query->result();
		$refno = $result[0]->refno;
		$query2 = $beta->get_where('PXFB0010', array('refno' => $refno));
		$result2 = $query2->result();
		return $result2[0]->pono;
	}

	public function run_no()
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->select('*');
		$beta->from('POFE0020');
		$beta->where('run_code', 'PO3');
		$result = $beta->get()->result_array();
		$Old_pono = $result[0]['runno'];
		$newpr = substr($Old_pono,0)+1;
		return $newpr;
	}

	public function insert_run_no($run_no)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->set('runno', $run_no);
		$beta->where('run_code', 'PO3');
		$beta->update('POFE0020');
		return;
	}

	public function insert_pono($BO_num,$primary,$podate)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$username = $this->session->username;
		$zzdate = $this->dateformat1();
		$zzstrdate = $this->dateformat2();
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(1);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('PR.prno', $primary);
		$result = $this->db->get()->result_array();
		$refno = $result[0]['refno'];


		$query_Coss = $this->db->get_where('Coss_PR', array('prno' => $primary));
		$result_Coss = $query_Coss->num_rows();
		$date_now = date("Y-m-d H:i:s");
		if ($result_Coss == '0') {
			$data = array(
				'prno' => $primary,
				'refno' => $refno,
				'pono' => $BO_num,
				'date_update' => $date_now);
			$this->db->insert('Coss_PR', $data);
		}elseif ($result_Coss ==  '1') {
			$this->db->set('pono', $BO_num);
			$this->db->set('date_update', $date_now);
			$this->db->where('refno', $refno);
			$this->db->update('Coss_PR');
		}
		// วนลูป ข้อมูล
		foreach ($result as $key => $row) {
			// ถ้า Vat มีค่า = Y
			if ($row['Vat'] == 'Y') {
				// ตั้งตัวแปร เก็บ ค่า 7
				$revat = '7';
			}elseif ($row['Vat'] == 'N') {
				$revat = '0';
			}
			if ($row['dep'] == 'HK03') {
				$row['dep'] = '';
			}else{
				$row['dep'] = $row['dep'];
			}
			$totamtcur = $this->totamtcur($primary);
			if ($row['Vat'] > 1) {
				$vatamtcur = $this->vatamtcur($totamtcur);
				$netamtcur = $this->netamtcur($totamtcur,$vatamtcur);
			}else{
				$vatamtcur = '';
				$netamtcur = $totamtcur;
			}

			$data = array(
	        'comid' => '0001',
	        'pono' => $BO_num,
	        'podate' => $podate,
	        'buytype' => '3',
	        'vencode' => $row['Vendor'],
	        'inclusive' => 'N',
	        'warecode' => strtoupper($row['warecode']),
	        'refno' => $row['refno'],
	        'refdate' => $podate,
	        'crterm' => $this->crterm($row['Vendor']),
	        'deldate' => $podate,
	        'div' => $row['div'],
	        'dep' => '',
	        'offcode' => 'N.03',
	        'currency' => 'BAHT',
	        'partflag' => 'Y',
	        'delloc1' => '',
	        'delloc2' => '',
	        'delloc3' => '',
	        'rem1' => '',
	        'rem2' => '',
	        'rem3' => '',
	        'rem4' => '',
	        'rem5' => '',
	        'placeflag' => 'N',
	        'totamtcur' => number_format($totamtcur, 2, '.', ''),
	        'discper1' => '0',
	        'discper2' => '0',
	        'discper3' => '0',
	        'totdisc3cur' => '0',
	        'discamtcur' => '0',
	        'expcode1' => '',
	        'expamtcur1' => '0',
	        'expcode2' => '',
	        'expamtcur2' => '0',
	        'totbfvatcur' => number_format($totamtcur, 2, '.', ''),
	        'vatcode' => number_format($revat, 2, '.', ''),
	        'vatloc' => '001',
	        'vatrate' => number_format($revat, 2, '.', ''),
	        'vatamtcur' => $vatamtcur,
	        'netamtcur' => number_format($netamtcur, 2, '.', ''),
	        'endflag' => 'N',
	        'holdflag' => 'N',
	        'postatus' => 'N',
	        'zzuser' => strtoupper($username),
	        'zzdate' => $zzdate,
	        'zzstrdate' => $zzstrdate,
	        'holdcode' => '',
	        'updprice' => 'Y',
	        'totcalvatcur' => number_format($totamtcur, 2, '.', ''),
	        'prno' => '',
	        'prntime' => '0',
	        'overreceived' => 'Y',
	        'jobcode' => '',
	        'approveFlag' => 'N');
			$this->Insert_px00011($data);
		}
		return;
	}

	public function Insert_px00011($data)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->insert('PXFB0010', $data);
	}

	public function crterm($vencode)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->select('*');
		$beta->from('PXFB0010');
		$beta->where('vencode', $vencode);
		$result = $beta->get()->result_array();
		return $result[0]['crterm'];
	}

	public function totamtcur($primary)
	{
		$this->db->select("(SELECT SUM(PR_Item.prprice * PR_Item.prqty) FROM PR_Item WHERE PR_Item.prno ='$primary')", FALSE);
		$query = $this->db->get();
		$row = $query->result_array();
		$result = $row[0][''];
		return $result;
	}

	public function insert_pono2($BO_num,$primary)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$this->db->select('*');
		$this->db->from('PR_Item');
		$this->db->where('prno', $primary);
		$result = $this->db->get()->result_array();
		foreach ($result as $key => $row) {
			$amountcur = $row['prqty'] * $row['prprice'];
			$purunitdesc = $this->purunitdesc($row['prdcode']);
			$confactor1  = $this->confactor1($row['prdcode']);
			$data[] = array(
				'comid' => '0001',
				'pono' => $BO_num,
				'seq' => $row['seq'],
				'prdcode' => $row['prdcode'],
				'stbarcode' => '',
				'poqty' => $row['prqty'],
				'price' => $row['prprice'],
				'discper1' => '0',
				'discper2' => '0',
				'discprice' => '0',
				'amountcur' => $amountcur,
				'stockflag' => 'N',
				'invqty' => '0',
				'confactor' => $confactor1,
				'purunitdesc' => $purunitdesc,
				'whcode' => '',
				'prflag' => '');
		}
		$beta->insert_batch('PXFB0011', $data);
		return;
	}

	public function update_pono2($BO_num,$primary)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$this->db->select('*');
		$this->db->from('PR_Item');
		$this->db->where('prno', $primary);
		$result = $this->db->get()->result_array();
		foreach ($result as $key => $row) {
			$amountcur = $row['prqty'] * $row['prprice'];
			$purunitdesc = $this->purunitdesc($row['prdcode']);
			$confactor1  = $this->confactor1($row['prdcode']);
			$data = array(
				'comid' => '0001',
				'pono' => $BO_num,
				'seq' => $row['seq'],
				'prdcode' => $row['prdcode'],
				'stbarcode' => '',
				'poqty' => $row['prqty'],
				'price' => $row['prprice'],
				'discper1' => '0',
				'discper2' => '0',
				'discprice' => '0',
				'amountcur' => $amountcur,
				'stockflag' => 'N',
				'invqty' => '0',
				'confactor' => $confactor1,
				'purunitdesc' => $purunitdesc,
				'whcode' => '',
				'prflag' => '');
				$beta->where('pono', $BO_num);
				$beta->update('PXFB0011', $data);
		}
		return;
	}

	public function dateformat1() {
	    $output = date("d m Y h:i:s A");
	    $datearray = explode(" ", $output);
	    $customyear = $datearray[2]+543;
	    $output =  $customyear."".$datearray[1]."".$datearray[0]." ".$datearray[3]." ".$datearray[4];
	  return $output;
	}

	public function dateformat2() {
	    $output = date("d m Y h:i:s A");
	    $datearray = explode(" ", $output);
	    $customyear = $datearray[2]+543;
	    $output =  $customyear."".$datearray[1]."".$datearray[0];
	  return $output;
	}

	public function vatamtcur($total)
	{
		$result = ($total*7)/100;
		return $result;
	}

	public function netamtcur($totamtcur,$vatamtcur)
	{
		$result = $totamtcur+$vatamtcur;
		return $result;
	}

	public function confactor1($stcode)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->where('stcode', $stcode);
		$result = $beta->get()->result_array();
		return $result[0]['confactor1'];
	}

	public function purunitdesc($stcode)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$beta->select('*');
		$beta->from('STFA0010');
		$beta->where('stcode', $stcode);
		$result = $beta->get()->result_array();
		return $result[0]['purunit'];
	}

	public function Get_refno_pr($prno)
	{
		$query = $this->db->get_where('PR', array('prno' => $prno));
		$result = $query->result();
		return $result[0]->refno;
	}

	public function Get_Zign_Beta($refno)
	{
		$beta = $this->load->database('Bo1', TRUE);
		$query = $beta->get_where('PXFB0010', array('refno' => $refno));
		$result = $query->result_array();
		if (empty($result)) {
		  $pono = '0';
		}else{
		  $pono = '1';
		}
		return $pono;
	}

	public function Get_pr_004($primary)
	{
		$query = $this->db->get_where('PR_ref', array('prno' => $primary));
		$result = $query->result();
		$vendor = $result[0]->Vendor;
		if ($vendor == 'C004') {
			$resultvendor = '1';
		}else{
			$resultvendor = '0';
		}
		return $resultvendor;
	}

	public function Vendor004completedY_AC($prno)
	{
		$PR_ref = array(
			'chkre' => 'Y');
		$this->db->where('prno', $prno);
		$this->db->update('PR_ref', $PR_ref);
	}

	public function AC_appovecheck()
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->limit(300);
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		//$this->db->join('Coss_PR', 'Coss_PR.prno = PR.prno');
		$where = "((dep = 'AC') AND (GMApprove is null) AND (EFCApprove is null) AND (PRApprove is null) AND (completed is null) AND (warecode != '' ) AND (HdApprove is null) OR (dep != 'AC') AND (GMApprove is null) AND (EFCApprove is null) AND (PRApprove is null) AND (completed is null) AND (warecode != '' ) AND (HdApprove = 'Y'))";
		$this->db->where($where);
		$this->db->order_by("PR_ref.prno", "desc");
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function acapproveaction_model($prno)
	{
		$date = date('YmdHi');
		$query = $this->db->get_where('PR_ref', array('prno' => $prno));
		$result = $query->result_array();
		if ($result[0]['HdApprove'] == 'Y') {
		$PR_ref = array('PRApprove' => 'Y','PRApprove_Date' => $date);
		}else{
		$PR_ref = array('HdApprove' => 'Y','HdApprove_Date' => $date,'PRApprove' => 'Y','PRApprove_Date' => $date, 'Hd_signature' => 'Somkid');
		}
		$this->db->where('prno', $prno);
		$this->db->update('PR_ref', $PR_ref);
	}





}

/* End of file Get_data.php */
/* Location: ./application/models/Get_data.php */
?>
