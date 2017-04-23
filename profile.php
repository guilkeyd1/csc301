<?php

include('beginning.php');			// include boilerplate with config.php include
$user = get('user');				// get user_id from URL for page setup
$member_id = $site_user->getId();	//get user's user_id for comparison

// get profile details for specified user
$params = array('user_id' => $user);
$statement = runQuery('getUser', $params);
$profiles = $statement->fetchAll(PDO::FETCH_ASSOC);
$profile = $profiles[0];

// query database for number of articles by user
$params = array('user_id' => $profile['user_id']);
$statement = runQuery('getDashboardArticles', $params);
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<h2>User Details: <?php echo $profile['user_name'] ?></h2>
			<label>Username:</label>
			<?php echo $profile['user_name'] ?>
			<br>
			<label>Member Since:</label>
			<?php echo $profile['register_date'] ?>
			<br>
			<label>First Name:</label>
			<?php echo $profile['first_name'] ?>
			<br>
			<label>Last Name:</label>
			<?php echo $profile['last_name'] ?>
			<br>
			<label>Email Address:</label>
			<?php echo $profile['email'] ?>
			<br>
			<label>Total Articles:</label>
			<a href="search.php?search_term=<?php echo $profile['user_name'] ?>&search_type=author"><?php echo sizeof($articles) ?></a>
			<br>
			<?php if($member_id == $user) : ?>
				<a href="user_details.php?action=edit">Edit Details</a>
			<?php endif; ?>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->