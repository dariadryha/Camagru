<?php
namespace app\models\db_models;

use app\components\Database;
use app\helpers\ArrayHelper;

/**
 * Class DbModel
 * @package app\models\db_models
 */
class DbModel
{
    const NAMESPACE = 'app\models\db_models\\';

    /** @var array $columns */
    protected $columns;

    /** @var Database $db */
    protected static $db;

    /**
     * DbModel constructor.
     */
    protected function __construct()
    {
        self::$db = Database::load();

        $this->columns = array_fill_keys(static::COLUMNS, null);
    }

    public static function load()
    {
        return new static;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        self::$db
            ->query()
            ->setTable(static::TABLE)
            ->buildInsert();

        return self::$db
            ->fulfillQuery(
                $this->getColumnsSet(
                    self::$db
                        ->query()
                        ->getInto()
                )
            );
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        self::$db
            ->query()
            ->buildWhere()
            ->setTable(static::TABLE)
            ->buildDelete();

        return self::$db
            ->fulfillQuery(
                $this->getColumnsSet(
                    self::$db
                        ->query()
                        ->getWhere()
                )
            );
    }

    /**
     * @return bool
     */
    public function update(): bool
    {
        self::$db
            ->query()
            ->setTable(static::TABLE)
            ->buildWhere()
            ->buildUpdate();

        return self::$db
            ->fulfillQuery(
                $this->getColumnsSet(
                    array_merge(
                        self::$db
                            ->query()
                            ->getSet(),
                        self::$db
                            ->query()
                            ->getWhere()
                    )
                )
            );
    }

//    /**
//     * @param array $set
//     * @return bool
//     */
//    public function update(array $set): bool
//    {
//        self::$db
//            ->query()
//            ->buildWhere()
//            ->setTable(static::TABLE)
//            ->buildUpdate($set);
//
//        return self::$db
//            ->fulfillQuery(
//                $this->getColumnsSet(
//                    array_merge(
//                        $set,
//                        self::$db
//                            ->query()
//                            ->getWhere()
//                    )
//                )
//            );
//    }

    /**
     * @param array $set
     * @return $this
     */
    public function setColumnsSet(array $set)
    {
        foreach ($set as $column => $value) {
            $this->setColumn($column, $value);
        }

        return $this;
    }

    /**
     * Returns the values of the obtained set of columns
     *
     * @param array $set
     * @return array
     */
    public function getColumnsSet(array $set)
    {
        $values = array_map([$this, 'getColumn'], $set);

        return $values;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return DbModel[]
     */
    public static function asObjects()
    {
//        if (!count($dbResult = self::$db->asArrays())) {
//            return false;
//        }
        $users = [];

        $dbResult = self::$db->asArrays();

        foreach ($dbResult as $user) {
            $users[] = (new static)->setColumnsSet($user);
        }

        return $users;
    }

    /**
     * @return DbModel|bool
     */
    public static function asObject()
    {
        $dbResult = self::$db->asArray();

//        var_dump($dbResult);
//        exit();

        //$this->handleUsersData($dbResult);

        return $dbResult ? (new static)->setColumnsSet($dbResult) : $dbResult;
    }
//
//    public static function select(array $where, array $select)
//    {
//        self::$db
//            ->query()
//            ->setTable(static::TABLE)
//            ->buildWhere(
//                array_keys($where)
//            )
//            ->buildSelect($select);
//    }

    /**
     * @param array $where
     * @param array $select
     * @return DbModel|bool
     */
    public static function read(array $where = [], array $select = ['*'])
    {
        self::$db = Database::load();

        self::$db
            ->query()
            ->setTable(static::TABLE)
            ->buildWhere(
                array_keys($where)
            )
            ->buildSelect($select);

        //self::select(array_keys($where), $select);

        self::$db
            ->fulfillQuery(
                array_values($where)
            );

        return empty($where) ? self::asObjects() : self::asObject();
    }


    /**
     * @return DbModel
     */
    public function byUnique(): DbModel
    {
        self::$db
            ->query()
            ->setWhere(
                [
                    static::UNIQUE
                ]
            );

        return $this;
    }

    /**
     * @return DbModel
     */
    public function byPrimaryKey(): DbModel
    {
        self::$db
            ->query()
            ->setWhere(
                [
                    static::PRIMARY_KEY
                ]
            );

        return $this;
    }

    /**
     * Using for hash password or token
     *
     * @param string $value
     * @return bool|string
     */
    public static function hash(string $value)
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->getColumn('token');
    }

    /**
     * @param string $token
     * @return DbModel
     */
    public function setToken(string $token): DbModel
    {
        return $this->setColumn('token', $this->hash($token));
    }

    /**
     * @param string $column
     * @return mixed
     */
    public function getColumn(string $column)
    {
        return ArrayHelper::getValue($this->columns, $column);
    }

    /**
     * @param string $column
     * @param $value
     * @return $this
     */
    public function setColumn(string $column, $value)
    {
        if (array_key_exists($column, $this->columns))
            $this->columns[$column] = $value;

        return $this;
    }
}