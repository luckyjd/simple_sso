<?php 
	/**
	*
	*/
	class util {
		function __construct($argument) {

		}

		public static function gen_token() {
			$token = bin2hex(openssl_random_pseudo_bytes(64));
			return $token;
		}

		public static function convert_date_to_string($date) {
			$result = date_format($date, 'Y-m-d H:i:s');
			return $result;
		}

		public static function convert_string_to_date($string) {
			$time = strtotime($string);
			$newformat = Datetime::createFromFormat('Y-m-d H:i:s', $string);
			return $newformat;
		}

		public static function add_minutes($minute, $date_time) {
			$minute_str = $minute.' minutes';
			date_add($date_time, date_interval_create_from_date_string($minute_str));
			// echo date_format($date_time, 'Y-m-d H:i:s');
			return $date_time;
		}

		public static function check_user_exist($conn, $username) {
			$sql = "select count(*) from user where username = '".$username."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    $row = $result->fetch_assoc();
			    if ($row['count(*)'] === '0') {
			    	return false;
			    }
			    return true;
			} 
			else {
			    return false;
			}
			return true;
		}
	}
?>