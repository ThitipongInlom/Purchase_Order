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
		$this->db->select('stcode,stname1,stunit1,mdesc1');
 
		$condition = "1=1";
		if(!empty($keyword)){
			$condition .= " and (stcode like '%{$keyword}%' or stname1 like '%{$keyword}%')";
		}
 
		$this->db->join('STFC0060', 'STFC0060.mcode = STFA0010.stunit1', 'left');
		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);
 
		$query = $this->db->get('STFA0010');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
		}else{
			$data = '';
		}
 
		$count_condition = $this->db->from('STFA0010')->where($condition)->count_all_results();
		$count = $this->db->from('STFA0010')->count_all_results();
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'');
		return $result;
	}

	public function Getunit_product()
	{
		$return_arr = array();
		$row_array = array();
		$text = $this->input->get('text');
		if ($text==null) {
		$barang = $this->db->select("*")
						->from("STFC0060")
						->get();
		}else{
		$barang = $this->db->select("*")
						->from("STFC0060")
						->like("mdesc1", $text)
						->or_like("mdesc2",$text)
						->get();
		}
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['mdesc2'];
				$row_array['text'] = "<strong>[".$row['mdesc2'] ."]</strong> $row[mdesc1]";
				array_push($return_arr,$row_array);
			}
			}
		echo json_encode(array("results" => $return_arr ));
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
		}else{
			$data = '';
		}
 
		$count_condition = $this->db->from('APFA0010')->where($condition)->count_all_results();
		$count = $this->db->from('APFA0010')->count_all_results();

		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'');
		return $result;
	}

	public function find_with_page_warehouse($param){
		$keyword = $param['keyword'];
		$this->db->select('*');
 
		$condition = "1=1";
		if(!empty($keyword)){
			$condition .= " and (warecode like '%{$keyword}%' or waredesc1 like '%{$keyword}%')";
		}
 
		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);
 
		$query = $this->db->get('STFC0070');
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
		}else{
			$data = '';
		}
 
		$count_condition = $this->db->from('STFC0070')->where($condition)->count_all_results();
		$count = $this->db->from('STFC0070')->count_all_results();

		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'');
		return $result;
	}

	public function CheckCode_SaveAddvendor()
	{
		$result = $this->db->count_all_results('APFA0010');
		return $result;
	}

	public function CheckNum_rows_product()
	{
		$result = $this->db->count_all_results('STFA0010');
		return $result;		
	}

	public function CheckNum_rows_warehouse()
	{
		$result = $this->db->count_all_results('STFC0070');
		return $result;		
	}

	public function CheckNum_rows_vendor()
	{
		$result = $this->db->count_all_results('APFA0010');
		return $result;	
	}

	public function Check_Name_product()
	{
		$Name = $_POST['Name'];
		$Unit = $_POST['Unit'];	
		$this->db->select('*');
		$this->db->from('STFA0010');
		$this->db->where('stname1', $Name);
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function Check_Name_warehouse()
	{
		$Name = $_POST['Name'];
		$this->db->select('*');
		$this->db->from('STFC0070');
		$this->db->where('waredesc1', $Name);
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function Insert_product($newcode)
	{
		$Name = $_POST['Name'];
		$Unit = $_POST['Unit'];
		$data = array(
				'comid' => '0001',
				'stcode' => $newcode,
				'stname1' => $Name,
				'purunit' => $Unit,
				'stunit1' => $Unit
		);
		$this->db->insert('STFA0010', $data);
		return;
	}

	public function Insert_warehouse($newcode)
	{
		$Name = $_POST['Name'];
		$data = array(
				'comid' => '0001',
				'warecode' => $newcode,
				'waredesc1' => $Name,
				'div' => 'Z01'
		);		
		$this->db->insert('STFC0070', $data);
		return;
	}

	public function Edit_Getproduct()
	{
		$Code = $_POST['code'];
		$this->db->select('*');
		$this->db->from('STFA0010');
		$this->db->join('STFC0060', 'STFC0060.mcode = STFA0010.stunit1');
		$this->db->where('stcode', $Code);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function EditSaveProduct()
	{
		$Code = $_POST['Code'];
		$Name = $_POST['Name'];
		$Unit = $_POST['Unit'];
		$data = array(
				'stname1' => $Name,
				'stunit1' => $Unit
		);
		$this->db->where('stcode', $Code);
		$this->db->update('STFA0010', $data);
		return;
	}

	public function CheckNum_rows_editproduct()
	{
		$Name = $_POST['Name'];
		$Unit = $_POST['Unit'];
		$this->db->select('*');
		$this->db->from('STFA0010');
		$this->db->where('stname1', $Name);
		$this->db->where('stunit1', $Unit);
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function CheckCode_EditAddwarehouse()
	{
		$Name = $_POST['name'];
		$this->db->select('*');
		$this->db->from('STFC0070');
		$this->db->where('waredesc1', $Name);
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function CheckCode_EditAddvendor()
	{
		$Code = $_POST['code'];
		$Name = $_POST['name'];
		$Phone = $_POST['phone'];
		$Fax = $_POST['fax'];
		$Email = $_POST['email'];
		$Address = $_POST['address'];
		$this->db->select('*');
		$this->db->from('APFA0010');
		$this->db->where('vencode', $Code);
		$this->db->where('venname1', $Name);
		$this->db->where('venadd1', $Address);
		$this->db->where('ventel', $Phone);
		$this->db->where('venfax', $Fax);
		$this->db->where('venemail', $Email);
		$result = $this->db->get()->num_rows();
		return $result;
	}

	public function Delete_Vendor()
	{
		$Code = $_POST['code'];
		$this->db->where('vencode', $Code);
		$this->db->delete('APFA0010');
		return;
	}

	public function Delete_product()
	{
		$Code = $_POST['code'];
		$this->db->where('stcode', $Code);
		$this->db->delete('STFA0010');
		return;
	}

	public function Deletewarehouse()
	{
		$Code = $_POST['code'];
		$this->db->where('warecode', $Code);
		$this->db->delete('STFC0070');
		return;
	}

	public function Edit_Getvendor()
	{
		$Code = $_POST['code'];
		$this->db->select('*');
		$this->db->from('APFA0010');
		$this->db->where('vencode', $Code);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function Edit_warehouse()
	{
		$Code = $_POST['code'];
		$this->db->select('*');
		$this->db->from('STFC0070');
		$this->db->where('warecode', $Code);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function Insert_vendor($Code)
	{
		$Name = $_POST['name'];
		$Phone = $_POST['phone'];
		$Fax = $_POST['fax'];
		$Email = $_POST['email'];
		$Address = $_POST['address'];
		$data = array(
				'comid' => '0001',
				'vencode' => strtoupper($Code),
				'apcode' => strtoupper($Code),
				'venname1' => $Name,
				'venadd1' => $Address,
				'ventel' => $Phone,
				'venfax' => $Fax,
				'venemail' => $Email
		);
		$this->db->insert('APFA0010', $data);
		return;
	}

	public function Update_vendor()
	{
		$Code = $_POST['code'];
		$Name = $_POST['name'];
		$Phone = $_POST['phone'];
		$Fax = $_POST['fax'];
		$Email = $_POST['email'];
		$Address = $_POST['address'];		
		$data = array(
				'vencode' => $Code,
				'apcode' => $Code,
				'venname1' => $Name,
				'venadd1' => $Address,
				'ventel' => $Phone,
				'venfax' => $Fax,
				'venemail' => $Email
		);
		$this->db->where('vencode', $Code);
		$this->db->update('APFA0010', $data);
		return;
	}

	public function Update_warehouse()
	{
		$Code = $_POST['code'];
		$Name = $_POST['name'];
		$data = array(
				'waredesc1' => $Name
		);
		$this->db->where('warecode', $Code);
		$this->db->update('STFC0070', $data);
		return;
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