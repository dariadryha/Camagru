<?php
namespace app\helpers\validators;

use app\components\Database;
use app\models\db_models\AuthModel;
use app\models\db_models\DbModel;

class ValidatorTimestampDiff extends Validator
{
    private $dbModel;

    public function __construct(DbModel $dbModel)
    {
        parent::__construct();

        $this->dbModel = $dbModel;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        if (Database::load()->timeDiff([$value])) {
            if (Database::load()->getRecord() < $this->dbModel::TOKEN_LIFE) {
                return parent::validate($value);
            }
        }

        return false;
    }
}