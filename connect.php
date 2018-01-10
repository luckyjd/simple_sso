<?php
$servername = "localhost";
$username = "root";
$password = "mysql@1211";
$dbname = "sso_db";

// Create connection by MySQLi Object-oriented
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>