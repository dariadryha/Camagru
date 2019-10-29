<?php
namespace app\helpers\validators;

/**
 * Class ValidatorRecordExists
 * @package app\helpers\validators
 */
class ValidatorRecordExists extends ValidatorDBData
{
    /** @var string $column */
    private $column;

    /**
     * ValidatorRecordExists constructor.
     * @param string $table
     * @param string $column
     * @throws \ReflectionException
     */
    public function __construct(string $table, string $column)
    {
        parent::__construct($table);

        $this->column = $column;
    }

    /**
     * @param mixed $value
     * @return bool
     * @throws \ReflectionException
     */
    public function validate($value): bool
    {
        $this
            ->db
            ->query()
            ->setTable($this->table)
            ->read(
                [
                    $this->column,
                ],
                [
                    $this->column,
                ]
            );

        if ($this->db->exists([$value])) {
            return parent::validate($value);
        }

        $this->setChainError();

        return false;
    }
}