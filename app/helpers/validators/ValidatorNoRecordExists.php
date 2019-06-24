<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorDBData;
use \app\helpers\validators\ValidatorRecordExists;

class ValidatorNoRecordExists extends ValidatorDBData {

	private $validatorRecordExists;

	public function __construct($table, $column) {
		parent::__construct();
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