<?php
namespace app\core;

use app\components\Database;

/**
 * Class Model
 * @package app\core
 */
class Model
{
    /** @var Database $db */
	protected $db;

	protected function __construct()
    {
		$this->db = Database::load();
	}
}