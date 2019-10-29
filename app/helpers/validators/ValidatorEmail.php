<?php
namespace app\helpers\validators;

/**
 * Class ValidatorEmail
 * @package app\helpers\validators
 */
class ValidatorEmail extends Validator
{
    /**
     * ValidatorEmail constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct();

//        echo "email";
//        exit();
    }

    /**
     * @param string $email
     * @return bool
     */
    public function validate($email): bool
    {
		if (!!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return parent::validate($email);
		}

		//$this->initError();
        $this->setChainError();

		return false;
	}
}
