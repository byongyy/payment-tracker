<?php require "dbconnect.php"; ?>
	
<?php
	if (isset($_POST['submit'])){
		$member= $_POST['membername'];
		$query = "INSERT INTO payment (Users, Owers, Description, Amount) VALUES ('{$member}', '{$member}', 'Initialization', 0)";
		$result = mysqli_query($conn, $query);	
	}
?>

<!DOCTYPE html>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<head>
	<meta charset="UTF-8">	
	<title> IoU - Add Member </title>	
</head>

<body>
	<form action="addmember.php" method="post" class="form-horizontal">
		<fieldset>

		<!-- Form Name -->
		<legend>Add a Member to Current Session</legend>

		<!-- Member Name Input -->
		<div class="form-group">
		  <label class="col-xs-5 col-xs-offset-3" for="membername">Name</label>  
		  <div class="col-xs-5 col-xs-offset-3">
			<input name="membername" type="text" placeholder="Enter Name Here" class="form-control input-md">
		  </div>
		</div>
		
		<!-- Submit/Cancel Buttons -->
		<div class="form-group">
		  <div class="col-xs-5 col-xs-offset-3">
			<button type="submit" name="submit" value="Submit" class="btn btn-default">Submit</button>
			<a class="btn btn-default btn-outline" href="main.php">Back</a>
			<?php 
				if(isset($_POST['submit'])){
					if($_POST['membername'] == ""){
						echo " Name Required";
					} elseif(!$result){
						echo " Invalid characters or member already exists.";
					} else{echo " Member Added!";}
				} 
			?>
		  </div>
		</div>

		</fieldset>
	</form>
	
	<?php mysqli_free_result($results); ?>
	
</body>

