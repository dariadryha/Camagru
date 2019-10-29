<?php
namespace app\helpers\validators;

/**
 * Class ValidatorHashVerification
 * @package app\helpers\validators
 */
class ValidatorDbHashVerification extends ValidatorDBData
{
    /** @var array $where */
    private $where;

    /** @var string $select */
    private $select;

    /**
     * ValidatorPasswordVerification constructor.
     * @param string $table
     * @param string $select
     * @param array $where
     * @throws \ReflectionException
     */
    public function __construct(string $table, string $select, array $where)
    {
        parent::__construct($table);

        $this->select = $select;
        $this->where = $where;
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
            ->read(
                $this->table,
                [
                    $this->select,
                ],
                $this->where
            );

        $hash = $this->db->getRecord();

        if ((new ValidatorHashVerification($hash))->validate($value)) {
            return parent::validate($value);
        }

        $this->setChainError();

        return false;
    }
}