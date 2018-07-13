<?
class Notifications_model extends CI_Model
{
	var $table_name;

	function __construct()
	{
		parent::__construct();
		$this->table_name = "notifications";
	}

	public function insert_user_notification($user_id, $notification_id)
	{
		$inserted = false;

		$data = array(
			"user_id" => $user_id,
			"notification_id" => $notification_id,
			"date_received" => date("Y-m-d H:i:s"),
			"status_id" => 2
		);

		return $this->db->insert("user_notifications", $data);
	}

	public function insert_user_notification_from_array($user_info_array, $notification_id)
	{
		$inserted = false;

		if( !empty($user_info_array) )
		{
			foreach ($user_info_array as $key => $value) {
				$user_id = $value["user_id"];

				$data = array(
					"user_id" => $user_id,
					"notification_id" => $notification_id,
					"date_received" => date("Y-m-d H:i:s"),
					"status_id" => 2
				);

				$this->db->insert("user_notifications", $data);
			}
		}
	}

	public function get_user_notifications_for_drop_down($user_id)
	{
		$query = "SELECT un.`user_notification_id`, n.`title`, REPLACE( n.`details`, '[first_name]', u.`first_name`) details, un.date_received,
				CASE
				WHEN TIMEDIFF(NOW(), un.`date_received`) < 60 THEN TIMEDIFF(NOW(), un.`date_received`) + ' mins ago'
				WHEN TIMEDIFF(NOW(), un.`date_received`) < 24 THEN TIMEDIFF(NOW(), un.`date_received`) + ' hours ago'
				WHEN DATEDIFF(NOW(), un.date_received) <= 7 THEN CONCAT(DATEDIFF(NOW(), un.date_received), ' days ago')
				WHEN ROUND(DATEDIFF(NOW(), un.date_received)/7) < 4 THEN CONCAT(ROUND(DATEDIFF(NOW(), un.date_received)/7), ' weeks ago')
				WHEN TIMESTAMPDIFF(MONTH, NOW(), un.date_received) < 12 THEN CONCAT(TIMESTAMPDIFF(MONTH, NOW(), un.date_received), ' months ago')
				WHEN FLOOR(DATEDIFF(NOW(), un.date_received)/365) > 365 THEN CONCAT(FLOOR(DATEDIFF(NOW(), un.date_received)/365), ' years ago')
				END 'LengthOfTime'
				FROM user_notifications un
				INNER JOIN notifications n ON n.`notification_id` = un.`notification_id`
				INNER JOIN sir_users u ON u.`user_id` = un.`user_id`
				WHERE un.`user_id` = $user_id
				AND un.`status_id` = 2
				limit 0, 7";

		return $this->sir->format_query_result_as_array($query);
	}

	public function get_notifications_for_user($user_id)
	{
		$query = "SELECT un.`user_notification_id`, un.`date_received`, un.`date_read`, un.`notification_id`, un.`status_id`, un.`user_id`,
					n.`title`, REPLACE( n.`details`, '[first_name]', u.`first_name`) details, ns.`notification_status`
					FROM user_notifications un
					INNER JOIN notifications n ON n.`notification_id` = un.`notification_id`
					LEFT JOIN notification_statuses ns ON ns.`status_id` = un.`status_id`
                    INNER JOIN sir_users u ON u.`user_id` = un.`user_id`
					WHERE un.`user_id` = $user_id";

		return $this->sir->format_query_result_as_array($query);
	}

	public function get_notification_by_id($id)
	{
		$query = "SELECT un.`user_notification_id`, un.`date_received`, un.`date_read`, un.`notification_id`, un.`status_id`, un.`user_id`,
					n.`title`, REPLACE( n.`details`, '[first_name]', u.`first_name`) details, ns.`notification_status`
					FROM user_notifications un
					INNER JOIN notifications n ON n.`notification_id` = un.`notification_id`
					LEFT JOIN notification_statuses ns ON ns.`status_id` = un.`status_id`
					INNER JOIN sir_users u ON u.`user_id` = un.`user_id`
					WHERE un.`user_notification_id` = $id";

		return $this->sir->format_query_result_as_array($query);
	}

	public function set_notification_as_read($notification_id)
	{
	    $query = "UPDATE `user_notifications`
                    SET status_id = 1
                    WHERE user_notification_id = $notification_id";

	    return $this->db->query($query);
	}

	public function send_notification_for_low_stock_level_after_requisition($users_array, $low_stock_products)
	{
		//echo "<pre>";print_r($low_stock_products);exit;
		if( !empty($low_stock_products) )
		{
			$from = "smbusinessapps@gmail.com";
			$low_stock_email = $this->emailer->get_email_by_slug( "low_stock_level" );

			// Configure email library
			/*$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_port'] = 465;
			$config['smtp_timeout'] = '7';
			$config['smtp_user'] = "smbusinessapps@gmail.com";
			$config['smtp_pass'] = "Sm@!!Bu$@pp$";*/

			$config = array(
			    'protocol' => 'tls',
			    'smtp_host' => 'smtp.gmail.com',
			    'smtp_port' => 587, //and 25
			    'smtp_user' => 'smbusinessapps@gmail.com',
			    'smtp_pass' => 'Sm@!!Bu$@pp$',
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1'
			);


			$this->load->library('email', $config);

			//$this->email->initialize($config);

			for( $p = 0; $p < count( $low_stock_products ); $p++ )
			{
				$product_name = $low_stock_products[0]["product_name"];

				foreach ($users_array as $key => $value) {	

					$to = $value["email_address"];
					$first_name = $value["first_name"];

					//$this->email->from('your@example.com', 'SIR Application');
					$subject = $low_stock_email[0]["email_subject"];

					$message = $low_stock_email[0]["email_body"];
					$message = str_replace("{first_name}", $first_name, $message);
					$message = str_replace("{product_name}", $product_name, $message);

					/*$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: ' . $from . "\r\n";
					$headers .= 'Reply-To: ' .$from . "\r\n";
	    			$headers .= 'X-Mailer: PHP/' . phpversion();

	    			mail( $to, $subject, $message, $headers );*/

	    			$this->email->from($from, 'SIR App');
					$this->email->to($to);

					$this->email->subject($subject);
					$this->email->message($message);

					if($this->email->send())
					{
						echo "message sent";
					} else {
						echo $this->email->print_debugger();
					}
				} //end of foreach
			}
		} //end of if statement		
	}

	public function send_notification_to_approve_purchase_order($users_array, $purchase_order_no)
	{
		
		$from = "smbusinessapps@gmail.com";
		$approve_po_email = $this->emailer->get_email_by_slug( "approve_po" );

		$config = array(
			'protocol' => 'tls',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587, //and 25
			'smtp_user' => 'smbusinessapps@gmail.com',
			'smtp_pass' => 'Sm@!!Bu$@pp$',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);


		$this->load->library('email', $config);

		//$this->email->initialize($config);

		foreach ($users_array as $key => $value) {	

			$to = $value["email_address"];
			$first_name = $value["first_name"];

			//$this->email->from('your@example.com', 'SIR Application');
			$subject = $approve_po_email[0]["email_subject"];

			$message = $approve_po_email[0]["email_body"];
			$message = str_replace("{first_name}", $first_name, $message);
			$message = str_replace("{purchase_order_no}", $purchase_order_no, $message);

			/*$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: ' . $from . "\r\n";
			$headers .= 'Reply-To: ' .$from . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();

			mail( $to, $subject, $message, $headers );*/

			$this->email->from($from, 'SIR App');
			$this->email->to($to);

			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send())
			{
				echo "message sent";
			} else {
				echo $this->email->print_debugger();
			}
		} //end of foreach
		
	}

	public function send_notification_to_dispatch_requisition($users_array, $client_name, $flight_no)
	{
		
		$from = "smbusinessapps@gmail.com";
		$approve_po_email = $this->emailer->get_email_by_slug( "dispatch_requisition" );

		$config = array(
			'protocol' => 'tls',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587, //and 25
			'smtp_user' => 'smbusinessapps@gmail.com',
			'smtp_pass' => 'Sm@!!Bu$@pp$',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);

		$this->load->library('email', $config);

		//$this->email->initialize($config);

		foreach ($users_array as $key => $value) {	

			$to = $value["email_address"];
			$first_name = $value["first_name"];

			//$this->email->from('your@example.com', 'SIR Application');
			$subject = $approve_po_email[0]["email_subject"];

			$message = $approve_po_email[0]["email_body"];
			$message = str_replace("{first_name}", $first_name, $message);
			$message = str_replace("{client_name}", $client_name, $message);
			$message = str_replace("{flight_no}", $flight_no, $message);

			/*$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: ' . $from . "\r\n";
			$headers .= 'Reply-To: ' .$from . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();

			mail( $to, $subject, $message, $headers );*/

			$this->email->from($from, 'SIR App');
			$this->email->to($to);

			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send())
			{
				echo "message sent";
			} else {
				echo $this->email->print_debugger();
			}
		} //end of foreach
		
	}
}