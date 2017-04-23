<?php

include('beginning.php');	// include boilerplate with config.php include

// if user is already logged in, redirect to dashboard
if(isset($site_user)) {
	header('location: dashboard.php');
}

// Login button functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user_name = $_POST['user_name'];
	$pass = $_POST['pass'];
	$params = array(
		'user_name' => $user_name,
		'password' => $pass
	);
	$statement = runQuery("attemptLogin", $params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	if(!empty($users)) {
		$site_user = $users[0];
		$_SESSION['user_id'] = $site_user['user_id'];
		header('location: dashboard.php');
	}
}
?>

<!-- BEGIN NON-BOILERPLATE CODE -->
		<div class="slogan_box"></div>
		<div class="login-box">
			<form method="POST">
				<!--<a href="" class="forgot">Forgot Password?</a>-->
				<h3>Sign in:</h3>
				<input type="text" size="30" placeholder="Username" name="user_name">
				<br>
				<input type="password" size="30" placeholder="Password" name="pass">
				<br>
				<input type="submit" name="login_button" value="Login">
				<div class="register">
					<!--New members <a href="register.php">join</a> here.-->
					New members <a href="user_details.php?action=add">join</a> here.
				</div>
			</form>
		</div>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?>	<!-- INCLUDE ENDING BOILERPLATE -->
