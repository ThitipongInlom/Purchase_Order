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
		if ($leve=='admin') {
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
			$this->db->select('*');
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
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('HdApprove','Y');
			$this->db->where('PRApprove','Y');
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);		
			$this->db->order_by("PRApprove_Date", "desc");
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);						
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}			
			$result = $this->db->get()->result_array();
		}elseif($username=='Nalinee'){
			$this->db->select('*');
			$this->db->from('PR');
			$this->db->limit(1000);
			$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('PRApprove IS NOT NULL',null, false);
			$this->db->where('GMApprove IS NOT NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by("GMApprove_Date", "desc");
			$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
			$this->db->where($where);					
			if ($dateforstart !='N' AND $dateforend !='N') {
			$this->db->where('prdate >=', $dateforstart);
			$this->db->where('prdate <=', $dateforend);
			}			
			$result = $this->db->get()->result_array();
		}elseif ($dep=='EXC' AND $leve=='user' OR $dep=='EXC' AND $leve=='hod') {
			$this->db->select('*');
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
			$this->db->select('*');
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

	public function Get_completed($dateforstart,$dateforend)
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
			$this->db->where('completed','Y');		
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
			$this->db->where('completed','Y');		
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

	public function approveY($primary,$approvedata,$type,$date,$username)
	{
		if ($type=='hod') {
			$PR_ref = array(
			'HdApprove' => $approvedata,
			'HdApprove_Date' => $date);
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
			$PR_ref = array(
			'HdApprove' => $approvedata,
			'HdApprove_Date' => $date);
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



	

}

/* End of file Get_data.php */
/* Location: ./application/models/Get_data.php */
?>