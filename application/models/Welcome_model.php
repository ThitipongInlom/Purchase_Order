<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function login_model()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$query = $this->db->query("select * from PR_Users where username='$username' and password='$password'")->num_rows();
		if ($query =='1') {
			$query2 = $this->db->query("select * from PR_Users where username='$username'")->result_array();
			$newdata = array(
			'username'  => $query2[0]['username'],
			'fname'     => $query2[0]['fname'],
			'lname'     => $query2[0]['lname'],
			'email'     => $query2[0]['email'],
			'type'      => $query2[0]['type'],
			'dep'       => $query2[0]['dep'],
			'div'       => $query2[0]['div'],
			'lang'      => $query2[0]['lang']
			);
			$this->session->set_userdata($newdata);
		}
		echo $query;
	}

}

/* End of file Welcome_model.php */
/* Location: ./application/models/Welcome_model.php */
?>