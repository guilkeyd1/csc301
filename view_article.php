<?php

include('beginning.php');	// include boilerplate with config.php include
$article_id = get('article');	// get article_id from the URL
$member_id = $site_user->getId();

// get article in question based on article_id in URL
$params = array('article_id' => $article_id);
$statement = runQuery('getArticle', $params);
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);
$article = $articles[0];

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
			<?php include('header.php'); ?>	<!-- INCLUDE USER TOP BAR -->
			<h2><?php echo $article['title'] ?></h2>
			<?php if($member_id == $article['user_id']) : ?>
				<div class="article_right">
					<a href="article_details.php?action=edit&article=<?php echo $article['article_id'] ?>">Edit</a>
				</div>
			<?php endif; ?>
			A <?php echo $article['genre_name'] ?> article by 
			<a href="profile.php?user=<?php echo $article['user_id'] ?>"><?php echo $article['user_name'] ?></a>
			<br><br>
			<p><?php echo $article['article_body'] ?></p>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->