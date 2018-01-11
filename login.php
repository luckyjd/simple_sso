<?php

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

// secret key
$secret_key = "mysecret_key";

// setting expire_time
$expire = 500;
$token = "";

// Check event regis, enough param or not
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['url_handle']) && isset($_POST['secret_key']) && $_POST['secret_key'] == $secret_key){
        
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
    $sql_check_username = "SELECT username, password FROM user WHERE username='$username'";
    $result = mysqli_query($conn,$sql_check_username);
    if (mysqli_num_rows($result) == 0) {
        $error .= "This user is not exists.";
        mysqli_close($conn);
        redirect($url, $username, $token, $error,$expire);

    }
    // fetch record
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    //compare password
    if ($password == $row['password']) {
        // correct pass
        $token = bin2hex(openssl_random_pseudo_bytes(64));
        $sql_update_token = "UPDATE user SET token='$token' WHERE username='$username'";
        if (mysqli_query($conn, $sql_update_token)) {
            //echo "Record updated successfully";
            $error = "pass";
            //close connection
            mysqli_close($conn);
            //redirect 
            redirect($url, $username, $token, $error,$expire);
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        
        
    } else {
        // uncorrect pass
        $error .= "Not correct password. Try again";
        redirect($url, $username, $token, $error, $expire);
    }
    // close connection
    mysqli_close($conn);
} else {
    // if not enough param, kill process
    die("SOME THING WRONG HEREEEEEEE");
}

function redirect($url, $username, $token, $error,$expire) {
    $html = "<html><body><form id='form' action='$url' method='post'>";
    $html .= "<input type='hidden' name='username' value='$username'>";
    $html .= "<input type='hidden' name='token' value='$token'>";
    $html .= "<input type='hidden' name='error' value='$error'>";
    $html .= "<input type='hidden' name='expire' value='$expire'>";
    $html .= "<input type='hidden' name='secret_key' value='$secret_key'>";

    $html .= "</form>";
    $html .= "<script>document.getElementById('form').submit();</script>";
    $html .= "</body></html>";
    print($html);
}
?>