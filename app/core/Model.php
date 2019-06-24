<?php
namespace app\core;
use app\components\Database;

class Model {
	protected $db;

	protected function __construct() {
		$this->db = Database::load();
	}

	
}