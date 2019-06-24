<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorChain;
use app\components\Database;

class ValidatorDBData extends ValidatorChain
{
	protected $db;

	protected function __construct() {
		$this->db = Database::load();
	}
	
    public function validate($value) {
    	return parent::validate($value);
    }
}