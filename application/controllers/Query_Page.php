<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query_Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('Query_Page_model');
	}

	public function namewarecode($warecode)
	{
		$CI =& get_instance();
		$beta = $CI->load->database('bo', TRUE);
		if ($warecode != '') {
		$query = $beta->get_where('STFC0070', array('warecode' => $warecode));
		$result = $query->result_array();
		$waredesc1 = $result[0]['waredesc1'];
		}else{
		$waredesc1 = '';	
		}
		return $waredesc1;
	}

	public function Show_reject_Ajax()
	{
		$Datalist = $this->Query_Page_model->get_datatables_reject();
		$data = array();
		foreach ($Datalist as $key => $item) {

			$reprno = "<div align='center'>$item->prno</div>";
			$revendor = "<div align='left'>$item->Vendor_name - <b>$item->Vendor</b></div>";
			$redate = "<div align='center'>".nice_date($item->prdate, 'd-m-Y')."";
			$rerefno = "<div align='center'>$item->refno</div>";
			$redepartmentandwarehouse = "<div align='left'>
			[D] <b>$item->dep</b> => $item->Dep_name <br>
			[W] <b>$item->warecode</b> => ".$this->namewarecode($item->warecode)."</div>";
			// Check Hod 
			if ($item->HdApprove == 'Y') {
				$rehodapprove = '<div align="center"><i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i></div>';
			}elseif ($item->HdApprove == 'N') {
				$rehodapprove = '<div align="center"><i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i></div>';
			}else{
				$rehodapprove = '';
			}
			// Check PR
			if ($item->PRApprove == 'Y') {
				$reprapprove = '<div align="center"><i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i></div>';
			}elseif ($item->PRApprove == 'N') {
				$reprapprove = '<div align="center"><i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i></div>';
			}else{
				$reprapprove = '';
			}
			// Check GM
			if ($item->GMApprove == 'Y') {
				$regmapprove = '<div align="center"><i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i></div>';
			}elseif ($item->GMApprove == 'N') {
				$regmapprove = '<div align="center"><i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i></div>';
			}else{
				$regmapprove = '';
			}
			// Check EFC
			if ($item->EFCApprove == 'Y') {
				$reefcapprove = '<div align="center"><i class="fa fa-check fa-2x" aria-hidden="true" style="color: #00a65a;"></i></div>';
			}elseif ($item->EFCApprove == 'N') {
				$reefcapprove = '<div align="center"><i class="fa fa-times fa-2x" aria-hidden="true" style="color: #dd4b39;"></i></div>';
			}else{
				$reefcapprove = '';
			}	

			$reacton = "";		

            $row = array();
            $row[] = $reprno;
            $row[] = $revendor;
            $row[] = $redate;
            $row[] = $rerefno;
            $row[] = $redepartmentandwarehouse;
            $row[] = $rehodapprove;
            $row[] = $reprapprove;
            $row[] = $regmapprove;
            $row[] = $reefcapprove;
            $row[] = $reacton;
 
            $data[] = $row;
		}
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Query_Page_model->count_all_reject(),
                        "recordsFiltered" => $this->Query_Page_model->count_filtered_reject(),
                        "data" => $data,
                );
        echo json_encode($output);		
	}	

}

/* End of file Query_Page.php */
/* Location: ./application/controllers/Query_Page.php */
?>