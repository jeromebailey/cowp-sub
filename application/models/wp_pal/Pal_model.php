<?
class Pal_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_gcg_locations(){
		$query = "SELECT *
					FROM gcg_locations
					ORDER BY location;";

		return Pal_model::format_query_result_as_array( $query );
	}

	public function get_next_po_no()
	{
		$sql = "select next_po_no from next_po_seq_no";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function get_next_invoice_no()
	{
		$sql = "select next_invoice_no from next_invoice_seq_no";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function get_next_quote_no()
	{
		$sql = "select next_quote_no from next_quote_seq_no";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function get_all_uom()
	{
		$sql = "select * from measurement_units order by unit_name asc";

		$result = $this->db->query($sql);

		return $result->result_array();
	}

	public function get_settings_by_slug($slug)
	{
		$sql = "select settings_value from sir_settings where slug = '$slug'";
		$result = $this->db->query($sql);
		return $result->result_array();
	}

	public function get_category_id($category_name){
		$sql = "select * from product_location_categories where category_name ='$category_name'";

		$result = Pal_model::format_query_result_as_array( $sql );

		return $result[0]["category_id"];
	}

	public function get_category_id_from_new_category($category_name){
		if($this->db->insert("product_location_categories", array("category_name" => $category_name))){
			return $this->db->insert_id();
		}
	}

	public function get_genders()
	{
		$sql = "select * from genders";

		$result = $this->db->query($sql);

		return $result->result_array();
	}

	public function manage_session(){
		if( empty( $this->session->userdata("logged_in") ) ){
			redirect("Users/login");
			exit;
		}
	}

	public function log_login($user_id){
		$info = array(
			"user_id" => $user_id,
			"login_date" => date("Y-m-d h:i:s")
			);

		$this->db->insert("login_log", $info);
	}

	public function format_query_result_as_array( $query ){
		$result = $this->db->query( $query );

		return $result->result_array();
	}

	public function format_result_array_as_array($result, $column_name){
		if( !empty( $result ) ){
			foreach ($result as $key => $value) {
				$_array[] = $value[$column_name];
			}
			return $_array;
		}
		
	}

	public function user_has_permission_to($permission){

		if(in_array($permission, $this->session->userdata("permissions"))){
			return true;
		}
		return false;
	}

	public function set_inventory_date($inventory_date){
		$user_id = $this->session->userdata('user_id');

		$data = array (
			"taken_on" => $inventory_date,
			"initiated_by_employee_id" => $user_id
		);

		//$query = "INSERT INTO inventory_dates VALUES ('$inventory_date', $user_id);";

		if( $this->db->insert( "inventory_dates", $data ) ){
			$this->session->set_userdata("inventory_id", $this->db->insert_id());
			$this->session->set_userdata("inventory_date_is_set", true);
			$this->session->set_userdata("inventory_date", $inventory_date);
			//echo $this->session->userdata("inventory_date_is_set");
			echo 1;
		} else {
			echo 0;
		}		
	}

	public function encrypt_user_id($raw_id){
		return urlencode(base64_encode($raw_id));
	}

	public function decrypt_user_id($encrypted_user_id){
		return base64_decode(urldecode($encrypted_user_id));
	}

	public function get_week_number_from_date( $date = null ){
		$date = ( $date == null ) ? date("Y-m-d") : $date;

		$date_obj = new DateTime($date);
		$week = $date_obj->format("W");
		return $week;
	}

	public function get_start_and_end_date_of_week($week, $year) {
	  $dto = new DateTime();
	  $ret['week_start'] = $dto->setISODate($year, $week)->format('Y-m-d');
	  $ret['week_end'] = $dto->modify('+6 days')->format('Y-m-d');
	  return $ret;
	}

	public function pad_product_category_id( $category_id ){
		$padded_category_id = "";

		if( !empty($category_id) ){
			if( strlen($category_id) < 2 ){
				$padded_category_id = "0" . $category_id;
			} else {
				$padded_category_id = $category_id;
			}
			return $padded_category_id;
		}
	}

	public function pad_product_id( $product_id ){
		$padded_product_id = "";
		$max_product_id_length = 4;

		if( !empty($product_id) ){

			$product_id_length = strlen($product_id);
			$max_product_id_length_difference = $max_product_id_length - $product_id_length;

			if( $max_product_id_length_difference != 0 ){
				for( $i = 0; $i < $max_product_id_length_difference; $i++ ){
					$padded_product_id .= "0";
				}

				$padded_product_id .= $product_id;
			} else {
				$padded_product_id = $product_id;
			}

			return $padded_product_id;
		}
	}
}