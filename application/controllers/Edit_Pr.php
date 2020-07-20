<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_Pr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Addpr_model');
		$this->load->model('Editpr_model');
		$this->load->model('Get_data_model');
	}

	public function edit($i)
	{
		$data['getdata'] = $this->Editpr_model->getdatapredit($i);
		$this->load->view('theme/head');
		$this->load->view('editpr',$data);
		$this->load->view('theme/footer');
	}

	public function getimgdataedit()
	{
		$result = $this->Editpr_model->getimgdataedit();
		$i = 1;
		foreach ($result as $key => $row) {
		$date_upload = $row['date_upload'];
		$Data[] = "<div class='btn-group' role='group' aria-label='Button_Img_group'><button class='btn btn-sm btn-primary' imgdata=". $row['part_img'] ." onclick='openwindowimg(this)'>ดูรูปที่ ". $i ."</button><button type='button' class='btn btn-sm btn-danger' imgdatetime='$date_upload' imgdata=". $row['part_img'] ." onclick='Dalete_loadimg(this)'><i class='fa fa-fw fa-close'></i></button></div>   |  ";
		$i++;
		}
		if(empty($Data)){
			$Data[] = '';
		}
		// Encode To Json
		$Jsonencode = json_encode(array('data' => $Data,'result' => $result));
		print_r($Jsonencode);
	}

	public function UploadImg()
	{
		$this->load->database();
		$prno = $_POST['prno'];
		$Count_file = count($_FILES);
		// Uploadimg_1
		if (isset($_FILES['uploadimg_1']['name'])) {
			$number = '1';
			$this->Set_Doupload_img($_FILES,$prno,$number);
		}
		// End_Uploadimg_1
	}

	public function Set_Doupload_img($File_Data,$prno,$number)
	{
		$this->load->database();
		$nowsha = sha1(now().$File_Data["uploadimg_$number"]['name']);
		$filename = $nowsha.$File_Data["uploadimg_$number"]['name'];
		$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
		$filesqlname = $nowsha.'.'.$file_ext;
		$config1['upload_path'] = FCPATH.'assets/photo_storage/';
		$config1['allowed_types'] = '*';
		$config1['max_size']     = '10240'; //10240 = 10 MB
		$config1['file_name'] = $filesqlname;
		$this->load->library('upload', $config1);
			if ( ! $this->upload->do_upload("uploadimg_$number"))
			{
				echo 'NOT - ';
			}else{
				echo 'OK - ';
				$data = array(
					'prno' => $_POST['prno'],
					'part_img' => $filesqlname,
					'date_upload' => date('Y-m-d H:i:s')
				);
				$this->db->insert('PR_img', $data);
			}
		print_r($File_Data);
		return;
	}

	public function Dalete_loadimg()
	{
		$this->load->database();
		$img = $_POST['imgdata'];
		$imgdatetime = $_POST['imgdatetime'];
		$path = FCPATH.'assets/photo_storage/'.$img;
		unlink($path);
		$this->db->delete('PR_img', array('part_img' => $img,'date_upload' => $imgdatetime));
	}

	public function receive($i)
	{
		$data['getdata'] = $this->Editpr_model->getdatapredit($i);
		$this->load->view('theme/head');
		$this->load->view('receive',$data);
		$this->load->view('theme/footer');
	}

	public function editprice($i)
	{
		$data['getdata'] = $this->Editpr_model->getdatapredit($i);
		$this->load->view('theme/head');
		$this->load->view('editprice',$data);
		$this->load->view('theme/footer');
	}	

	public function editupper()
	{
		$prno = $_POST['prno'];
		$div = $_POST['div'];
		$remark = $_POST['remark'];
		$warecode = $_POST['warecode'];
		$dc = $_POST['dc'];
		$dc_a = $_POST['dc_a'];
		$vat = $_POST['vat'];
		$vendor = $_POST['vendor'];
		$vendorname = $_POST['vendorname'];
		$depname = $_POST['depname'];
		$depcode = $_POST['depcode'];
		$gmremark = $_POST['gmremark'];
		$efcremark = $_POST['efcremark'];
		$express = $_POST['express'];
		$date = date('YmdHi');
		$typuser = $this->session->type;
		$username = $this->session->username;
		$this->Editpr_model->editupper($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark,$express);
	}

	public function receiveupper()
	{
		$prno = $_POST['prno'];
		$div = $_POST['div'];
		$remark = $_POST['remark'];
		$warecode = $_POST['warecode'];
		$dc = $_POST['dc'];
		$dc_a = $_POST['dc_a'];
		$vat = $_POST['vat'];
		$vendor = $_POST['vendor'];
		$vendorname = $_POST['vendorname'];
		$depname = $_POST['depname'];
		$depcode = $_POST['depcode'];
		$gmremark = $_POST['gmremark'];
		$efcremark = $_POST['efcremark'];
		$date = date('YmdHi');
		$typuser = $this->session->type;
		$username = $this->session->username;
		$this->Editpr_model->receiveupper($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark);
	}

	public function editupper2()
	{
		$prno = $_POST['prno'];
		$div = $_POST['div'];
		$remark = $_POST['remark'];
		$warecode = $_POST['warecode'];
		$dc = $_POST['dc'];
		$dc_a = $_POST['dc_a'];
		$vat = $_POST['vat'];
		$vendor = $_POST['vendor'];
		$vendorname = $_POST['vendorname'];
		$depname = $_POST['depname'];
		$depcode = $_POST['depcode'];
		$gmremark = $_POST['gmremark'];
		$efcremark = $_POST['efcremark'];
		$express = $_POST['express'];
		$date = date('YmdHi');
		$typuser = $this->session->type;
		$username = $this->session->username;
		$this->Editpr_model->editupper2($prno,$div,$remark,$warecode,$dc,$dc_a,$vat,$vendor,$vendorname,$depname,$depcode,$typuser,$username,$date,$gmremark,$efcremark,$express);
	}


}

/* End of file Edit_Pr.php */
/* Location: ./application/controllers/Edit_Pr.php */ ?>
