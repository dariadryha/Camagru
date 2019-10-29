<?php
namespace app\helpers\validators;

class ValidatorNotIdentical extends Validator
{
    private $validatorIdentical;
    //private $token;

    public function __construct($token)
    {
        parent::__construct();

        $this->validatorIdentical = new ValidatorIdentical($token);
        //$this->token = $token;
    }

    public function validate($value): bool
    {
        if ($this->validatorIdentical->validate($value)) {
            return false;
        }

//        if ($this->token === $value) {
//            return false;
//        }

        return parent::validate($value);
    }
}