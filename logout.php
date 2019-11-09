<?php
require 'dbconnect.php';
if(isset($_POST['username'])&&isset($_POST['session_id'])){
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);
	$username = addslashes(htmlspecialchars($username));
	$session_id = addslashes(htmlspecialchars($session_id));
	$query = "UPDATE faculty_users SET session_id = '' WHERE username = '$username' and session_id = '$session_id'";
	if(mysqli_query($conn, $query)){
		$response['status'] = "success";
		print(json_encode($response));
	}
}


?>