<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('departments/Departments_model', 'departments');
		$this->load->model('notifications/Notifications_model', 'notifications');
		
	}

	public function index()
	{
		$PageTitle = "All Departments";

		$data = array(
			"page_title" => $PageTitle
			);

		$this->load->view('users/list_users', $data);
	}

	public function add_department()
	{
		$PageTitle = "Add Department";

		$data = array(
			"page_title" => $PageTitle
			);

		$this->load->view('departments/add_department', $data);
	}

	public function do_add_department(){
		//echo "<pre>";print_r($this->input->post());exit;
		$data = array(
			'department_name' => $this->input->post('department-name')
			);

		$this->departments->insert_department($data);
	}
}
