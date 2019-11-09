<?php
require 'dbconnect.php';


if(isset($_POST['email'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['mobileno'])&&isset($_POST['designation'])&&isset($_POST['department'])&&isset($_POST['fullname'])&&isset($_POST['pic'])){
	if(!empty($_POST['email'])&&!empty($_POST['username'])&&!empty($_POST['password'])&&!empty($_POST['mobileno'])&&!empty($_POST['designation'])&&!empty($_POST['department'])&&!empty($_POST['fullname'])&&!empty($_POST['pic'])){
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$mobileno = mysqli_real_escape_string($conn, $_POST['mobileno']);
		$designation = mysqli_real_escape_string($conn, $_POST['designation']);
		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
		$pic = mysqli_real_escape_string($conn, $_POST['pic']);
		$email = addslashes(htmlspecialchars($email));
		$username = addslashes(htmlspecialchars($username));
		$password = addslashes(htmlspecialchars($password));
		$mobileno = addslashes(htmlspecialchars($mobileno));
		$designation = addslashes(htmlspecialchars($designation));
		$department = addslashes(htmlspecialchars($department));
		$fullname = addslashes(htmlspecialchars($fullname));
		$pic = addslashes(htmlspecialchars($pic));

		// validate email and password
		$query = "SELECT * FROM faculty_users WHERE username = '$username' OR email='$email'";
		$run = mysqli_query($conn, $query);
		$row_count = mysqli_num_rows($run);
		if($row_count>0){
			$response['status'] = "failed";
			$response['message'] = "Username or Email already registered.";
			print(json_encode($response));
			die();
		}

		//
		$password = md5($password);
		$query = "INSERT INTO faculty_users(username, fullname, email, password, designation, department, mobile_no, profilepic) VALUES('$username', '$fullname', '$email','$password', '$designation', '$department', '$mobileno', '$pic')";
		if($run_query = mysqli_query($conn, $query)){
			$response['status'] = "success";
			print(json_encode($response));
		} else{
			$response['status'] = "failed";
			$response['message'] = "Something went wrong.";
			print(json_encode($response));
		}
		
	}else{
		$response['status'] = "failed";
		$response['message'] = "All Fields are required";
		print(json_encode($response));
	}
	
	
}
else{
	$response['status'] = "failed";
	$response['message'] = "Invalid request!";
	print(json_encode($response));
}


?>