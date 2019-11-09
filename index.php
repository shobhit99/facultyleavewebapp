<!DOCTYPE html>
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
		  <div class="modal" id="myModal">
			<div class="modal-dialog">
			  <div class="modal-content">
			  
				<!-- Modal Header -->
				<div id="modalbodyandfooter">
				<div class="modal-header">
				  <center><h4 class="modal-title">Confirm Your Profile</h4></center>
				  <button type="button" class="close" onClick="javascript:$('#myModal').hide();">&times;</button>
				</div>
				
				<!-- modal body and fotter -->
				
				<!-- Modal body -->
				
				<div class="modal-body">
					<div class="form-group">
						<center><img src="images/loading.gif" class="img-fluid" alt="Profile Picture" id="yourprofilepic"></center>
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="fullname" placeholder="Full Name">
					</div>
					<div class="form-group">
						<select class="form-control" id="dept">
							<option val="Computer Engineering">Computer Engineering</option>
							<option val="Information Technology">Information Technology</option>
							<option val="Electronics & Telecommunication">Electronics & Telecommunication</option>
							<option val="Applied Science">Applied Science</option>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="desig">
							<option val="Assistant Professor">Assistant Professor</option>
							<option val="Associate Professor">Associate Professor</option>
							<option val="Professor">Professor</option>
							<option val="Lecturer">Lecturer</option>
						</select>
					</div>
					<div class="form-group">
					<input type="email" class="form-control" id="email" minlength="5" placeholder="Email ID">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="mobileno" minlength="10" placeholder="Mobile No">
					</div>
					<div class="form-group">
					<input type="text" class="form-control" id="reg-username" minlength="4" placeholder="Username">
					</div>
					<div class="form-group">
					<input type="password" class="form-control" id="reg-password" minlength="6" placeholder="Password">
					</div>
					<div class="form-group">
					<input type="password" class="form-control" id="repeatpassword" minlength="6" placeholder="Repeat Password">
					</div>
					<p class="text-danger" id="error-msg-submit"></p>
					<p class="text-success" id="success-msg-submit"></p>
				</div>
				
				<!-- Modal footer -->
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" onClick="javascript:register();">Submit</button>
				  <button type="button" class="btn btn-danger" onClick="javascript:$('#myModal').hide();">Close</button>
				</div>
				</div>
			  </div>
			</div>
		  </div>
<!-- Modal ends -->
<div class="container">
<div class="jumbotron ">
<div class="col-sm-12" id="panel">
<div class="row">
<div class="col-sm-6 mx-auto" id="leftimg">
 <center><div class="photo"><img src="images/pict.png" class="rounded-circle img-thumbnail" alt="PICT" id="pictlogo"> </center>

</div>


<div class="col-sm-4 mx-auto" id="rightform">

<!-- Login Card starts -->
<div class="card" id="logincard">

<div class="card-header">
	<center><h1 class="display-4"><strong>Login</strong></h1></center>
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
			<button class="btn btn-success btn-block" name="login" id="login" onClick="javascript:login();">Login</button>
		</div>
		<a href="forgot.php" id="forgot"><center><span class="text-muted">Forgot</span> Username / Password?</center></a>

		<div class="createaccount">
			<a href="#" id="createacc">
			Create your Account
			</a>
		</div>

	</div>
<!-- Login Form Ends -->
</div>
<!-- Login Card ends -->
<!-- Register Card starts -->

<div class="card" id="registercard">

<div class="card-header">
	<center><h1 class="display-4"><strong>Register</strong></h1></center>
</div>
<!-- Register Form Starts -->

	<div class="card-body">
		<div class="form-group">
			<input type="text" id="firstname" class="form-control" placeholder="First Name">
		</div>
		<div class="form-group">
			<input type="text" id="lastname" class="form-control" placeholder="Last Name">
		</div>
		</br>
		<p class="text-danger" id="error-msg-register"></p>
		<p class="text-success" id="success-msg-register"></p>
		<div class="form-group">
			<button class="btn btn-success btn-block" id="register" name="register" onClick="registerform();">Register</button>
		</div>
		<a href="forgot.php" id="forgot"><center><span class="text-muted">Forgot</span> Username / Password?</center></a>

		<div class="createaccount">
			<a href="#" id="loginclick">
			Login
			</a>
		</div>
	</div>
<!-- Register Form Ends -->
</div>



<!-- Register card ends -->

</div>

</div>

</div>
</div>
</div>

</div>




<!---------------------------------------------------------------->

<script language="JavaScript" type="text/javascript">

function login(){
		
		$("#success-msg").hide();
		$("#error-msg").hide();
	
		var xhttp = new XMLHttpRequest();
		var url = "login.php";
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
					location.href = "dashboard.php";
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
function registerform(){
	
		$("#error-msg-register").hide();
		$("#success-msg-register").hide();
		document.getElementById("success-msg-register").innerHTML = "Loading...";
		$("#success-msg-register").show();
		var xhttp = new XMLHttpRequest();
		var url = "registerform.php";
		var firstname =  document.getElementById("firstname").value;
		var lastname =  document.getElementById("lastname").value;
		if(firstname == '' || lastname == ''){
			document.getElementById("error-msg").innerHTML = "All Fields are required!";
					$("#error-msg").show();
					$("#success-msg-register").hide();
		}
		var param = "firstname="+firstname+"&lastname="+lastname;
		xhttp.open("POST", url, false);
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhttp.onreadystatechange  = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
				var response = xhttp.responseText;
				var resp = JSON.parse(response);
				if(resp.status=="failed"){
					document.getElementById("error-msg-register").innerHTML = resp.message;
					$("#success-msg-register").hide();
					$("#error-msg-register").show();
					
				}
				else if(resp.status=="success"){
					
					document.getElementById("success-msg-register").innerHTML = "";
					$("#success-msg-register").hide();
					$("#fullname").val(resp.FullName);
					$("#yourprofilepic").attr("src","http://faculty.pictinc.org/UploadImages/"+resp.ProfileImage);
					$("#dept").val(resp.Department);
					$("#desig").val(resp.Designation);
					$("#email").val(resp.Email);
					$("#mobileno").val(resp.Phone);
					$("#success-msg-register").hide();
					$("#myModal").show();
					
					
					
				}else{
					document.getElementById("error-msg-register").innerHTML = "Something went wrong";
					$("#success-msg-register").hide();
					$("#error-msg-register").show();
					
				}
			}
		}
		
		xhttp.send(param); 
	
}
function register(){
	$("#error-msg-submit").hide();
	$("#success-msg-submit").hide();
	var xhttp = new XMLHttpRequest();
	var pic = $("#yourprofilepic").attr("src");
	var fullname = $("#fullname").val();
	var department = $("#dept").val();
	var designation = $("#desig").val();
	var email = $("#email").val();
	var mobileno = $("#mobileno").val();
	var pass = $("#reg-password").val();
	var rep_pass = $("#repeatpassword").val();
	var reg_username = $("#reg-username").val();
	var url = "register.php";
	
	if(pass != rep_pass){
		alert(rep_pass);
		$("#error-msg-submit").val("Passwords donot match.");
		$("#error-msg-submit").show();
	}else{
		
		xhttp.open("POST", url, false);
		var param = "pic="+pic+"&fullname="+fullname+"&department="+department+"&designation="+designation+"&email="+email+"&mobileno="+mobileno+"&password="+pass+"&username="+reg_username;
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhttp.onreadystatechange = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
				var response = xhttp.responseText;
				var resp = JSON.parse(response);
				if(resp.status=="failed"){
					document.getElementById("error-msg-submit").innerHTML = resp.message;
					$("#error-msg-submit").show();
				}
				else if(resp.status=="success"){
					document.getElementById("success-msg-submit").innerHTML = "You've been registered Successfully!";
					$("#success-msg-submit").show();
				}
				else{
					document.getElementById("error-msg-submit").innerHTML = "Something went wrong";
					$("#error-msg-submit").show();
				}
			}
		}
		xhttp.send(param);
		
		}
		
		
	}
	
$(document).ready(function(){
	$("#registercard").hide();
	$("#error-msg").hide();
	$("#error-msg-register").hide();
	$("#success-msg-register").hide();
	$("#success-msg").hide();
	
	
});

$("#createacc").click(function(){
	$("#logincard").hide()
	$("#registercard").show()
	$("#error-msg").hide();
});
$("#loginclick").click(function(){
	$("#registercard").hide()
	$("#logincard").show()
});

</script>
<!---------------------------------------------------------------->

</body>
 </html>