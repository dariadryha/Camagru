<?php
namespace app\helpers\validators;

/**
 * Class ValidatorPattern
 * @package app\helpers\validators
 */
class ValidatorPattern extends Validator
{
    /** @var string $pattern */
	private $pattern;

    /**
     * ValidatorPattern constructor.
     * @param string|null $pattern
     * @throws \ReflectionException
     */
	public function __construct(string $pattern = null)
    {
	    parent::__construct();

		$this->pattern = $pattern;
	}

    /**
     * @param mixed $value
     * @return bool
     * @throws \ReflectionException
     */
	public function validate($value): bool
    {
		if (preg_match($this->pattern, $value) != 1) {
		    //$this->initError();

            $this->setChainError();

			return false;
		}

		return parent::validate($value);
	}

    /**
     * @param string $pattern
     * @return Validator
     */
	public function setPattern(string $pattern): Validator
    {
		$this->pattern = $pattern;

		return $this;
	}
}
