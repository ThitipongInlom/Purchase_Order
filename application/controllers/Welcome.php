<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Welcome_model');
		$this->load->database();
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

	public function Clear_Pr()
	{
		$PR  = $this->load->database('default', TRUE);
		// Delete PR Is Null
		$PR->where('warecode',null, false);
		$PR->where('div',null, false);
		$PR->delete('PR');
		$PR->where('Vendor',null, false);
		$PR->where('HdApprove',null, false);
		$PR->delete('PR_ref');
		echo 'Delete OK For Auto';
	}

	public function Coss_PR()
	{
		$beta = $this->load->database('Bo1', TRUE);
		$PR   = $this->load->database('default', TRUE);
		$PR->select('prno,refno');
		$PR->order_by('prno', 'DESC');
		$query = $PR->get('PR', 8000);
		$resultPR = $query->result();
		foreach ($resultPR as $key => $row) {
			$date_update = $this->dateformat2();
			$prno = $row->prno;
			$refno = $row->refno;
			$result_C = $this->Check_Have_Data($prno);
			if ($result_C == '') {
				$data = array(
				        'prno' => $prno,
				        'refno' => $refno,
				        'date_update' => $date_update
				);
				$PR->insert('Coss_PR', $data);
			}
			$beta->select('pono,refno');
			$query_bata = $beta->get_where('PXFB0010', array('refno' => $refno));
			$resultPO = $query_bata->result();
			foreach ($resultPO as $key => $PO) {
				$po = $PO->pono;
				$refnopo = $PO->refno;
				$PR->set('pono', $po);
				$PR->where('refno', $refnopo);
				$PR->update('Coss_PR');
			}
		}
		echo "OK";
	}

	public function Check_Have_Data($prno)
	{
		$PR = $this->load->database('default', TRUE);
		$query = $PR->get_where('Coss_PR', array('prno' => $prno));
		$result = $query->num_rows();
		return $result;
	}

	public function dateformat2() {
	    $output = date("d m Y h:i:s A");
	    $datearray = explode(" ", $output);
	    $customyear = $datearray[2]+543;
	    $output =  $customyear."".$datearray[1]."".$datearray[0];
	  return $output;
	}

}