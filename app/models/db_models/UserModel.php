<?php
namespace app\models\db_models;

use app\components\Database;

/**
 * Class UserModel
 * @package app\models\db_models
 */
class UserModel extends DbModel
{
    const TABLE = 'Users';
    const COLUMNS = [
        'id',
        'username',
        'email',
        'password',
        'activated',
    ];

    /**
     * UserModel constructor.
     */
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
                    'username',
                    'email',
                    'password',
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
                    'id'
                ]
            );

        return parent::delete();
    }

    /**
     * @return bool
     */
    public function updateUsername(): bool
    {
        self::$db
            ->query()
            ->setWhere(
                [
                    'id'
                ]
            )
            ->setSet(
                [
                    'username'
                ]
            );

        return parent::update();
    }

    /**
     * @return bool
     */
    public function updateEmail(): bool
    {
        self::$db
            ->query()
            ->setWhere(
                [
                    'username'
                ]
            )
            ->setSet(
                [
                    'email'
                ]
            );

        return parent::update();
    }

    /**
     * @return bool
     */
    public function updatePassword(): bool
    {
        self::$db
            ->query()
            ->setWhere(
                [
                    'username'
                ]
            )
            ->setSet(
                [
                    'password'
                ]
            );

        return parent::update();
    }

    /**
     * @return bool
     */
    public function activate(): bool
    {
        $this
            ->setActivated(true);

        self::$db
            ->query()
            ->setWhere(
                [
                    'id'
                ]
            )
            ->setSet(
                [
                    'activated'
                ]
            );

        return parent::update();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getColumn('id');
    }

    /**
     * @param int $id
     * @return UserModel
     */
    public function setId(int $id): UserModel
    {
        return $this->setColumn('id', $id);
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->getColumn('username');
    }

    /**
     * @param string $username
     * @return UserModel
     */
    public function setUsername(string $username): UserModel
    {
        return $this->setColumn('username', $username);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getColumn('email');
    }


    /**
     * @param string $email
     * @return UserModel
     */
    public function setEmail(string $email): UserModel
    {
        return $this->setColumn('email', $email);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getColumn('password');
    }

    /**
     * @param string $password
     * @return UserModel
     */
    public function setPassword(string $password): UserModel
    {
        return $this->setColumn('password', $this->hash($password));
    }

    /**
     * @return bool|null
     */
    public function getActivated(): ?bool
    {
        return $this->getColumn('activated');
    }

    /**
     * @param bool $activated
     * @return UserModel
     */
    public function setActivated(bool $activated): UserModel
    {
        return $this->setColumn('activated', $activated);
    }
}