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
	$image = "";
	$bio = "";
}
elseif($action == 'edit') {
	if($new_user) {
		// redirect new user to registration methodology
		header('location: user_details.php?action=add');
	}
	
	// get profile details for specific user
	$params = array('user_id' => $site_user->getId());
	$statement = runQuery('getUser', $params);
	$profiles = $statement->fetchAll(PDO::FETCH_ASSOC);
	$profile = $profiles[0];
	
	// set variables from site_user User object
	$user_name = $profile['user_name'];
	$register_date = $profile['register_date'];
	$first_name = $profile['first_name'];
	$last_name = $profile['last_name'];
	$email = $profile['email'];
	$image = $profile['image'];
	$bio = $profile['bio'];
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
		$bio = $_POST['bio'];
		// set up parameters array
		$params = array(
			'user_name' => $user_name,
			'password' => $pass,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'bio' => $bio
		);
		// run query to register user
		runQuery('insertUser', $params);

		// log new user in and redirect to profile
		$params = array(
			'user_name' => $user_name,
			'password' => $pass
		);
		$statement = runQuery("attemptLogin", $params);
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
		if(!empty($users)) {
			$site_user = $users[0];
			$_SESSION['user_id'] = $site_user['user_id'];
			header('location: profile.php?user=' . $_SESSION['user_id']);
		}
	}
	elseif($action == 'edit') {
		// set variables from form submission
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$image = $_POST['image'];
		$bio = $_POST['bio'];
		// setup parameters array
		$params = array(
			'user_id' => $member_id,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'image' => $image,
			'bio' => $bio
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
				<h2>Edit User Details:</h2>
			<?php else : ?>
				<?php include('login.php'); ?>	<!-- INCLUDE USER TOP BAR -->
				<h2>Enter User Details:</h2>
			<?php endif; ?>
			<div class="register_layout">
				<div class="register_image">
					<img src="./images/08_splash.png">
				</div>
				<div class="register_data">
					<form method="POST">
						<div class="details_label">
							<label>Username:</label>
						</div>
						<?php if(isset($site_user)) : ?>
							<div class="details_box">
								<?php echo $user_name ?>
							</div>
							<div class="details_label">
								<label>Member Since:</label>
							</div>
							<div class="details_box">
								<?php echo $register_date ?>
							</div>
						<?php else : ?>
							<div class="details_box">
								<input type="text" size="40" name="user_name" value="<?php echo $user_name ?>" />
							</div>
							<div class="details_label">
								<label>Password:</label>
							</div>
							<div class="details_box">
								<input type="password" size="40" name="password" value="<?php echo $pass ?>" />
							</div>
						<?php endif; ?>
						<div class="details_label">
							<label>First Name:</label>
						</div>
						<div class="details_box">
							<input type="text" name="first_name" size="40" value="<?php echo $first_name ?>" />
						</div>
						<div class="details_label">
							<label>Last Name:</label>
						</div>
						<div class="details_box">
							<input type="text" name="last_name" size="40" value="<?php echo $last_name ?>" />
						</div>
						<div class="details_label">
							<label>Email:</label>
						</div>
						<div class="details_box">
							<input type="text" name="email" size="40" value="<?php echo $email ?>" />
						</div>
						<?php if(isset($site_user)) : ?>
							<div class="details_label">
								<label>Image URL:</label>
							</div>
							<div class="details_box">
								<input type="text" name="image" size="40" value="<?php echo $image ?>" />
							</div>
						<?php endif; ?>
						<div class="details_label">
							<label>Biography:</label>
						</div>
						<div class="details_box">
							<textarea name="bio" cols="30" rows="5"><?php echo $bio ?></textarea>
						</div>
						<div class="details_submit">
							<input type="submit" value="Submit"/>
						</div>
					</form>
				</div>
			</div>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->