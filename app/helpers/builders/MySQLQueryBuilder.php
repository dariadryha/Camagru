<?php 
namespace app\helpers\builders;

use app\components\Query;

class MySQLQueryBuilder implements SQLQueryBuilder
{
    /** @var QueryBuilder|null $instance */
    private static $instance;

    /** @var Query $query */
    private $query;

    /**
     * MySQLQueryBuilder constructor.
     */
    private function __construct()
    {
        $this->reset();
    }

    /**
     * Reset query property of SQLQueryBuilder instance
     */
    public function reset()
    {
        $this->query = new Query();
    }

    /**
     * @return MySQLQueryBuilder
     */
    public static function load(): MySQLQueryBuilder
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        $parts = array_filter($this->query->getParts());
        $this->reset();

        return implode(' ', $parts);
    }

    /**
     * @param string $clause
     * @param string $operator
     * @return string
     */
    public function buildUnnamed(string $clause, string $operator): string
    {
        return "$clause $operator ?";
    }

    /**
     * @param array $pieces
     * @return string
     */
    public function glue(array $pieces): string
    {
        return implode(", ", $pieces);
    }

    /**
     * @param string $table
     * @return MySQLQueryBuilder
     */
    public function setTable(string $table): MySQLQueryBuilder
    {
        $this->query->table = $table;

        return $this;
    }

    /**
     * @param int $limit
     * @param int|null $offset
     * @return MySQLQueryBuilder
     */
    public function buildLimit(int $limit, int $offset = null): MySQLQueryBuilder
    {
        $limitPart = $offset ? "LIMIT {$this->glue([$offset, $limit])}" : "LIMIT {$limit}";

        $this->query->setLimit($limitPart);

        return $this;
    }

    /**
     * @return MySQLQueryBuilder
     */
    public function order(): MySQLQueryBuilder
    {
        $this->query->setOrder('ORDER BY ');

        return $this;
    }

    /**
     * @param string $column
     * @return MySQLQueryBuilder
     */
    public function byAsc(string $column): MySQLQueryBuilder
    {
        $this->query->setBy("$column ASC");

        return $this;
    }


    /**
     * @param string $column
     * @return MySQLQueryBuilder
     */
    public function byDesc(string $column): MySQLQueryBuilder
    {
        $this->query->setBy("$column DESC");

        return $this;
    }

    /**
     * @param array $order
     * @return MySQLQueryBuilder
     */
    public function buildOrder(array $order): MySQLQueryBuilder
    {
        foreach ($order as $column => $criterion) {
            $order[$column] = "$column $criterion";
        }

        $this->query->setOrder("ORDER BY {$this->glue($order)}");

        return $this;
    }

    /**
     * @param array $where
     * @return MySQLQueryBuilder
     */
    public function setWhere(array $where): MySQLQueryBuilder
    {
        $this->query->where = $where;

        return $this;
    }

    /**
     * @return array
     */
    public function getWhere(): array
    {
        return $this->query->where;
    }

    /**
     * @param array|null $where
     * @return MySQLQueryBuilder
     */
    public function buildWhere(array $where = null): MySQLQueryBuilder
    {
        $where = $where ?? $this->query->where;

        if (!empty($where)) {
            foreach ($where as $index => $clause) {
                $where[$index] = $this->buildUnnamed($clause, '=');
            }

            $this->query->setClause('WHERE ' . implode(' AND ', $where));
        }

        return $this;
    }

    /**
     * @param string $clause
     * @param string $operator
     * @return MySQLQueryBuilder
     */
    public function where(string $clause, string $operator = '='): MySQLQueryBuilder
    {
        $this->query->setClause("WHERE {$this->buildUnnamed($clause, $operator)}");

        return $this;
    }

    /**
     * @param string $clause
     * @param string $operator
     * @return MySQLQueryBuilder
     */
    public function andWhere(string $clause, string $operator = '='): MySQLQueryBuilder
    {
        $this->query->setClause(" AND {$this->buildUnnamed($clause, $operator)}");

        return $this;
    }

    /**
     * @param string $clause
     * @param string $operator
     * @return MySQLQueryBuilder
     */
    public function orWhere(string $clause, string $operator = '='): MySQLQueryBuilder
    {
        $this->query->setClause(" OR {$this->buildUnnamed($clause, $operator)}");

        return $this;
    }

    /**
     * @return array
     */
    public function getInto(): array
    {
        return $this->query->into;
    }

    /**
     * @param array $into
     * @return MySQLQueryBuilder
     */
    public function setInto(array $into): MySQLQueryBuilder
    {
        $this->query->into = $into;

        return $this;
    }

    /**
     * @param array $select
     * @return MySQLQueryBuilder
     */
    public function buildSelect(array $select = ['*']): MySQLQueryBuilder
    {
        foreach ($select as $column => $alias) {
            if (is_int($column))
                continue ;

            $select[$column] = "$column AS $alias";
        }
        $select = $this->glue($select);

        $this->query->setStatement("SELECT $select FROM {$this->query->table}");

        return $this;
    }

    /**
     * @return array
     */
    public function getSet(): array
    {
        return $this->query->set;
    }

    /**
     * @param array $set
     * @return MySQLQueryBuilder
     */
    public function setSet(array $set): MySQLQueryBuilder
    {
        $this->query->set = $set;

        return $this;
    }

    /**
     * @return MySQLQueryBuilder
     */
    public function buildUpdate(): MySQLQueryBuilder
    {
        $set = array_map(function ($column) { return $this->buildUnnamed($column, '='); }, $this->query->set);
        $set = $this->glue($set);

        $this->query->setStatement("UPDATE {$this->query->table} SET {$set}");

        return $this;
    }

    /**
     * @return MySQLQueryBuilder
     */
    public function buildInsert(): MySQLQueryBuilder
    {
        $values = $this->glue(array_fill(0, count($this->query->into), '?'));
        $into = $this->glue($this->query->into);

        $this->query->setStatement("INSERT INTO {$this->query->table} ({$into}) VALUES ({$values})");

        return $this;
    }
    
    /**
     * @return MySQLQueryBuilder
     */
    public function buildDelete(): MySQLQueryBuilder
    {
        $this->query->setStatement("DELETE FROM {$this->query->table}");

        return $this;
    }

    /**
     * @param array $select
     * @param array $where
     * @return MySQLQueryBuilder
     */
    public function read(array $select, array $where): MySQLQueryBuilder
    {
        $this
            ->buildWhere($where)
            ->buildSelect($select);

        return $this;
    }
}
