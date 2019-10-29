<?php
namespace app\helpers\validators;

use app\helpers\ClassHelper;
use app\models\db_models\DbModel;

class ValidatorTest extends Validator
{
    /**
     * @var DbModel $dbModel
     */
    private $dbModel;

    /** @var string $select */
    private $select;

    /**
     * ValidatorTest constructor.
     * @param string $select
     * @param DbModel $dbModel
     * @throws \ReflectionException
     */
    public function __construct(string $select, DbModel $dbModel)
    {
        parent::__construct();

        $this->setDbModel($dbModel);
        $this->select = $select;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function validate($value): bool
    {

        if ($this->dbModel and (new ValidatorHashVerification($this->dbModel->getColumn($this->select)))->validate($value)) {
            return parent::validate($value);
        }

        return false;
    }

    /**
     * @param DbModel $dbModel
     * @return Validator
     */
    public function setDbModel(DbModel $dbModel): Validator
    {
        $this->dbModel = $dbModel;

        return $this;
    }
}