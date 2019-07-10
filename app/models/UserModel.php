<?php
namespace app\models;
use \app\core\Model;

class UserModel extends Model {
	private $table = "Users";
	private $username;
	private $email;
	private $password;

	public function __construct() {
		parent::__construct();
	}

	public function save() {
		$query = $this
				->db
				->query()
				->buildInsert($this->table, ['username', 'email', 'password'])
				->getQuery();
		return $this->db->create($query,
			[
				$this->username,
				$this->email,
				$this->password
			]);
	}

	public function setUsername($username) {
		$this->username = $username;

		return $this;
	}

	public function setEmail($email) {
		$this->email = $email;

		return $this;
	}

	public function setPassword($password) {
		$this->password = $this->hashPassword($password);

		return $this;
	}
	
	public function hashPassword($password) {
		return password_hash($password, PASSWORD_DEFAULT);
	}
}