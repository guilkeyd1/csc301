<?php
?>

<!-- BEGIN BOILERPLATE CODE -->
		</div>
		<div class="footer"></div>
	</main>
	<div class="copyright">
		<?php if(isset($site_user)) : ?>
			<a href="profile.php?user=<?php echo $site_user->getId() ?>">Profile</a>
			&nbsp;|&nbsp;
			<a href="dashboard.php">Dashboard</a>
			&nbsp;|&nbsp;
			<a href="search.php">Search</a>
			&nbsp;|&nbsp;
			<a href="logout.php">Logout</a>
		<?php else : ?>
			<a href="index.php">Home</a>
			&nbsp;|&nbsp;
			<a href="user_details.php?action=add">Register</a>
		<?php endif; ?>
		<br>
		&copy; 2017 Daniel Guilkey CSC301
	</div>
</body>
</html>