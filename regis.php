<?php
    header("Access-Control-Allow-Origin: *");
    //secret_key
    $secret_key = "mysecretkey";

    // Check event regis, enough param or not
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['secret_key']) && $_POST['secret_key'] == $secret_key){
        
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
            // close connection
            mysqli_close($conn);
            echo $error;
        } else {
            // insert into database 
            $current_time = date('Y-m-d H:i:s');
            $sql = "INSERT INTO user (username, password, created_date) VALUES ('{$username}', '{$password}', '{$current_time}')";
            // excute query
            if (mysqli_query($conn, $sql)) {
                $error = 'pass';
                // close connection
                mysqli_close($conn);
                // redirect
                echo $error;
            } else {
                $error .= "Error: " . mysqli_error($conn);
                // close connection
                mysqli_close($conn);
                //redirect
                echo $error;
            }
        }
    } else {
        // if not enough param, kill process
        die("SOME THING WRONG HEREEEEEEE");
    }
?>