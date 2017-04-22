<?php

include('includes/config.php');		// include necessary config
session_destroy();					// destroy the current session
header('location: index.php');		// redirect browser to index.php
	
?>