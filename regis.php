<?php

    // Check event regis, enough param or not
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['url_handle']) && isset($_POST['secret_key']) && $_POST['secret_key'] == "mysecretkey"){
        
        //connect to database
        include('connect.php');
        
        //get data
        $username   = addslashes($_POST['username']);
        $password   = addslashes($_POST['password']);
        $error = ""; 

        //md5 
        $password = md5($password);
        
        // check username exists
        $sql_check_username = "SELECT username FROM user WHERE username='$username'";
        if (mysqli_num_rows(mysqli_query($conn, $sql_check_username)) > 0) {
            $error .= "This username is used. Try other.";
            redirect($_POST['url_handle'], $error);
        } else {
            // insert into database 
            $sql = "INSERT INTO user (username, password) VALUES ('{$username}', '{$password}')";
            // excute query
            if (mysqli_query($conn, $sql)) {
                $error = 'pass';
                redirect($_POST['url_handle'], $error);
            } else {
                $error .= "Error: " . mysqli_error($conn);
                redirect($_POST['url_handle'], $error);
            }
        }
    } else {
        // if not enough param, kill process
        die("SOME THING WRONG HEREEEEEEE");
    }
    //create from to redirect and post data
    function redirect($url, $error) {
        $html = "<html><body><form id='form' action='$url' method='post'>";
        $html .= "<input type='hidden' name='error' value='$error'>";

        $html .= "</form>";
        $html .= "<script>document.getElementById('form').submit();</script>";
        $html .= "</body></html>";
        print($html);
    }
?>