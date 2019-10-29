<?php
namespace app\helpers\validators;

/**
 * Class ValidatorMax
 * @package app\helpers\validators
 */
class ValidatorMax extends Validator
{
    /**
     * @var int $max
     */
    private $max;

    /**
     * ValidatorMax constructor.
     * @param int $max
     */
    public function __construct(int $max)
    {
        parent::__construct();

        $this->max = $max;
    }

    /**
     * @param int $value
     * @return bool
     */
    public function validate($value): bool
    {
        if ($value > $this->max) {
            return parent::validate($value);
        }

        return false;
    }
}