<?php
require_once dirname(__DIR__).'/config/bootstrap.php';
require_once PATH_CONFIG.'autoloader.php';

use \app\models\db_models\AuthModel;
use app\models\db_models\UserModel;
use app\helpers\validators\ValidatorTimestampDiff;

/**
 * @var AuthModel[]|bool
 */
$usersAuth = AuthModel::read([],
    [
        'user_id',
        'creation_date'
    ]
);

$validator = new ValidatorTimestampDiff();

foreach ($usersAuth as $userAuth) {
    if ($validator->validate($userAuth->getCreationDate())) {
        continue;
    }

    UserModel::load()
                ->setId($userAuth->getUserId())
                ->delete();
}

