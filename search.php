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

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
	<?php include('header.php') ?>	<!-- INCLUDE USER TOP BAR -->
	<h2>ARTICLE SEARCH RESULTS</h2>
	<table>
		<tr>
			<th width="5%"></th>
			<th width="51%">&nbsp;Title:</th>
			<th width="12%">&nbsp;Author:</th>
			<th width="12%">&nbsp;Date:</th>
			<th width="12%">&nbsp;Genre:</th>
		</tr>
		<?php foreach($articles as $article) : ?>
			<tr>
				<td>&nbsp;<a href="view_article.php?action=view&article=<?php echo $article['article_id'] ?>">View</a>
				<td>&nbsp;<?php echo $article['title'] ?></td>
				<td>&nbsp;<a href="user_details.php?user=<?php echo $article['author']?>&action=view"><?php echo $article['user_name'] ?></a></td>
				<td>&nbsp;<?php echo $article['date_written'] ?></td>
				<td>&nbsp;<?php echo $article['genre_name'] ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?>	<!-- INCLUDE ENDING BOILERPLATE -->