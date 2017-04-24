<?php

include('beginning.php');	// include boilerplate with config.php include

// if user is already logged in, redirect to dashboard
if(isset($site_user)) {
	header('location: dashboard.php');
}

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
		<?php include('login.php'); ?>
		<div class="slogan_box"></div>
		<a href="user_details.php?action=add"><img src="./images/07_Ribbons.png"><a/>
		
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?>	<!-- INCLUDE ENDING BOILERPLATE -->
