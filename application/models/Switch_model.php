<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 0 ON  // 1 OFF
class Switch_model extends CI_Model {

	public function __construct()
	{
		$this->config->load('Switch');
	}

	public function Checkuser()
	{
		$username = 'nice';
		return $username;
	}

	public function SQLAddpr()
	{
		$Switch_config = $this->config->item('SQLAddpr');
		return $Switch_config;
	}

	public function Addprset()
	{
		$Switch_config = $this->config->item('Addprset');
		return $Switch_config;
	}

	public function show_all()
	{
		$Switch_config = $this->config->item('show_all');
		return $Switch_config;
	}

	public function show_allnew()
	{
		$Switch_config = $this->config->item('show_allnew');
		return $Switch_config;
	}

	public function show_approve()
	{
		$Switch_config = $this->config->item('show_approve');
		return $Switch_config;
	}

	public function show_completed()
	{
		$Switch_config = $this->config->item('show_completed');
		return $Switch_config;		
	}

	public function Show_accounting()
	{
		$Switch_config = $this->config->item('Show_accounting');
		return $Switch_config;
	}

	public function show_reject()
	{
		$Switch_config = $this->config->item('show_reject');
		return $Switch_config;	
	}

	public function settinguser()
	{
		$Switch_config = $this->config->item('settinguser');
		return $Switch_config;	
	}

}

/* End of file Switch.php */
/* Location: ./application/controllers/Switch.php */
?>