<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__).'/app/config/bootstrap.php';
require_once PATH_CONFIG.'autoloader.php';

use \app\components\Router;
use \app\components\Database;

//Database::load();
Router::getInstance()->run();
//TODO check need this close connection
//Database::closeConnection();