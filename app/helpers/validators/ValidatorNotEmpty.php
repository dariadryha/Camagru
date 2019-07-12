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
		return false;
	}
}
