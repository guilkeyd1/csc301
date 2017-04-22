<?php

include('beginning.php');	// include boilerplate with config.php include
$action = get('action');	// get action from URL for page setup
$article_id = get('article');	// get article_id from the URL

// get article in question based on article_id in URL
$params = array('article_id' => $article_id);
$statement = runQuery('getArticle', $params);
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
$article = $articles[0];

// get genre options from the database for drop down
$params = array();
$statement = runQuery('getGenres', $params);
$genres = $statement->fetchAll(PDO::FETCH_ASSOC);

// Submit button functionality for editing articles
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// set insertion variables
	$title = $_POST['title'];
	$status = $_POST['status'];
	$genre = $_POST['genre'];
	$body = $_POST['article_body'];
	$article_id = $_POST['article_id'];
	
	$params = array(
		'title' => $title,
		'status' => $status,
		'genre' => $genre,
		'article_body' => $body,
		'article_id' => $article_id
	);
	runQuery('updateArticle', $params);
	header('location:dashboard.php');
}
?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<?php if($action == 'edit' && $site_user->getId() == $article['author']) : ?>
				<h2>Editing: <?php echo $article['title'] ?></h2>
				<form method="POST">
					<input type="hidden" name="author" value="<?php echo $article['author'] ?>" />
					<input type="hidden" name="article_id" value="<?php echo $article['article_id'] ?>" />
					<label>Title:</label>
					<input type="text" name="title" size="70" value="<?php echo $article['title'] ?>"/>
					<label>&nbsp;Genre:</label>
					<select name="genre">
						<?php foreach($genres as $genre) : ?>
							<?php if($genre['genre_id'] == $article['genre_id']) : ?>
								<option value="<?php echo $genre['genre_id'] ?>" selected="selected"><?php echo $genre['genre_name'] ?></option>
							<?php else : ?>
								<option value="<?php echo $genre['genre_id'] ?>"><?php echo $genre['genre_name'] ?></option>
							<?php endif; ?>
						<?php endforeach ?>
					</select>
					<label>&nbsp;Viewability:</label>
					<select name="status">
						<?php if($article['status'] == 'Public') : ?>
							<option value="Public" selected="selected">Public</option>
							<option value="Hidden">Hidden</option>
						<?php elseif($article['status'] == 'Hidden') : ?>
							<option value="Public">Public</option>
							<option value="Hidden" selected="selected">Hidden</option>
						<?php endif; ?>
					</select>
					<br>
					<br>
					<textarea name="article_body" cols="96" rows="20"><?php echo $article['article_body'] ?></textarea>
					<br>
					<div class="right-align">
						<input type="submit" value="Submit" />
					</div>
				</form>
			<?php else : ?>
				<h2><?php echo $article['title'] ?></h2>
				A <?php echo $article['genre_name'] ?> article by 
				<a href="user_details.php?user=<?php echo $article['user_id'] ?>&action=view"><?php echo $article['user_name'] ?></a>
				<br><br>
				<p><?php echo $article['article_body'] ?></p>
			<?php endif; ?>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->