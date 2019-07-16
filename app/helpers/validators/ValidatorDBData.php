<?php
namespace app\helpers\validators;
use \app\helpers\validators\ValidatorBase;
use app\components\Database;

class ValidatorDBData extends ValidatorBase
{
	protected $db;
	protected $table;
	protected $column;

	protected function __construct($table, $column) {
	    parent::__construct();
		$this->db = Database::load();
		$this->table = $table;
		$this->column = $column;
	}
	
    public function validate($value) {
    	return parent::validate($value);
    }
}