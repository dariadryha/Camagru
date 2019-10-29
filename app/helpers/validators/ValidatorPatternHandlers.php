<?php
namespace app\helpers\validators;

/**
 * Class ValidatorPatternHandlers
 * @package app\helpers\validators
 */
class ValidatorPatternHandlers extends Validator {

    /** @var array $handlers */
	private $handlers;

    /** @var ValidatorPattern $pattern */
	private $pattern;

    /**
     * ValidatorPatternHandlers constructor.
     * @param array|null $handlers
     */
	public function __construct(array $handlers = null)
    {
	    parent::__construct();

	    $this->setHandlers($handlers);
		$this->pattern = new ValidatorPattern;
	}

    /**
     * @param string|null $handler
     * @throws \ReflectionException
     */
	public function setChainError(string $handler = null)
    {
        /**
         * call parent constructor for getting an array of patterns errors
         */
        parent::setChainError();

        self::$chainError = self::$chainError[$handler];
    }

    /**
     * @param array $handlers
     * @return Validator
     */
    public function setHandlers(array $handlers): Validator
    {
        $this->handlers = $handlers;

        return $this;
    }

    /**
     * @param mixed $value
     * @return bool
     * @throws \ReflectionException
     */
    public function validate($value): bool
    {
		foreach ($this->handlers as $handler => $pattern) {

			$this->pattern->setPattern($pattern);

			if ($this->pattern->validate($value) === false)
			{
				$this->setChainError($handler);
				return false;
			}
		}

		return parent::validate($value);
	}
}