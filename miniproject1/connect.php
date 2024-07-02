<?php
// Check if session is not already started, then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$base_url = 'http://localhost/My-Project';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store";

// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error());
    die("Connection failed: Please contact support.");
}

?>
