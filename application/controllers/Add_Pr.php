<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_Pr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Addpr_model');
	}

	public function index()
	{
		$data['newpr'] = $this->Addpr_model->getnewpr();
		$data['newref'] = $this->Addpr_model->getnewref();
		$data['prdate'] = date('d/m/Y');
		$this->load->view('theme/head');
		$this->load->view('addpr',$data);
		$this->load->view('theme/footer');
	}

	public function getvender()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$text = $this->input->get('text');
		$barang = $beta->select("*")
						->from("APFA0010")
						->like("vencode", $text)
						->or_like("venname1",$text)
						->get();
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['vencode'];
				$row_array['text'] = "<strong>[".$row['vencode'] ."]</strong> $row[venname1]";
				array_push($return_arr,$row_array);
			}
		}	
		echo json_encode(array("results" => $return_arr ));			
	}

	public function getwarehouse()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$barang = $beta->select("*")
						->from("STFC0070")
						->get();
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['warecode'];
				$row_array['text'] = "<strong>[".$row['warecode'] ."]</strong> $row[waredesc1]";
				array_push($return_arr,$row_array);
			}
		}	
		echo json_encode(array("results" => $return_arr ));				
	}

	public function setvendor()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("APFA0010")
						->where("vencode",$id)
						->get()
						->row();
		echo json_encode($info);
	}

	public function setwarehouse()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("STFC0070")
						->where("warecode",$id)
						->get()
						->row();
		echo json_encode($info);
	}

}

/* End of file Add_Pr.php */
/* Location: ./application/controllers/Add_Pr.php */
?>