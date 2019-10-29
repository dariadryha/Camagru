<?php
namespace app\helpers\validators;

/**
 * Class ValidatorStrLength
 * @package app\helpers\validators
 */
class ValidatorStrLength extends Validator
{
    /** @var ValidatorRange $range */
	private $range;

    /**
     * ValidatorStrLength constructor.
     * @param int $min
     * @param int $max
     * @throws \ReflectionException
     */
	public function __construct(int $min, int $max)
    {
	    parent::__construct();

		$this->range = new ValidatorRange($min, $max);
	}

    /**
     * @param mixed $value
     * @return bool
     * @throws \ReflectionException
     */
	public function validate($value): bool
    {
		if ($this->range->validate(strlen($value))) {
			return parent::validate($value);
		}

		//$this->initError();
        $this->setChainError();

		return false;
	}
}
