<?php
namespace app\models\db_models;

class ChangeEmailModel extends DbModel
{
    const TOKEN_LIFE = 86400;
    const TOKEN_LENGTH = 10;
    const TABLE = 'ChangeEmail';
    const COLUMNS = [
        'user_id',
        'token',
        'creation_date'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param int $userId
     * @return DbModel
     */
    public function setUserId(int $userId): DbModel
    {
        return $this->setColumn('user_id', $userId);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        self::$db
            ->query()
            ->setInto(
                [
                    'user_id',
                    'token'
                ]
            );

        return parent::save();
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->getColumn('creation_date');
    }
}