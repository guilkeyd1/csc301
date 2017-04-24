<?php

include('beginning.php');	// include boilerplate with config.php include

// get supplied search criteria from URL
if(isset($_GET['search_term']) && isset($_GET['search_type'])) {
	$search_term = $_GET['search_term'];
	$search_type = $_GET['search_type'];
}
else {
	$search_term = "";
	$search_type = "title";
}

// set search_term into params and conduct search
$params = array('search_term' => $search_term);
if($search_type == 'author') {
	$statement = runQuery('searchArticlesAuthor', $params);
}
elseif($search_type == 'genre') {
	$statement = runQuery('searchArticlesGenre', $params);
}
else {
	$statement = runQuery('searchArticlesTitle', $params);
}
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
$count = 0;
foreach($articles as $art) {
	$count++;
}
	

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
	<?php include('header.php') ?>	<!-- INCLUDE USER TOP BAR -->
	<h2>ARTICLE SEARCH RESULTS</h2>
	<table>
		<tr>
			<th width="56%">&nbsp;Title:</th>
			<th width="12%">&nbsp;Author:</th>
			<th width="12%">&nbsp;Date:</th>
			<th width="12%">&nbsp;Genre:</th>
		</tr>
		<?php if($count == 0) : ?>
			<tr>
				<td colspan="4" style="text-align:center;">No Matches Found</td>
			</tr>
		<?php else: ?>
			<?php foreach($articles as $article) : ?>
				<?php if($article['status'] != 'Hidden') : ?>
					<tr>
						<td>&nbsp;<a href="view_article.php?article=<?php echo $article['article_id'] ?>"><?php echo $article['title'] ?></a></td>
						<td>&nbsp;<a href="profile.php?user=<?php echo $article['author']?>"><?php echo $article['user_name'] ?></a></td>
						<td>&nbsp;<?php echo $article['date_written'] ?></td>
						<td>&nbsp;<a href="search.php?search_term=<?php echo $article['genre_name'] ?>&search_type=genre"><?php echo $article['genre_name'] ?></a></td>
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?>	<!-- INCLUDE ENDING BOILERPLATE -->