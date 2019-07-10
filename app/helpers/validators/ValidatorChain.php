<?php
namespace app\helpers\validators;

abstract class ValidatorChain implements Validator {
	private $next;
	protected static $errorHandler;
	protected static $error;
	protected $name;

	protected function __construct() {
	    $this->name = (new \ReflectionClass($this))->getShortName();
    }

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

	public function setErrorHandler($errorHandler) {
	    self::$errorHandler = $errorHandler;
	    return $this;
    }

    public function getErrorHandler() {
	    return self::$errorHandler;
    }

	public function setError($handler = null) {
	    self::$error = self::$errorHandler->getErrorMessage($this->name);
		return $this;
	}

	public function getError() {
	    return self::$error;
	}

	public static function createChain($head, $links) {
        $temp = $head;

        foreach ($links as $link) {
            $temp = $temp->setNext($link);
        }
        return $head;
    }
}