<?php
namespace app\helpers\validators;

class ValidatorRecordExists extends ValidatorDBData {

	public function __construct($table, $column) {
		parent::__construct($table, $column);
	}

	public function validate($value) {
		$query = $this
				->db
				->query()
				->buildWhere([$this->column])
				->buildSelect($this->table, [$this->column])
				->getQuery();
		if ($this->db->exists($query, array($value))) {
			return parent::validate($value);
		}
		$this->setError();
		return false;
	}

 }