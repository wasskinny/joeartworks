<?php
	
	// Database Details
	$dbHost = 'localhost';
	$dbUsername = 'joesartworks';
	$dbPassword = '-B9%zd!!A%;B:lz';
	$dbName = 'joesartworks';
	
	// Create connection and Select DB
	$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	
	if ($db->connect_error) {
		die("Unable to Connect to Database: " . $db->connect_error);
	}

?>