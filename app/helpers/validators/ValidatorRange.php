<?php
namespace app\helpers\validators;

/**
 * Class ValidatorRange
 * @package app\helpers\validators
 */
class ValidatorRange extends Validator
{
    /** @var int $min */
	private $min;

    /** @var int @max */
	private $max;

    /**
     * ValidatorRange constructor.
     * @param int $min
     * @param int $max
     * @throws \ReflectionException
     */
	public function __construct(int $min, int $max)
    {
	    parent::__construct();

		$this->min = $min;
		$this->max = $max;
	}

    /**
     * @param int $value
     * @return bool
     */
	public function validate($value): bool
    {
		if (($value >= $this->min) && ($value <= $this->max)) {
			return parent::validate($value);
		}

		//$this->initError();

		return false;
	}
}
