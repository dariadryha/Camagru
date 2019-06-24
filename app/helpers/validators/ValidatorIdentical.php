<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorChain;

class ValidatorIdentical extends ValidatorChain {
	
	private $token;

	public function __construct($token) {
		$this->token = $token;
	}

	public function validate($value) {
		if ($this->token === $value) {
			return parent::validate($value);
		}
		$this->setError();
		return false;
	}
}
