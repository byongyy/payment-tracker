<?php
    $host = "payment-calculator:us-central1:iou-db";
	$user = "root";
    $pwd = "password"; 
    $dbname = "iou";

    $conn = mysqli_connect($host,$user,$pwd,$dbname);

    if (mysqli_connect_errno()){
        die("DB Connection Failed : " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    } 
?>
 
