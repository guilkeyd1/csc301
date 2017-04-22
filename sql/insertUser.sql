INSERT INTO project_users (user_name, password, register_date, first_name, last_name, email)
VALUES(:user_name, :password, now(), :first_name, :last_name, :email)