<?php
namespace app\helpers\validators;
use \app\helpers\validators\Validator;

abstract class ValidatorChain implements Validator {
	private $next;
	private static $error;

	public function setNext($next) {
		$this->next = $next;
		return $next;
	}

	public function validate($value) {
		if ($this->next) {
			return $this->next->validate($value);
		}
		return true;
	}

	public function setError() {
		self::$error['validator'] = (new \ReflectionClass($this))->getShortName();
		self::$error['parameters'] = func_get_args();
		return $this;
	}

	public function getError() {
		return self::$error;
	}

//	public function getNext() {
//		return $this->next;
//	}
}