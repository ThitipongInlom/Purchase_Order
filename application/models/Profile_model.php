<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_datauser()
	{
		$query = $this->db->get_where('PR_Users', array('username' => $this->session->username));
		$result = $query->result();
		return $result;
	}

	public function set_lang($language)
	{
		$user = $this->session->username;
		$this->db->where('username', $user);
		$data = array(
        'lang' => $language
		);
		$this->db->update('PR_Users', $data);
		return;
	}

}

/* End of file Proflie_model.php */
/* Location: ./application/models/Proflie_model.php */
?>