<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersetting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usersetting_model');
		$this->load->helper('date');
		$this->load->model('Switch_model');
	}

	public function Settinguser()
	{
		$set = $this->Switch_model->settinguser();
		if ($set == '0') {
		$data['user'] = $this->Usersetting_model->GetUserall();
		$this->load->view('theme/head');
		$this->load->view('usersetting', $data);
		$this->load->view('theme/footer');
		}else{
		$this->load->view('theme/head');
		$this->load->view('modifly');
		$this->load->view('theme/footer');	
		}
	}

	public function updatedata()
	{
		$primary = $this->input->post('primary');
		$editfname = $this->input->post('editfname');
		$editlname = $this->input->post('editlname');
		$edittype = $this->input->post('edittype');
		$editmail = $this->input->post('editmail');
		$editdep = $this->input->post('editdep');
		$editdiv = $this->input->post('editdiv'); 
		$this->Usersetting_model->updatedata($primary,$editfname,$editlname,$edittype,$editmail,$editdep,$editdiv);
	}

	public function uploadimghod()
	{
		$primary = $_POST['primary'];
		if (isset($_FILES['hodimg']['name'])) {
			$filename = $_FILES['hodimg']['name'];
			$file_ext = pathinfo($filename,PATHINFO_EXTENSION);
			$filesqlname = $primary.'.'.$file_ext;
			$config['upload_path'] = FCPATH.'assets/signature/';
			$config['allowed_types'] = '*';
			$config['max_size']     = '10240'; //10240 = 10 MB
			$config['file_name'] = $filesqlname;
			$this->load->library('upload', $config);
			$this->upload->do_upload('hodimg');
			$this->Usersetting_model->updatehodimg($primary,$filesqlname);
			echo 'YES';
		}else{
			echo 'NO';
		}
	}

	public function deleteimghod()
	{
		$primary = $_POST['primary'];
		$hoddelte = $this->Usersetting_model->deleteimghod($primary);
		$path = FCPATH.'assets/signature/'.$hoddelte;
		unlink($path); 
		$this->Usersetting_model->deleteupdate($primary);
		echo 'OK';
	}

	public function edituseradata()
	{
		$primary = $this->input->post('primary');
		$alldepname = $this->Usersetting_model->alldepname();
		$alldivname = $this->Usersetting_model->alldivname();
		$result = $this->Usersetting_model->Geteditdata($primary);
		$depcode = $result[0]->dep;
		$divcode = $result[0]->div;
		echo '<table class="table">';
		echo '<tr align="center">
				<td><b>First Name:</b> </td>
				<td><input type="text" class="form-control" id="editfname" value="'.$result[0]->fname.'"></td></tr>';
		echo '<tr align="center">
			  <td><b>Last Name:</b> </td>
			  <td><input type="text" class="form-control" id="editlname" value="'.$result[0]->lname.'"></td></tr>';
		echo '<tr align="center">
			  <td><b>Username:</b> </td>
			  <td><input type="text" class="form-control"  value="'.$result[0]->username.'" disabled></td></tr>';
		echo '<tr align="center">
			  <td><b>Password:</b> </td>
			  <td><input type="text" class="form-control"  value="'.$result[0]->password.'" disabled></td></tr>';			
		echo '<tr align="center">
		      <td><b>User Type:</b> </td>
		      <td>
		      <select class="form-control" id="edittype" >
			  <option value="user"'; if ($result[0]->type == 'user') {
			  	echo 'selected';
			  }  echo'>user</option>
			  <option value="HOD"'; if ($result[0]->type == 'hod') {
			  	echo 'selected';
			  }  echo'>HOD</option>
			  <option value="HOD0"'; if ($result[0]->type == 'hod0') {
			  	echo 'selected';
			  } echo'>HOD0</option>
			  <option value="approval"'; if ($result[0]->type == 'approval') {
			  	echo 'selected';
			  } echo'>approval</option>
			  <option value="accounting0"'; if ($result[0]->type == 'accounting0') {
			  	echo 'selected';
			  } echo'>accounting0</option>
			  <option value="accounting"'; if ($result[0]->type == 'accounting') {
			  	echo 'selected';
			  } echo'>accounting</option>
			  <option value="admin"'; if ($result[0]->type == 'admin') {
			  	echo 'selected';
			  } echo'>admin</option>
			  </select>
		      </td></tr>';	
		echo '<tr align="center">
				<td><b>Email:</b> </td>
				<td><input type="text" class="form-control" id="editmail" value="'.$result[0]->email.'"></td></tr>';     
		echo '<tr align="center">
			  <td><b>Department:</b> </td>
			  <td>
			  <select class="form-control" id="editdep">';
			  foreach ($alldepname as  $rowdep) {
			  	echo '<option  value="'.$rowdep['depcode'].'"'; if ($rowdep['depcode'] == $depcode) {
			  		echo 'selected';
			  	} echo' >'.$rowdep['depname1'].'</option>';
			  }
			  echo '</select></td></tr>';	
		echo '<tr align="center">
			  <td><b>Division:</b> </td>
			  <td>
			  <select class="form-control" id="editdiv">';
			  foreach ($alldivname as  $rowdiv) {
			  	echo '<option  value="'.$rowdiv['divcode'].'"'; if ($rowdiv['divcode'] == $divcode) {
			  		echo 'selected';
			  	} echo' >'.$rowdiv['divname1'].'</option>';
			  }
			  echo '</select></td></tr>';  	  	  		  		
		echo '</table>';
		echo '<hr>';
		echo '<div align="center">';
		echo '<button class="btn btn-success" primary="'.$result[0]->username.'" onclick="updatedata(this)">อัพเดต</button>';
		echo '  ';
		echo '<button class="btn btn-danger" id="closemodal" data-dismiss="modal">ปิด</button>';
		echo '</div>';
	}

}

/* End of file Usersetting.php */
/* Location: ./application/controllers/Usersetting.php */
?>