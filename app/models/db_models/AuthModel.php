<?php
namespace app\models\db_models;

class AuthModel extends DbModel
{
    const TOKEN_LIFE = 86400;
    //const TOKEN_LIFE = 120;
    const TOKEN_LENGTH = 10;
    const TABLE = 'Auth';
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
     * @return bool
     */
    public function save(): bool
    {
        $this
            ->setUserId(self::$db->getLastInsertId());

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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->getColumn('user_id');
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
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->getColumn('creation_date');
    }
}