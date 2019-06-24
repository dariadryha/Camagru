<?php
require_once dirname(__DIR__).'/components/Database.php';
require_once dirname(__DIR__).'/config/bootstrap.php';
use \app\components\Database;

$db = Database::load();
$db->exec('CREATE TABLE IF NOT EXISTS Users (
  		id SMALLINT(11) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
 		username VARCHAR(12) NOT NULL UNIQUE,
  		email VARCHAR(50) NOT NULL,
  		password VARCHAR(255) NOT NULL,
  		tstamp INTEGER UNSIGNED NOT NULL DEFAULT ' . $_SERVER["REQUEST_TIME"]. ',
  		activated BOOLEAN NOT NULL DEFAULT FALSE
	)');

$db->exec("INSERT INTO Users (username, email, password) SELECT * FROM (SELECT 'usertest1', 'usertest1@gmail.com', '".password_hash("testpassword1", PASSWORD_DEFAULT)."') AS tmp WHERE NOT EXISTS (SELECT username FROM Users WHERE username = 'usertest1')");
$db->exec("INSERT INTO Users (username, email, password) SELECT * FROM (SELECT 'usertest2', 'usertest2@gmail.com', '".password_hash("testpassword2", PASSWORD_DEFAULT)."') AS tmp WHERE NOT EXISTS (SELECT username FROM Users WHERE username = 'usertest2')");