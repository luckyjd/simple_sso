<?php 
	include('constant.php');
	include('utilities.php');

	if (!isset($_GET['username']) || !isset($_GET['action'])) {
		$dict = array('code' => RESET_TOKEN_FALSE, 'token' => '', 'mess' => 'pram khong hop le.');
		echo json_encode($dict);
		return;
	}

	include('connect.php');
	$username = $_GET['username'];
	$action = $_GET['action'];
	if (util::check_user_exist($conn, $username) === false) {
		$dict = array('code' => RESET_TOKEN_FALSE, 'token' => '', 'mess' => 'tai khoan khong ton tai');
		echo json_encode($dict);
		return;
	}

	if ($action == RESET_TOKEN_LOGOUT) {
		$query = "update user set expire_date = null where username = '$username'";
		if ($conn->query($query) === TRUE) {
			$dict = array('code' => RESET_TOKEN_SUCCESS, 'token' => '', 'mess' => 'thanh cong.');
			echo json_encode($dict);
		}
		else {
			$dict = array('code' => RESET_TOKEN_FALSE, 'token' => '', 'mess' => 'that bai.');
			echo json_encode($dict);
		}
		
		$conn->close();
	}
	
	elseif ($action == RESET_TOKEN_RESET) {
		$new_token = util::gen_token();
		$new_date = util::add_minutes(15, new Datetime());
		$expire_date = util::convert_date_to_string($new_date);
		$query = "update user set expire_date = '$expire_date', token='$new_token' where username = '$username'";

		if ($conn->query($query) === TRUE) {
			$dict = array('code' => RESET_TOKEN_SUCCESS, 'token' => $new_token, 'mess' => 'thanh cong.');
			echo json_encode($dict);
		}
		else {
			$dict = array('code' => RESET_TOKEN_FALSE, 'token' => '', 'mess' => 'that bai.');
			echo json_encode($dict);
		}

		$conn->close();
	}
	
	else {
		$dict = array('code' => RESET_TOKEN_FALSE, 'token' => '', 'mess' => 'pram khong hop le.');
		echo json_encode($dict);
		$conn->close();
	}
?>