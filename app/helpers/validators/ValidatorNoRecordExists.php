<?php
namespace app\helpers\validators;

class ValidatorNoRecordExists extends ValidatorDBData {

	private $validatorRecordExists;

	public function __construct($table, $column) {
	    parent::__construct($table, $column);
		$this->validatorRecordExists = new ValidatorRecordExists($table, $column);
	}

	public function validate($value) {
		if ($this->validatorRecordExists->validate($value)) {
			$this->setError();
			return false;
		}
		return parent::validate($value);
	}
 }