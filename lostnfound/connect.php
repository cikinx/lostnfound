<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$db = "reclaimuptm";

// Correct function to establish a connection to the database
$conn = mysqli_connect($host, $user, $pass , $db, 3306);

// Check the connection
if (!$conn) {
    die("Failed to connect to DB: " . mysqli_connect_error());
} else {
    
}
?>