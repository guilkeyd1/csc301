<?php

	include('connection.php');							// include database connection
	include('functions.php');							// include functions file
	$current_url = basename($_SERVER['REQUEST_URI']);	// get current URL
	
	// declare class autoloader function and register it
	function includeClass($className) {
		include 'classes/class.' . $className. '.php';
	}
	spl_autoload_register('includeClass');

	// start the session
	session_start();
	
	// determine if current URL is for not-signed-in users
	if($current_url != 'index.php' && $current_url != 'user_details.php?action=add') {
		$nosession = true;
	}
	else {
		$nosession = false;
	}
	
	// if user_id isn't set in $_SESSION and current_url is a $nosession url
	if(!isset($_SESSION['user_id']) && $nosession) {
		header('location: index.php');
	}
	elseif(isset($_SESSION['user_id'])) {
		$site_user = new User($_SESSION['user_id'], $database);
	}
	
?>
