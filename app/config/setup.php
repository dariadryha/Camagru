<?php
require_once dirname(__DIR__).'/config/bootstrap.php';
require_once PATH_DB_MODELS . 'DbModel.php';
require_once PATH_DB_MODELS . 'UserModel.php';
require_once PATH_COMPONENTS . 'Database.php';
require_once PATH_HELPERS . 'Token.php';

use app\components\Database;
use app\models\db_models\UserModel;
use app\helpers\Token;

//$db->exec('CREATE TABLE IF NOT EXISTS Users (
//  		id SMALLINT(11) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
// 		username VARCHAR(12) NOT NULL UNIQUE,
//  		email VARCHAR(50) NOT NULL,
//  		password VARCHAR(255) NOT NULL,
//  		auth_token VARCHAR(255),
//  		auth_tstamp TIMESTAMP DEFAULT NOW(),
//  		reset_pass_token VARCHAR(255) DEFAULT NULL,
//  		reset_pass_tstamp TIMESTAMP DEFAULT NULL,
//  		activated BOOLEAN NOT NULL DEFAULT FALSE
//	)');


$db = Database::load();
$db->exec('CREATE TABLE IF NOT EXISTS Users (
  		id SMALLINT(11) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
 		username VARCHAR(12) NOT NULL UNIQUE,
  		email VARCHAR(50) NOT NULL,
  		password VARCHAR(255) NOT NULL,
  		activated BOOLEAN NOT NULL DEFAULT FALSE
	)');


//$db->exec('CREATE TABLE IF NOT EXISTS Users (
//  		id SMALLINT(11) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
// 		username VARCHAR(12) NOT NULL UNIQUE,
//  		email VARCHAR(50) NOT NULL,
//  		password VARCHAR(255) NOT NULL,
//  		auth_token VARCHAR(255),
//  		reset_pass_token VARCHAR(255) DEFAULT NULL,
//  		activated BOOLEAN NOT NULL DEFAULT FALSE
//	)');

$db->exec('CREATE TABLE IF NOT EXISTS Auth (
  		user_id SMALLINT(11) UNSIGNED NOT NULL,
  		token VARCHAR(255),
  		creation_date TIMESTAMP DEFAULT NOW(),
  		FOREIGN KEY (user_id)  REFERENCES Users (id) ON DELETE CASCADE
	)'
);

$db->exec('CREATE TABLE IF NOT EXISTS ResetPassword (
  		user_id SMALLINT(11) UNSIGNED NOT NULL,
  		token VARCHAR(255),
  		creation_date TIMESTAMP DEFAULT NOW(),
  		FOREIGN KEY (user_id)  REFERENCES Users (id) ON DELETE CASCADE
	)'
);

$db->exec('CREATE TABLE IF NOT EXISTS ChangeEmail (
  		user_id SMALLINT(11) UNSIGNED NOT NULL,
  		token VARCHAR(255),
  		creation_date TIMESTAMP DEFAULT NOW(),
  		FOREIGN KEY (user_id)  REFERENCES Users (id) ON DELETE CASCADE
	)'
);

//$db->exec("INSERT INTO Users (username, email, password, auth_token) SELECT * FROM (SELECT 'usertest1', 'usertest1@gmail.com', '" . UserModel::hash("testpassword1") . "', '" . UserModel::hash(Token::generateToken(10)) . "') AS tmp WHERE NOT EXISTS (SELECT username FROM Users WHERE username = 'usertest1')");
//$db->exec("INSERT INTO Users (username, email, password, auth_token) SELECT * FROM (SELECT 'usertest2', 'usertest2@gmail.com', '" . UserModel::hash("testpassword2") . "', '" . UserModel::hash(Token::generateToken(10)) . "') AS tmp WHERE NOT EXISTS (SELECT username FROM Users WHERE username = 'usertest2')");