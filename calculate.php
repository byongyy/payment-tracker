<?php 
	require "dbconnect.php";
	
	$results = mysqli_query($conn, "SELECT Users, Owers, Amount FROM payment WHERE Users != Owers AND Users != \"\"");
	$results2 = mysqli_query($conn, "SELECT DISTINCT Users FROM payment WHERE Users != \"\"");
	$distinctUsers = array();
	while($row = mysqli_fetch_assoc($results2)){
		$distinctUsers[] = $row["Users"];
	}
?>

<?php
	function in_array_2d($value, $array){
		foreach($array as $row){
			if(in_array($value, $row)){
				return true;
			}
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
	
	<div class="container">
		<table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
			<thead>                        
				<tr>
					<th>Member</th>
					<th>Pays To</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<br><br><br>
				<?php
					$memberPairs = array();
					for($i = 0; $i < sizeof($distinctUsers); $i++){
						for($j = $i+1; $j < sizeof($distinctUsers); $j++){
							$pair = $distinctUsers[$i].','.$distinctUsers[$j];
							array_push($memberPairs, array($pair, 0));
						}
					}
					
					while($row = mysqli_fetch_assoc($results)){
						$user = $row["Users"];
						$ower = $row["Owers"];
						$amount = $row["Amount"];
						$pair = $user.','.$ower;
						$pairReverse = $ower.','.$user;
						for($count = 0; $count < sizeof($memberPairs); $count++){
							if($pair == $memberPairs[$count][0]){
								$memberPairs[$count][1] += $amount;
							} elseif($pairReverse == $memberPairs[$count][0]){
								$memberPairs[$count][1] -= $amount;									
							}
						}							
					}
					
					foreach($memberPairs as $row){
						$temp = explode(",", $row[0]);
						$member1 = $temp[0];
						$member2 = $temp[1];
						$amount = $row[1];
						if($amount > 0){
							echo '<tr>
										<td>' .$member2. '</td>
										<td>' .$member1. '</td>
										<td>' .'$'.$amount. '</td>
									</tr>';
						} elseif($amount < 0){
							echo '<tr>
										<td>' .$member1. '</td>
										<td>' .$member2. '</td>
										<td>' .'$'.-1*$amount. '</td>
									</tr>';								
						}
					}
				?>
			</tbody>
		</table>
			
		<!-- Back Button -->
		<a class="btn btn-default btn-outline" href="main.php">Back</a>
				
     </div>
	
	<?php mysqli_free_result($results); ?>
	
</body>

