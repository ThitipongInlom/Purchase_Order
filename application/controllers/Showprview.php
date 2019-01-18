<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Showprview extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Get_data_model');
	}

	public function showwindowsmodelprview($prno)
	{
		$data['data_head'] = $this->Get_data_model->modal_head_open($prno);
		$data['data_body'] = $this->Get_data_model->modal_body_open($prno);
		$this->load->view('showwindowsmodelprview',$data);
	}

	public function API_Print($prno)
	{
		$data['data_head'] = $this->Get_data_model->modal_head_open($prno);
		$data['data_body'] = $this->Get_data_model->modal_body_open($prno);
		$this->load->view('API_Print',$data);
	}

	public function API_View($prno)
	{
		$data['data_head'] = $this->Get_data_model->modal_head_open($prno);
		$data['data_body'] = $this->Get_data_model->modal_body_open($prno);
		$this->load->view('API_View',$data);
	}

	public function API_email()
	{
		//SMTP Gmail
		$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'ingnice007@gmail.com',
		    'smtp_pass' => 'rgejjocunqkursdm',
		    'mailtype'  => 'html',
		    'charset'   => 'iso-8859-1',
		    'wordwrap' => TRUE
		);

		$this->load->library('email' ,$config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h1>Sending email via SMTP server</h1>';
		$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

		$this->email->to('ingnice007@gmail.com');
		$this->email->from('ingnice007@gmail.com','MyWebsite');
		$this->email->subject('How to send email via SMTP server in CodeIgniter');
		$this->email->message($htmlContent);

		//Send email
		if ($this->email->send()) {
			echo 'OK';
		}else{
			show_error($this->email->print_debugger());
		}
	}

}

/* End of file Showprview.php */
/* Location: ./application/controllers/Showprview.php */
?>
