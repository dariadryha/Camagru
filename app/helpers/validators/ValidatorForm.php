<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorDBData;

class ValidatorForm extends ValidatorDBData
{
    public function validate($value) {
    	return parent::validate($value);
    }
}