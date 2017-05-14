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
		$payer = $_POST['payer'];
		$desc = $_POST['description'];
		$members = $_POST['members'];
		$amount = (float) $_POST['amount']/count($members);
		for($count=0; $count < count($members); $count++){
			$query = "INSERT INTO payment (Users, Owers, Description, Amount) VALUES ('{$payer}', '{$members[$count]}', '{$desc}', ROUND({$amount}, 2))";
			$result = mysqli_query($conn, $query);
			if (!$result){die("Database query failed.");}
		}
	}
?>


<!DOCTYPE html>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="css/buttons.css" rel="stylesheet">
<head>
	<meta charset="UTF-8">	
	<title> IoU </title>	
</head>

<body>
	<!-- <div align="right"><a class="btn btn-default btn-outline" href="resetall.php">Reset Data</a></div> -->
	
	<form action="main.php" method="post" class="form-horizontal">
		<fieldset>

		<!-- Form Name -->
		<legend>
			<a style="float: right;" class="btn btn-default btn-outline btn-sm" href="resetall.php">Reset Data</a>
			Enter New Payment
		</legend>

		<!-- Payer -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="payer">Payer</label>
		  <div class="col-md-4">
			<select name="payer" class="form-control">
				<?php 
					for($count=0; $count < $results->num_rows; $count++){
						echo "<option value=\"{$queryResults[$count]}\">{$queryResults[$count]}</option>";
					}
				?>
			</select>
		  </div>
		</div>

		<!-- Payment Amount -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="amount">Payment Amount</label>  
		  <div class="col-md-4">
		  <input name="amount" type="text" placeholder="Enter Amount" class="form-control input-md">
		  </div>
		</div>

		<!-- Payment Description-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="description">Description</label>  
		  <div class="col-md-4">
		  <input name="description" type="text" placeholder="Payment Description Here" class="form-control input-md">
		  </div>
		</div>

		<!-- Checkboxes -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="members">Members to Include</label>
			<div class="col-md-4">
			<?php
				for($count=0; $count < $results->num_rows; $count++){
					$name=$queryResults[$count];
					echo '<div class="checkbox">'.
								'<label for="'.$name.'">'.'<input type="checkbox" name="members[]" value="'.$name.'">'.$name.'</label>'.
							'</div>';
				}
			?>
		  </div>
		</div>
		
		<!-- Submit Button -->
		<div class="form-group">
			<div class="col-xs-5 col-xs-offset-3">
				<input type="submit" name="submit" value="Submit" class="btn btn-default">
				<!-- Submission Confirmation Message -->
				<?php if(isset($_POST['submit'])){echo " Entry Added!";} ?>
			</div>
		</div>

		</fieldset>
	</form>

	<?php mysqli_free_result($results); ?>
			
	<div class="container">
		<div class="row" align="center">
				<br>
				<a class="btn btn-default btn-outline btn-lg" href="calculate.php">Calculate</a><br><br>
				<a class="btn btn-default btn-outline" href="breakdown.php">Spend Breakdown</a><br><br>
				<a class="btn btn-default btn-outline" href="rmpayment.php">Remove Payment</a><br><br>
				<a class="btn btn-default btn-outline" href="addmember.php">Add Member</a>		
				<a class="btn btn-default btn-outline" href="rmmember.php">Remove Member</a><br><br>
				<br>
			</ul>
		</div>
	</div>
</body>

</html>