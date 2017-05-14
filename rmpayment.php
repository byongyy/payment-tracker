<?php 
	require "dbconnect.php"; 
	
	$results = mysqli_query($conn, "SELECT Description, SUM(Amount) as Amount FROM payment WHERE Description != 'Initialization' GROUP BY Description");
	$queryDesc = array();
	$queryAmount = array();
	while($row = mysqli_fetch_assoc($results)){
		$queryDesc[] = $row["Description"];
		$queryAmount[] = $row["Amount"];
	}
?>
	
<?php
	if (isset($_POST['submit'])){
		$desc = $_POST['desc'];
		$query = "DELETE FROM payment WHERE Description = '{$desc}'";
		$result = mysqli_query($conn, $query);
		
		if (!$result){die("Error: Failed to delete entry.");}
	}
?>

<!DOCTYPE html>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<head>
	<meta charset="UTF-8">	
	<title> IoU - Remove Payment</title>	
</head>

<body>
	<form action="rmpayment.php" method="post" class="form-horizontal">
		<fieldset>

		<!-- Form Name -->
		<legend>Remove a Payment</legend>

		<!-- Dropdown for Payment Choices-->
		<div class="form-group">
		  <label class="col-xs-5 col-xs-offset-3" for="membername">Payment</label>  
		  <div class="col-xs-5 col-xs-offset-3">
			<select name="desc" class="form-control">
				<?php 
					for($count=0; $count < $results->num_rows; $count++){
						echo "<option value=\"{$queryDesc[$count]}\">{$queryDesc[$count]}".", $"."{$queryAmount[$count]}"."</option>";
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
			<?php if(isset($_POST['submit'])){echo " Payment Removed!";} ?>
		  </div>
		</div>

		</fieldset>
	</form>
	
	<?php mysqli_free_result($results); ?>
	
</body>

