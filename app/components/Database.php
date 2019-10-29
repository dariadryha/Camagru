<?php
namespace app\components;

use \app\helpers\builders\MySQLQueryBuilder;
use app\helpers\builders\QueryBuilder;

/**
 * Class Database
 * @package app\components
 */
class Database
{
    /** @var null|Database $instance */
	private static $instance = null;

    /** @var \PDO $connection */
	private $connection;

    /** @var \PDOStatement $stmt */
	private $stmt;

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

    public function prepare(string $sql, array $values = [])
    {
        $this->stmt = $this->connection->prepare($sql);

        return $this->stmt->execute($values);
    }

	public function exists($values)
    {
		$this->prepare("SELECT EXISTS ({$this->query()->getQuery()})", $values);

		return !!$this->stmt->fetchColumn();
	}

    /**
     * @param array $values
     * @return bool
     */
	public function timeDiff(array $values): bool
    {
        return $this->prepare('SELECT TIMESTAMPDIFF(SECOND, ?, NOW())', $values);
    }

    /**
     * @return Database
     */
	public static function load(): Database
    {
		if (!isset(self::$instance)) {
			self::$instance = new self(require_once PATH_CONFIG.'database.php');
		}

		return self::$instance;
	}

    /**
     * @return MySQLQueryBuilder
     */
	public function query(): MySQLQueryBuilder
    {
        return MySQLQueryBuilder::load();
    }

	public function exec($sql)
    {
		$this->connection->exec($sql); 
	}

	public static function closeConnection()
    {
	    self::$instance = null;
    }

    /**
     * @return mixed
     */
    public function getRecord()
    {
	    return $this->stmt->fetchColumn();
    }

    public function getLastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    /**
     * Return result of PDOStatement::execute
     *
     * @param array $values
     * @return bool
     */
    public function fulfillQuery(array $values = []): bool
    {
        $query = $this
            ->query()
            ->getQuery();



//        echo $query;
//        exit();

        return $this->prepare($query, $values);
    }

    /**
     * @return array
     */
    public function asArrays(): array
    {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array|bool
     */
    public function asArray()
    {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function read(string $table, array $select, array $where): bool
    {
        $this
            ->query()
            ->setTable($table)
            ->read($select, array_keys($where));

        return $this->fulfillQuery(array_values($where));
    }
}