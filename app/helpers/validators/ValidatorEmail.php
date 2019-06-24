<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorForm;

class ValidatorEmail extends ValidatorForm {

	public function validate($email) {
		if (!!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return parent::validate($email);
		}
		$this->setError();
		return false;
	}
}
