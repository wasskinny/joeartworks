<?php
	
	
	$host = "localhost";
	$username = "joeartworks";
	$password = "-B9%zd!!A%;B:lz";
	$dbname = "joesartworks";
	
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
	
	try {
		$db1 = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
	}
	catch(PDOException $ex)
	{
		die("Failed to connect to the databse: " . $ex->getMessage());
	}
	
	$db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db1->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	header('Content-Type: text/html; charset=utf-8');
	
	session_start();
?>