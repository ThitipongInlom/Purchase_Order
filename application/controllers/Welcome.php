<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Welcome_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$this->Welcome_model->login_model();
	}

	public function logout()
	{
		$this->session->sess_destroy();
	}

}	
