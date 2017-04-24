UPDATE project_users
SET first_name = :first_name, last_name = :last_name, email = :email, image = :image, bio = :bio
WHERE user_id = :user_id;