<?php 
	require "dbconnect.php"; 
	
	$results = mysqli_query($conn, "SELECT DISTINCT Users FROM payment WHERE Users != \"\"");
	$queryResults = array();
	while($row = mysqli_fetch_assoc($results)){
		$queryResults[] = $row["Users"];
	}
?>
	
<?php
	if (isset($_POST['submit'])){
		$member= $_POST['membername'];
		$query = "DELETE FROM payment WHERE Users = '{$member}'";
		$result = mysqli_query($conn, $query);
		
		if (!$result){die("Error: Failed to delete member.");}
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
	<form action="rmmember.php" method="post" class="form-horizontal">
		<fieldset>

		<!-- Form Name -->
		<legend>Remove Member from Current Session</legend>

		<!-- Dropdown List of Members -->
		<div class="form-group">
		  <label class="col-xs-5 col-xs-offset-3" for="membername">Member</label>  
		  <div class="col-xs-5 col-xs-offset-3">
			<select name="membername" class="form-control">
				<?php 
					for($count=0; $count < $results->num_rows; $count++){
						$name = $queryResults[$count];
						echo "<option value=\"{$name}\">{$name}"."</option>";
					}
				?>
			</select>
		  </div>
		</div>
		
		<!-- Submit/Cancel Buttons -->
		<div class="form-group">
		  <div class="col-xs-5 col-xs-offset-3">
			<button type="submit" name="submit" value="Submit" class="btn btn-default">Submit</button>
			<a class="btn btn-default btn-outline" href="main.php">Back</a>
			<?php if(isset($_POST['submit'])){echo " Member Removed!";} ?>
		  </div>
		</div>

		</fieldset>
	</form>
	
	<?php mysqli_free_result($results); ?>
	
</body>

