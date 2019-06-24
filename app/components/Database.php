<?php
namespace app\components;
use \app\helpers\builders\MySQLQueryBuilder;

class Database {
	private static $instance = NULL;
	private $connection;

	private function __construct($database) {
		try {
			$this->connection = new \PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['password'], $database['options']);
		} catch (\PDOException $e) {
   		 	die($e->getMessage());
		}
	}

	public function prepare($sql, $values) {
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($values);
		return $stmt;
	}

	public function exists($sql, $values) {
		$stmt = $this->prepare("SELECT EXISTS ($sql)", $values);
		return !!$stmt->fetchColumn();
	}

	public function create($sql, $values) {
		$stmt = $this->prepare($sql, $values);
		return $stmt;
	}

	public static function load() {
		if (!isset(self::$instance)) {
			self::$instance = new self(require_once PATH_CONFIG.'database.php');
		}
		return self::$instance;
	}

	public function query() {
		return new MySQLQueryBuilder;
	}

	public function exec($sql) {
		$this->connection->exec($sql); 
	}
}