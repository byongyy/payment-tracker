<?php

    session_start(); 
	require_once 'dbconnect.php';
    
    if (isset($_SESSION['current_user'])!="") 
    {
        //print "A is " . $_SESSION['current_user'];
        $current_user = $_SESSION['current_user'];
    }
    else  
    {
        //print "B is " . $_SESSION['current_user'];
        $_SESSION['current_user'] = "guest";
        $current_user = "guest";
    }


?>