<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorBase;

class ValidatorPattern extends ValidatorBase {
	
	private $pattern;

	public function __construct($pattern = null) {
	    parent::__construct();
		$this->pattern = $pattern;
	}

	public function validate($value) {
		if (preg_match($this->pattern, $value) != 1)
		{
		    $this->setError();
			return false;
		}
		return parent::validate($value);
	}

	public function setPattern($pattern) {
		$this->pattern = $pattern;
		return $this;
	}
}
