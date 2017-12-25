<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function login_model()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->db->get_where('user', array('user_username' => $username,'user_password' => $password));
		$result = $query->num_rows();
		echo $result;
	}

}

/* End of file Welcome_model.php */
/* Location: ./application/models/Welcome_model.php */
?>