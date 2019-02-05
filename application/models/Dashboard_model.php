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

	public function find_with_page_product($param){
		$keyword = $param['keyword'];
		$this->db->select('*');
 
		$condition = "1=1";
		if(!empty($keyword)){
			$condition .= " and (stcode like '%{$keyword}%' or stname1 like '%{$keyword}%')";
		}
 
		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);
 
		$query = $this->db->get('STFA0010');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
		}
 
		$count_condition = $this->db->from('STFA0010')->where($condition)->count_all_results();
		$count = $this->db->from('STFA0010')->count_all_results();
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'');
		return $result;
	}

	public function find_with_page_vendor($param){
		$keyword = $param['keyword'];
		$this->db->select('*');
 
		$condition = "1=1";
		if(!empty($keyword)){
			$condition .= " and (vencode like '%{$keyword}%' or venname1 like '%{$keyword}%')";
		}
 
		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);
 
		$query = $this->db->get('APFA0010');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
		}
 
		$count_condition = $this->db->from('APFA0010')->where($condition)->count_all_results();
		$count = $this->db->from('APFA0010')->count_all_results();
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'');
		return $result;
	}

	public function query_hod_apv_today()
	{
		$today = date('Ymd');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.HdApprove_date,8)', $today);
		$this->db->where('PR_ref.HdApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_ac_apv_today()
	{
		$today = date('Ymd');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.PRApprove_date,8)', $today);
		$this->db->where('PR_ref.PRApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_gm_apv_today()
	{
		$today = date('Ymd');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.GMApprove_date,8)', $today);
		$this->db->where('PR_ref.GMApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_efc_apv_today()
	{
		$today = date('Ymd');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.EFCApprove_date,8)', $today);
		$this->db->where('PR_ref.EFCApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}	


	public function query_ac_apv_todayno()
	{
		$today = date('Ymd');
		$this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.PRApprove_date,8)', $today);
		$this->db->where('PR_ref.hdApprove', 'Y');
		$this->db->where('PR_ref.PRApprove is null');
				$this->db->Group_by ('PR.prno');

		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_gm_apv_todayno()
	{
		$today = date('Ymd');
	    $this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.GMApprove_date,8)', $today);
		$this->db->where('PR_ref.PrApprove', 'Y');
		$this->db->where('PR_ref.GMApprove is null');
		$this->db->Group_by ('PR.prno');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_efc_apv_todayno()
	{
		$today = date('Ymd');
        $this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.efcApprove_date,8)', $today);
		$this->db->where('PR_ref.GMApprove', 'Y');
		$this->db->where('PR_ref.efcApprove is null');
		$this->db->Group_by ('PR.prno');
		$result = $this->db->get()->num_rows();
		return $result;
	}		

/// mouth
public function query_mouth(){
		$mouths = date('Ym');
		$query = $this->db->get_where('PR', array('left(prdate,6)' => $mouths));
		$result = $query->num_rows();
		return $result;
	}
public function query_hod_apv_mouth()
	{
		$mouths = date('Ym');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.HdApprove_date,6)', $mouths);
		$this->db->where('PR_ref.HdApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_ac_apv_mouth()
	{
		$mouths = date('Ym');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.PRApprove_date,6)', $mouths);
		$this->db->where('PR_ref.PRApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_gm_apv_mouth()
	{
		$mouths = date('Ym');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.GMApprove_date,6)', $mouths);
		$this->db->where('PR_ref.GMApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_efc_apv_mouth()
	{
		$mouths = date('Ym');
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.EFCApprove_date,6)', $mouths);
		$this->db->where('PR_ref.EFCApprove', 'Y');
		$result = $this->db->get()->num_rows();
		return $result;
	}		

public function query_ac_apv_mouthno()
	{
		$mouths = date('Ym');
        $this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.hdApprove_date,6)', $mouths);
		$this->db->where('PR_ref.hdApprove', 'Y');
		$this->db->where('PR_ref.prApprove is null');
		$this->db->Group_by ('PR.prno');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_gm_apv_mouthno()
	{
		$mouths = date('Ym');
        $this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.prApprove_date,6)', $mouths);
		$this->db->where('PR_ref.prApprove', 'Y');
		$this->db->where('PR_ref.gmApprove is null');
		$this->db->Group_by ('PR.prno');
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function query_efc_apv_mouthno()
	{
		$mouths = date('Ym');


        $this->db->select('PR.prno');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('left(PR_ref.gmApprove_date,6)', $mouths);
		$this->db->where('PR_ref.gmApprove', 'Y');
		$this->db->where('PR_ref.efcApprove is null');
		$this->db->Group_by ('PR.prno');


		$result = $this->db->get()->num_rows();
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


}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */
?>