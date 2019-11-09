<?php
require 'dbconnect.php';
function authenticate(){
	if(isset($_COOKIE['syi'])){
		$cok = $_COOKIE['syi'];
	}else{
		$cok = "";
	}
	if($cok == ""){
		header('location: index.php');
	}
	else{
		$query = "SELECT fullname, username, email, designation, department, login_ip, last_login, mobile_no, profilepic, casual_leaves, medical_leaves, earned_leaves FROM faculty_users WHERE session_id='$cok'";
		if($run = mysqli_query($GLOBALS['conn'], $query)){
			$count = mysqli_num_rows($run);
			if($count == 0){
				header('Location: index.php');
			}
			$rows = mysqli_fetch_assoc($run);
			return $rows;
			
		}else{
			header('Location: index.php');
		}
		
	}
}

?>