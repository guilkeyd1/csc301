SELECT *
FROM project_users
WHERE
	user_name = :user_name AND
	password = :password