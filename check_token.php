<?php
	include('constant.php');
	include('utilities.php');

	if (!isset($_GET['token']) || !isset($_GET['secret_key'])) {
		$dict = array('code' => CHECK_TOKEN_ERR_PARAM, 'mess' => 'pram khong hop le.');
		echo json_encode($dict);
		return;
	}

	$token = $_GET['token'];
	$secret = $_GET['secret_key'];
	if ($secret !== SECRET_KEY) {
		$dict = array('code' => CHECK_TOKEN_ERR_SECRET_KEY, 'mess' => 'secret_key khong hop le.');
		echo json_encode($dict);
		return;
	}

	include('connect.php');
	$query = "select * from user where token ='$token'";
	$result = $conn->query($query);
	if ($result->num_rows === 0) {
		$dict = array('code' => CHECK_TOKEN_ERR_TOKEN_NOT_EXIST, 'mess' => 'token khong ton tai.');
		echo json_encode($dict);
		$conn->close();
		return;
	}

	$row = $result->fetch_assoc();
	$datetime = util::convert_string_to_date($row['expire_date']);
	$current_time = new Datetime();
	if ($datetime <= $current_time) {
		$dict = array('code' => CHECK_TOKEN_ERR_TOKEN_EXPIRE, 'mess' => 'token da het han.', 'expire_date' => $datetime, 'current_time' => $current_time);
		echo json_encode($dict);
		$conn->close();
	}
	else {
		$dict = array('code' => CHECK_TOKEN_SUCCESS, 'mess' => 'success.', 'expire_date' => $datetime, 'current_time' => $current_time);
		echo json_encode($dict);
		$conn->close();
	}
?>