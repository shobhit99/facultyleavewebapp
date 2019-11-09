<?php
$username = "id8465773_faculty";
$password = "yourpasswordhere";
$database = "id8465773_faculty";
$host = "localhost";
$conn = mysqli_connect($host, $username, $password, $database);
if(!$conn){
	die("Failed to Connect to Database");
}

?>