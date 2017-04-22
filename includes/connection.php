<?php
	// Connection to the MySQL database
	$user = 'guilkeyd1';
	$password = 'yQsy6uRN';
	
	$database = new PDO(
		'mysql:host=localhost;dbname=db_spring17_guilkeyd1',
		$user, $password
	);
?>
