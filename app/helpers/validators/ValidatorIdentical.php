<?php
namespace app\helpers\validators;
/**
 * Class ValidatorIdentical
 * @package app\helpers\validators
 */
class ValidatorIdentical extends Validator
{
    /** @var mixed $token */
	private $token;

    /**
     * ValidatorIdentical constructor.
     * @param mixed $token
     * @throws \ReflectionException
     */
	public function __construct($token = null)
    {
	    parent::__construct();

	    $this->setToken($token);
	}

    /**
     * @param mixed $token
     * @return Validator
     */
	public function setToken($token): Validator
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param mixed $value
     * @return bool
     * @throws \ReflectionException
     */
	public function validate($value): bool
    {
		if ($this->token === $value) {
			return parent::validate($value);
		}

		//$this->initError();
        $this->setChainError();

		return false;
	}
}
