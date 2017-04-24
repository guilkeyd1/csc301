<?php

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

<!-- THIS GETS INSERTED INTO PAGES -->
<div class="user_top">
	<div class="drop_down">
		<button class="drop_button open" onclick="expand()">Login / Register &#9660;</button>
		<div id="drop_menu" class="drop_menu open">
			<form method="POST">
				<input type="text" class="open" size="30" placeholder="Username" name="user_name">
				<input type="password" class="open" size="30" placeholder="Password" name="pass">
				<input type="submit" name="login_button" value="Login">
			</form>
			<a href="user_details.php?action=add">Not a member? Register</a>
		</div>
	</div>
</div>
<!-- END INSERT -->