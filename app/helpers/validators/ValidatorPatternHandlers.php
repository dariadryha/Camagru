<?php
namespace app\helpers\validators;

/**
 * Class ValidatorPatternHandlers
 * @package app\helpers\validators
 */
class ValidatorPatternHandlers extends ValidatorChain {
	
	private $handlers;
	private $pattern;

	public function __construct($handlers = null)
    {
	    parent::__construct();
	    $this->setHandlers($handlers);
		$this->pattern = new ValidatorPattern;
	}

	public function setError($handler = null)
    {
        parent::setError();
        self::$error = self::$error[$handler];

        return $this;
    }

    public function setHandlers($handlers)
    {
        $this->handlers = $handlers;

        return $this;
    }

    public function validate($value)
    {
	    //self::$errorHandler
		foreach ($this->handlers as $handler => $pattern) {
			$this->pattern->setPattern($pattern);
			if ($this->pattern->validate($value) === false)
			{
				$this->setError($handler);
				return false;
			}
		}
		return parent::validate($value);
	}
}