<?php
namespace app\helpers\validators;
use app\components\Database;

/**
 * Class ValidatorDBData
 * @package app\helpers\validators
 */
class ValidatorDBData extends Validator
{
    /** @var Database $db */
    protected $db;

    /** @var string $table */
    protected $table;

    /**
     * ValidatorDBData constructor.
     * @param string $table
     * @throws \ReflectionException
     */
    protected function __construct(string $table)
    {
        parent::__construct();

        $this->db = Database::load();
        $this->table = $table;
//        $this
//            ->db
//            ->query()
//            ->setTable($table);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        return parent::validate($value);
    }
}