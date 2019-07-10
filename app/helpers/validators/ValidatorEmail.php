<?php
namespace app\helpers\validators;

class ValidatorEmail extends ValidatorChain {
	public function validate($email) {
		if (!!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return parent::validate($email);
		}
		$this->setError();
		return false;
	}
}
