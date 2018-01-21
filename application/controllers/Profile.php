<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Profile_model');
	}

	public function index()
	{
		$data['result'] = $this->Profile_model->get_datauser();
		$this->load->view('theme/head');
		$this->load->view('profile', $data);
		$this->load->view('theme/footer');
	}


}

/* End of file Proflie.php */
/* Location: ./application/controllers/Proflie.php */
?>