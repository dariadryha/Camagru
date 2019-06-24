<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorRange;
use \app\helpers\validators\ValidatorChain;

class ValidatorStrLength extends ValidatorChain {
	private $range;

	public function __construct($min, $max) {
		$this->range = new ValidatorRange($min, $max);
	}

	public function validate($value) {
		if ($this->range->validate(strlen($value))) {
			return parent::validate($value);
		}
		$this->setError($this->range->getMin(), $this->range->getMax());
		return false;
	}
}