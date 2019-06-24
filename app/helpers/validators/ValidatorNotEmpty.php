<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorChain;

class ValidatorNotEmpty extends ValidatorChain {

	public function validate($value) {
		if (!empty($value)) {
			return parent::validate($value);
		}
		$this->setError();
		return false;
	}

}
