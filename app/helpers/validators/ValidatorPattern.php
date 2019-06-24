<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorChain;

class ValidatorPattern extends ValidatorChain {
	
	private $pattern;

	public function __construct($pattern = '') {
		$this->pattern = $pattern;
	}

	public function validate($value) {
		if (preg_match($this->pattern, $value) != 1)
		{
			return false;
		}
		return parent::validate($value);
	}

	public function setPattern($pattern) {
		$this->pattern = $pattern;
		return $this;
	}
}
