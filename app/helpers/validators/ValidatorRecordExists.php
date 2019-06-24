<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorDBData;

class ValidatorRecordExists extends ValidatorDBData {

	private $table;
	private $column;

	public function __construct($table, $column) {
		parent::__construct();
		$this->table = $table;
		$this->column = $column;
	}

	public function validate($value) {
		$query = $this
				->db
				->query()
				->buildWhere([$this->column])
				->buildSelect($this->table, [$this->column])
				->getQuery();
		if ($this->db->exists($query, [$value])) {
			return parent::validate($value);
		}
		$this->setError();
		return false;
	}

 }