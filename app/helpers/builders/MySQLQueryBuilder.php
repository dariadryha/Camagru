<?php 
namespace app\helpers\builders;
use \app\helpers\builders\SQLQueryBuilder;
use \app\components\Query;

class MySQLQueryBuilder implements SQLQueryBuilder {
	protected $query;
	protected $sql;

	public function __construct() {
		$this->query = new Query;
	}

	public function getQuery() {
		return $this->sql;
	}

	public function buildWhere($where) {
		foreach ($where as $key => $clause) {
			$operator = (isset($this->query->operator[$key])) ? $this->query->operator[$key] : '=';
			$logic = (isset($this->query->logic[$key])) ? $this->query->logic[$key] : 'AND';
			$where[$key] = "$clause $operator ?";
			$where[$key] .= " $logic";
		}
		$where = trim(implode(" ", $where), " $logic");
		$this->query->where = " WHERE $where";
		return $this;
	}

	public function buildLimit($start, $offset) {
		$this->query->limit = " LIMIT $start, $offset";
		return $this;
	}

	public function buildOrder($order) {
		foreach ($order as $column => $criterion) {
			$order[$column] = "$column $criterion";
		}
		$this->query->order = " ORDER BY ".implode(", ", $order);
		return $this;
	}

	public function setOperators($operators) {
		$this->query->operators = $operators;
		return $this;
	}

	public function setLogics($logics) {
		$this->query->logics = $logics;
		return $this;
	}

	public function buildSelect($table, $select) {
		foreach ($select as $column => $alias) {
			if (is_int($column))
				continue ;
			$select[$column] = "$column AS $alias";
		}
		$select = implode(", ", $select);
		$this->sql = sprintf("SELECT %s FROM %s%s%s%s", $select, $table, $this->query->where, $this->query->order, $this->query->limit);
		return $this;
	}

	public function buildUpdate($table, $set) {
		$set = array_map(function ($column) {return $column.' = ?'; }, $set);
		$set = implode(", ", $set);
		$this->sql = sprintf("UPDATE %s SET %s%s%s%s", $table, $set, $this->query->where, $this->query->order, $this->query->limit);
		return $this;
	}

	public function buildInsert($table, $into) {
		$values = implode(", ", array_fill(0, count($into), '?'));
		$into = implode(", ", $into);
		$this->sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $into, $values);
		return $this;
	}

	public function buildDelete($table) {
		$this->sql = sprintf("DELETE FROM %s%s%s%s", $table, $this->query->where, $this->query->order, $this->query->limit);
		return $this;
	}
}
