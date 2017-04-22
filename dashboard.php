<?php

include('beginning.php');	// include boilerplate with config.php include

// pull user's articles from the database to populate table
$params = array('user_id' => $site_user->getId());
$statement = runQuery('getDashboardArticles', $params);
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- BEGIN NON-BOILERPLATE CODE -->
		<?php include('header.php'); ?>
		<h2>ARTICLE ADMINISTRATION</h2>
		<?php if(sizeof($articles) < 1) : ?>
			<h3>You have no articles. <a href="new_article.php">Create an Article</a></h3>
		<?php else : ?>
			<div class="add_new">
				<a href="new_article.php">Add New</a>
			</div>
			<table>
				<tr>
					<th width="8%"></th>
					<th width="50%">&nbsp;Title:</th>
					<th width="10%">&nbsp;Date:</th>
					<th width="5%">&nbsp;Status:</th>
					<th width="7%">&nbsp;Genre:</th>
				</tr>
				<?php foreach($articles as $article) : ?>
					<tr>
						<td><a href="view_article.php?action=view&article=<?php echo $article['article_id'] ?>">View</a> 
							&nbsp;<a href="view_article.php?action=edit&article=<?php echo $article['article_id'] ?>">Edit</a>
						</td>
						<td>&nbsp;<?php echo $article['title'] ?></td>
						<td>&nbsp;<?php echo $article['date_written'] ?></td>
						<td>&nbsp;<?php echo $article['status'] ?></td>
						<td>&nbsp;<?php echo $article['genre_name'] ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
<!-- END NON-BOILERPLATE CODE -->
<?php include('end.php'); ?> <!-- INCLUDE ENDING BOILERPLATE -->