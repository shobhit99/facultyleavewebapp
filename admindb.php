<?php
require 'core.php';
if(isset($_COOKIE['admin'])&&$_COOKIE['admin']==md5("password123")){
		$admin = $_COOKIE['admin'];
	}else{
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.2.1/materia/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/navbar-fixed-right.min.css">
    <link rel="stylesheet" href="css/navbar-fixed-left.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.js"></script>
    <script src="js/docs.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
	 <link rel="stylesheet" href="css/docs.css">
 <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
	<div class="row" id="profile-content">
	<img src="http://faculty.pictinc.org/UploadImages/principal.jpg" class="img-fluid" alt="Profile Picture" id="profilepic">
	<div id="uname">
    <a class="navbar-brand" href >Welcome, Pralhad <br>Kulkarni</a>
	</div>
	</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admindb.php">Dashboard</a>
            </li>
			 <li class="nav-item">
                <a class="nav-link" href="javascript:logout();">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<!-- dashboard -->
<div class="container-fluid" id="dashboard-panel">
	<div class="jumbotron" id="dashboard-jumbo">
	<h1 class="display-6" ><strong>Leave Requests</strong></h1>
	<br>
	<table class="table">
				<thead>
				  <tr>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Reason</th>
					<th>Leave Type</th>
					<th>Amount</th>
					<th>Name</th>
					<th></th>
			
				  </tr>
					<tbody>
					  <?php
						$query = "SELECT * FROM leaves WHERE status='waiting'";
						$rquery = mysqli_query($conn, $query);
						while($rows = mysqli_fetch_assoc($rquery))
				 				{
									?>
                                    <tr id="<?php echo $rows['id']; ?>">
                                    <td> <?php echo $rows['startdate']?></td>
                                     <td> <?php echo $rows['enddate']?></td>
                                     <td> <?php echo $rows['reason']?></td>
                                     <td> <?php echo $rows['type']?></td>
									 <td> <?php echo $rows['amount']?></td>
									 <td> <?php echo $rows['name']?></td>
									 <td> <button class="btn btn-success btn-sm" onClick="javascript:approve(<?php echo $rows['id']; ?>);">✓</button><button class="btn btn-danger btn-sm" onClick="javascript:reject(<?php echo $rows['id']; ?>);">X</button></td>
                                    </tr>
                                    <?php				
								}
					  ?>
					</tbody>
				</thead>
		</table>
	</div>
</div>

<!-- dashboard end -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>

function logout(){
	
	document.cookie = 'admin' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	window.location.href = '/admin.php';
	
}
function approve(lid){
	var xhttp = new XMLHttpRequest();
		var url = "adminauth.php";
		var id = lid;
		var param = "id="+id+"&action=approve";
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
							var row = document.getElementById(lid);
							var table = row.parentNode;
							while ( table && table.tagName != 'TABLE' )
							table = table.parentNode;
							if ( !table )
							return;
							table.deleteRow(row.rowIndex);
				}
				else{
					document.getElementById("error-msg").innerHTML = "Something went wrong";
					$("#error-msg").show();
				}
			}
		}
		xhttp.send(param); 
		
}
function reject(lid){
		var xhttp = new XMLHttpRequest();
		var url = "adminauth.php";
		var id = lid;
		var param = "id="+id+"&action=reject";
		xhttp.open("POST", url, false);
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhttp.onreadystatechange  = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
				var response = xhttp.responseText;
				var resp = JSON.parse(response);
				if(resp.status=="failed"){
					alert("Something Went wrong");
				}
				else if(resp.status=="success"){
					var row = document.getElementById(lid);
					var table = row.parentNode;
					while ( table && table.tagName != 'TABLE' )
					table = table.parentNode;
					if ( !table )
					return;
					table.deleteRow(row.rowIndex);
				}
				else{
					alert("Something Went wrong");
				}
			}
		}
		xhttp.send(param); 
}
</script>
</body>
</html>