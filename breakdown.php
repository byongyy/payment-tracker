<?php 
	require "dbconnect.php"; 
	
	$results = mysqli_query($conn, "SELECT DISTINCT Users FROM payment WHERE Users != \"\"");
	$distinctUsers = array();
	while($row = mysqli_fetch_assoc($results)){
		$distinctUsers[] = $row["Users"];
	}
?>

<?php 
	if(isset($_POST['submit'])){
		$user = $_POST['membername'];
	$query = "SELECT Description, Amount FROM payment WHERE Amount != 0 AND Owers = \"{$user}\"";
		$results = mysqli_query($conn, $query);
		$queryResults = array();
		while($row = mysqli_fetch_assoc($results)){
			array_push($queryResults, $row);
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
	<title> IoU - Calculate </title>	
</head>

<body>

	<form action="breakdown.php" method="post" class="form-horizontal">
		<fieldset>

		<!-- Form Name -->
		<legend>Select Member to Show Spend Breakdown</legend>

		<!-- Dropdown List of Members -->
		<div class="form-group">
		  <label class="col-xs-5 col-xs-offset-3" for="membername">Member</label>  
		  <div class="col-xs-5 col-xs-offset-3">
			<select name="membername" class="form-control">
				<?php 
					for($count=0; $count < sizeof($distinctUsers); $count++){
						$name = $distinctUsers[$count];
						echo "<option value=\"{$name}\">{$name}"."</option>";
					}
				?>
			</select>
		  </div>
		</div>
		
		<!-- Show/Cancel Buttons -->
		<div class="form-group">
		  <div class="col-xs-5 col-xs-offset-3">
			<button type="submit" name="submit" value="Show" class="btn btn-default">Show</button>
			<a class="btn btn-default btn-outline" href="main.php">Back</a>
		  </div>
		</div>

		</fieldset>
	</form>
	
	<div class="container">
		<table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
			<caption><h3><b><?php if(isset($_POST['submit'])){echo $user;} ?></b></h3></caption>
			<thead>                        
				<tr>
					<th>Payment Description</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<br><br>
				<?php
					$sum = 0;
					foreach($queryResults as $row){
						$desc = $row["Description"];
						$amt = $row["Amount"];
						$sum += $amt;
						echo '<tr>
									<td>' .$desc. '</td>
									<td>' .'$'.$amt. '</td>
								</tr>';
					}
					echo '<tr>
								<td>'.'<strong>' ."Total". '</strong>'.'</td>
								<td>'.'<strong>' .'$'.$sum. '</strong>'.'</td>
							</tr>';
				?>
			</tbody>
		</table>
				
     </div>
	
	<?php mysqli_free_result($results); ?>
	
</body>

