<?php

include('beginning.php');	// include boilerplate with config.php include

// get genre options from the database for drop down
$params = array();
$statement = runQuery('getGenres', $params);
$genres = $statement->fetchAll(PDO::FETCH_ASSOC);

// Login button functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// set insertion variables
	$title = $_POST['title'];
	$author = $_POST['author'];
	$status = $_POST['status'];
	$genre = $_POST['genre'];
	$body = $_POST['article_body'];
		
	$params = array(
		'title' => $title,
		'author' => $author,
		'status' => $status,
		'genre' => $genre,
		'article_body' => $body
	);
	runQuery('insertArticle', $params);
	header('location:dashboard.php');
}
?>

<!-- BEGIN NON-BOILERPLATE CODE -->
		<?php include('header.php'); ?>
		<h2>Create New Article</h2>
		<form method="POST">
			<input type="hidden" name="author" value="<?php echo $site_user->getId() ?>" />
			<label>Title:</label>
			<input type="text" name="title" size="70"/>
			<label>&nbsp;Genre:</label>
			<select name="genre">
				<?php foreach($genres as $genre) : ?>
					<option value="<?php echo $genre['genre_id'] ?>"><?php echo $genre['genre_name'] ?></option>
				<?php endforeach ?>
			</select>
			<label>&nbsp;Viewability:</label>
			<select name="status">
				<option value="Public">Public</option>
				<option value="Hidden">Hidden</option>
			</select>
			<br>
			<br>
			<textarea name="article_body" cols="96" rows="20"></textarea>
			<br>
			<div class="right-align">
				<input type="submit" value="Submit" />
			</div>
		</form>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?>	<!-- INCLUDE ENDING BOILERPLATE -->