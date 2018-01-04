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
		$this->load->view('theme/head');
		$this->load->view('show_approve');
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
		$Newdate = nice_date($data_head[0]['prdate'], 'd-m-Y');
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
	<div class="col-md-12 col-xs-12">
	<p class="pull-right"><b>Purchase Requistion</b></p>
	<p class="pull-left"><b>Remark: </b> '.$data_head[0]['remark'].'</p>
	</div>
	<div class="col-md-12 col-xs-12" align="center">
	<table boder="5" class="table table-bordered table-responsive table-striped">
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
	<td>กล่อง</td>
	<td>'.$row['prqty'].'</td>
	<td>820009</td>
	<td>11</td>
	<td>10/11/2014</td>
	<td>26/09/2014</td>
	<td>1,480.00</td>
	<td>1,480.00</td>
	<td>1,480.00</td>
	</tr>';
	}
echo'
	<tr class="info">
	<td colspan="8" style="text-align: right;"><b>Total</b></td>
	<td></td>
	</tr>
	</table>
	</div>

	</div>';
	}



}

/* End of file Show_data.php */
/* Location: ./application/controllers/Show_data.php */
?>