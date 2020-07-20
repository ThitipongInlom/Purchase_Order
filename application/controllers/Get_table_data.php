<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_table_data extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->helper('date');
        $this->load->model('Get_table_data_model');
    }
    
    public function Show_Table_all()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
 
        $results = $this->Get_table_data_model->find_with_page_show_all_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Show_Table_show_approve()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
 
        $results = $this->Get_table_data_model->find_with_page_show_approve_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Show_Table_show_accounting()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
        $param['typeselect'] = $this->input->post('typeselect');
 
        $results = $this->Get_table_data_model->find_with_page_show_accounting_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Show_Table_show_acapprove()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
 
        $results = $this->Get_table_data_model->find_with_page_show_acapprove_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Show_Table_show_completed()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
 
        $results = $this->Get_table_data_model->find_with_page_show_completed_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Show_Table_show_reject()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
 
        $results = $this->Get_table_data_model->find_with_page_show_reject_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Show_Table_show_fax()
    {
        $order_index = $this->input->post('order[0][column]');
        $param['page_size'] = $this->input->post('length');
        $param['start'] = $this->input->post('start');
        $param['draw'] = $this->input->post('draw');
        $param['keyword'] = trim($this->input->post('search[value]'));
        $param['column'] = $this->input->post("columns[{$order_index}][data]");
        $param['dir'] = $this->input->post('order[0][dir]');
 
        $results = $this->Get_table_data_model->find_with_page_show_fax_table($param);
 
        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];
        $data['MYSQL'] = $results['MYSQL'];
 
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}