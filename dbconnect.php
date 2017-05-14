<?php
    $host = "35.188.87.193";
	$user = "root";
    $pwd = "password"; 
    $dbname = "iou";

    $conn = mysqli_connect($host,$user,$pwd,$dbname);

    if (mysqli_connect_errno()){
        die("DB Connection Failed : " . mysqli_connect_error() . "(" . mysqli_connect_errno() . ")");
    } 
?>
 
