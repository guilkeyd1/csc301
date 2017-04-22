<?php

include('beginning.php');	// include boilerplate with config.php include
$action = get('action');	// get action from URL for page setup
$user = get('user');		// get user_id for profile acquisition
$member_id = $site_user->getId();		// get user's user_id for comparison

// get profile details for specified user
$params = array('user_id' => $user);
$statement = runQuery('getUser', $params);
$profiles = $statement->fetchAll(PDO::FETCH_ASSOC);
$profile = $profiles[0];

// setup Submit button functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$params = array(
		'user_id' => $member_id,
		'first_name' => $first_name,
		'last_name' => $last_name,
		'email' => $email
	);
	runQuery('updateUser', $params);
	header('location: user_details.php?user=' . $member_id . '&action=view');
}
?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<h2>User Details: <?php echo $profile['user_name'] ?></h2>
			<form method="POST">
				User ID: <?php echo $profile['user_id'] ?><br>
				Username: <?php echo $profile['user_name'] ?><br>
				Password: <?php echo $profile['password'] ?><br>
				Registration Date: <?php echo $profile['register_date'] ?><br>
				<?php if($action == 'edit' && $profile['user_id'] == $member_id) : ?>
					First Name: <input type="text" name="first_name" value="<?php echo $profile['first_name'] ?>" /><br>
					Last Name: <input type="text" name="last_name" value="<?php echo $profile['last_name'] ?>" /><br>
					Email Address: <input type="text" name="email" value="<?php echo $profile['email'] ?>" /><br>
					<input type="submit" value="Update" />
				<?php else : ?>
					First Name: <?php echo $profile['first_name'] ?><br>
					Last Name: <?php echo $profile['last_name'] ?><br>
					Email Address: <?php echo $profile['email'] ?><br>
					<?php if($profile['user_id'] == $member_id) : ?>
						<a href="user_details.php?user=<?php echo $_SESSION['user_id']?>&action=edit">test</a>
					<?php endif; ?>
				<?php endif; ?>
			</form>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->