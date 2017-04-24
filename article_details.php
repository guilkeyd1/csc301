<?php

include('beginning.php');		// include boilerplate with config.php include
$action = get('action');		// get action from URL for page setup
$article_id = get('article');	// get article_id from the URL
$member_id = $site_user->getId();	// get user's user_id for comparison

// get genre options from the database to populate drop down
$params = array();
$statement = runQuery('getGenres', $params);
$genres = $statement->fetchAll(PDO::FETCH_ASSOC);

// functionality fork based on URL action value
if($action == 'add') {
	
	// initialize variables for insertion
	$title = "";
	$body = "";
	
}
elseif($action == 'edit') {
	
	// get article in question based on article_id in URL
	$params = array('article_id' => $article_id);
	$statement = runQuery('getArticle', $params);
	$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
	$article = $articles[0];
	
	// redirect if user is not article's author
	if($member_id != $article['author']) {
		header('location: view_article.php?article=' . $article['article_id']);
	}
	
	// set variables from article for insertion
	$title = $article['title'];
	$author = $article['user_name'];
	$status = $article['status'];
	$body = $article['article_body'];
	$article_id = $article['article_id'];

}

// Submit button functionality for editing articles
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	// functionality fork based on action
	if($action == 'add') {
		
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
		header('location: dashboard.php');
	}
	elseif($action == 'edit') {
			
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
		header('location: dashboard.php');
	}
}
?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<h2>
			<?php if($action == 'edit') : ?>
				Edit
			<?php endif; ?>
			Article Details:</h2>
			<form method="POST">
				<input type="hidden" name="author" value="<?php echo $member_id ?>" />
				<?php if($action == 'edit') : ?>
					<input type="hidden" name="article_id" value="<?php echo $article_id ?>" />
				<?php endif; ?>
				<label>Title:</label>
				<input type="text" name="title" size="70" value="<?php echo $title ?>"/>
				<label>&nbsp;Genre:</label>
				<select name="genre">
					<?php foreach($genres as $genre) : ?>
						<?php if($action == 'edit' && $genre['genre_id'] == $article['genre_id']) : ?>
							<option value="<?php echo $genre['genre_id'] ?>" selected="selected"><?php echo $genre['genre_name'] ?></option>
						<?php else : ?>
							<option value="<?php echo $genre['genre_id'] ?>"><?php echo $genre['genre_name'] ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
				<label>&nbsp;Viewability:</label>
				<select name="status">
					<?php if($action == 'edit') : ?>
						<?php if($status == 'Public') : ?>
							<option value="Public" selected="selected">Public</option>
							<option value="Hidden">Hidden</option>
						<?php elseif($status == 'Hidden') : ?>
							<option value="Public">Public</option>
							<option value="Hidden" selected="selected">Hidden</option>
						<?php endif; ?>
					<?php else : ?>
						<option value="Public">Public</option>
						<option value="Hidden">Hidden</option>
					<?php endif; ?>
				</select>
				<br>
				<br>
				<textarea name="article_body" cols="96" rows="20"><?php echo $body ?></textarea>
				<br>
				<div class="right-align">
					<input type="submit" value="Submit" />
				</div>
			</form>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->