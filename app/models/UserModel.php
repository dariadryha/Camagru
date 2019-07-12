<?php
namespace app\models;

use \app\core\Model;

/**
 * Class UserModel
 * @package app\models
 */
class UserModel extends Model
{
    /** @var string $table */
	private $table = 'Users';

    /** @var string $username */
	private $username;

    /** @var string $email */
	private $email;

    /** @var string $password */
	private $password;

	public function __construct()
    {
		parent::__construct();
	}

	public function save()
    {
        //TODO php doc, type hint
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

    /**
     * @param string $username
     * @return UserModel
     */
	public function setUsername(string $username): UserModel
    {
		$this->username = $username;

		return $this;
	}

    /**
     * @param string $email
     * @return UserModel
     */
	public function setEmail(string $email): UserModel
    {
		$this->email = $email;

		return $this;
	}

    /**
     * @param string $password
     * @return UserModel
     */
	public function setPassword(string $password): UserModel
    {
		$this->password = $this->hashPassword($password);

		return $this;
	}

    /**
     * @param string $password
     * @return bool|string
     */
	public function hashPassword(string $password)
    {
        //TODO type hint bool or string: only DOC?
		return password_hash($password, PASSWORD_DEFAULT);
	}
}