<?php

    $dbHost     = "localhost";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbName     = "aauk";
    //$dbUsername = "androida_andyc";
    //$dbPassword = "mYsqlp4ss.";
    //$dbName     = "androida_aauk";
    

	$link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
	
	if (mysqli_connect_error()) {
		
		die("There was an error connecting to the database");
		
	}

?>
