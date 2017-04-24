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

// calculate number of public articles
$public_articles = 0;
foreach ($articles as $article) {
	if($article['status'] == 'Public') {
		$public_articles++;
	}
}

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<div class="profile_container">
				<div class="profile_image">
					<img class="profile_pic" src="<?php echo $profile['image'] ?>">
				</div>
				<div class="profile_block">
					<div class="profile_name">
						<?php if($member_id == $user) : ?>
							<div class="profile_edit">
								<a href="user_details.php?action=edit">Edit</a>
							</div>
						<?php endif; ?>
						<h1><?php echo $profile['first_name'] ?> <?php echo $profile['last_name'] ?></h1>
					</div>
					<div class="profile_small">
						<label>Username:</label>
						<?php echo $profile['user_name'] ?>
					</div>
					<div class="profile_small">
						<label>Member Since:</label>
						<?php echo $profile['register_date'] ?>
					</div>
					<div class="profile_small">
						<label>Contact:</label>
						<a href="mailto:<?php echo $profile['email'] ?>">Email <?php echo $profile['first_name']?></a>
					</div>
					<div class="profile_small">
						<label>Public Articles:</label>
						<a href="search.php?search_term=<?php echo $profile['user_name'] ?>&search_type=author"><?php echo $public_articles ?> (View List)</a>
					</div>
					<div class="bio_box">
						<label>About <?php echo $profile['first_name'] ?>:</label>
						<?php echo $profile['bio'] ?>
					</div>
				</div>
			</div>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->