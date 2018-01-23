<?php

header("Access-Control-Allow-Origin: *");

// secret key
$secret_key = "mysecretkey";

// setting expire_time
$expire = 500;
$token = "";

// Check event regis, enough param or not
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['secret_key']) && $_POST['secret_key'] == $secret_key){
        
    //connect to database
    include('connect.php');

    //collect data
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);
    $error = "";
    $url = $_POST['url_handle'];

    //encript
    $password = md5($password);

    //check username
    $sql_check_username = "SELECT id, username, password FROM user WHERE username='$username'";
    $result = mysqli_query($conn,$sql_check_username);
    if (mysqli_num_rows($result) == 0) {
        $error .= "This user is not exists.";
        mysqli_close($conn);
        // nghiatt
        format_data(0, '', 'Tai khoan khong tont tai', '', '', '');
    }
    // fetch record
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    //compare password
    if ($password == $row['password']) {
        // correct pass
        $token = bin2hex(openssl_random_pseudo_bytes(64));
        $sql_update_token = "UPDATE user SET token='{$token}' AND expire_date='2019-01-01 00:00:00' WHERE username='{$username}'";
        if (mysqli_query($conn, $sql_update_token)) {
            //echo "Record updated successfully";
            $error = "pass";
            //close connection
            mysqli_close($conn);
            // nghiatt
            
            format_data(1, $token, 'Thanh cong ', $username, $row['id'], $_POST['url_handle']);
        } else {
            echo "Error updating record: " . mysqli_error($conn);
            
            // nghiatt
            format_data(0, '', 'Co loi xay ra', '', '', '');
        }
        
        
    } else {
        // uncorrect pass
        $error .= "Not correct password. Try again";
        format_data(0, '', 'Sai password', '', '','');
    }
    // close connection
    mysqli_close($conn);

    // nghiatt
    format_data(0, '', 'sai mat khau', '', '', '');
} else {
    // if not enough param, kill process
    die("SOME THING WRONG HEREEEEEEE");
}


function format_data($status, $token, $mess, $username, $id, $url_handle) {
    $dict = array('status' => $status,  'token' => $token, 'mess' => $mess, 'username' => $username, 'sso_id' => $id, 'url_handle' => $url_handle);
    echo json_encode($dict);
    exit();
}
?>