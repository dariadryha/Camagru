<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorPattern;
use \app\helpers\validators\ValidatorChain;

class ValidatorPatternHandlers extends ValidatorChain {
	
	private $handlers;
	private $pattern;

	public function __construct($handlers) {
		$this->handlers = $handlers;
		$this->pattern = new ValidatorPattern;
	}

	public function validate($value) {
		foreach ($this->handlers as $handler => $pattern) {
			$this->pattern->setPattern($pattern);
			if ($this->pattern->validate($value, true) === false)
			{
				$this->setError($handler);
				return false;
			}
		}
		return parent::validate($value);
	}

}