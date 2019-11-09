<?php

require 'core.php';
$data = authenticate();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Dashboard</title>
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
	<img src="<?php echo $data['profilepic']; ?>" class="img-fluid" alt="Profile Picture" id="profilepic">
	<div id="uname">
    <a class="navbar-brand" href >Welcome,<br><small id="uname"><?php echo $data['username']; ?></small></a>
	</div>
	</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="apply.php">Apply</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="history.php">History</a>
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
	<h1 class="display-6" ><strong>Dashboard</strong></h1>
	<hr><br>
		<div class="row" id="db-row">
		<div class="col-md-3"></div>
			<div class="col-md-2">
			<div class="card" id="casual">
			<div class="card-header">
				<center><img src="images/boy.png" class="img-fluid" id="db-img"></center>
			</div>
			<div class="card-body">
					<center><h1 class="display-6"><strong><?php echo $data['casual_leaves']; ?></strong></h1></center>
				</div>
			</div>
			</div>
			<div class="col-md-2">
			<div class="card" id="medical">
				<div class="card-header">
					<center><img src="images/hospital.png" class="img-fluid " id="db-img"></center>
					</div>
				<div class="card-body">
					<center><h1 class="display-6"><strong><?php echo $data['medical_leaves']; ?></strong></h1></center>
				</div>
			
			</div>
			</div>
			<div class="col-md-2">
			<div class="card" id="earned">
				<div class="card-header">
					<center><img src="images/profit.png" class="img-fluid " id="db-img"></center>
				</div>
				
				<div class="card-body">
					<center><h1 class="display-6"><strong><?php echo $data['earned_leaves']; ?></strong></h1></center>
				</div>
				</div>
			</div>
			
			<div class="col-md-3"></div>
		
		</div>
	</div>
</div>
<!-- dashboard end -->
<script>
function logout(){
	var op1 = "<?php echo $data['username']; ?>";
	var op2 = "<?php echo $_COOKIE['syi']; ?>";
	var xhttp = new XMLHttpRequest();
	var url = "logout.php";
	var param = "username="+op1+"&session_id="+op2;
	xhttp.open("POST", url, false);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.onreadystatechange  = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
				var response = xhttp.responseText;
				var resp = JSON.parse(response);
				if(resp.status=="success"){
					location.href = "index.php";
				}
			}
		}
	xhttp.send(param);
}

</script>
</body>
</html>