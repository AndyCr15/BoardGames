<?php

    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "root";
    private $dbName     = "aauk";
    //private $dbUsername = "androida_andyc";
    //private $dbPassword = "mYsqlp4ss.";
    //private $dbName     = "androida_aauk";
    private $userTbl    = 'boardgames';

	$link = mysqli_connect($hostname, $username, $password, $database);
	
	if (mysqli_connect_error()) {
		
		die("There was an error connecting to the database");
		
	}

?>
