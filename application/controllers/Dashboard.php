<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->model('Get_data_model');
		$this->load->library("pagination");
	}

	public function UserRoute()
	{
		$type = $this->session->type;
		$right_ac = $this->session->right_ac;
        $right_gm = $this->session->right_gm;
	    $right_efc = $this->session->right_efc;
		if($right_gm=='Y' OR $right_efc=='Y'){
			redirect('index.php/Show_data/show_approve');
		}elseif($right_ac=='Y' and $type=='user'){
			redirect('index.php/Show_data/show_all');
		}elseif($right_ac=='Y'){
			redirect('index.php/Show_data/Show_accounting?i=All');
		}else{
			redirect('index.php/Dashboard/Dashboard');
		}
	}

	public function Dashboard()
	{
		$data['acnoapp']  = $this->Dashboard_model->query_ac_apv_noapp();
		$data['gmnoapp']  = $this->Dashboard_model->query_gm_apv_noapp();
		$data['efcnoapp']  = $this->Dashboard_model->query_efc_apv_noapp();

		$data['table_call_back'] = $this->Dashboard_model->Table_call_back();

		$this->Get_data_model->delte_pr_is_null();

		$this->load->view('theme/head');
		$this->load->view('dashboard',$data);
		$this->load->view('theme/footer');		
	}

	public function SaveAddvendor()
	{
		$Check_code = $this->Dashboard_model->CheckCode_SaveAddvendor();
		$CheckNum_rows = $this->Dashboard_model->CheckNum_rows_vendor();
		if ($Check_code == '0') {
			$New_Code = '0001';
		}else{
			$New_Code = $this->Set_code_vendor($CheckNum_rows);
		}
		$this->Dashboard_model->Insert_vendor($New_Code);
		$Status = "Insert";
		// Encode To Json
		$Jsonencode = json_encode(array('Numm_rows' => $Check_code,'Status' => $Status));
		print_r($Jsonencode);
	}

	public function EditGetvendor()
	{
		$Data = $this->Dashboard_model->Edit_Getvendor();
		// Encode To Json
		$Jsonencode = json_encode($Data);
		print_r($Jsonencode);
	}

	public function EditGetwarehouse()
	{
		$Data = $this->Dashboard_model->Edit_warehouse();
		// Encode To Json
		$Jsonencode = json_encode($Data);
		print_r($Jsonencode);
	}

	public function SaveEditwarehouse()
	{
		$Check_code = $this->Dashboard_model->CheckCode_EditAddwarehouse();
		if ($Check_code == '0') {
			$this->Dashboard_model->Update_warehouse();
			$Status = "Update";
		}else{
			$Status = "Error";
		}
		// Encode To Json
		$Jsonencode = json_encode(array('Numm_rows' => $Check_code,'Status' => $Status));
		print_r($Jsonencode);
	}

	public function SaveEditvendor()
	{
		$Check_code = $this->Dashboard_model->CheckCode_EditAddvendor();
		if ($Check_code == '0') {
			$this->Dashboard_model->Update_vendor();
			$Status = "Update";
		}else{

			$Status = "Error";
		}
		// Encode To Json
		$Jsonencode = json_encode(array('Numm_rows' => $Check_code,'Status' => $Status));
		print_r($Jsonencode);
	}

	public function Savewarehouse()
	{
		$CheckNum_rows = $this->Dashboard_model->CheckNum_rows_warehouse();
		if ($CheckNum_rows == '0') {
			$New_Code = 'C01';
		}else{
			$New_Code = $this->Set_code_warehouse($CheckNum_rows);
		}
		$Check_Name = $this->Dashboard_model->Check_Name_warehouse();
		if ($Check_Name >= '1') {
			echo 'Error';
		}else{
			$this->Dashboard_model->Insert_warehouse($New_Code);
			echo 'Insert';
		}
	}

	public function Set_code_warehouse($num_rows)
	{
		$Code_old = $num_rows;
		$m_code = substr($Code_old,0)+1;
		if (strlen($m_code)<2) {
			$m_code ="C0".$m_code;
		}elseif(strlen($m_code)<3) {
			$m_code ="C".$m_code;
		}
		return $m_code;
	}

	public function Set_code_vendor($num_rows)
	{
		$Code_old = $num_rows;
		$m_code = substr($Code_old,0)+1;
		if (strlen($m_code)<2) {
			$m_code ="000".$m_code;
		}elseif(strlen($m_code)<3) {
			$m_code ="00".$m_code;
		}elseif(strlen($m_code)<4) {
			$m_code = "0".$m_code;
		}elseif(strlen($m_code)<5) {
			$m_code = $m_code;
		}
		return $m_code;
	}

	public function Deletevendor()
	{
		$this->Dashboard_model->Delete_Vendor();
		echo 'Delete';
	}

	public function Deleteproduct()
	{
		$this->Dashboard_model->Delete_product();
		echo 'Delete';
	}

	public function Deletewarehouse()
	{
		$this->Dashboard_model->Deletewarehouse();
		echo 'Delete';
	}

	public function product_table()
	{
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
        $param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
 
        $results = $this->Dashboard_model->find_with_page_product($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function vendor_table()
	{
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
        $param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
 
        $results = $this->Dashboard_model->find_with_page_vendor($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function warehouse_table()
	{
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
        $param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');
 
        $results = $this->Dashboard_model->find_with_page_warehouse($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function Getunitproduct()
	{
		$this->Dashboard_model->Getunit_product();
	}

	public function SaveProduct()
	{
		/*
		$CheckNum_rows = $this->Dashboard_model->CheckNum_rows_product();
		if ($CheckNum_rows == '0') {
			$New_Code = '000001';
		}else{
			$New_Code = $this->Set_code_product($CheckNum_rows);
		}
		*/

		$New_Code = $_POST['Code'];

		$Check_Code = $this->Dashboard_model->Check_num_product_id($New_Code);

		if ($Check_Code >= '1'){
			echo 'Error_Code';
		}else {
		$Check_Name = $this->Dashboard_model->Check_Name_product();
		if ($Check_Name >= '1') {
			echo 'Error_Name';
		}else{
			$this->Dashboard_model->Insert_product($New_Code);
			echo 'Insert';
		}
		}
	}

	public function Set_code_product($num_rows)
	{
		$Code_old = $num_rows;
		$m_code = substr($Code_old,0)+1;
		if (strlen($m_code)<2) {
			$m_code ="00000".$m_code;
		}elseif(strlen($m_code)<3) {
			$m_code ="0000".$m_code;
		}
		elseif(strlen($m_code)<4) {
			$m_code ="000".$m_code;
		}
		elseif(strlen($m_code)<5) {
			$m_code ="00".$m_code;
		}
		elseif(strlen($m_code)<6) {
			$m_code ="0".$m_code;
		}
		return $m_code;
	}

	public function EditGetproduct()
	{
		$Data = $this->Dashboard_model->Edit_Getproduct();
		// Encode To Json
		$Jsonencode = json_encode($Data);
		print_r($Jsonencode);
	}

	public function EditSaveProduct()
	{
		$CheckNum_rows = $this->Dashboard_model->CheckNum_rows_editproduct();
		if ($CheckNum_rows == '0') {
			$this->Dashboard_model->EditSaveProduct();
			$Status = 'Insert';
		}else{

			$Status = 'Error';
		}
		// Encode To Json
		$Jsonencode = json_encode(array('Num_rows' => $CheckNum_rows,'Status' => $Status));
		print_r($Jsonencode);
	}

	public function AddData()
	{
		$this->load->view('theme/head');
		$this->load->view('Adddata');
		$this->load->view('theme/footer');		
	}

	public function About()
	{
		$this->load->view('theme/head');
		$this->load->view('about');
		$this->load->view('theme/footer');	
	}


		
}
/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
?>