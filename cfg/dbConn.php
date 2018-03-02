<?php
	// Database connection
	$conn = mysqli_connect('localhost', 'root', '', 'GF1login');
	if (!$conn){
		die ("Connection fail:". mysqli_connect_error());
		echo "Connection to the database failed!";
	}


	//Login System Connection - Index/Login
	$link = mysqli_connect('127.0.0.1', 'root', 'admin', 'GF1login');

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>