<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="bg">
<!-- The Modal -->
		<!-- The Modal -->
		
<!-- Modal ends -->
<div class="container">
<div class="jumbotron ">
<div class="row">
<div class="col col-md-3"></div>
<div id="panel" class="col md=6">
<!-- Login Card starts -->
<div class="card" id="logincard">
<div class="card-header">
	<center><h1 class="display-5"><strong>Admin Login</strong></h1></center>
</div>
<!-- Login Form Starts -->
	<div class="card-body">

		<div class="form-group">
			<input type="text" name="username" class="form-control" id="username" placeholder="Username">
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" id="password" placeholder="Password">
		</div>
		</br>
		<p class="text-danger" id="error-msg"></p>
		<p class="text-success" id="success-msg"></p>
		<div class="form-group">
			<button class="btn btn-success btn-block" name="login" onClick="adminauth();">Login</button>
		</div>
		<br>
		<p class="text-danger" id="error-msg"></p>
		<p class="text-success" id="success-msg"></p>

	</div>
<!-- Login Form Ends -->
</div>
<!-- Login Card ends -->
</div>
<div class="col col-md-3"></div>
</div>
</div>

</div>

</div>



<script>
function adminauth(){
	
	$("#success-msg").hide();
		$("#error-msg").hide();
	
		var xhttp = new XMLHttpRequest();
		var url = "adminauth.php";
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		if(username == '' || password == ''){
			document.getElementById("error-msg").innerHTML = "All Fields are required!";
					$("#error-msg").show();
		}
		else{
		var param = "username="+username+"&password="+password;
		xhttp.open("POST", url, false);
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhttp.onreadystatechange  = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
				var response = xhttp.responseText;
				var resp = JSON.parse(response);
				if(resp.status=="failed"){
					document.getElementById("error-msg").innerHTML = resp.message;
					$("#error-msg").show();
				}
				else if(resp.status=="success"){
					document.getElementById("success-msg").innerHTML = resp.message;
					$("#success-msg").show();
					location.href = "admindb.php";
				}
				else{
					document.getElementById("error-msg").innerHTML = "Something went wrong";
					$("#error-msg").show();
				}
			}
		}
		
		xhttp.send(param); 
		}
	
}
</script>

</body>
 </html>