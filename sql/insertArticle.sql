INSERT INTO project_articles (title, author, status, genre, date_written, article_body)
VALUES(:title, :author, :status, :genre, now(), :article_body)