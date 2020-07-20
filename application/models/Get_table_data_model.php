<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_table_data_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$beta = $this->load->database('bo', TRUE);
		ini_set('memory_limit','256M');
		ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); 
		ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); 
	}

	public function export_dep()
	{
		$dep = $this->session->dep;
		if ($pos = strrpos($dep, ",")) {
			$dep_new = explode(",",$dep);
		}else{
			$dep_new = $dep;
		}
		return $dep_new;
	}

	public function namewarecode($warecode)
	{
		$CI =& get_instance();
		$beta = $CI->load->database('bo', TRUE);
		$query = $beta->get_where('STFC0070', array('warecode' => $warecode));
		$result = $query->result_array();
		$waredesc1 = $result[0]['waredesc1'];
		return $waredesc1;
	}

	public function Faxdata($prno)
	{
		$query = $this->db->get('Fax');
		$Fax = $query->result_array();
        foreach ($Fax as $key => $value) {  
            if ($value['Fax_prno'] == $prno) {
                $Fax_date = $value['Fax_date'];
				$result[] = nice_date($Fax_date, 'd-m-Y');
				return $result;
            }
        }
	}

	public function return_icon_yes($pr_approve,$pr_approve_date)
	{
		if ($pr_approve == 'Y') {
			$Approve_res = "<i class='fa fa-check fa-2x' aria-hidden='true' style='color: #00a65a;' data-toggle='tooltip' data-placement='bottom' title='$pr_approve_date'></i>";
		}elseif ($pr_approve == 'N') {
			$Approve_res = "<i class='fa fa-times fa-2x' aria-hidden='true' style='color: #dd4b39;'></i>";
		}else{
			$Approve_res = "";
		}
		return $Approve_res;
	}
	
	public function find_with_page_show_all_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$where = "((GMApprove <> 'N' OR GMApprove is null) AND (EFCApprove <> 'N' OR EFCApprove is null) AND (HdApprove <> 'N' OR HdApprove is null) AND (PRApprove <> 'N' OR PRApprove is null))";
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where($where);
		$this->db->where('GMApprove IS NULL',null, false);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by('prdate', $param['dir']);

		if ($leve == 'admin' OR $dep == 'AC') {
			$this->db->where($condition);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where('GMApprove IS NULL',null, false)->where($where)->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where('GMApprove IS NULL',null, false)->where($where)->count_all_results(); 
		}else{
			$this->db->where_in('dep', $depa);
			$this->db->where($condition);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where('GMApprove IS NULL',null, false)->where_in('dep', $depa)->where($where)->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where('GMApprove IS NULL',null, false)->where_in('dep', $depa)->where($where)->count_all_results(); 
		}
 
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<img width='55' src='".base_url().'/assets/icon/express.gif'."'>" : "";
				$prdate = $row->prdate == '' ? "" : nice_date($row->prdate, 'd-m-Y');
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$warecode = $row->warecode == '' ? "" : $this->namewarecode($row->warecode).' - '.$row->warecode;
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";
				$action = "
                    <button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
                    <button type='button' class='btn btn-xs  btn-success' primary='$row->prno' onclick='btnprint(this)' data-toggle='tooltip' data-placement='bottom' title='พิมพ์ข้อมูล'><i class='fa fa-fw fa-print'></i></button>
                    <button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไขข้อมูล'><i class='fa fa-fw fa-edit'></i></button>				
					<button type='button' class='btn btn-xs btn-danger' primary='$row->prno' onclick='deletedata(this)'  data-toggle='tooltip' data-placement='left' title='ลบข้อมูล' $disabled><i class='fa fa-fw fa-close'></i></button>
				";

				$re_result['prno'] = $row->prno;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$express;
				$re_result['prdate'] =  $prdate;
				$re_result['refno'] = $row->refno;
				$re_result['warecode'] = $warecode;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['action'] = $action;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}

	public function find_with_page_show_approve_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$username = $this->session->username;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date,
						   dep,
						   Dep_name,
						   statusapp,
						   statusdatetime,
						   statusby,
						   hold_pr');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (HdApprove<>'N' OR HdApprove is null) AND (PRApprove<>'N' OR PRApprove is null))";
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where($where);
		$this->db->limit($param['page_size'], $param['start']);

		if ($leve=='admin' OR $dep=='AC') {
			$this->db->where($condition);
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by('prdate', $param['dir']);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where($where)->where($condition)
										->where('HdApprove IS NOT NULL',null, false)
										->where('completed IS NULL',null, false)
										->count_all_results();
			$count = $this->db->from('PR')
							  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where('HdApprove IS NOT NULL',null, false)
							  ->where('completed IS NULL',null, false)
							  ->where($where)->count_all_results(); 
		}elseif ($username == 'Somkhit') {
			$this->db->where($condition);
			$this->db->where('HdApprove','Y');
			$this->db->where('PRApprove','Y');
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by('PRApprove_Date', 'DESC');
			$this->db->where('div','Z01');
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where($where)->where($condition)
										->where('HdApprove','Y')
										->where('PRApprove','Y')
										->where('GMApprove IS NULL',null, false)
										->where('EFCApprove IS NULL',null, false)
										->where('completed IS NULL',null, false)
										->where('div','Z01')
										->count_all_results();
			$count = $this->db->from('PR')
							  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where('HdApprove','Y')
							  ->where('PRApprove','Y')
							  ->where('GMApprove IS NULL',null, false)
						      ->where('EFCApprove IS NULL',null, false)
							  ->where('completed IS NULL',null, false)
							  ->where('div','Z01')
							  ->where($where)->count_all_results(); 
		}elseif ($username == 'Nuntaporn2') {
			$this->db->where($condition);
			$this->db->where('HdApprove','Y');
			$this->db->where('PRApprove','Y');
			$this->db->where('GMApprove IS NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by('PRApprove_Date', 'DESC');
			$this->db->where('div !=','Z01');
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where($where)->where($condition)
										->where('HdApprove','Y')
										->where('PRApprove','Y')
										->where('GMApprove IS NULL',null, false)
										->where('EFCApprove IS NULL',null, false)
										->where('completed IS NULL',null, false)
										->where('div !=','Z01')
										->count_all_results();
			$count = $this->db->from('PR')
							  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where('HdApprove','Y')
							  ->where('PRApprove','Y')
							  ->where('GMApprove IS NULL',null, false)
						      ->where('EFCApprove IS NULL',null, false)
							  ->where('completed IS NULL',null, false)
							  ->where('div !=','Z01')
							  ->where($where)->count_all_results(); 
		}elseif ($username == 'Nalinee') {
			$this->db->where($condition);
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('PRApprove IS NOT NULL',null, false);
			$this->db->where('GMApprove IS NOT NULL',null, false);
			$this->db->where('EFCApprove IS NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by('prdate', $param['dir']);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where($where)->where($condition)
										->where('HdApprove IS NOT NULL',null, false)
										->where('PRApprove IS NOT NULL',null, false)
										->where('GMApprove IS NOT NULL',null, false)
										->where('EFCApprove IS NULL',null, false)
										->where('completed IS NULL',null, false)
										->count_all_results();
			$count = $this->db->from('PR')
							  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where('HdApprove IS NOT NULL',null, false)
							  ->where('PRApprove IS NOT NULL',null, false)
							  ->where('GMApprove IS NOT NULL',null, false)
							  ->where('EFCApprove IS NULL',null, false)
							  ->where('completed IS NULL',null, false)
							  ->where($where)->count_all_results(); 
		}else{
			$this->db->where_in('dep', $depa);
			$this->db->where($condition);
			$this->db->where('HdApprove IS NOT NULL',null, false);
			$this->db->where('completed IS NULL',null, false);
			$this->db->order_by('prdate', $param['dir']);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where_in('dep', $depa)->where($where)
										->where($condition)
										->where('HdApprove IS NOT NULL',null, false)
										->where('completed IS NULL',null, false)
										->count_all_results();
			$count = $this->db->from('PR')
			 				  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where_in('dep', $depa)
							  ->where($where)
							  ->where('HdApprove IS NOT NULL',null, false)
							  ->where('completed IS NULL',null, false)
							  ->count_all_results(); 
		}
 
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<br><div class='text-center'><img width='55' src='".base_url().'/assets/icon/express.gif'."'></div>" : "";
				$change_vendor = $dep == 'AC' ? "<br><button type='button' class='btn btn-xs btn-warning' prid='$row->prno' onclick='Setvenderprmodel(this)'' venderold='$row->Vendor'><i class='fa fa-fw fa-refresh'></i></button></div><input type='hidden' id='Setvenderprmodelshow' data-toggle='modal' data-target='#Setvenderprmodel'>" : "";
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$statusdatetime = $row->statusdatetime != '' ? nice_date($row->statusdatetime, 'd-m-Y')." <b>".$row->statusby."</b>": "";
				// Date Time
				if ($username == 'Somkhit') {
					$prdate = "<b>ACC: </b>".$PRApprove."<br><b>HOD: </b>".$HdApprove;
					if($row->hold_pr != '') {
						$ref_no = $row->refno.'<br> <span class="badge badge-primary">H '.nice_date($row->hold_pr, 'd-m-Y').'</span>';
					}else{
						$ref_no = $row->refno;
					}
				}else if ($username == 'Nalinee') {
					$prdate = "<b>GM: </b>".$GMApprove."<br><b>ACC:</b>".$PRApprove;
					$ref_no = $row->refno;
				}else {
					$prdate = "<b>HOD: </b>".nice_date($row->prdate, 'd-m-Y');
					$ref_no = $row->refno;
				}
				// Cemment
                if($dep =='AC' OR $username =='Somkhit' OR $username == 'Nalinee'){
                    $comment_disabled = '';
                }else{
                    $comment_disabled = 'Disabled';
				}
				$warecode = $row->warecode == '' ? "" : "[D] <b>".$row->dep."</b> => ".$row->Dep_name."<br>[W] <b>".$row->warecode.'</b> => '.$this->namewarecode($row->warecode);
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$comment = "<input type='text' onchange='statusapp(this);' style='font-size: 13px; width: 100%; height: 25px' statusapppr='$row->prno' deppr='$row->Dep_name' class='form-control' $comment_disabled value='$row->statusapp'><br> $statusdatetime";
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";
				// Action 
				if ($row->GMApprove == 'Y' OR $row->EFCApprove == 'Y') {
					if ($username == 'Nalinee') {
						$action = "
							<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
							<button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='อนุมัติ'><i class='fa fa-fw fa-edit'></i></button>
						";
					}
					elseif ($username == 'Somkid') {
						$action = "
							<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
							<button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไขข้อมูล'><i class='fa fa-fw fa-edit'></i></button>
							<button type='button' class='btn btn-xs  btn-danger' primary='$row->prno' onclick='approvex_sd(this)' data-toggle='tooltip' data-placement='bottom' title='ยกเลิก PR'><i class='fa fa-times-circle'></i></button>
						";
					}else
					{
					$action = "
						<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
					";						
					}
							$hold_pr = '';
				}else {
					$action = "
						<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
						<button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไขข้อมูล'><i class='fa fa-fw fa-edit'></i></button>
					";
							$hold_pr = '';
					if ($username == 'Somkhit') {
						if ($row->hold_pr != '') {
							$action = "
								<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
								<button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไขข้อมูล'><i class='fa fa-fw fa-edit'></i></button>
								<button type='button' class='btn btn-xs  btn-danger' primary='$row->prno' onclick='hold_pr(this)' data-toggle='tooltip' data-placement='bottom' title='ยกเลิก Hold PR'><i class='fa fa-header'></i></button>
							";
							$hold_pr = $row->hold_pr;
						}else{
							$action = "
								<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
								<button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไขข้อมูล'><i class='fa fa-fw fa-edit'></i></button>
								<button type='button' class='btn btn-xs  btn-info' primary='$row->prno' onclick='hold_pr(this)' data-toggle='tooltip' data-placement='bottom' title='Hold PR'><i class='fa fa-header'></i></button>
							";
							$hold_pr = '';
						}
					}
				}

				$re_result['prno'] = $row->prno.$express;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$change_vendor;
				$re_result['prdate'] =  $prdate;
				$re_result['prdate_desc'] = nice_date($row->PRApprove_Date, 'Ymd');
				$re_result['refno'] = $ref_no;
				$re_result['warecode'] = $warecode;
				$re_result['comment'] = $comment;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['action'] = $action;
				$re_result['hold_pr'] = $hold_pr;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}

	public function find_with_page_show_accounting_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$username = $this->session->username;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date,
						   completed,
						   chkre,
						   dep,
						   Dep_name,
						   statusapp,
						   statusdatetime,
						   statusby');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$where = "((GMApprove<>'N' OR GMApprove is null) AND (EFCApprove<>'N' OR EFCApprove is null) AND (PRApprove is null OR PRApprove<>'N') AND (completed is null))";
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where($where);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by('prdate', $param['dir']);
		if ($param['typeselect']=='All') {
			$this->db->where($condition);
			$this->db->where('HdApprove','Y');
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where($where)->where($condition)
										->where('HdApprove','Y')
										->count_all_results();
			$count = $this->db->from('PR')
							  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where('HdApprove','Y')
							  ->where($where)->count_all_results(); 
		}else{
			$this->db->where('dep', $param['typeselect']);
			$this->db->where('HdApprove','Y');
			$this->db->where($condition);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')
										->join('PR_ref', 'PR_ref.prno = PR.prno')
										->where($where)
										->where($condition)
										->where('dep', $param['typeselect'])
										->where('HdApprove','Y')
										->count_all_results();
			$count = $this->db->from('PR')
			 				  ->join('PR_ref', 'PR_ref.prno = PR.prno')
							  ->where('dep', $param['typeselect'])
							  ->where($where)
							  ->where('HdApprove','Y')
							  ->count_all_results(); 
		}
 
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<br><div class='text-center'><img width='55' src='".base_url().'/assets/icon/express.gif'."'></div>" : "";
				$change_vendor = $dep == 'AC' ? "<br><button type='button' class='btn btn-xs btn-warning' prid='$row->prno' onclick='Setvenderprmodel(this)'' venderold='$row->Vendor'><i class='fa fa-fw fa-refresh'></i></button></div><input type='hidden' id='Setvenderprmodelshow' data-toggle='modal' data-target='#Setvenderprmodel'>" : "";
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$statusdatetime = $row->statusdatetime != '' ? nice_date($row->statusdatetime, 'd-m-Y')." <b>".$row->statusby."</b>": "";
				// Cemment
                if($dep =='AC' OR $username =='Somkhit' OR $username == 'Nalinee'){
                    $comment_disabled = '';
                }else{
                    $comment_disabled = 'Disabled';
				}
				// completed
				if ($row->completed == 'Y' AND $row->chkre == 'Y') {
					$completed = '<i class="fa fa-exchange fa-2x" aria-hidden="true" style="color: #ff9933;"></i>';
				}else{
					$completed = "";
				}
				$warecode = $row->warecode == '' ? "" : "[D] <b>".$row->dep."</b> => ".$row->Dep_name."<br>[W] <b>".$row->warecode.'</b> => '.$this->namewarecode($row->warecode);
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$comment = "<input type='text' onchange='statusapp(this);' style='font-size: 13px; width: 100%; height: 17px' statusapppr='$row->prno' deppr='$row->Dep_name' class='form-control' $comment_disabled value='$row->statusapp'><br> $statusdatetime";
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";

				$action = "
						<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
						<button type='button' class='btn btn-xs  btn-success' primary='$row->prno' onclick='btnprint(this)' data-toggle='tooltip' data-placement='bottom' title='พิมพ์ข้อมูล'><i class='fa fa-fw fa-print'></i></button>				
				";
				// Action 
				if ($row->GMApprove == 'Y' OR $row->EFCApprove == 'Y') {
					if ($username == 'Nalinee') {
						$action .= "
							<button type='button' class='btn btn-xs  btn-warning' primary='$row->prno' onclick='edit(this)' data-toggle='tooltip' data-placement='bottom' title='อนุมัติ'><i class='fa fa-fw fa-edit'></i></button>
						";
					}
				}
				if ($dep == 'AC' AND $row->HdApprove =='Y' AND $row->PRApprove == 'Y' AND $row->GMApprove =='Y' AND $row->EFCApprove =='Y' AND $row->completed == '') {
					$action .= "
							<button type='button' class='btn btn-warning btn-xs' prno='$row->prno' onclick='completedModal(this)' data-toggle='tooltip' data-placement='bottom' title='สั้งซื้อแล้ว'><i class='fa fa-fw fa-exchange'></i></button>
						";
				}

				$re_result['prno'] = $row->prno.$express;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$change_vendor;
				$re_result['prdate'] = nice_date($row->prdate, 'd-m-Y');
				$re_result['refno'] = $row->refno;
				$re_result['warecode'] = $warecode;
				$re_result['comment'] = $comment;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['completed'] = $completed;
				$re_result['action'] = $action;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}

	public function find_with_page_show_acapprove_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date,
						   dep,
						   Dep_name');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$where = "((dep = 'AC') AND (HdApprove is null) AND (GMApprove is null) AND (EFCApprove is null)  AND (warecode != '' ) OR (dep != 'AC') AND (GMApprove is null) AND (EFCApprove is null) AND (PRApprove is null) AND (completed is null) AND (warecode != '') AND (HdApprove = 'Y'))";
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where($where);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by('prdate', $param['dir']);

		$this->db->where($condition);
		$result = $this->db->get('PR');
		$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where($condition)->where('GMApprove IS NULL',null, false)->count_all_results();
		$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->count_all_results(); 
 
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<img width='55' src='".base_url().'/assets/icon/express.gif'."'>" : "";
				$prdate = $row->prdate == '' ? "" : nice_date($row->prdate, 'd-m-Y');
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$warecode = $row->warecode == '' ? "" : "[D] <b>".$row->dep."</b> => ".$row->Dep_name."<br>[W] <b>".$row->warecode.'</b> => '.$this->namewarecode($row->warecode);
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";
				$checkbox = "<input type='checkbox' class='RCcheckbox' name='RCcheckbox' value='$row->prno'>";
				$action = "
                    <button type='button' class='btn btn-xs  btn-warning'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
				";

				$re_result['prno'] = $row->prno;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$express;
				$re_result['prdate'] =  $prdate;
				$re_result['refno'] = $row->refno;
				$re_result['warecode'] = $warecode;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['checkbox'] = $checkbox;
				$re_result['action'] = $action;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}
	
	public function find_with_page_show_completed_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$username = $this->session->username;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date,
						   completed,
						   chkre,
						   dep,
						   Dep_name,
						   statusapp,
						   statusdatetime,
						   statusby');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('completed','Y');
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by('prdate', $param['dir']);
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->where($condition);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where('completed','Y')->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where('completed','Y')->count_all_results(); 
		}else{
			$this->db->where($condition);
			$this->db->where_in('dep', $depa);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where_in('dep', $depa)->where('completed','Y')->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where_in('dep', $depa)->where('completed','Y')->count_all_results(); 			
		}

		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<img width='55' src='".base_url().'/assets/icon/express.gif'."'>" : "";
				$prdate = $row->prdate == '' ? "" : nice_date($row->prdate, 'd-m-Y');
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$warecode = $row->warecode == '' ? "" : "[D] <b>".$row->dep."</b> => ".$row->Dep_name."<br>[W] <b>".$row->warecode.'</b> => '.$this->namewarecode($row->warecode);
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";
				$statusdatetime = $row->statusdatetime != '' ? nice_date($row->statusdatetime, 'd-m-Y')." <b>".$row->statusby."</b>": "";
				// Cemment
                if($dep =='AC' OR $username =='Somkhit' OR $username == 'Nalinee'){
                    $comment_disabled = '';
                }else{
                    $comment_disabled = 'Disabled';
				}
				$comment = "<input type='text' onchange='statusapp(this);' style='font-size: 13px; width: 100%; height: 17px' statusapppr='$row->prno' deppr='$row->Dep_name' class='form-control' $comment_disabled value='$row->statusapp'><br> $statusdatetime";
				// completed
				if ($row->completed == 'Y') {
					$completed = '<i class="fa fa-exchange fa-2x" aria-hidden="true" style="color: #ff9933;"></i>';
				}else{
					$completed = "";
				}
				if ($row->chkre == 'Y') {
					$chkre = '<i class="fa fa-thumbs-up fa-2x" aria-hidden="true" style="color: #337ab7;"></i>';
				}else{
					$chkre = "";
				}
				$action = "
                    <button type='button' class='btn btn-xs  btn-warning'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
					<button type='button' class='btn btn-xs  btn-success' primary='$row->prno' onclick='btnprint(this)' data-toggle='tooltip' data-placement='bottom' title='พิมพ์ข้อมูล'><i class='fa fa-fw fa-print'></i></button>
				";
				if ($row->chkre == '' AND $dep =='AC' AND $leve =='accounting' OR $row->chkre == '' AND $dep == 'AC' AND $leve =='accounting0' OR $row->chkre == '' AND $dep == 'AC' AND $username == 'dang') {
					$action .= "
						<button type='button' class='btn btn-xs  btn-primary'  primary='$row->prno' onclick='receive(this)' data-toggle='tooltip' data-placement='bottom' title='ูรับของ'><i class='fa fa-fw fa-thumbs-up'></i></button>
					";
				}
				if ($username =='Somkid') {
					$action .= "
						<button class='btn btn-xs btn-danger'  primary='$row->prno' onclick='editprice(this)' data-toggle='tooltip' data-placement='bottom' title='แก้ไขราคา'><i class='fa fa-fw fa-edit'></i></button>
					";
				}
				if ($username =='Somkid') {
					$chane_vendor = "<button type='button' class='btn btn-xs btn-warning' prid='$row->prno' onclick='Setvenderprmodel(this)' venderold='$row->Vendor'><i class='fa fa-fw fa-refresh'></i></button></div><input type='hidden' id='Setvenderprmodelshow' data-toggle='modal' data-target='#Setvenderprmodel'>";
				}else{
					$chane_vendor = "";
				}

				$re_result['prno'] = $row->prno;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$express.'<br>'.$chane_vendor;
				$re_result['prdate'] =  $prdate;
				$re_result['refno'] = $row->refno;
				$re_result['warecode'] = $warecode;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['comment'] = $comment;
				$re_result['completed'] = $completed;
				$re_result['chkre'] = $chkre;
				$re_result['action'] = $action;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}

	public function find_with_page_show_reject_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$username = $this->session->username;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date,
						   completed,
						   chkre,
						   dep,
						   Dep_name,
						   statusapp,
						   statusdatetime,
						   statusby');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$where = "(HDApprove='N' OR PRApprove='N' OR GMApprove='N' OR EFCApprove='N')";
		$this->db->where($where);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by('prdate', $param['dir']);
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->where($where);
			$this->db->where($condition);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->count_all_results(); 
		}else{
			$this->db->where($where);
			$this->db->where($condition);
			$this->db->where_in('dep', $depa);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where_in('dep', $depa)->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where_in('dep', $depa)->count_all_results(); 			
		}

		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<img width='55' src='".base_url().'/assets/icon/express.gif'."'>" : "";
				$prdate = $row->prdate == '' ? "" : nice_date($row->prdate, 'd-m-Y');
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$warecode = $row->warecode == '' ? "" : "[D] <b>".$row->dep."</b> => ".$row->Dep_name."<br>[W] <b>".$row->warecode.'</b> => '.$this->namewarecode($row->warecode);
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";
				$action = "
                    <button type='button' class='btn btn-xs  btn-warning'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
					<button type='button' class='btn btn-xs  btn-success' primary='$row->prno' onclick='btnprint(this)' data-toggle='tooltip' data-placement='bottom' title='พิมพ์ข้อมูล'><i class='fa fa-fw fa-print'></i></button>
				";

				$re_result['prno'] = $row->prno;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$express;
				$re_result['prdate'] =  $prdate;
				$re_result['refno'] = $row->refno;
				$re_result['warecode'] = $warecode;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['action'] = $action;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}

	public function find_with_page_show_fax_table($param)
	{
		$depa = $this->export_dep();
		$dep = $this->export_dep();
		$leve = $this->session->type;
		$username = $this->session->username;
		$keyword = $param['keyword'];
		$this->db->select('PR.prno,
						   Vendor_name,
						   Vendor,
						   prdate,
						   refno,
						   express,
						   warecode,
						   HdApprove,
						   HdApprove_Date,
						   PRApprove,
						   PRApprove_Date,
						   GMApprove,
						   GMApprove_Date,
						   EFCApprove,
						   EFCApprove_Date,
						   completed,
						   chkre,
						   dep,
						   Dep_name,
						   statusapp,
						   statusdatetime,
						   statusby');

		$condition = "0=0";
		if(!empty($keyword)){
			$condition .= "and (PR.prno like '%{$keyword}%' or warecode like '%{$keyword}%' or Vendor like '%{$keyword}%' or Vendor_name like '%{$keyword}%' or refno like '%{$keyword}%')";
		}
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$where = "((PR_ref.GMApprove<>'N' OR PR_ref.GMApprove is null) AND (PR_ref.EFCApprove<>'N' OR PR_ref.EFCApprove is null) AND (PR_ref.PRApprove is null OR PR_ref.PRApprove<>'N') AND (chkre is null) AND (PR.warecode is not null))";
		$this->db->where($where);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by('prdate', $param['dir']);
		if ($leve=='admin' OR $dep=='AC' OR $dep=='EXC') {
			$this->db->where($where);
			$this->db->where($condition);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->count_all_results(); 
		}else{
			$this->db->where($where);
			$this->db->where($condition);
			$this->db->where_in('dep', $depa);
			$result = $this->db->get('PR');
			$count_condition = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where_in('dep', $depa)->where($condition)->count_all_results();
			$count = $this->db->from('PR')->join('PR_ref', 'PR_ref.prno = PR.prno')->where($where)->where_in('dep', $depa)->count_all_results(); 			
		}

		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$express = $row->express == 'true' ? "<img width='55' src='".base_url().'/assets/icon/express.gif'."'>" : "";
				$prdate = $row->prdate == '' ? "" : nice_date($row->prdate, 'd-m-Y');
				$HdApprove = $row->HdApprove == 'Y' ? nice_date($row->HdApprove_Date, 'd-m-Y') : "";
				$PRApprove = $row->PRApprove == 'Y' ? nice_date($row->PRApprove_Date, 'd-m-Y') : "";
				$GMApprove = $row->GMApprove == 'Y' ? nice_date($row->GMApprove_Date, 'd-m-Y') : "";
				$EFCApprove = $row->EFCApprove == 'Y' ? nice_date($row->EFCApprove_Date, 'd-m-Y') : "";
				$warecode = $row->warecode == '' ? "" : "[D] <b>".$row->dep."</b> => ".$row->Dep_name."<br>[W] <b>".$row->warecode.'</b> => '.$this->namewarecode($row->warecode);
				$HdApprove_res = $this->return_icon_yes($row->HdApprove,$HdApprove);
				$PRApprove_res = $this->return_icon_yes($row->PRApprove,$PRApprove);
				$GMApprove_res = $this->return_icon_yes($row->GMApprove,$GMApprove);
				$EFCApprove_res = $this->return_icon_yes($row->EFCApprove,$EFCApprove);
				$disabled = $row->HdApprove == 'Y' ? "disabled" : "";
				$checkbox = "<input type='checkbox' class='RCcheckbox' name='RCcheckbox' value='$row->prno'>";
				// completed
				if ($row->completed == 'Y') {
					$completed = '<i class="fa fa-exchange fa-2x" aria-hidden="true" style="color: #ff9933;"></i>';
				}else{
					$completed = "";
				}
				if ($row->chkre == 'Y') {
					$chkre = '<i class="fa fa-thumbs-up fa-2x" aria-hidden="true" style="color: #337ab7;"></i>';
				}else{
					$chkre = "";
				}
				$action = "
                    <button type='button' class='btn btn-xs  btn-warning'  primary='$row->prno' onclick='opendata(this)' data-toggle='tooltip' data-placement='bottom' title='ดูข้อมูล'><i class='fa fa-fw fa-search'></i></button>
					<button type='button' class='btn btn-xs  btn-success' primary='$row->prno' onclick='btnprint(this)' data-toggle='tooltip' data-placement='bottom' title='พิมพ์ข้อมูล'><i class='fa fa-fw fa-print'></i></button>
				";

				$re_result['prno'] = $row->prno;
				$re_result['vendor'] = $row->Vendor_name.' - '.$row->Vendor.' '.$express;
				$re_result['prdate'] =  $prdate;
				$re_result['refno'] = $row->refno;
				$re_result['warecode'] = $warecode;
				$re_result['HdApprove'] = $HdApprove_res;
				$re_result['PRApprove'] = $PRApprove_res;
				$re_result['GMApprove'] = $GMApprove_res;
				$re_result['EFCApprove'] = $EFCApprove_res;
				$re_result['checkbox'] = $checkbox;
				$re_result['completed'] = $completed;
				$re_result['chkre'] = $chkre;
				$re_result['fax'] = $this->Faxdata($row->prno);
				$re_result['action'] = $action;

				$data[] = $re_result;
			}
		}else{
			$data = '';
		}
		
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'','MYSQL'=>$this->db->queries);
		return $result;	
	}

	public function delte_pr_is_null()
	{
		$this->db->where('Vendor IS NULL',null, false);
		$this->db->where('Vendor_name IS NULL',null, false);
		$this->db->where('Dep_name IS NULL',null, false);
		$this->db->where('HdApprove IS NULL',null, false);
		$this->db->delete('PR_ref');
		$this->db->where('div IS NULL',null, false);
		$this->db->where('warecode IS NULL',null, false);
		$this->db->delete('PR');
	}

}