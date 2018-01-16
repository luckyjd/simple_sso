<?php
// $servername = "simple.sso.tinhvan.com:3306";
// $username = "root";
// $password = "tinhvan@2017";
// $dbname = "simple_sso_db";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_sso";

// Create connection by MySQLi Object-oriented
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>