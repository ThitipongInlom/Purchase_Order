<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Show_data extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Get_data_model');
		$this->load->helper('date');
		$this->load->model('Switch_model');
	}
	public function show_all()
	{
		$checkdate = date('Y-m-d');
		$datesearchstart = $this->input->get('datesearchstart');
		$datesearchend = $this->input->get('datesearchend');
		if (empty($datesearchstart) AND empty($datesearchend)) {
			$dateforstart = 'N';
			$dateforend = 'N';
		}else{
			if ($datesearchstart==$checkdate AND $datesearchend==$checkdate) {
				$dateforstart = 'N';
				$dateforend = 'N';
			}else{
			$dateforstart = nice_date($datesearchstart, 'Ymd');
			$dateforend = nice_date($datesearchend, 'Ymd');
			}
		}
		$set = $this->Switch_model->show_all();
		if ($set == '0') {
		$data['row'] = $this->Get_data_model->Get_all($dateforstart,$dateforend);
		$this->load->view('theme/head');
		$this->load->view('show_all',$data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');	
		}
	}
	public function Fax()
	{
		$checkdate = date('Y-m-d');
		$datesearchstart = $this->input->get('datesearchstart');
		$datesearchend = $this->input->get('datesearchend');
		if (empty($datesearchstart) AND empty($datesearchend)) {
			$dateforstart = 'N';
			$dateforend = 'N';
		}else{
			if ($datesearchstart==$checkdate AND $datesearchend==$checkdate) {
				$dateforstart = 'N';
				$dateforend = 'N';
			}else{
			$dateforstart = nice_date($datesearchstart, 'Ymd');
			$dateforend = nice_date($datesearchend, 'Ymd');
			}
		}	
		$set = $this->Switch_model->show_completed();
		if ($set == '0') {
		$data['row'] = $this->Get_data_model->Get_completedrc($dateforstart,$dateforend);
		$data['Fax'] = $this->Get_data_model->Faxdata();
		$this->load->view('theme/head');
		$this->load->view('fax',$data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');			
		}
	}
	public function show_approve()
	{
		$checkdate = date('Y-m-d');
		$datesearchstart = $this->input->get('datesearchstart');
		$datesearchend = $this->input->get('datesearchend');
		if (empty($datesearchstart) AND empty($datesearchend)) {
			$dateforstart = 'N';
			$dateforend = 'N';
		}else{
			if ($datesearchstart==$checkdate AND $datesearchend==$checkdate) {
				$dateforstart = 'N';
				$dateforend = 'N';
			}else{
			$dateforstart = nice_date($datesearchstart, 'Ymd');
			$dateforend = nice_date($datesearchend, 'Ymd');
			}
		}
		$set = $this->Switch_model->show_approve();
		if ($set == '0') {
		$data['row'] = $this->Get_data_model->Get_approve($dateforstart,$dateforend);
		$this->load->view('theme/head');
		$this->load->view('show_approve',$data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');			
		}
	}
	public function show_completed()
	{
		$checkdate = date('Y-m-d');
		$datesearchstart = $this->input->get('datesearchstart');
		$datesearchend = $this->input->get('datesearchend');
		if (empty($datesearchstart) AND empty($datesearchend)) {
			$dateforstart = 'N';
			$dateforend = 'N';
		}else{
			if ($datesearchstart==$checkdate AND $datesearchend==$checkdate) {
				$dateforstart = 'N';
				$dateforend = 'N';
			}else{
			$dateforstart = nice_date($datesearchstart, 'Ymd');
			$dateforend = nice_date($datesearchend, 'Ymd');
			}
		}	
		$set = $this->Switch_model->show_completed();
		if ($set == '0') {
		$data['row'] = $this->Get_data_model->Get_completed($dateforstart,$dateforend);
		$this->load->view('theme/head');
		$this->load->view('show_completed',$data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');			
		}
	}
	public function Show_accounting()
	{
		$checkdate = date('Y-m-d');
		$datesearchstart = $this->input->get('datesearchstart');
		$datesearchend = $this->input->get('datesearchend');
		if (empty($datesearchstart) AND empty($datesearchend)) {
			$dateforstart = 'N';
			$dateforend = 'N';
		}else{
			if ($datesearchstart==$checkdate AND $datesearchend==$checkdate) {
				$dateforstart = 'N';
				$dateforend = 'N';
			}else{
			$dateforstart = nice_date($datesearchstart, 'Ymd');
			$dateforend = nice_date($datesearchend, 'Ymd');
			}
		}	
		$set = $this->Switch_model->Show_accounting();
		if ($set == '0') {	
		$i = $this->input->get('i');
		$data['row'] = $this->Get_data_model->Get_accounting($dateforstart,$dateforend,$i);		
		$this->load->view('theme/head');
		$this->load->view('accounting',$data);
		$this->load->view('theme/footer');		
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');				
		}
	}
	public function show_reject()
	{
		$checkdate = date('Y-m-d');
		$datesearchstart = $this->input->get('datesearchstart');
		$datesearchend = $this->input->get('datesearchend');
		if (empty($datesearchstart) AND empty($datesearchend)) {
			$dateforstart = 'N';
			$dateforend = 'N';
		}else{
			if ($datesearchstart==$checkdate AND $datesearchend==$checkdate) {
				$dateforstart = 'N';
				$dateforend = 'N';
			}else{
			$dateforstart = nice_date($datesearchstart, 'Ymd');
			$dateforend = nice_date($datesearchend, 'Ymd');
			}
		}	
		$set = $this->Switch_model->show_reject();
		if ($set == '0') {
		$data['row'] = $this->Get_data_model->Get_reject($dateforstart,$dateforend);
		$this->load->view('theme/head');
		$this->load->view('show_reject',$data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');			
		}
	}
	public function modal_opendata()
	{
		function namewarecode($warecode)
		{
		$CI =& get_instance();
		$beta = $CI->load->database('bo', TRUE);
		$query = $beta->get_where('STFC0070', array('warecode' => $warecode));
		$result = $query->result_array();
		$waredesc1 = $result[0]['waredesc1'];
		return $waredesc1;
		}

		$rowred = $this->input->post('rowred');
		$prnoopen = $this->input->post("primary");
		$data_head = $this->Get_data_model->modal_head_open($prnoopen);
		$data_body = $this->Get_data_model->modal_body_open($prnoopen);
		$pono_model = $this->Get_data_model->Get_pono_model($prnoopen);
		$Newdate = nice_date($data_head[0]['prdate'], 'd/m/Y');
echo'<div id="dispayopendata2"><div class="row">
		<div class="col-md-12 col-xs-12">
				<div align="center">
					<img src="'.base_url().'assets/icon/thezign.gif'.'" width="120">
				</div>
		</div>
		<div class="col-md-12 col-xs-12">
			<p align="center"><b>Division: '.$data_head[0]['div'].'</b></p>
		</div>
		<div class="col-md-12 col-xs-12">
			<p class="pull-left"><b>Vendor: </b> '.$data_head[0]['Vendor'].' - '.$data_head[0]['Vendor_name'].'</p>
			<p class="pull-right"><b>P/R No: </b> '.$data_head[0]['prno'].'</p>
			 <input type="hidden" id="prapproveset" value="'.$data_head[0]['prno'].'">
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<p class="pull-left"><b>No: </b> '.$data_head[0]['refno']; if (isset($pono_model[0]->pono) !='') {echo ','.$pono_model[0]->pono;} echo '</p>
			<p class="pull-right"><b>Warehouse: </b> ['.$data_head[0]['warecode'].'] '.namewarecode($data_head[0]['warecode']).'</p>
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<p class="pull-left"><b>Date: </b> '.$Newdate.'</p>
			<p class="pull-right"><b>Department: </b> ['.$data_head[0]['dep'].'] '.$data_head[0]['Dep_name'].'</p>
		</div>
		<br>
		<div class="col-md-9 col-xs-9">
			<p class="pull-left"><b>Remark: </b> '.$data_head[0]['remark'].'</p>
		</div>
		<div class="col-md-3 col-xs-3">
			<p class="pull-right"><b>Purchase Requistion</b></p>
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<div class="table-responsive">
				<table  width="100%" class="table table-bordered table-condensed  table-striped">
					<tr style="background:#D5DBDB;">
						<th width="10%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Unit</b></th>
						<th width="5%"  rowspan="2" style="text-align: center; vertical-align: middle;"><b>Qty</b></th>
						<th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>No.</b></th>
						<th width="40%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Description</b></th>
						<th width="10%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Delivery Date</b></th>
						<th width="20%" colspan="2" style="text-align: center; vertical-align: middle;"><b>Last Purchase</b></th>
						<th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Unit Price</b></th>
						<th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Total</b></th>
					</tr>
					<tr style="background:#D5DBDB;">
						<th width="10%" style="text-align: center; vertical-align: middle;"><b>Date</b></th>
						<th width="10%" style="text-align: center; vertical-align: middle;"><b>Unit Price</b></th>
					</tr>';
					foreach ($data_body as $row)
					{
					echo '<tr>
						<td style="text-align: center;">'; $warecode = $row['prdcode']; $betaware = $this->Get_data_model->getUnit($warecode); echo  $betaware.'</td>
						<td style="text-align: center;">'.$row['prqty'].'</td>
						<td style="text-align: center;">';if ($row['ifileupd']!='') {
								echo '<div align="center"><i class="fa fa-paperclip" id="iconimg" imgdata="'.$row['ifileupd'].'" onclick="openwindowimg(this)"></i></div>';
						} echo '<a href="#"> <p sendid="'.$row['prdcode'].'" onclick="windowsdata(this);">'.$row['prdcode'].'</p></a></td>
						<td style="text-align: left;">';$warecode = $row['prdcode']; $iremark = $this->Get_data_model->iremark($warecode); $ciremark = $row['iremark'];  echo $iremark[0]['stname1']; if ($ciremark != '') {
								echo ' [* '.$ciremark.' *]';
						} echo'</td>
						<td style="text-align: center;">';$Newdate = nice_date($row['usedate'], 'd/m/Y'); echo $Newdate.'</td>
						<td style="text-align: center;">';if ($row['lastpurdate'] =='new') {
								echo 'New Item';
							}else{
								$lastpurdate = nice_date($row['lastpurdate'], 'd/m/Y'); echo $lastpurdate;
						} echo'</td>
						<td style="text-align: center;">'.number_format($row['prprice_old'],2).'</td>
						<td style="text-align: center;">'.number_format($row['prprice'],2).'</td>
						<td style="text-align: center;">'; $totalpice = $row['prprice'] * $row['prqty']; echo number_format($totalpice,2); echo'</td>
					</tr>';
					}
				echo'
					<tr style="background:#D5DBDB;">
						<td colspan="8" style="text-align: right;"><b>Total</b></td>
						<td>'; $totalget = $this->Get_data_model->gettotal($data_head[0]['prno']); echo number_format($totalget,2).''; echo'</td>
					</tr>';
					if ($data_head[0]['DC']>0) {
						$dispersen = $data_head[0]['DC'];
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Discount '.$dispersen.'%</b></td>
							<td>';$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);$DC = $data_head[0]['DC']; $DV_V = ($DC*$totalget)/100;  echo number_format($DV_V,2).''; echo'</td>
						</tr>';
						}
					if ($data_head[0]['DC_A']>0) {
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Discount</b></td>
							<td>';$DV_V = $data_head[0]['DC_A'];  echo number_format($DV_V,2).''; echo'</td>
						</tr>';
						}
					if ($data_head[0]['Vat']=='Y') {
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Vat 7%</b></td>
							<td>';
								$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);
								if ($data_head[0]['DC_A']>0) {
									$DV_VA = $data_head[0]['DC_A'];
								}elseif($data_head[0]['DC']>0){
									$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);
									$DC = $data_head[0]['DC'];
									$DV_VA = (($DC*$totalget)/100);
								}else{
									$DV_VA = 0;
								}
								$vata = (7/100)*($totalget - $DV_VA);
								echo number_format($vata,2).'';
							echo'</td>
						</tr>';
					}
					if ($data_head[0]['Vat']=='Y' OR $data_head[0]['DC_A']>0 OR $data_head[0]['DC']>0) {
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Grand Total</b></td>
							<td>';
								if ($data_head[0]['DC_A']>0) {
									$DV_V = $data_head[0]['DC_A'];
								}elseif($data_head[0]['DC']>0){
									$totalget = $this->Get_data_model->gettotal($data_head[0]['prno']);
									$DC = $data_head[0]['DC'];
									$DV_V = (($DC*$totalget)/100);
								}else{
									$DV_V = 0;
								}
								if ($data_head[0]['Vat']=='Y') {
									$this->Get_data_model->gettotal($data_head[0]['prno']);
									$newtotl =$totalget-$DV_V;
									$vata = ($newtotl/100)*7;
								}elseif($data_head[0]['Vat']=='N'){
									$vata = 0;
								}
							$totalget = $gtotal = (($totalget-$DV_V)+$vata); echo number_format($gtotal,2).'';  echo'</td>
						</tr>';
					}
				echo'</table>';
				$GMcomment =  $data_head[0]['GMComment'];
				$EFCcomment = $data_head[0]['EFCComment'];
				if ($GMcomment !='') {
					echo '<b>GM Comment:</b>'.$GMcomment.'<br>';
				}
				if ($EFCcomment !='') {
					echo '<b>EFC Comment:</b>'.$EFCcomment.'<br>';
				}
			echo'</div></div></div>';
			$userhodapp = $data_head[0]['Hd_signature'];
			//$userhodapp = substr($data_head[0]['Hd_signature'], 0, -4);

			echo '<div class="row"><div class="col-md-12"><table width="100%"><tr align="center"><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
				if ($data_head[0]['HdApprove'] =='Y') {
				$dep = $data_head[0]['dep'];
					if ($dep=='HK01') {
						$dep ='HK01';
					}elseif($dep=='FO01'){
						$dep ='FO01';
					}elseif ($dep =='HK01' OR $dep =='FO01') {
						$dep ='RM';
					}
					$resultimg = $this->Get_data_model->Getimg_hod($userhodapp);

					if ($userhodapp=='') {
						
					if ($dep =='EN01'){
					 	echo '<img src="../../assets/signature/EN01.gif" width="100">';
					}else{
						echo '<img src="../../assets/signature/'.$dep.'.gif" width="100">';
					}
					}else{
						if ($resultimg[0]['signature_img'] == '') {
						echo '<img src="../../assets/signature/'.$dep.'.gif" width="100">';
						}else{
						echo '<img src="../../assets/signature/'.$resultimg[0]['signature_img'].'" width="100">';		
						}
					}

				}else{
						echo '...............................';
				}
				echo '</td><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
			if ($data_head[0]['GMApprove'] =='Y') {
				echo '<img src="../../assets/signature/GM.gif" width="80">';
			}else{
				echo '..............................';
			}
		echo '</td><td>';
		if ($data_head[0]['EFCApprove'] =='Y') {
			echo '<img src="../../assets/signature/EFC.gif" width="80">';
		}else{
			echo '........................................';
		}
			echo '</td></tr><tr align="center"><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
	if ($data_head[0]['HdApprove'] =='Y') {
		if (isset($resultimg[0]['signature_img'])) {
			echo $resultimg[0]['fname'].' '.$resultimg[0]['lname'].'<br>';
		}
		$HdApprove_Date = nice_date($data_head[0]['HdApprove_Date'], 'd/m/Y h:i'); echo $HdApprove_Date;
	}
		echo '</td><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
	if ($data_head[0]['GMApprove'] =='Y') {
		$GMApprove_Date = nice_date($data_head[0]['GMApprove_Date'], 'd/m/Y h:i'); echo $GMApprove_Date;
	}
		echo '</td><td>';
	if ($data_head[0]['EFCApprove'] =='Y') {
		$EFCApprove = nice_date($data_head[0]['EFCApprove_Date'], 'd/m/Y h:i'); echo $EFCApprove;
	}
	echo '</td></tr><tr align="center"><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
		echo 'Department Head';
	echo '</td><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
		echo 'General Manager';
		echo '</td><td>';
		echo 'Executive Financial Controller';
	echo '</td></table></div></div></div><br>';
	echo '<div class="row"><div class="col-md-12"><div class="modal-footer">
		  <div align="center">';
	$type = $this->session->type;
	$user = $this->session->username;
        if ($type=='hod' AND $data_head[0]['HdApprove'] =='' AND $data_head[0]['GMApprove'] =='' AND $data_head[0]['EFCApprove'] =='' AND $data_head[0]['completed'] =='' OR $user=='Somkid' AND $data_head[0]['HdApprove'] =='' AND $data_head[0]['GMApprove'] =='' AND $data_head[0]['EFCApprove'] =='' AND $data_head[0]['completed'] =='') {
        echo '<button type="button" class="btn btn-success" onclick="approve(this)" data-toggle="tooltip" data-placement="bottom" title="อนุมันติPR">อนุมันติPR</button>
              <button type="button" class="btn btn-danger" onclick="approvex(this)" data-toggle="tooltip" data-placement="bottom" title="ไม่อนุมันติPR">ไม่อนุมันติPR</button>';
        }elseif ($type=='accounting' AND $data_head[0]['HdApprove'] =='Y' AND $data_head[0]['PRApprove'] == '' AND $data_head[0]['GMApprove'] =='' AND $data_head[0]['EFCApprove'] =='' AND $data_head[0]['completed'] =='' OR $type=='accounting0' AND $data_head[0]['HdApprove'] =='Y' AND $data_head[0]['PRApprove'] == '' AND $data_head[0]['GMApprove'] =='' AND $data_head[0]['EFCApprove'] =='' AND $data_head[0]['completed'] =='') {
        echo '<button type="button" class="btn btn-success" onclick="approve(this)" data-toggle="tooltip" data-placement="bottom" title="อนุมันติPR">อนุมันติPR</button>
              <button type="button" class="btn btn-danger" onclick="approvex(this)" data-toggle="tooltip" data-placement="bottom" title="ไม่อนุมันติPR">ไม่อนุมันติPR</button>';
     	}elseif ($user=='Somkhit' AND $data_head[0]['HdApprove'] =='Y' AND $data_head[0]['PRApprove'] == 'Y' AND $data_head[0]['GMApprove'] =='' AND $data_head[0]['EFCApprove'] =='' AND $data_head[0]['completed'] =='') {
        echo '<button type="button" class="btn btn-success" rowred="'.$rowred.'" onclick="approve(this)" data-toggle="tooltip" data-placement="bottom" title="อนุมันติPR">อนุมันติPR</button>
              <button type="button" class="btn btn-danger"  rowred="'.$rowred.'" onclick="approvex(this)" data-toggle="tooltip" data-placement="bottom" title="ไม่อนุมันติPR">ไม่อนุมันติPR</button>';
     	}elseif ($user=='Nalinee' AND $data_head[0]['HdApprove'] =='Y' AND $data_head[0]['PRApprove'] == 'Y' AND $data_head[0]['GMApprove'] =='Y' AND $data_head[0]['EFCApprove'] =='' AND $data_head[0]['completed'] =='') {
        echo '<button type="button" class="btn btn-success" onclick="approve(this)" data-toggle="tooltip" data-placement="bottom" title="อนุมันติPR">อนุมันติPR</button>
              <button type="button" class="btn btn-danger" onclick="approvex(this)" data-toggle="tooltip" data-placement="bottom" title="ไม่อนุมันติPR">ไม่อนุมันติPR</button>';
     	}
     	if ($type=='accounting' AND $data_head[0]['HdApprove'] =='Y' AND $data_head[0]['PRApprove'] == 'Y' AND $data_head[0]['GMApprove'] =='Y' AND $data_head[0]['EFCApprove'] =='Y' AND $data_head[0]['completed'] =='' OR $type=='accounting0' AND $data_head[0]['HdApprove'] =='Y' AND $data_head[0]['PRApprove'] == 'Y' AND $data_head[0]['GMApprove'] =='Y' AND $data_head[0]['EFCApprove'] =='Y' AND $data_head[0]['completed'] =='') {
     	echo '<button type="button" class="btn btn-warning" onclick="completedY(this)" data-toggle="tooltip" data-placement="bottom" title="สั้งซื้อแล้ว"><i class="fa fa-exchange"></i></button>';		
     	}
    echo '<button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" data-placement="bottom" title="ปิด" id="modelclose">ปิด</button>
          <button type="button" class="btn btn-primary"  onclick="printdata(this)" primary="'.$data_head[0]['prno'].'" data-toggle="tooltip" data-placement="bottom" title="พิมพ์ข้อมูล"><i class="fa fa-print"></i></button>';         
	echo '</div></div></div></div>';
	}
	
	public function setstatusapp()
	{
		$prid = $_POST['prid'];
		$deppr = $_POST['deppr'];
		$statusappval = $_POST['statusappval'];
		$userby = null;
		$datetimeupdate = date("d-m-Y");
		if ($this->session->username=='Somkhit') {
			$userby = 'By:GM';
		}elseif ($this->session->username=='Nalinee') {
			$userby = 'By:EFC';
		}elseif ($this->session->dep=='AC') {
			$userby = 'By:AC';
		}else{
			$userby = 'By:'.$this->session->dep;
		}
		$this->Get_data_model->statusapp($prid,$statusappval,$userby);
		$this->Get_data_model->updatestatustime($prid,$datetimeupdate,$statusappval);
		if ($statusappval!='') {
			$this->bot_line_setting($statusappval,$prid,$userby,$datetimeupdate,$deppr);
		}
	}

	public function approveY()
	{
		$primary = $_POST['primary'];
		$approvedata = $_POST['approvedata'];
		$type = $this->session->type;
		$username = $this->session->username;
		$date = date('YmdHi');
		$this->Get_data_model->approveY($primary,$approvedata,$type,$date,$username);
	}

	public function approveX()
	{
		$primary = $_POST['primary'];
		$approvedata = $_POST['approvedata'];
		$type = $this->session->type;
		$username = $this->session->username;
		$date = date('YmdHi');
		$this->Get_data_model->approveX($primary,$approvedata,$type,$date,$username);
	}	

	public function completedY()
	{
		$primary = $_POST['primary'];
		$approvedata = $_POST['approvedata'];
		$refno_pr = $this->Get_data_model->Get_refno_pr($primary);
		$set_app = $this->Get_data_model->Get_Zign_Beta($refno_pr);
		if ($set_app == '0') {
			$this->Add_Pr_BO($primary);
		}
		elseif ($set_app == '1') {
			//$this->Update_Pr_BO($primary);
		}
		$this->Get_data_model->completedY($primary,$approvedata);
	}

	public function completedY_AC()
	{
		$primary = $_POST['primary'];
		$approvedata = $_POST['approvedata'];
		$refno_pr = $this->Get_data_model->Get_refno_pr($primary);
		$set_app = $this->Get_data_model->Get_Zign_Beta($refno_pr);
		if ($set_app == '0') {
			$this->Add_Pr_BO($primary);
		}
		elseif ($set_app == '1') {
			//$this->Update_Pr_BO($primary);
		}
	}	

	public function Add_Pr_BO($primary)
	{
		$BO_num = $this->Get_data_model->Check_BO_number($primary);
		$run_no = $this->Get_data_model->run_no();
		$podate = date('Ymd');
		$Coo4 = $this->Get_data_model->Get_pr_004($primary);
		if ($Coo4=='0') {
		$this->Get_data_model->insert_run_no($run_no);	
		$this->Get_data_model->insert_pono($BO_num,$primary,$podate);
		$this->Get_data_model->insert_pono2($BO_num,$primary);
		}
		return;
	}

	public function Update_Pr_BO($primary)
	{
		$BO_num = $this->Get_data_model->Get_Pono_primary($primary);
		$podate = date('Ymd');
		$Coo4 = $this->Get_data_model->Get_pr_004($primary);
		if ($Coo4=='0') {
		$this->Get_data_model->update_pono2($BO_num,$primary);	
		}
	}	

	public function savesetvenderpr()
	{
		$vendorcode = $this->input->post('vendorcode');
		$vendorname = $this->input->post('vendorname');
		$prno = $this->input->post('prid');
		if ($vendorcode!= '') {
		$this->Get_data_model->savesetvenderpr($vendorcode,$vendorname,$prno);
		}
		echo 'OK';
	}

	public function deletedata()
	{
		$primary = $this->input->post('primary');
		$this->Get_data_model->deletedata($primary);
		echo 'OK';
	}

	public function RC_modal_opendata()
	{
		function namewarecode($warecode)
		{
		$CI =& get_instance();
		$beta = $CI->load->database('bo', TRUE);
		$query = $beta->get_where('STFC0070', array('warecode' => $warecode));
		$result = $query->result_array();
		$waredesc1 = $result[0]['waredesc1'];
		return $waredesc1;
		}
		$prnoarray = $this->input->post('prno');
		$data_head = $this->Get_data_model->RC_modal_head_open($prnoarray);
		foreach ($data_head as $key => $value) {
		$Newdate = nice_date($value['prdate'], 'd/m/Y');
		echo '<page size="A4">';
		echo'<div id="dispayopendata2"><div class="row">
		<div class="col-md-12 col-xs-12">
				<div align="center">
					<img src="'.base_url().'assets/icon/thezign.gif'.'" width="120">
				</div>
		</div>
		<div class="col-md-12 col-xs-12">
			<p align="center"><b>Division: '.$value['div'].'</b></p>
		</div>
		<div class="col-md-12 col-xs-12">
			<p class="pull-left"><b>Vendor: </b> '.$value['Vendor'].' - '.$value['Vendor_name'].'</p>
			<p class="pull-right"><b>P/R No: </b> '.$value['prno'].'</p>
			 <input type="hidden" id="prapproveset" value="'.$value['prno'].'">
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<p class="pull-left"><b>No: </b> '.$value['refno'].'</p>
			<p class="pull-right"><b>Warehouse: </b> ['.$value['warecode'].'] '.namewarecode($value['warecode']).'</p>
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<p class="pull-left"><b>Date: </b> '.$Newdate.'</p>
			<p class="pull-right"><b>Department: </b> ['.$value['dep'].'] '.$value['Dep_name'].'</p>
		</div>
		<br>
		<div class="col-md-9 col-xs-9">
			<p class="pull-left"><b>Remark: </b> '.$value['remark'].'</p>
		</div>
		<div class="col-md-3 col-xs-3">
			<p class="pull-right"><b>Purchase Requistion</b></p>
		</div>
		<br>
		<div class="col-md-12 col-xs-12">
			<div class="table-responsive">
				<table  width="100%" class="table table-bordered table-condensed  table-striped">
					<tr style="background:#D5DBDB;">
						<th width="10%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Unit</b></th>
						<th width="5%"  rowspan="2" style="text-align: center; vertical-align: middle;"><b>Qty</b></th>
						<th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>No.</b></th>
						<th width="40%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Description</b></th>
						<th width="10%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Delivery Date</b></th>
						<th width="20%" colspan="2" style="text-align: center; vertical-align: middle;"><b>Last Purchase</b></th>
						<th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Unit Price</b></th>
						<th width="5%" rowspan="2" style="text-align: center; vertical-align: middle;"><b>Total</b></th>
					</tr>
					<tr style="background:#D5DBDB;">
						<th width="10%" style="text-align: center; vertical-align: middle;"><b>Date</b></th>
						<th width="10%" style="text-align: center; vertical-align: middle;"><b>Unit Price</b></th>
					</tr>';
					$data_body = $this->Get_data_model->RC_modal_body_open($value['prno']);
					$i = 1;
					foreach ($data_body as $row)
					{
					echo '<tr>
						<td style="text-align: center;">'; $warecode = $row['prdcode']; $betaware = $this->Get_data_model->getUnit($warecode); echo  $betaware.'</td>
						<td style="text-align: center;">'.$row['prqty'].'</td>
						<td style="text-align: center;">';if ($row['ifileupd']!='') {
								echo '<div align="center"><i class="fa fa-paperclip" id="iconimg" imgdata="'.$row['ifileupd'].'" onclick="openwindowimg(this)"></i></div>';
						} echo '<a href="#"> <p sendid="'.$row['prdcode'].'" onclick="windowsdata(this);">'.$row['prdcode'].'</p></a></td>
						<td style="text-align: left;">';$warecode = $row['prdcode']; $iremark = $this->Get_data_model->iremark($warecode); $ciremark = $row['iremark'];  echo $iremark[0]['stname1']; if ($ciremark != '') {
								echo ' [* '.$ciremark.' *]';
						} echo'</td>
						<td style="text-align: center;">';$Newdate = nice_date($row['usedate'], 'd/m/Y'); echo $Newdate.'</td>
						<td style="text-align: center;">';if ($row['lastpurdate'] =='new') {
								echo 'New Item';
							}else{
								$lastpurdate = nice_date($row['lastpurdate'], 'd/m/Y'); echo $lastpurdate;
						} echo'</td>
						<td style="text-align: center;">'.number_format($row['prprice_old'],2).'</td>
						<td style="text-align: center;">'.number_format($row['prprice'],2).'</td>
						<td style="text-align: center;">'; $totalpice = $row['prprice'] * $row['prqty']; echo number_format($totalpice,2); echo'</td>
					</tr>';
					$i++;
					}
				echo'
					<tr style="background:#D5DBDB;">
						<td colspan="8" style="text-align: right;"><b>Total</b></td>
						<td>'; $totalget = $this->Get_data_model->gettotal($value['prno']); echo number_format($totalget,2).''; echo'</td>
					</tr>';
					if ($value['DC']>0) {
						$dispersen = $data_head[0]['DC'];
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Discount '.$dispersen.'%</b></td>
							<td>';$totalget = $this->Get_data_model->gettotal($value['prno']);$DC = $value['DC']; $DV_V = ($DC*$totalget)/100;  echo number_format($DV_V,2).''; echo'</td>
						</tr>';
						}
					if ($value['DC_A']>0) {
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Discount</b></td>
							<td>';$DV_V = $value['DC_A'];  echo number_format($DV_V,2).''; echo'</td>
						</tr>';
						}
					if ($value['Vat']=='Y') {
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Vat 7%</b></td>
							<td>';
								$totalget = $this->Get_data_model->gettotal($value['prno']);
								if ($value['DC_A']>0) {
									$DV_VA = $value['DC_A'];
								}elseif($value['DC']>0){
									$totalget = $this->Get_data_model->gettotal($value['prno']);
									$DC = $value['DC'];
									$DV_VA = (($DC*$totalget)/100);
								}else{
									$DV_VA = 0;
								}
								$vata = (7/100)*($totalget - $DV_VA);
								echo number_format($vata,2).'';
							echo'</td>
						</tr>';
					}
					if ($value['Vat']=='Y' OR $value['DC_A']>0 OR $value['DC']>0) {
						echo '<tr style="background:#D5DBDB;">
							<td colspan="8" style="text-align: right;"><b>Grand Total</b></td>
							<td>';
								if ($value['DC_A']>0) {
									$DV_V = $value['DC_A'];
								}elseif($value['DC']>0){
									$totalget = $this->Get_data_model->gettotal($value['prno']);
									$DC = $value['DC'];
									$DV_V = (($DC*$totalget)/100);
								}else{
									$DV_V = 0;
								}
								if ($value['Vat']=='Y') {
									$this->Get_data_model->gettotal($value['prno']);
									$newtotl =$totalget-$DV_V;
									$vata = ($newtotl/100)*7;
								}elseif($value['Vat']=='N'){
									$vata = 0;
								}
							$totalget = $gtotal = (($totalget-$DV_V)+$vata); echo number_format($gtotal,2).'';  echo'</td>
						</tr>';
					}
				echo'</table>';
				$GMcomment =  $value['GMComment'];
				$EFCcomment = $value['EFCComment'];
				if ($GMcomment !='') {
					echo '<b>GM Comment:</b>'.$GMcomment.'<br>';
				}
				if ($EFCcomment !='') {
					echo '<b>EFC Comment:</b>'.$EFCcomment.'<br>';
				}
			echo'</div></div></div>';
			$userhodapp = $value['Hd_signature'];
			//$userhodapp = substr($data_head[0]['Hd_signature'], 0, -4);

			echo '<div class="row"><div class="col-md-12"><table width="100%"><tr align="center"><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
				if ($value['HdApprove'] =='Y') {
				$dep = $value['dep'];
					if ($dep=='HK01') {
						$dep ='HK01';
					}elseif($dep=='FO01'){
						$dep ='FO01';
					}elseif ($dep =='HK01' OR $dep =='FO01') {
						$dep ='RM';
					}
					$resultimg = $this->Get_data_model->Getimg_hod($userhodapp);
					if ($userhodapp=='') {
						
					if ($dep =='EN01'){
					 	echo '<img src="../../assets/signature/EN01.gif" width="100">';
					}else{
						echo '<img src="../../assets/signature/'.$dep.'.gif" width="100">';
					}
					}else{
					echo '<img src="../../assets/signature/'.$resultimg[0]['signature_img'].'" width="100">';	
					}

				}else{
						echo '...............................';
				}
				echo '</td><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
			if ($value['GMApprove'] =='Y') {
				echo '<img src="../../assets/signature/GM.gif" width="80">';
			}else{
				echo '..............................';
			}
		echo '</td><td>';
		if ($value['EFCApprove'] =='Y') {
			echo '<img src="../../assets/signature/EFC.gif" width="80">';
		}else{
			echo '........................................';
		}
			echo '</td></tr><tr align="center"><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
	if ($value['HdApprove'] =='Y') {
		if ($userhodapp!='') {
			echo $resultimg[0]['fname'].' '.$resultimg[0]['lname'].'<br>';
		}
		$HdApprove_Date = nice_date($value['HdApprove_Date'], 'd/m/Y h:i'); echo $HdApprove_Date;
	}
		echo '</td><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
	if ($value['GMApprove'] =='Y') {
		$GMApprove_Date = nice_date($value['GMApprove_Date'], 'd/m/Y h:i'); echo $GMApprove_Date;
	}
		echo '</td><td>';
	if ($value['EFCApprove'] =='Y') {
		$EFCApprove = nice_date($value['EFCApprove_Date'], 'd/m/Y h:i'); echo $EFCApprove;
	}
	echo '</td></tr><tr align="center"><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
		echo 'Department Head';
	echo '</td><td align="'; 
			if ($userhodapp=='') {
			 	echo 'right';
			}else{
				echo 'center';
			} 
			echo'">';
		echo 'General Manager';
		echo '</td><td>';
		echo 'Executive Financial Controller';
	echo '</td></table></div></div></div><hr>';
	echo '</page>';
	}
	}

	public function FAXSAVE()
	{
		$Fax_prno = $this->input->post('prno');
		$Fax_date = date('Y-m-d');
		$Fax_username = $this->session->username;
		foreach ($Fax_prno as $key => $fprno) {
			$countid = $this->Get_data_model->FaxCount();
			$Newarray = array('Fax_prno' => $fprno, 'Fax_date' => $Fax_date, 'Fax_username' => $Fax_username, 'Fax_id' => $countid);
			$this->Get_data_model->Faxsave($Newarray);
		}
	echo 'OK';	
	}

	public function bot_line_setting($statusappval,$prid,$userby,$datetimeupdate,$deppr)
	{
		// Token
		$token = $this->Get_data_model->get_tokenbot();
		
		// Message
		$message = "PR: $prid
		แผนก: $deppr
		คอมเม้น: $statusappval
		โดย: $userby
		วันที่: $datetimeupdate";

		// Send Message
		$this->bot_send($token,$message);
	}

	public function bot_send($token, $message)
	{
	//  Bot Start
	$Bot = curl_init(); 
	curl_setopt( $Bot, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $Bot, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $Bot, CURLOPT_SSL_VERIFYPEER, 0); 

	curl_setopt( $Bot, CURLOPT_POST, 1); 

	curl_setopt( $Bot, CURLOPT_POSTFIELDS, "message=$message"); 

	curl_setopt( $Bot, CURLOPT_FOLLOWLOCATION, 1); 

	$headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", ); 
	curl_setopt($Bot, CURLOPT_HTTPHEADER, $headers); 
	//RETURN 
	curl_setopt( $Bot, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $Bot ); 
	//Check error 
	if(curl_error($Bot)) { echo 'error:' . curl_error($Bot); } 
	else { $result_ = json_decode($result, true); 
	echo "status : ".$result_['status']; echo "message : ". $result_['message']; } 
	curl_close( $Bot );  
	}

}
/* End of file Show_data.php */
/* Location: ./application/controllers/Show_data.php */
?>