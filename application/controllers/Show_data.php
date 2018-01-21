<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Show_data extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Get_data_model');
		$this->load->helper('date');
	}

	public function show_all()
	{
		$data['row'] = $this->Get_data_model->Get_all();
		$this->load->view('theme/head');
		$this->load->view('show_all',$data);
		$this->load->view('theme/footer');
	}

	public function show_approve()
	{
		$data['row'] = $this->Get_data_model->Get_approve();
		$this->load->view('theme/head');
		$this->load->view('show_approve',$data);
		$this->load->view('theme/footer');
	}

	public function show_completed()
	{
		$this->load->view('theme/head');
		$this->load->view('show_completed');
		$this->load->view('theme/footer');
	}

	public function modal_opendata()
	{
		$data_head = $this->Get_data_model->modal_head_open();	
		$data_body = $this->Get_data_model->modal_body_open();
		$Newdate = nice_date($data_head[0]['prdate'], 'd/m/Y');
echo'<div class="row">
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
	</div>
	<br>
	<div class="col-md-12 col-xs-12">
	<p class="pull-left"><b>No: </b> '.$data_head[0]['refno'].'</p>
	<p class="pull-right"><b>Warehouse: </b> '.$data_head[0]['warecode'].'</p>
	</div>
	<br>
	<div class="col-md-12 col-xs-12">
	<p class="pull-left"><b>Date: </b> '.$Newdate.'</p>
	<p class="pull-right"><b>Department: </b> '.$data_head[0]['dep'].'</p>
	</div>
	<br>
	<div class="col-md-9 col-xs-9">
	<p class="pull-left"><b>Remark: </b> '.$data_head[0]['remark'].'</p>
	</div>
	<div class="col-md-3 col-xs-3">
	<p class="pull-right"><b>Purchase Requistion</b></p>
	</div>
	<br>
	<div class="col-md-12 col-xs-12" align="center">
	<div class="table-responsive">
	<table boder="5" cellspacing="0" width="100%" class="table table-bordered table-responsive table-striped">
	<tr class="info">
	<th width="10%" rowspan="2"><b>Unit</b></th>
	<th width="5%"  rowspan="2"><b>Qty</b></th>
	<th width="5%" rowspan="2"><b>No.</b></th>
	<th width="40%" rowspan="2"><b>Description</b></th>
	<th width="10%" rowspan="2"><b>Delivery Date</b></th>
	<th width="20%" colspan="2"><b>Last Purchase</b></th>
	<th width="5%" rowspan="2"><b>Unit Price</b></th>
	<th width="5%" rowspan="2"><b>Total</b></th>
	</tr>
	<tr class="info">
	<th width="10%" align="center"><b>Date</b></th>
	<th width="10%" align="center"><b>Unit Price</b></th>
	</tr>';
	foreach ($data_body as $row)
	{
	echo '<tr>
	<td>'; $warecode = $row['prdcode']; $betaware = $this->Get_data_model->getUnit($warecode); echo  $betaware.'</td>
	<td>'.$row['prqty'].'</td>
	<td>';if ($row['ifileupd']!='') {
		echo '<i class="fa fa-paperclip" id="iconimg" imgdata="'.$row['ifileupd'].'" onclick="openwindowimg(this)"></i>';
	} echo $row['prdcode'].'</td>
	<td>';$warecode = $row['prdcode']; $iremark = $this->Get_data_model->iremark($warecode); $ciremark = $row['iremark'];  echo $iremark[0]['stname1']; if ($ciremark >0) {
		echo '[* '.$ciremark.' *]';
	} echo'</td>
	<td>';$Newdate = nice_date($row['usedate'], 'd/m/Y'); echo $Newdate.'</td>
	<td>';if ($row['lastpurdate'] =='new') {
		echo 'New Item';
	}else{
		  $lastpurdate = nice_date($row['lastpurdate'], 'd/m/Y'); echo $lastpurdate;
	} echo'</td>
	<td>'.number_format($row['prprice_old'],2).'฿</td>
	<td>'.number_format($row['prprice'],2).'฿</td>
	<td>'; $totalpice = $row['prprice'] * $row['prqty']; echo number_format($totalpice,2); echo'฿</td>
	</tr>';
	}
echo'
	<tr class="info">
	<td colspan="8" style="text-align: right;"><b>Total</b></td>
	<td>'; $totalget = $this->Get_data_model->gettotal($data_head[0]['prno']); echo number_format($totalget,2).'฿'; echo'</td>
	</tr>';
	if ($data_head[0]['DC_A']>0) {
		echo '<tr class="info">
		<td colspan="8" style="text-align: right;"><b>Discount</b></td>
		<td>';$DC_A = $data_head[0]['DC_A'];  echo number_format($DC_A,2).'฿'; echo'</td>
		</tr>';
	}	
	if ($data_head[0]['Vat']=='Y') {
		echo '<tr class="info">
		<td colspan="8" style="text-align: right;"><b>Vat 7%</b></td>
		<td>';$newtotl =$totalget-$DC_A;  
		$vata = ($newtotl/100)*7;
		echo number_format($vata,2).'฿';
		echo'</td>
		</tr>';
	}
	if ($data_head[0]['Vat']=='Y' AND $data_head[0]['DC']>=0 AND $data_head[0]['DC_A']>=0) {
		echo '<tr class="info">
		<td colspan="8" style="text-align: right;"><b>Grand Total</b></td>
		<td>';$gtotal = (($totalget-$DC_A)+$vata); echo number_format($gtotal,2).'฿';  echo'</td>
		</tr>';
	}
	echo'</table></div>
	</div>';
	$GMcomment =  $data_head[0]['GMComment'];
	$EFCcomment = $data_head[0]['EFCComment'];
	if ($GMcomment !='') {
		echo '<b>GM Comment:</b>'.$GMcomment.'<br>';
	}
	if ($EFCcomment !='') {
		echo '<b>EFC Comment:</b>'.$EFCcomment.'<br>';
	}
	echo'<div class="col-md-4 col-xs-4"><div align="center">'; 
	if ($data_head[0]['HdApprove'] =='Y') {
		$dep = $data_head[0]['dep'];
		if ($dep=='HK01') {
			$dep ='HK01';
		}elseif($dep=='FO01'){
			$dep ='FO01';
		}elseif ($dep =='HK01' OR $dep =='FO01') {
			$dep ='RM';
		}
		if ($dep =='EN01'){
			echo '<img src="../../assets/signature/EN03.gif" width="80">';
		}else{
			echo '<img src="../../assets/signature/'.$dep.'.gif" width="80">';
		}
	}else{
		echo '........................................';
	}
	if ($data_head[0]['HdApprove'] =='Y') {
		$dep = $data_head[0]['dep'];
		if ($dep=='HK01') {
			$dep ='HK01';
		}elseif($dep=='FO01'){
			$dep ='FO01';
		}elseif ($dep =='HK01' OR $dep =='FO01') {
			$dep ='RM';
		}
		$HdApprove_Date = nice_date($data_head[0]['HdApprove_Date'], 'd/m/Y h:i'); echo '<br>'.$HdApprove_Date;
	}else{
		echo '<br>';
	}echo '<br>Department Head';
	echo'</div></div>
	<div class="col-md-4 col-xs-4"><div align="center">';
	if ($data_head[0]['GMApprove'] =='Y') {
		echo '<img src="../../assets/signature/GM.gif" width="80">';
		$GMApprove_Date = nice_date($data_head[0]['GMApprove_Date'], 'd/m/Y h:i'); echo '<br>'.$GMApprove_Date;
	}else{
		echo '........................................';
		echo '<br>';
	}echo '<br>General Manager';
	echo'</div></div>
	<div class="col-md-4 col-xs-4"><div align="center">'; 
	if ($data_head[0]['EFCApprove'] =='Y') {
		echo '<img src="../../assets/signature/EFC.gif" width="80">';
		$EFCApprove = nice_date($EFCApprove[0]['EFCApprove_Date'], 'd/m/Y h:i'); echo '<br>'.$EFCApprove;
	}else{
		echo '........................................';
		echo '<br>';
	}echo '<br>Executive Financial Controller';
	echo'</div></div>
	</div>';
	}




}

/* End of file Show_data.php */
/* Location: ./application/controllers/Show_data.php */
?>