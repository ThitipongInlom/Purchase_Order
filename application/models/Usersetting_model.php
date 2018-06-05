<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersetting_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}	

	public function GetUserall()
	{
		$query = $this->db->get('PR_Users');
		$result = $query->result_object();
		return $result;
	}

	public function Geteditdata($primary)
	{
		$query = $this->db->get_where('PR_Users', array('username' => $primary));
		$result = $query->result();
		return $result;
	}

	public function alldepname()
	{
		$CI =& get_instance();
		$beta = $CI->load->database('bo', TRUE);
		$query = $beta->get('ZZFC0020');
		$result = $query->result_array();
		return $result;
	}

	public function alldivname()
	{
		$CI =& get_instance();
		$beta = $CI->load->database('bo', TRUE);
		$query = $beta->get('ZZFC0010');
		$result = $query->result_array();
		return $result;
	}

	public function updatedata($primary,$editfname,$editlname,$edittype,$editmail,$editdep,$editdiv)
	{
		$data = array(
        'fname' => $editfname,
        'lname' => $editlname,
        'email' => $editmail,
        'type' => $edittype,
        'dep' => $editdep,
        'div' => $editdiv);
		$this->db->where('username', $primary);
		$this->db->update('PR_Users', $data);
		$dataok = array('Success' => 'OK');
		echo json_encode($dataok);
	}



}

/* End of file Usersetting_model.php */
/* Location: ./application/models/Usersetting_model.php */
?>