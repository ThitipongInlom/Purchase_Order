<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	public function UserRoute()
	{
		$user = $this->session->username;
		if($user=='Somkhit' OR $user=='Nalinee'){
			redirect('index.php/Show_data/show_approve');
		}elseif($user=='Somkid'){
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


		
}
/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
?>