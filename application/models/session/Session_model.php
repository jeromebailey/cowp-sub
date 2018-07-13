<?
class Session_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		//$this->load->config("sir_config");
	}

	public function clear_status_message()
	{
		$this->session->unset_userdata('status_message');
		$this->session->unset_userdata('status_code');
	}

	public function add_status_message($message, $code){
		
		$this->session->set_userdata('status_message', $message);
		$this->session->set_userdata('status_code', $code);
	}
}