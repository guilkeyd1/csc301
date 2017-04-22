<?php

include('beginning.php');	// include boilerplate with config.php include

// if user is already logged in, redirect to dashboard
if(isset($site_user)) {
	header('location: dashboard.php');
}

// Submit button functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// set variables from form submission
	$user_name = $_POST['user_name'];
	$pass = $_POST['password'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	
	// set up parameters array
	$params = array(
		'user_name' => $user_name,
		'password' => $pass,
		'first_name' => $first_name,
		'last_name' => $last_name,
		'email' => $email
	);
	// run query to register user and redirect
	runQuery('insertUser', $params);
	header('location:index.php');
}
?>

<!-- BEGIN NON-BOILERPLATE CODE -->
		<form method="POST">
			Username: <input type="text" name="user_name" value="" /><br>
			Password: <input type="password" name="password" value="" /><br>
			First Name: <input type="text" name="first_name" value="" /><br>
			Last Name: <input type="text" name="last_name" value="" /><br>
			Email Address: <input type="text" name="email" value="" /><br>
			<input type="submit" value="Register" />
		</form>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?>	<!-- INCLUDE ENDING BOILERPLATE -->