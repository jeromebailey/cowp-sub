<?
class Jobtitles_model extends CI_Model
{
	var $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = "job_titles";
	}

	public function insert_job_title($details)
	{
		$inserted = false;

		if( $this->db->insert($this->table_name, $details) ){
			$inserted = true;	
		} else {
			echo "<pre>";print_r($this->db->error());exit;
		}
		
		return $inserted;
	}

	public function get_all_job_titles(){
		$query = $this->db->query("select * from ". $this->table_name . " order by job_title asc");

		return $query->result_array();
	}
}