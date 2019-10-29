<?php
namespace app\models\db_models;

class ResetPasswordModel extends DbModel
{
    const TOKEN_LIFE = 86400;
    const TOKEN_LENGTH = 10;
    const TABLE = 'ResetPassword';
    const COLUMNS = [
        'user_id',
        'token',
        'creation_date',
    ];

    public function __construct()
    {
        parent::__construct();
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
                    'token',
                ]
            );

        return parent::save();
    }


    /**
     * @return bool
     */
    public function delete(): bool
    {
        self::$db
            ->query()
            ->setWhere(
                [
                    'user_id'
                ]
            );

        return parent::delete();
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
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->getColumn('creation_date');
    }
}