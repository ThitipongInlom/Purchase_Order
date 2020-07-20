<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_Pr extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->model('Addpr_model');
		$this->load->model('Get_data_model');
		$this->load->model('Switch_model');
	}
	public function index()
	{
		$data['newpr'] = $this->Addpr_model->getnewpr();
		$data['newref'] = $this->Addpr_model->getnewref();
		$data['prdate'] = date('Ymd');
		$setadd = $this->Switch_model->SQLAddpr();
		if ($setadd== '0') {
			$this->Addpr_model->newpradd($data['newpr'],$data['newref'],$data['prdate']);
		}else{
			//$this->Addpr_model->newpradd($data['newpr'],$data['newref'],$data['prdate']);
		}

		$set = $this->Switch_model->Addprset();
		if ($set == '0') {
		$this->load->view('theme/head');
		$this->load->view('addpr',$data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');
		}
	}
	public function viewhistory($id)
	{
		$data['titlehistory'] = $this->Addpr_model->titleviewhistory($id);
		$data['datahistory']  = $this->Addpr_model->dataviewhistory($id);
		$this->load->view('viewhistory', $data);
	}
	public function listitem()
	{
		$beta = $this->load->database('bo', TRUE);
		echo '
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
				<div align="center">
				<div class="input-group">
                <input type="text" class="form-control" id="inputgolist" placeholder="ค้นหา" onkeydown="Keygolist(event);" autofocus>
                   	<span class="input-group-btn">
                     <button type="button" class="btn btn-primary" onclick="golist();">ค้นหา
                     <i class="fa fa-refresh fa-spin" id="loginicon" style="padding-right: 2px;"></i></button>
                    </span>
              </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div id="tablelist"></div>
			</div>
		</div>
		';
	}

	public function listitem2()
	{
		$beta = $this->load->database('bo', TRUE);
		echo '
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1">
				<div align="center">
				<div class="input-group">
                <input type="text" class="form-control" id="inputgolist" placeholder="ค้นหา" onkeydown="Keygolist2(event);" autofocus>
                   	<span class="input-group-btn">
                     <button type="button" class="btn btn-primary" onclick="golist2();">ค้นหา
                     <i class="fa fa-refresh fa-spin" id="loginicon" style="padding-right: 2px;"></i></button>
                    </span>
              </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div id="tablelist"></div>
			</div>
		</div>
		';
	}

	public function listitem3()
	{
		echo '
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1">
				<div align="center">
				<div class="input-group">
                <input type="text" class="form-control" id="inputgolistv3" placeholder="ค้นหา" onkeydown="Keygolistv3(event);" autofocus>
                   	<span class="input-group-btn">
                     <button type="button" class="btn btn-primary" onclick="golistv3();">ค้นหา
                     <i class="fa fa-refresh fa-spin" id="loginicon" style="padding-right: 2px;"></i></button>
                    </span>
              </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div id="tablelistv3"></div>
			</div>
		</div>
		';
	}

	public function listitemv()
	{
		echo '
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1">
				<div align="center">
				<div class="input-group">
                <input type="text" class="form-control" id="inputgolistv" placeholder="ค้นหา" onkeydown="Keygolistv2(event);" autofocus>
                   	<span class="input-group-btn">
                     <button type="button" class="btn btn-primary" onclick="golistv();">ค้นหา
                     <i class="fa fa-refresh fa-spin" id="loginicon" style="padding-right: 2px;"></i></button>
                    </span>
              </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div id="tablelistv"></div>
			</div>
		</div>
		';
	}

	public function golist()
	{
		$result = $this->Addpr_model->golistmodel();
		echo '
		<br>
		<div class="table-responsive">
		<table class="table table-bordered">
		<tr class="info" align="center">
			<td><b>Code</b></td>
			<td><b>History</b></td>
			<td><b>Description</b></td>
			<td><b>Description2</b></td>
			<td><b>Unit</b></td>
		</tr>';
		foreach ($result as $row)
		{
		$stcode = $row['stcode'];
		echo '
		<tr>
			<td align="center"><span class="badge bg-red" style="cursor: pointer;" onclick="setproductcode(this);" value="'.$row['stcode'].'">'.$row['stcode'].'</span></td>
			<td align="center">';
			$cholddata = $this->Addpr_model->checkoldata($stcode);
			if ($cholddata =='0') {
				echo '<i class="fa fa-fw fa-2x fa-close" style="color:red;"></i>';
			}else {
				echo '<i class="fa fa-fw fa-2x fa-eye" sendid="'.$row['stcode'].'" onclick="windowsdata(this);" style="color:blue;"></i>';
			}
			echo'</td>
			<td>'.$row['stname1'].'</td>
			<td>'.$row['stname2'].'</td>
			<td>'.$row['mdesc1'].'</td>
		</tr>';
		}
		echo'</table><div class="table-responsive">
		';
	}

	public function golist3()
	{
		$result = $this->Addpr_model->golistmodel3();
		echo '
		<br><div class="table-responsive">
		<table class="table table-bordered">
		<tr class="info" align="center">
			<td width="10%"><b>PR</b></td>
			<td width="10%"><b>Refno</b></td>
			<td width="20%"><b>Vendor</b></td>
			<td width="20%"><b>Dep_name</b></td>
			<td width="10%"><b>วันที่เปิดPR</b></td>
			<td width="10%"><b>สเตตัส</b></td>
			<td width="10%"><b>RC</b></td>
		</tr>';
		foreach ($result as $row)
		{
		$stcode = $row['prno'];
		$Newdate = nice_date($row['prdate'], 'd-m-Y');
		echo '
		<tr>
			<td align="center"><a href="#"><span dataprno="'.$row['prno'].'" onclick="showwindowsmodalprview(this)" class="badge bg-red" value="'.$row['prno'].'">'.$row['prno'].'</span></a></td>
			<td align="center"><b>'.$row['refno'].'</b></td>
			<td align="left"><b>'.$row['Vendor_name'].'</b></td>
			<td><b>'.$row['Dep_name'].'</b></td>
			<td align="center"><b>'.$Newdate.'</b></td>';

		if ($row['HdApprove'] == '') {
			echo '<td align="center"><b>รอ Hod</b></td>';
		}elseif ($row['PRApprove'] == '' ) {
			echo '<td align="center"><b>รอ AC</b></td>';
		}elseif ($row['GMApprove'] == '') {
			echo '<td align="center"><b>รอ GM</b></td>';
		}elseif ($row['EFCApprove'] == '') {
			echo '<td align="center"><b>รอ EFC</b></td>';
		}elseif ($row['completed'] == '') {
			echo '<td align="center"><b>กำลังสั่งสินค้า</b></td>';
		}elseif ($row['chkre'] == '') {
			echo '<td align="center"><b>รอรับสินค้า</b></td>';
		}else{
			echo '<td align="center"><b>เสร็จสิ้น</b></td>';
		}

		if ($row['chkre']=='Y') {
			echo '<td align="center"><b><i class="fa fa-thumbs-up fa-2x" aria-hidden="true" style="color: #337ab7;"></i></b></td>';
		}else{
			echo '<td align="center"></td>';
		}
		echo '</tr>';
		}
		echo'</table><div class="table-responsive">
		';
	}

	public function golist2()
	{
		$result = $this->Addpr_model->golistmodel();
		echo '
		<br><div class="table-responsive">
		<table class="table table-bordered">
		<tr class="info" align="center">
			<td><b>Code</b></td>
			<td><b>History</b></td>
			<td><b>Description</b></td>
			<td><b>Description2</b></td>
			<td><b>Unit</b></td>
		</tr>';
		foreach ($result as $row)
		{
		$stcode = $row['stcode'];
		echo '
		<tr>
			<td align="center"><span class="badge bg-red" value="'.$row['stcode'].'">'.$row['stcode'].'</span></td>
			<td align="center">';
			$cholddata = $this->Addpr_model->checkoldata($stcode);
			if ($cholddata =='0') {
				echo '<i class="fa fa-fw fa-2x fa-close" style="color:red;"></i>';
			}else {
				echo '<i class="fa fa-fw fa-2x fa-eye" sendid="'.$row['stcode'].'" onclick="windowsdata(this);" style="color:blue;"></i>';
			}
			echo'</td>
			<td>'.$row['stname1'].'</td>
			<td>'.$row['stname2'].'</td>
			<td>'.$row['mdesc1'].'</td>
		</tr>';
		}
		echo'</table><div class="table-responsive">
		';
	}

	public function golistv()
	{
		$result = $this->Addpr_model->golistmodelv();
		echo '<br><div class="table-responsive">
		<table class="table table-bordered">
		<tr class="info" align="center">
			<td><b>Prno</b></td>
			<td><b>Vendor</b></td>
			<td><b>HistoryDate</b></td>
			<td><b>Warehouse</b></td>
		</tr>';
		foreach ($result as $row)
		{
		$Newdate = nice_date($row['prdate'], 'd-m-Y');
		echo '<tr align="center"><td><a href="#"><p style="color:red;" dataprno="'.$row['prno'].'" onclick="showwindowsmodalprview(this)">'.$row['prno'].'</p></a></td>
		<td>'.$row['Vendor_name'].'</td>
		<td>'.$Newdate.'</td>
		<td>'; print_r($this->namewarecode($row['warecode']));
		echo '</td></tr>';
		}
		echo '</table><div class="table-responsive">';
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

	public function showtabledataitem()
	{
		$result = $this->Addpr_model->showtabledataitem();
		$num = $this->Addpr_model->checkitemid();
		if ($num > '1') {
			echo '
			<div class="table-responsive">
			<table class="table table-bordered table-condensed">
			<tr style="background-color: #428bca" align="center">
				<td>No</td>
				<td>Product Code</td>
				<td>Product Name</td>
				<td>Quantity</td>
				<td>Last Unit Price</td>
				<td>Unit Price</td>
				<td>Delivery Date</td>
				<td>Remark</td>
				<td>File</td>
				<td>Action</td>
			</tr>';
			foreach ($result as $key => $row) {
				echo '
				<tr class="info" align="center">
				<td>'.$row->seq.'</td>
				<td>'.$row->prdcode.'</td>
				<td align="left">'; $warecode = $row->prdcode;
				$iremark = $this->Get_data_model->iremark($warecode);
				echo $iremark[0]['stname1'];
				echo'</td>
				<td>'.$row->prqty.'</td>
				<td>'.number_format($row->prprice_old,2).'฿</td>
				<td>'.number_format($row->prprice,2).'฿</td>
				<td>';$Newusedate = nice_date($row->usedate, 'd/m/Y'); echo $Newusedate.'</td>
				<td align="left">';if ($row->iremark !='') {
					echo $row->iremark;
				}echo '</td>
				<td>';
				if ($row->ifileupd!='') {
                    echo '<div align="center"><i class="fa fa-paperclip" id="iconimg" imgdata="'.$row->ifileupd.'" onclick="openwindowimg(this)"></i></div>';
                }
				echo'</td>
				<td>
				<button class="btn btn-xs btn-warning"  seq="'.$row->seq.'" prno="'.$row->prno.'" onclick="openedititem(this);"><i class="fa fa-fw fa-edit"></i></button>
				<button type="button" seq="'.$row->seq.'" pocode="'.$row->prdcode.'" prno="'.$row->prno.'" class="btn btn-xs btn-danger" img="';if ($row->ifileupd =='') {
					echo 'No';
				}else{ echo $row->ifileupd;} echo '" onclick="deleteitem(this);"><i class="fa fa-fw fa-close"></i></button>
				</td>
				</tr>
				';
			}
			echo'
			</table>
			</div>
			';
		}
	}
	public function openedititem()
	{
		$prno = $this->input->post('prno');
		$seq = $this->input->post('seq');
		$result = $this->Addpr_model->openedititem($prno,$seq);
		echo json_encode($result);
	}
	public function checkitemid()
	{
		$num = $this->Addpr_model->checkitemid();
		echo $num;
	}
	public function setproductcode()
	{
		$result = $this->Addpr_model->setproductcode();
		echo json_encode($result);
	}

	public function setproductoldpr()
	{
		$result = $this->Addpr_model->setproductoldpr();
		echo json_encode($result);
	}

	public function getvender()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$text = $this->input->get('text');
		$barang = $beta->select("*")
						->from("APFA0010")
						->like("vencode", $text)
						->or_like("venname1",$text)
						->get();
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['vencode'];
				$row_array['text'] = "<strong>[".$row['vencode'] ."]</strong> $row[venname1]";
				array_push($return_arr,$row_array);
			}
		}
		echo json_encode(array("results" => $return_arr ));
	}
	public function getwarehouse()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$text = $this->input->get('text');
		if ($text==null) {
		$barang = $beta->select("*")
						->from("STFC0070")
						->get();
		}else{
		$barang = $beta->select("*")
						->from("STFC0070")
						->like("warecode", $text)
						->or_like("waredesc1",$text)
						->get();
		}
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['warecode'];
				$row_array['text'] = "<strong>[".$row['warecode'] ."]</strong> $row[waredesc1]";
				array_push($return_arr,$row_array);
			}
		}
		echo json_encode(array("results" => $return_arr ));
	}
	public function getdivision()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$text = $this->input->get('text');
		if ($text==null) {
		$barang = $beta->select("*")
						->from("ZZFC0010")
						->get();
		}else{
		$barang = $beta->select("*")
						->from("ZZFC0010")
						->like("divcode", $text)
						->or_like("divname1",$text)
						->get();
		}
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['divcode'];
				$row_array['text'] = "<strong>[".$row['divcode'] ."]</strong> $row[divname1]";
				array_push($return_arr,$row_array);
			}
		}
		echo json_encode(array("results" => $return_arr ));
	}
	public function getdepartment()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$text = $this->input->get('text');
		if ($text==null) {
		$barang = $beta->select("*")
						->from("ZZFC0020")
						->get();
		}else{
		$barang = $beta->select("*")
						->from("ZZFC0020")
						->like("depcode", $text)
						->or_like("depname1",$text)
						->get();
		}
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['depcode'];
				$row_array['text'] = "<strong>[".$row['depcode'] ."]</strong> $row[depname1]";
				array_push($return_arr,$row_array);
			}
		}
		echo json_encode(array("results" => $return_arr ));
	}
	public function setvendor()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("APFA0010")
						->where("vencode",$id)
						->get()
						->row();
		echo json_encode($info);
	}
	public function setwarehouse()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("STFC0070")
						->where("warecode",$id)
						->get()
						->row();
		echo json_encode($info);
	}
	public function setdivision()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("ZZFC0010")
						->where("divcode",$id)
						->get()
						->row();
		echo json_encode($info);
	}
	public function setdepartment()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("ZZFC0020")
						->where("depcode",$id)
						->get()
						->row();
		echo json_encode($info);
	}

	public function updatepr()
	{
		$prno = $_POST['prno'];
		$div = $_POST['div'];
		$remark = $_POST['remark'];
		$warecode = $_POST['warecode'];
		$dc = $_POST['dc'];
		$dc_a = $_POST['dc_a'];
		$vat = $_POST['vat'];
		$vendor = $_POST['vendor'];
		$vendorname = $_POST['vendorname'];
		$depname = $_POST['depname'];
		$depcode = $_POST['depcode'];
		$express = $_POST['express'];
		$this->Addpr_model->updatepr($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$express);
	}

	public function deleteitem()
	{
		$prno = $this->input->post('prno');
		$seq  = $this->input->post('seq');
		$img  = $this->input->post('img');
		$prdcode = $this->input->post('prdcode');
		$this->Addpr_model->deleteitem($prno,$seq,$prdcode);
		$deletedata = 'ลบข้อมูลสำเร็จ';
		$codedata = '1';
		if ($img=='No') {
			$codeimg ='1';
			$deleteimg ='';
		}else{
			// PO
			$path = FCPATH.'assets/photo_storage/'.$img;
			//PRA
			//$path = $_SERVER['DOCUMENT_ROOT'].'\PRA\upload\file_upload/'.$img;

			unlink($path);
			$deleteimg = 'ลบไฟล์สำเร็จ';
			$codeimg ='2';
		}
		$arrt = array('deletedata' => $deletedata, 'deleteimg'  => $deleteimg, 'codedata' => $codedata, 'codeimg' => $codeimg);
		echo json_encode($arrt);
	}

	public function doupload()
	{
		$this->load->database();
		if ($_POST['productcode']=='') {
			$ImgCode = '3';
			$ImgSave = '';
			$DataSave= 'กรุณาใส่ข้อมูลให้ครบ';
		}else{
			if (isset($_POST)) {
				$prno = $_POST['prno'];
				$seq = $_POST['seq'];
				$productcode = $_POST['productcode'];
				$prqty = $_POST['prqty'];
				$prpriceold = $_POST['prpriceold'];
				$lastpurdate = $_POST['lastpurdate'];
				$prprice = $_POST['prprice'];
				$usedate = $_POST['usedate'];
				$iremark = $_POST['iremark'];
				$newseq = $seq;
				$div = $_POST['div'];
				$remark = $_POST['remark'];
				$warecode = $_POST['warecode'];
				$dc = $_POST['dc'];
				$dc_a = $_POST['dc_a'];
				$vat = $_POST['vat'];
				$vendor = $_POST['vendor'];
				$vendorname = $_POST['vendorname'];
				$depname = $_POST['depname'];
				$depcode = $_POST['depcode'];
				$gmremark = $_POST['gmremark'];
				$efcremark = $_POST['efcremark'];
				if ($lastpurdate!='') {
					$Newlastpurdate = nice_date($lastpurdate, 'Ymd');
				}else{
					$Newlastpurdate = '';
				}if ($usedate!='') {
					$Newusedate = nice_date($usedate, 'Ymd');
				}else{
					$Newusedate = '';
				}
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
				$data = array(
				'comid' => '0001',
				'prno'  =>  $prno,
				'seq'   => 	$newseq,
				'prdcode' => $productcode,
				'prqty' =>  $prqty,
				'prprice_old' => $prpriceold,
				'lastpurdate' => $Newlastpurdate,
				'prprice' => $prprice,
				'usedate' => $Newusedate,
				'selected' => 'Y',
				'iremark' => $iremark);
				$this->db->insert('PR_Item', $data);
				$PR = array(
					'div' => $div,
					'remark' => $remark,
					'warecode' => $warecode,
					'dep' => $depcode);
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
				$DataSave = 'บันทึกข้อมูลสำเร็จ';
				$ImgSave  = '';
				$ImgCode  = '0';
			}
			if (isset($_FILES['file']['name'])) {
				$nowsha = sha1(now().$_FILES['file']['name']);

				$filename = $nowsha.$_FILES['file']['name'];
				$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
				$filesqlname = $nowsha.'.'.$file_ext;
				// PO
				$config['upload_path'] = FCPATH.'assets/photo_storage/';
				// PRA 253
				//$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'\PRAAC\upload\file_upload';

				$config['allowed_types'] = '*';
				$config['max_size']     = '10240'; //10240 = 10 MB
				$config['file_name'] = $filesqlname;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('file'))
				{
					$ImgSave = 'อัพโหลด ไฟล์ไม่สำเร็จ ขนาดเกิน 10MB';
					$ImgCode  = '1';
				}
				else
				{
					$this->db->set('ifileupd', $filesqlname);
					$this->db->where('prno', $prno);
					$this->db->where('seq', $newseq);
					$this->db->where('prdcode', $productcode);
					$this->db->update('PR_Item');
					$ImgSave = 'บันทึกรูปสำเร็จ';
					$ImgCode  = '2';
				}
			}
		}
		$arrt = array('DataSave' => $DataSave, 'ImgSave'  => $ImgSave, 'ImgCode' => $ImgCode);
		echo json_encode($arrt);
	}

	public function updataitem()
	{
		$this->load->database();
		if ($_POST['productcode']=='') {
			$ImgCode = '3';
			$ImgSave = '';
			$DataSave= 'กรุณาใส่ข้อมูลให้ครบ';
		}else{
		if (isset($_POST)) {
			$prno = $_POST['prno'];
			$prdcodeold = $_POST['prdcodeold'];
			$seqold = $_POST['seqold'];
			$productcode = $_POST['productcode'];
			$prqty = $_POST['prqty'];
			$prpriceold = $_POST['prpriceold'];
			$lastpurdate = $_POST['lastpurdate'];
			$prprice = $_POST['prprice'];
			$usedate = $_POST['usedate'];
			$iremark = $_POST['iremark'];
			$newseq = $seqold;
			if ($lastpurdate!='') {
				$Newlastpurdate = nice_date($lastpurdate, 'Ymd');
			}else{
				$Newlastpurdate = '';
			}if ($usedate!='') {
				$Newusedate = nice_date($usedate, 'Ymd');
			}else{
				$Newusedate = '';
			}
        	if ($Newlastpurdate=='Invalid Date') {
        	$this->db->set('prdcode', $productcode);
        	$this->db->set('prqty', $prqty);
        	$this->db->set('prprice_old', $prpriceold);
        	$this->db->set('prprice', $prprice);
        	$this->db->set('usedate', $Newusedate);
        	$this->db->set('iremark', $iremark);
        	$this->db->where('prno', $prno);
        	$this->db->where('seq', $newseq);
        	$this->db->where('prdcode', $prdcodeold);
        	$this->db->update('PR_Item');
        	$DataSave = 'อัพเดตข้อมูลสำเร็จ';
        	$ImgSave  = '';
        	$ImgCode  = '0';
        	}else{
        	$this->db->set('prdcode', $productcode);
        	$this->db->set('prqty', $prqty);
        	$this->db->set('prprice_old', $prpriceold);
        	$this->db->set('lastpurdate', $Newlastpurdate);
        	$this->db->set('prprice', $prprice);
        	$this->db->set('usedate', $Newusedate);
        	$this->db->set('iremark', $iremark);
        	$this->db->where('prno', $prno);
        	$this->db->where('seq', $newseq);
        	$this->db->where('prdcode', $prdcodeold);
        	$this->db->update('PR_Item');
        	$DataSave = 'อัพเดตข้อมูลสำเร็จ';
        	$ImgSave  = '';
        	$ImgCode  = '0';
			}
		}
		if (isset($_FILES['file']['name'])) {
			$nowsha = sha1(now().$_FILES['file']['name']);

			$filename = $nowsha.$_FILES['file']['name'];
			$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
			$filesqlname = $nowsha.'.'.$file_ext;
			// PO
			$config['upload_path'] = FCPATH.'assets/photo_storage/';
			// PRA 253
			//$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'\PRAAC\upload\file_upload';

			$config['allowed_types'] = '*';
			$config['max_size']     = '10240'; //10240 = 10 MB
			$config['file_name'] = $filesqlname;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file'))
			{
                $ImgSave = 'อัพโหลด ไฟล์ไม่สำเร็จ ขนาดเกิน 10MB';
                $ImgCode  = '1';
			}
			else
			{
				$this->db->set('ifileupd', $filesqlname);
				$this->db->where('prno', $prno);
				$this->db->where('seq', $newseq);
				$this->db->where('prdcode', $productcode);
				$this->db->update('PR_Item');
				$ImgSave = 'อัพเดตกรูปสำเร็จ';
				$ImgCode  = '2';
			}
		}

		}
		$arrt = array(
			'DataSave' => $DataSave, 'ImgSave'  => $ImgSave, 'ImgCode' => $ImgCode);
		echo json_encode($arrt);
	}

	public function formatdateitem()
	{
		$datadate = $this->input->post('datadate');
		$Newdate = nice_date($datadate, 'm/d/Y');
		$arrt = array(
			'datadate' => $Newdate);
		echo json_encode($arrt);
	}

	public function CheckPrcodeNoOne()
	{
		$productcode = $this->input->post('productcode');
		$prno = $this->input->post('prno');
		$result = $this->Addpr_model->CheckPrcodeNoOne($productcode,$prno);
		$arrt = array(
			'Result' => $result);
		echo json_encode($arrt);
	}

}
/* End of file Add_Pr.php */
/* Location: ./application/controllers/Add_Pr.php */
?>
