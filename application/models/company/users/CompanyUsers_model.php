<?
class CompanyUsers_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function validate_company_user($email_address, $user_password){
		try{
			$user_details = $this->validate_user($email_address, $user_password);

			echo "<pre>";print_r( $user_details );exit;

			if( empty($user_details) ){

			} else {
				add_user_details_to_session($user_details);
			}
		} catch( Exception $e ){

		}
	}

	public function validate_immigration_user($email_address, $user_password){
		try{
			$user_details = $this->ImmigrationUsers_model->validate_user($email_address, $user_password);


			if( empty($user_details) ){

			} else {
				add_user_details_to_session($user_details);
			}
		} catch( Exception $e ){

		}
	}

	public function validate_user($email_address, $user_password){
		if( $email_address != null && $user_password != null ){
			return $this->get_user_details( $email_address, $user_password );
		}
		return null;
	}

	public function get_user_details($email_address, $user_password){
		$query = "SELECT *
					FROM users u
					WHERE u.`email_address` = '$email_address'
					AND u.`password` = SHA2('$user_password', 512)
					AND u.`user_type_id` = 2
					AND enabled = 1";exit;

		return $this->format_query_result_as_array( $query );
	}

	private function format_query_result_as_array( $query ){
		$result = $this->db->query( $query );

		return $result->result_array();
	}

	public function formatDate($last_update_date){
		$months = array(
                    "JAN"=>"01",
                    "FEB"=>"02",
                    "MAR"=>"03",
                    "APR"=>"04",
                    "MAY"=>"05",
                    "JUN"=>"06",
                    "JUL"=>"07",
                    "AUG"=>"08",
                    "SEP"=>"09",
                    "OCT"=>"10",
                    "NOV"=>"11",
                    "DEC"=>"12"
                    );

		$_date = str_replace('"', "", $last_update_date);

		$date_parts = explode( "-", $_date);
//echo "<pre>";print_r($date_parts);exit;
		$mm_name = $date_parts[1];

		$mm = $months[$mm_name];
        
        return $date_parts[2] . "-" . $mm . "-" . $date_parts[0];

	}

	public function pharmaceutical_form_code_exist($pharamceutical_form){
		$query = "select * from form_code where PHARMACEUTICAL_CODE = '$pharamceutical_form'";

		$result = $this->db->query( $query );
//echo "<pre>";print_r(  $result->row_array());exit;
		if( $result->num_rows() == 0 ){
			return false;
		}
		return true;
	}
}