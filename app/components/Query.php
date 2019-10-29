<?php
namespace app\components;

class Query
{
    /** @var array $parts determines the order of statements in the final query */
    private $parts = [
        'statement',
        'clause',
        'order',
        'limit'
    ];

    /** @var string $table */
    public $table;

    /** @var array $where raw set of columns for WHERE statement */
    public $where = [];

    /** @var array $into raw set of columns for INSERT INTO statement */
    public $into;

    /** @var array $into raw set of columns for SET statement */
    public $set;

    /** @var array $by */
    private $by = [];

    /**
     * Query constructor.
     */
    public function __construct()
    {
        $this->parts = array_fill_keys($this->parts, '');
    }

    /**
     * @param string $by
     * @return Query
     */
    public function setBy(string $by): Query
    {
        array_push($this->by, $by);

        return $this;
    }

    /**
     * @return array
     */
    public function getParts(): array
    {
        if (!empty($this->by))
            $this->setOrder(implode(', ', $this->by));

        return $this->parts;
    }

    /**
     * @param string $part
     * @param $value
     * @return Query
     */
    public function setPart(string $part, $value): Query
    {
        $this->parts[$part] .= $value;

        return $this;
    }

    /**
     * @param string $limit
     * @return Query
     */
    public function setLimit(string $limit): Query
    {
        return $this->setPart('limit', $limit);
    }

    /**
     * @param string $order
     * @return Query
     */
    public function setOrder(string $order): Query
    {
        return $this->setPart('order', $order);
    }

    /**
     * @param string $clause
     * @return Query
     */
    public function setClause(string $clause): Query
    {
        return $this->setPart('clause', $clause);
    }

    /**
     * @param string $statement
     * @return Query
     */
    public function setStatement(string $statement): Query
    {
        return $this->setPart('statement', $statement);
    }
}