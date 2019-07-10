<?php
namespace app\helpers\validators;

class ValidatorNotEmpty extends ValidatorChain {

    public function __construct() {
        parent::__construct();
    }

    public function validate($value) {
		if (!empty($value)) {
			return parent::validate($value);
		}
		$this->setError();
		//self::$error = self::$errorHandler->getErrorMessage($this->name);
		return false;
	}
}
