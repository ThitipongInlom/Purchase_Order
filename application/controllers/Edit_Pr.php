<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_Pr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Addpr_model');
		$this->load->model('Editpr_model');
		$this->load->model('Get_data_model');
	}

	public function edit($i)
	{
		$data['getdata'] = $this->Editpr_model->getdatapredit($i);
		$this->load->view('theme/head');
		$this->load->view('editpr',$data);
		$this->load->view('theme/footer');
	}

	public function receive($i)
	{
		$data['getdata'] = $this->Editpr_model->getdatapredit($i);
		$this->load->view('theme/head');
		$this->load->view('receive',$data);
		$this->load->view('theme/footer');
	}

	public function editprice($i)
	{
		$data['getdata'] = $this->Editpr_model->getdatapredit($i);
		$this->load->view('theme/head');
		$this->load->view('editprice',$data);
		$this->load->view('theme/footer');
	}	

	public function editupper()
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
		$gmremark = $_POST['gmremark'];
		$efcremark = $_POST['efcremark'];
		$express = $_POST['express'];
		$date = date('YmdHi');
		$typuser = $this->session->type;
		$username = $this->session->username;
		$this->Editpr_model->editupper($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark,$express);
	}

	public function receiveupper()
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
		$gmremark = $_POST['gmremark'];
		$efcremark = $_POST['efcremark'];
		$date = date('YmdHi');
		$typuser = $this->session->type;
		$username = $this->session->username;
		$this->Editpr_model->receiveupper($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark);
	}

	public function editupper2()
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
		$gmremark = $_POST['gmremark'];
		$efcremark = $_POST['efcremark'];
		$express = $_POST['express'];
		$date = date('YmdHi');
		$typuser = $this->session->type;
		$username = $this->session->username;
		$this->Editpr_model->editupper2($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark,$express);
	}


}

/* End of file Edit_Pr.php */
/* Location: ./application/controllers/Edit_Pr.php */ ?>
