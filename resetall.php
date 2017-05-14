<?php 
	require "dbconnect.php";
	
	if(isset($_POST['submit'])){
		$query = "TRUNCATE payment";
		$results = mysqli_query($conn, $query);
		if (!$results){die("Error: Failed to reset data.");}
		
		// Populating with initialized value for form validation
		$query2 = "INSERT INTO payment (Users, Owers, Description, Amount) VALUES ('', '', 'Initialization', 0)";
		$results2 = mysqli_query($conn, $query2);
		if (!$results2){die("Error: Failed to reinitialize table.");}
	}
?>



<!DOCTYPE html>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<head>
	<meta charset="UTF-8">	
	<title> IoU - Calculate </title>	
</head>

<body>
	
	<h4>WARNING: reset is permanent; unable to undo process</h4>
	<h4><strong>Confirm Reset?</strong></h4><br>
	
	<form action="resetall.php" method="post" class="form-horizontal" align="left">	
		<fieldset>
		<!-- Confirm/Back Buttons -->
		<div class="form-group">
		  <div class="col-xs-5 col-xs-offset-3">
			<button type="submit" name="submit" value="Confirm" class="btn btn-default">Confirm</button>
			<a class="btn btn-default btn-outline" href="main.php">Back</a>
			<?php if(isset($_POST['submit'])){echo " Data has been reset!";} ?>
		  </div>
		</div>
		
		</fieldset>
	</form>
		  	
</body>

