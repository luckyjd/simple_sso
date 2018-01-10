<?php

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
 
//Xử lý đăng nhập
if (isset($_POST['login'])) 
{   
    //set url to redirect ( fix only that time )
    $url = 'http://nhattx.learnphp.tinhvan.com/login_form_learnphp.php';
    //Kết nối tới database
    include('connect.php');
     
    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);
    $error = "";
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        $error .= "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
        redirect($url, $username, $error);
    }
     
    // mã hóa pasword
    $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $sql_check_username = "SELECT username, password FROM user WHERE username='$username'";
    $result = mysqli_query($conn,$sql_check_username);
    if (mysqli_num_rows($result) == 0) {
        $error .= "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại.";
        redirect($url, $username, $error);
    }
    
    
    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        $error .= "Mật khẩu không đúng. Vui lòng nhập lại.";
        redirect($url, $username, $error);
    }
    function redirect($url, $username, $error) {
        $html = "<html><body><form id='form' action='$url' method='post'>";
        $html .= "<input type='hidden' name='username' value='$username'>";
        $html .= "<input type='hidden' name='error' value='$error'>";

        $html .= "</form>";
        $html .= "<script>document.getElementById('form').submit();</script>";
        $html .= "</body></html>";
        print($html);
    }
    if ($error == ""){
        $url = 'http://nhattx.learnphp.tinhvan.com/home_learnphp.php';
        $error = 'pass';
        redirect($url, $username, $error);
    }
    
}
?>