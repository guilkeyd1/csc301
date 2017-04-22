<?php

function runQuery($sqlFile, $params) {
	include('connection.php');
	$sql = file_get_contents('sql/' . $sqlFile . '.sql');
	$statement = $database->prepare($sql);
	$statement->execute($params);
	return $statement;
}

// Generic helper function to get URL-passed values
function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	else {
		return '';
	}
}
?>