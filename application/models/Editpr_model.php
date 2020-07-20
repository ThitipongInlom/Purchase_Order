<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editpr_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$beta = $this->load->database('bo', TRUE);
	}

	public function getdatapredit($i)
	{
		$this->db->select('*');
		$this->db->from('PR');
		$this->db->join('PR_ref', 'PR_ref.prno = PR.prno');
		$this->db->where('PR.prno', $i);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getimgdataedit()
	{
		$prno = $_POST['prno'];
		$this->db->select('*');
		$this->db->from('PR_img');
		$this->db->where('prno', $prno);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function editupper($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark,$express)
	{
		if ($typuser=='user' OR $typuser=='admin') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser=='hod') {
			$signature_img = $this->session->signature_img;
			$username = $this->session->username;
			if ($signature_img=='') {
				$signature = '';
			}else{
				$signature = $username;
			}

			$query = $this->db->get_where('PR_ref', array('prno' => $prno));
			$resultfaceobj = $query->result_array();
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
				'dep' => $depcode,
				'express' => $express);
			$this->db->where('prno', $prno);
			$this->db->update('PR', $PR);
			
			if ($resultfaceobj[0]['Hd_signature'] == '') {
				$PR_ref = array(
					'DC' => $dc,
					'DC_A' => $dc_a,
					'Vat' => $vat,
					'Vendor' => $vendor,
					'Vendor_name' => $vendorname,
					'Dep_name' => $depname,
					'HdApprove' => 'Y',
					'HdApprove_Date' => $date,
					'Hd_signature' => $signature);
			}else{
				$PR_ref = array(
					'DC' => $dc,
					'DC_A' => $dc_a,
					'Vat' => $vat,
					'Vendor' => $vendor,
					'Vendor_name' => $vendorname,
					'Dep_name' => $depname,
					'HdApprove' => 'Y',
					'HdApprove_Date' => $date);
			}

			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);

			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser=='accounting' OR $typuser=='accounting0') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
				'dep' => $depcode,
				'express' => $express);
			$this->db->where('prno', $prno);
			$this->db->update('PR', $PR);
			if ($username=='Somkid') {
			$PR_ref = array(
				'DC' => $dc,
				'DC_A' => $dc_a,
				'Vat' => $vat,
				'Vendor' => $vendor,
				'Vendor_name' => $vendorname,
				'Dep_name' => $depname,
				'HdApprove' => 'Y',
				'HdApprove_Date' => $date,
				'PRApprove' => 'Y',
				'PRApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			}else{
			$PR_ref = array(
				'DC' => $dc,
				'DC_A' => $dc_a,
				'Vat' => $vat,
				'Vendor' => $vendor,
				'Vendor_name' => $vendorname,
				'Dep_name' => $depname,
				'PRApprove' => 'Y',
				'PRApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			}
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser == 'approval' AND $username == 'Somkhit') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
				'Dep_name' => $depname,
				'GMApprove' => 'Y',
				'GMComment' => $gmremark,
				'GMApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$PR_Item = array(
				'selected' => 'Y');
			$this->db->where('prno', $prno);
			$this->db->update('PR_Item', $PR_Item);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser == 'approval' AND $username == 'Nalinee') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
				'Dep_name' => $depname,
				'EFCApprove' => 'Y',
				'EFCComment' => $efcremark,
				'EFCApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}
			// Update Total Price Item
			$totalget = $this->Get_data_model->gettotal($prno);
			if ($dc > 0) {
				$total_discount = ($dc*$totalget)/100;
			}
			if ($dc_a > 0) {
				$total_discount = $dc_a;
			}
			if ($dc == 0 AND $dc_a == 0) {
				$total_discount = "0";
			}
			if ($vat == 'Y') {
				if ($dc_a > 0 ) {
					$result = $dc_a;
				}elseif($dc > 0){
					$result = (($dc * $totalget)/100);
				}else{
					$result = 0;
				}
				$total_vat = (7/100)*($totalget - $result);
			}else{
				$total_vat = "0";
			}
			if ($vat == 'Y' OR $dc_a > 0 OR $dc > 0) {
				if ($dc_a > 0) {
					$res_p1 = $dc_a;
				}elseif($dc > 0){
					$res_p1 = (($dc * $totalget)/100);
				}else{
					$res_p1 = 0;
				}
				if ($vat == 'Y') {
					$newtotl =$totalget - $res_p1;
					$res_p2 = ($newtotl/100)*7;
				}elseif($vat == 'N'){
					$res_p2 = 0;
				}
				$total_gobal = (($totalget-$res_p1)+$res_p2);				
			}else{
				$total_gobal = "0";
			}
			$PR_priceup = array(
				'totalprice' => $totalget,
				'total_vat' => $total_vat,
				'total_discount' => $total_discount,
				'total_gobal' => $total_gobal);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_priceup);
			// Return
		$arrt = array(
			'Data' => $Data, 'Code' => $Code);
		echo json_encode($arrt);
	}

	public function editupper2($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark,$express)
	{
		if ($typuser=='user' OR $typuser=='admin') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser=='hod') {
			$signature_img = $this->session->signature_img;
			$username = $this->session->username;
			if ($signature_img=='') {
				$signature = '';
			}else{
				$signature = $username;
			}
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
				'Dep_name' => $depname,
				'HdApprove' => 'N',
				'HdApprove_Date' => $date,
				'Hd_signature' => $signature);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser=='accounting' OR $typuser=='accounting0') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
				'Dep_name' => $depname,
				'PRApprove' => 'N',
				'PRApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser == 'approval' AND $username == 'Somkhit') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
				'Dep_name' => $depname,
				'GMApprove' => 'N',
				'GMComment' => $gmremark,
				'GMApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$PR_Item = array(
				'selected' => 'N');
			$this->db->where('prno', $prno);
			$this->db->update('PR_Item', $PR_Item);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}elseif ($typuser == 'approval' AND $username == 'Nalinee') {
			$PR = array(
				'div' => $div,
				'remark' => $remark,
				'warecode' => strtoupper($warecode),
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
				'Dep_name' => $depname,
				'EFCApprove' => 'N',
				'EFCComment' => $efcremark,
				'EFCApprove_Date' => $date);
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}
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
		$arrt = array(
			'Data' => $Data, 'Code' => $Code);
		echo json_encode($arrt);
	}

	public function receiveupper($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark)
	{
		if ($typuser=='user' OR $typuser=='admin') {
			$PR_ref = array(
				'chkre' => 'Y');
			$this->db->where('prno', $prno);
			$this->db->update('PR_ref', $PR_ref);
			$Data = 'อัพเดตสำเร็จสำเร็จ';
			$Code = '2';
		}
		$arrt = array(
			'Data' => $Data, 'Code' => $Code);
		echo json_encode($arrt);
	}

}

/* End of file Editpr_model.php */
/* Location: ./application/models/Editpr_model.php */
?>
