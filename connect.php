<?php
session_start();

$base_url='http://localhost/miniproject';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store";

$conn = mysqli_connect($servername, $username, $password, $dbname); //สร้างการเชื่อมต่อกับฐานข้อมูล

//check connect
if(!$conn){ // connect failed
    die("Connection failed : ". mysqli_connect_error()); 
}else{
}
?> 