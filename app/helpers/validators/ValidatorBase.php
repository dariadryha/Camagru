<?php
namespace app\helpers\validators;

use app\helpers\ClassHelper;

class ValidatorBase implements Validator {

    /** @var string $validatorNamespace */
    private static $validatorNamespace = '\app\helpers\validators\\';

    /** @var ValidatorBase|null */
	private $next;

	protected static $errorHandler;
	protected static $error;

    /** @var string $name */
	private $name;

	protected function __construct()
    {
	    $this->name = ClassHelper::getShortName($this);
    }

    /**
     * @param ValidatorBase $next
     * @return ValidatorBase
     */
    public function setNext(ValidatorBase $next): ValidatorBase
    {
		$this->next = $next;
		return $next;
	}

	public function validate($value): bool
    {
		if ($this->next) {
			return $this->next->validate($value);
		}
		return true;
	}

	public function setErrorHandler($errorHandler)
    {
	    self::$errorHandler = $errorHandler;
	    return $this;
    }

    public function getErrorHandler() {
	    return self::$errorHandler;
    }

	public function setError($handler = null)
    {
	    self::$error = self::$errorHandler->getErrorMessage($this->name);
        return $this;
	}

	public function getError() {
	    return self::$error;
	}

	public static function createChain($head, $links)
    {
        $temp = $head;

        foreach ($links as $link) {
            $temp = $temp->setNext($link);
        }
        return $head;
    }

    /**
     * @param string $name
     * @param array $parameters
     * @return ValidatorBase
     */
    public static function load(string $name, array $parameters = []): ValidatorBase
    {
        $name = self::$validatorNamespace . 'Validator' . ucfirst($name);
        return ClassHelper::createInstance($name, $parameters);
    }
}