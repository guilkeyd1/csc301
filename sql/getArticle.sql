SELECT *
FROM project_users
JOIN project_articles on project_articles.author = project_users.user_id
JOIN project_genre on project_genre.genre_id = project_articles.genre
WHERE project_articles.article_id = :article_id