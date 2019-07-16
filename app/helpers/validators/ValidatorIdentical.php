<?php
namespace app\helpers\validators;

class ValidatorIdentical extends ValidatorBase {
	
	private $token;

	public function __construct($token = null) {
	    parent::__construct();
	    $this->setToken($token);
	}

	public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    public function getToken() {
	    if (is_callable($this->token))
	        $this->token = ($this->token)();
	    return $this->token;
    }

	public function validate($value) {
		if ($this->getToken() === $value) {
			return parent::validate($value);
		}
		$this->setError();
		return false;
	}
}
