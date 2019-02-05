<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->library("pagination");
	}

	public function UserRoute()
	{
		$right_ac = $this->session->right_ac;
        $right_gm = $this->session->right_gm;
	    $right_efc = $this->session->right_efc;
		if($right_gm=='Y' OR $right_efc=='Y'){
			redirect('index.php/Show_data/show_approve');
		}elseif($right_ac=='Y'){
			redirect('index.php/Show_data/Show_accounting?i=All');
		}else{
			redirect('index.php/Dashboard/Dashboard');
		}
	}

	public function Dashboard()
	{
		$data['alltoday'] = $this->Dashboard_model->query_today();
		$data['hodtoday'] = $this->Dashboard_model->query_hod_apv_today();
		$data['actoday']  = $this->Dashboard_model->query_ac_apv_today();
		$data['gmtoday']  = $this->Dashboard_model->query_gm_apv_today();
		$data['efctoday']  = $this->Dashboard_model->query_efc_apv_today();
       
		$data['actodayno']  = $this->Dashboard_model->query_ac_apv_todayno();
		$data['gmtodayno']  = $this->Dashboard_model->query_gm_apv_todayno();	
		$data['efctodayno']  = $this->Dashboard_model->query_efc_apv_todayno();

		$data['allmouth'] = $this->Dashboard_model->query_mouth();
		$data['hodmouth'] = $this->Dashboard_model->query_hod_apv_mouth();
		$data['acmouth']  = $this->Dashboard_model->query_ac_apv_mouth();
		$data['gmmouth']  = $this->Dashboard_model->query_gm_apv_mouth();
		$data['efcmouth']  = $this->Dashboard_model->query_efc_apv_mouth();

		$data['acmouthno']  = $this->Dashboard_model->query_ac_apv_mouthno();
		$data['gmmouthno']  = $this->Dashboard_model->query_gm_apv_mouthno();
		$data['efcmouthno']  = $this->Dashboard_model->query_efc_apv_mouthno();

		$data['acnoapp']  = $this->Dashboard_model->query_ac_apv_noapp();
		$data['gmnoapp']  = $this->Dashboard_model->query_gm_apv_noapp();
		$data['efcnoapp']  = $this->Dashboard_model->query_efc_apv_noapp();
		$this->load->view('theme/head');
		$this->load->view('dashboard',$data);
		$this->load->view('theme/footer');		
	}

	public function SaveAddWarehouse()
	{
		$Check_code = $this->Dashboard_model->CheckCode_Addwarehouse();
		print_r($Check_code);
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