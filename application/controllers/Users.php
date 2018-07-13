<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();

		$this->load->model('wp_pal/Pal_model', 'wp_pal');
		$this->load->model('session/Session_model', 'sir_session');		
		$this->load->model('exceptions/AppExceptions_model', 'xxx');
		$this->load->model('job_titles/Jobtitles_model', 'job_titles');
		$this->load->model('departments/Departments_model', 'departments');
		$this->load->model('company/users/CompanyUsers_model', 'company_users');
		$this->load->model('notifications/Notifications_model', 'notifications');

		$this->load->helper('cookie');

	}

	public function index()
	{
		$this->load->view('home/index');
	}

	public function validate_login()
	{

		$form_variables = $this->input->post();
		echo "<pre>";print_r($form_variables);exit;
		$user_type = $form_variables['user_type'];
		$email_address = $form_variables['user_email'];
		$user_password = $form_variables['user_password'];

		switch( $user_type ){
			case 'immigration-user':
				$this->company_users->validate_immigration_user($email_address, $user_password);
			break;

			case 'company-user':
				$this->company_users->validate_company_user($email_address, $user_password);
			break;			
		}
	}

	public function add_user()
	{
		//manage session
		//$this->wp_pal->manage_session();

		$PageTitle = "Add User";
		$genders = $this->wp_pal->get_genders();
		$departments = $this->departments->get_all_departments();
		$job_titles = $this->job_titles->get_all_job_titles();

		$data = array(
			"page_title" => $PageTitle,
			"genders" => $genders,
			"departments" => $departments,
			"job_titles" => $job_titles
			);

		$this->load->view('users/add_user', $data);
	}

	public function do_add_user(){
		//echo "<pre>";print_r($this->input->post());exit;
		$data = array(
			'user_id' => $this->input->post('user-id'),
			'first_name' => $this->input->post('first-name'),
			'last_name' => $this->input->post('last-name'),
			'email_address' => $this->input->post('email-address'),
			'gender_id' => $this->input->post('gender_id'),
			'dob' => $this->input->post('dob'),
			'department_id' => $this->input->post('department_id'),
			'job_title_id' => $this->input->post('job-title-id'),
			'user_password' => $this->input->post('user-password'),
			'is_an_admin' => ($this->input->post('is-an-admin') == "on") ? 1 : 0
			);

		//echo "<pre>";print_r($data);exit;

		try{
			$this->sir_users->insert_user($data);

			try{
				$this->logger->add_log(5, $this->session->userdata("user_id"), NULL, json_encode($data));
			} catch(Exception $x){
				$this->xxx->log_exception( $x->getMessage() );
			}
			
			$this->sir_session->add_status_message("User was successfully added", "success");
		} catch( Exception $e ){
			$this->xxx->log_exception( $e->getMessage() );
			$this->sir_session->add_status_message("Sorry, there was an error adding the user. Please try again", "danger");
		}

		return redirect('/Users/add_user');
	}

	public function edit_user()
	{
		//manage session
		$this->wp_pal->manage_session();

		$PageTitle = "Edit SIR User";

		$encrypted_id = $this->uri->segment(3);
		$this->encryption->decrypt($this->uri->segment(3));

		if( !isset($encrypted_id) ){

		} else {
			//echo "decrypted :: " . $this->encryption->decrypt($encrypted_id);exit;
			$genders = $this->wp_pal->get_genders();
			$departments = $this->departments->get_all_departments();
			$job_titles = $this->job_titles->get_all_job_titles();

			$user_details = $this->sir_users->get_user_details_by_encrypted_id($encrypted_id);
			//echo "<pre>";print_r($user_details);exit;

			$data = array(
				"page_title" => $PageTitle,
				"genders" => $genders,
				"departments" => $departments,
				"job_titles" => $job_titles,
				"user_details" => $user_details
				);

			$this->load->view('users/edit_user', $data);
		}
	}

	public function do_edit_user()
	{
		//echo "<pre>";print_r($this->input->post());exit;

		$update_password = false;

		if( empty( $this->input->post('user-password') ) )
		{

			$data = array(
				'first_name' => $this->input->post('first-name'),
				'last_name' => $this->input->post('last-name'),
				'email_address' => $this->input->post('email-address'),
				'gender_id' => $this->input->post('gender_id'),
				'dob' => $this->input->post('dob'),
				'department_id' => $this->input->post('department_id'),
				'job_title_id' => $this->input->post('job-title-id'),
				'is_an_admin' => ($this->input->post('is-an-admin') == "on") ? 1 : 0
			);
		} else {
			$update_password = true;

			$data = array(
				'first_name' => $this->input->post('first-name'),
				'last_name' => $this->input->post('last-name'),
				'email_address' => $this->input->post('email-address'),
				'gender_id' => $this->input->post('gender_id'),
				'dob' => $this->input->post('dob'),
				'department_id' => $this->input->post('department_id'),
				'job_title_id' => $this->input->post('job-title-id'),
				'user_password' => $this->input->post('user-password'),
				'is_an_admin' => ($this->input->post('is-an-admin') == "on") ? 1 : 0
			);
		}

		//get old data
		$user_details = $this->sir_users->get_user_details_by_id($this->input->post('user-id'));

		try{
			$this->sir_users->update_user($data, $this->input->post('user-id'), $update_password);

			try{
				$this->logger->add_log(6, $this->session->userdata("user_id"), json_encode($user_details[0]), json_encode($data));
			} catch(Exception $x){
				$this->xxx->log_exception( $x->getMessage() );
			}
			
			$this->sir_session->add_status_message("User was successfully updated", "success");
		} catch( Exception $e ){
			$this->xxx->log_exception( $e->getMessage() );
			$this->sir_session->add_status_message("Sorry, there was an error updating the user. Please try again", "danger");
		}

		//return redirect('/Users/');
		return redirect('/Users/edit_user/' . urlencode(base64_encode($this->input->post('user-id')))); //$this->encryption->encrypt($this->input->post('user-id'))
	}
}
