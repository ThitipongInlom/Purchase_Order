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
		$data['prdate'] = date('Ymd');
		//$this->Addpr_model->newpradd($data['newpr'],$data['newref'],$data['prdate']);
		$this->load->view('theme/head');
		$this->load->view('addpr',$data);
		$this->load->view('theme/footer');
	}
	public function viewhistory($id)
	{
		$data['titlehistory'] = $this->Addpr_model->titleviewhistory($id);
		$data['datahistory']  = $this->Addpr_model->dataviewhistory($id);
		$this->load->view('viewhistory', $data);
	}
	public function listitem()
	{
		$beta = $this->load->database('bo', TRUE);
		echo '
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
				<div align="center">
				<div class="input-group">
                <input type="text" class="form-control" id="inputgolist" placeholder="ค้นหา">
                   	<span class="input-group-btn">
                     <button type="button" class="btn btn-primary" onclick="golist();">ค้นหา
                     <i class="fa fa-refresh fa-spin" id="loginicon" style="padding-right: 2px;"></i></button>
                    </span>
              </div>
				</div>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-12">
			<div id="tablelist"></div>
			</div>
		</div>	
		';
	}
	public function golist()
	{
		$result = $this->Addpr_model->golistmodel();
		echo '
		<br>
		<table class="table table-bordered">
		<tr align="center">
			<td><b>Code</b></td>
			<td><b>History</b></td>
			<td><b>Description</b></td>
			<td><b>Description2</b></td>
			<td><b>Unit</b></td>		
		</tr>';
		foreach ($result as $row)
		{
		$stcode = $row['stcode'];	
		echo '
		<tr>
			<td align="center"><span class="badge bg-red" onclick="setproductcode(this);" value="'.$row['stcode'].'">'.$row['stcode'].'</span></td>
			<td align="center">';
			$cholddata = $this->Addpr_model->checkoldata($stcode);
			if ($cholddata =='0') {
				echo '<i class="fa fa-fw fa-2x fa-close" style="color:red;"></i>';
			}else {
				echo '<i class="fa fa-fw fa-2x fa-eye" sendid="'.$row['stcode'].'" onclick="windowsdata(this);" style="color:blue;"></i>';
			}
			echo'</td>
			<td>'.$row['stname1'].'</td>
			<td>'.$row['stname2'].'</td>
			<td>'.$row['mdesc1'].'</td>		
		</tr>';
		}
		echo'</table>
		';
	}
	public function checkitemid()
	{
		$num = $this->Addpr_model->checkitemid();
		echo $num;
	}
	public function setproductcode()
	{
		$result = $this->Addpr_model->setproductcode();
		echo json_encode($result);
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
	public function getdivision()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$barang = $beta->select("*")
						->from("ZZFC0010")
						->get();
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['divcode'];
				$row_array['text'] = "<strong>[".$row['divcode'] ."]</strong> $row[divname1]";
				array_push($return_arr,$row_array);
			}
			}
						echo json_encode(array("results" => $return_arr ));
	}
	public function getdepartment()
	{
		$beta = $this->load->database('bo', TRUE);
		$return_arr = array();
		$row_array = array();
		$barang = $beta->select("*")
						->from("ZZFC0020")
						->get();
		if($barang->num_rows() > 0)
		{
			foreach($barang->result_array() as $row)
			{
				$row_array['id'] = $row['depcode'];
				$row_array['text'] = "<strong>[".$row['depcode'] ."]</strong> $row[depname1]";
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
	public function setdivision()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("ZZFC0010")
						->where("divcode",$id)
						->get()
						->row();
		echo json_encode($info);
	}
	public function setdepartment()
	{
		$beta = $this->load->database('bo', TRUE);
		$id = $this->input->get('id');
		$info = $beta->select("*")
						->from("ZZFC0020")
						->where("depcode",$id)
						->get()
						->row();
		echo json_encode($info);
	}

	public function doupload()
	{
		if (isset($_POST)) {
			# code...
		}
		if (isset($_FILES['file']['name'])) {
			$nowsha = sha1(now());
			$filename = $nowsha.$_FILES['file']['name'];
			$config['upload_path'] = FCPATH.'assets/icon/';
			$config['allowed_types'] = '*';
			$config['max_size']     = '10240'; //10240 = 10 MB
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file'))
			{
                echo 'อัพโหลด ไฟล์ไม่สำเร็จ ขนาดเกิน 10MB';
			}
			else
			{
				echo 'OK';
			}
		}	


	}
}
/* End of file Add_Pr.php */
/* Location: ./application/controllers/Add_Pr.php */
?>