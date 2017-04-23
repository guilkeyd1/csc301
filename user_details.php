<?php

include('beginning.php');			// include boilerplate with config.php include
$action = get('action');			// get action from URL for page setup

// determine if user is logged in
if(isset($site_user)) {
	$new_user = false;
	$member_id = $site_user->getId();
}
else {
	$new_user = true;
}

// functionality fork based on URL action
if($action == 'add') {
	if(!$new_user) {
		// redirect logged in user to edit methodology
		header('location: user_details.php?action=edit');
	}
	// initialize variables for insertion
	$user_name = "";
	$pass = "";
	$first_name = "";
	$last_name = "";
	$email = "";
}
elseif($action == 'edit') {
	if($new_user) {
		// redirect new user to registration methodology
		header('location: user_details.php?action=add');
	}
	// set variables from site_user User object
	$user_name = $site_user->getName();
	$register_date = $site_user->getRegisterDate();
	$first_name = $site_user->getFirstName();
	$last_name = $site_user->getLastName();
	$email = $site_user->getEmail();
}
// submit button functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($action == 'add') {
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
	elseif($action == 'edit') {
		// set variables from form submission
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		// setup parameters array
		$params = array(
			'user_id' => $member_id,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email
		);
		// run query to update user and redirect
		runQuery('updateUser', $params);
		header('location: profile.php?user=' . $member_id);
		
	}
}


?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php if(isset($site_user)) : ?>
				<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<?php endif; ?>
			<h2>User Details:</h2>
			<form method="POST">
				<label>Username:</label>
				<?php if(isset($site_user)) : ?>
					<?php echo $user_name ?>
					<br>
					<label>Member Since:</label>
					<?php echo $register_date ?>
					<br>
				<?php else : ?>
					<input type="text" name="user_name" value="<?php echo $user_name ?>" />
					<br>
					<label>Password:</label>
					<input type="password" name="password" value="<?php echo $pass ?>" />
					<br>
				<?php endif; ?>
				<label>First Name:</label>
				<input type="text" name="first_name" value="<?php echo $first_name ?>" />
				<br>
				<label>Last Name:</label>
				<input type="text" name="last_name" value="<?php echo $last_name ?>" />
				<br>
				<label>Email:</label>
				<input type="text" name="email" value="<?php echo $email ?>" />
				<br>
				<input type="submit" value="Submit"/>
			</form>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->