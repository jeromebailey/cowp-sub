<?
class Exceptions_model extends CI_Model
{
	var $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = "exceptions";
	}

	public function log_exception($details)
	{
		$inserted = false;

		$data = array(
			'exception' => $details,
			'date_occured' => date('Y-m-d')
			);

		if( $this->db->insert($this->table_name, $data) ){
			$inserted = true;	
		} else {
			echo "<pre>";print_r($this->db->error());exit;
		}
		
		return $inserted;
	}
}