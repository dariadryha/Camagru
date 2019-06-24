<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorChain;

class ValidatorRange extends ValidatorChain {
	
	private $min;
	private $max;

	public function __construct($min, $max) {
		$this->min = $min;
		$this->max = $max;
	}

	public function validate($value) {
		if (($value >= $this->min) && ($value <= $this->max)) {
			return parent::validate($value);
		}
		return false;
	}

	public function getMin() {
		return $this->min;
	}

	public function getMax() {
		return $this->max;
	}

}
