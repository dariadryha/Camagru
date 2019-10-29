<?php
namespace app\helpers\validators;

/**
 * Class ValidatorNotEmpty
 * @package app\helpers\validators
 */
class ValidatorNotEmpty extends Validator
{
    /**
     * ValidatorNotEmpty constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
		if (!empty($value)) {
			return parent::validate($value);
		}

		$this->setChainError();

		return false;
	}
}
