<?php

require 'dbconnect.php';

if(isset($_POST['username'])&&isset($_POST['password'])){
	if(!empty($_POST['username'])&&!empty($_POST['password'])){
		
		

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$username = addslashes(htmlspecialchars($username));
		$password = addslashes(htmlspecialchars($password));
		
		$password = md5($password);
		$query = "SELECT username, password FROM faculty_users WHERE username='$username' AND password='$password'";
		if($run = mysqli_query($conn, $query)){
			$row_count = mysqli_num_rows($run);
			if($row_count > 0){
				$session_id = base64_encode(openssl_random_pseudo_bytes(30));
				$query = "UPDATE faculty_users set session_id = '$session_id' WHERE username='$username'";
				if($run = mysqli_query($conn, $query)){
						$response['status'] = "success";
						$response['message'] = "Authenticated!";
						setcookie("syi", $session_id, time()+36000,'/');
						setcookie("username", $username, time()+36000,'/');
						//$response['session_id'] = $session_id;
						print(json_encode($response));
				}else{

					$response['status'] = "failed";
					$response['message'] = "Something went wrong, please contact Administrator.";
					print(json_encode($response));
				}
			}else{
				$response['status'] = "failed";
				$response['message'] = "Invalid Username or password";
				print(json_encode($response));
			}
		}else{
			$response['status'] = "failed";
			$response['message'] = "Error in SQL, please contact Administrator";
			print(json_encode($response));
		}
		
	}else{
		$response['status'] = "failed";
		$response['message'] = "All Fields are required";
		print(json_encode($response));
	}
}
?>