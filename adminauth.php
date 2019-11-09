<?php
include 'core.php';
if(isset($_POST['username'])&&isset($_POST['password'])){
	if(!empty($_POST['username'])&&!empty($_POST['password'])){
		$username = addslashes(strip_tags($_POST['username']));
		$password = addslashes(strip_tags($_POST['password']));
		if($username=="kulkarni99"&&$password=="password123"){
			$hash = md5("password123");
			setcookie("admin", $hash, time()+36000,'/');
			$response['status'] = "success";
			$response['message'] = "Authenticated!";
			print(json_encode($response));
		}else{
			$response['status'] = "failed";
			$response['message'] = "Invalid Username or password";
			print(json_encode($response));
		}	
	}
}
else if(isset($_POST['id'])&&isset($_POST['action'])){
	$id = $_POST['id'];
	$action = $_POST['action'];
	if($action == "approve"){
	$query = "UPDATE leaves set status='approved' WHERE id=$id";	
	}
	else if($action == "reject"){
		$getamount = "SELECT * FROM leaves WHERE id=$id";
		$r = mysqli_query($conn, $getamount);
		$rows = mysqli_fetch_assoc($r);
		$amount = $rows['amount'];
		$username = $rows['username'];
		$type = $rows['type'];
		$newquery = "UPDATE faculty_users SET ".$type."_leaves = ".$type."_leaves + $amount WHERE username = '$username'";
		mysqli_query($conn, $newquery);
	$query = "UPDATE leaves set status='rejected' WHERE id=$id";
	}
	if(mysqli_query($conn, $query)){
			$response['status'] = "success";
			$response['message'] = "Authenticated!";
			print(json_encode($response));
	}else{
		$response['status'] = "failed";
		$response['message'] = "Invalid Username or password";
		print(json_encode($response));
	}
	
}
?>