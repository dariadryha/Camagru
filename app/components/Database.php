<?php
namespace app\components;

use \app\helpers\builders\MySQLQueryBuilder;

/**
 * Class Database
 * @package app\components
 */
class Database
{
    /** @var null|Database $instance */
	private static $instance = null;
	private $connection;

    /**
     * Database constructor.
     * @param array $database
     */
	private function __construct(array $database)
    {
        //TODO php doc all file
		try {
			$this->connection = new \PDO("mysql:host={$database['host']};dbname={$database['dbname']}", $database['user'], $database['password'], $database['options']);
		} catch (\PDOException $e) {
   		 	die($e->getMessage());
		}
	}

	public function prepare(string $sql, array $values)
    {
		$stmt = $this->connection->prepare($sql);
		$stmt->execute($values);
		//var_dump($stmt);
		return $stmt;
	}

	public function exists($sql, $values)
    {
		$stmt = $this->prepare("SELECT EXISTS ($sql)", $values);
		return !!$stmt->fetchColumn();
	}

	public function create($sql, $values) {
		$stmt = $this->prepare($sql, $values);
		return $stmt;
	}

	public static function load(): Database
    {
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

	public static function closeConnection()
    {
	    self::$instance = null;
    }

    public function getRecord($sql, $values)
    {
	    $stmt = $this->prepare($sql, $values);
	    return $stmt->fetchColumn();
    }
}