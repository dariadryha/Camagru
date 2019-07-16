<?php
namespace app\helpers\validators;

class ValidatorRange extends ValidatorBase {
	
	private $min;
	private $max;

	public function __construct($min, $max) {
	    parent::__construct();
		$this->min = $min;
		$this->max = $max;
	}

	public function validate($value) {
		if (($value >= $this->min) && ($value <= $this->max)) {
			return parent::validate($value);
		}
		$this->setError();
		return false;
	}

//	public function getMin() {
//		return $this->min;
//	}
//
//	public function getMax() {
//		return $this->max;
//	}
}
