<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorDBData;

class ValidatorForm extends ValidatorDBData
{
    public function __construct($table, $column)
    {
        parent::__construct($table, $column);
    }

    public function validate($value) {
    	return parent::validate($value);
    }
}