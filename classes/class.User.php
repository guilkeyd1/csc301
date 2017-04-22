<?php
class User {

	private $user_id;
	private $user_name;
	private $register_date;
	private $first_name;
	private $last_name;
	private $email;
	private $database;
	
	function __construct($user_id, $database) {
		
		$sql = file_get_contents('sql/getUser.sql');
		$params = array(
			'user_id' => $user_id,
			);
			
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$users = $statement->fetchAll(PDO::FETCH_ASSOC);
		$site_user = $users[0];
		
		$this->user_id = $site_user['user_id'];
		$this->user_name = $site_user['user_name'];
		$this->register_date = $site_user['register_date'];
		$this->first_name = $site_user['first_name'];
		$this->last_name = $site_user['last_name'];
		$this->email = $site_user['email'];
		$this->database = $database;
	}
	
	function getId() {
		return $this->user_id;
	}
	
	function getName() {
		return $this->user_name;
	}
	
	function getRegisterDate() {
		return $this->register_date;
	}
	
	function getFirstName() {
		return $this->first_name;
	}
	
	function getLastName() {
		return $this->last_name;
	}
	
	function getEmail() {
		return $this->email;
	}
}
?>