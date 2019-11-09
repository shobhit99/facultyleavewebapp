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
	<h1 class="display-6" ><strong>Apply for Leave</strong></h1>
	<hr><br>
	<form method="POST" action="apply.php">
			<div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date"><h4 class="text-muted">Start Date  </h4></label>
        <input class="form-control" id="startdate" name="startdate" placeholder="MM/DD/YYY" type="text"/>
      </div>&nbsp;&nbsp;&nbsp;
	  <div class="form-group"> <!-- Date input -->
        <label class="control-label" for="date"><h4 class="text-muted">End Date  </h4></label>
        <input class="form-control" id="enddate" name="enddate" placeholder="MM/DD/YYY" type="text"/>
      </div>	</br>
	   <div class="form-group">
				<div class="btn-group" data-toggle="buttons" >
				<label class="btn btn-primary">
				<input type="radio" name="options" value="casual"> Casual
				</label>
				<label class="btn btn-primary">
				<input type="radio" name="options" value="medical"> Medical
				</label>
				</div>
	   </div>
	    <div class="form-group">
		<input type="text" name="amount" placeholder="Amount" class="form-control">
		</div>
	  <div class="form-group">
			<h4 class="text-muted">Reason</h4>
			<textarea id="reason" rows="8" cols="50" name="reason"></textarea>
		</div>
		</br>
		<button class="btn btn-success" type="submit" name="submit">Submit</button><br><br>
		<?php
			if(isset($_POST['startdate'])&&isset($_POST['enddate'])&&isset($_POST['reason'])&&isset($_POST['amount'])&&isset($_POST['options'])){
				if(!empty($_POST['startdate'])&&!empty($_POST['enddate'])&&!empty($_POST['reason'])){
					
						$startdate = mysqli_real_escape_string($conn, $_POST['startdate']);
						$enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
						$reason = mysqli_real_escape_string($conn, $_POST['reason']);
						$username = $cok = $_COOKIE['username'];
						$namequery = "SELECT fullname FROM faculty_users WHERE username='$username'";
						$r = mysqli_query($conn, $namequery);
						$rows = mysqli_fetch_assoc($r);
						$name = $rows['fullname'];
						$amount = mysqli_real_escape_string($conn, $_POST['amount']);
						$type = mysqli_real_escape_string($conn, $_POST['options']);
						$query = "INSERT INTO leaves(startdate, enddate, username, reason, status, amount, type, name) VALUES('$startdate', '$enddate', '$username', '$reason', 'waiting', $amount, '$type', '$name')";
						if(mysqli_query($conn, $query)){
							$query = "UPDATE faculty_users SET ".$type."_leaves = ".$type."_leaves - $amount";
							if(mysqli_query($conn, $query)){
										echo "<h5 class='text text-muted' style='color:green'>Request for leave submitted Successfully!</h5>";
							}
							
						}
						else{
							echo "<h5 class=\"text-muted\">Failed to submit</h5>";
						}
				}
			}
		?>
		</form>
	</div>
</div>

<!-- dashboard end -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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
function apply(){
	
}

</script>
</body>
</html>