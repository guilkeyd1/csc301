<?php

// get the user's user_id
$member_id = $site_user->getId();

?>

<script>
	// toggle display of drop down on button click
	function expand() {
		document.getElementById("drop_menu").classList.toggle("show");
	}

	// toggle off display of drop down on outside click
	window.onclick = function(e) {
		if (!e.target.matches('.drop_button')) {
			var drop_menu = document.getElementById("drop_menu");
			if (drop_menu.classList.contains('show')) {
				drop_menu.classList.remove('show');
			}
		}
	}
</script>

<!-- THIS GETS INSERTED INTO PAGES -->
<div class="user_top">
	<div class="search_area">
		<form action="search.php" method="GET">
			<input type="text" name="search_term" size="30" placeholder="Search..." />
			<select name="search_type">
				<option vaule="title">by Title</option>
				<option value="author">by Author</option>
				<option value="genre">by Genre</option>
			</select>
			<input type="submit" value="Search">
		</form>
	</div>
	<div class="drop_down">
		<?php if(isset($site_user)) : ?>
			<button class="drop_button" onclick="expand()">Hello <?php echo $site_user->getName() ?> &#9660;</button>
			<div id="drop_menu" class="drop_menu">
				<a href="user_details.php?user=<?php echo $site_user->getId() ?>&action=view">My Profile</a>
				<a href="dashboard.php">Dashboard</a>
				<a href="logout.php">Logout</a>
			</div>
		<?php endif ?>
	</div>
</div>
<!-- END INSERT -->