<?php
namespace app\helpers\validators;

/**
 * Class ValidatorHashVerification
 * @package app\helpers\validators
 */
class ValidatorHashVerification extends Validator
{
    /**
     * @var string $hash
     */
    private $hash;

    /**
     * ValidatorHashVerification constructor.
     * @param string $hash
     */
	public function __construct(string $hash)
    {
        parent::__construct();

        $this->hash = $hash;
	}

    /**
     * @param string $value
     * @return bool
     */
    public function validate($value): bool
    {
        if (password_verify($value, $this->hash)) {
            return parent::validate($value);
        }

        //$this->initError();

        return false;
    }
}