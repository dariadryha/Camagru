<?php
$passwordCharacterSet = " * Your password must include a minimum of three of the following mix of character types: letters, numbers, non-alphanumeric symbols, for example !@#$%^&*()-_+={}[]|";
return [
	'username' => [
		'characterSet' => "* Username must include the following character set: lowercase, numeric, non-alphanumeric symbols ._-",
		'firstCharacter' => "* Username must begin with a letter.",
		'lastCharacter' => "* Username must end with a letter or number."
	],
	'email' => [
		'characterSet' => "* Email must include the following character set: letters, numeric, non-alphanumeric symbols .@-_",
		'firstPart' => "* Please enter the part before @.",
		'lastPart' => "* Please enter the part following @.",
		'domainZone' => "* Please complete email input."
	],
	'password' => [
		'characterSet' => &$passwordCharacterSet,
		'letters' => &$passwordCharacterSet,
		'digits' => &$passwordCharacterSet,
		'nonAlphanumeric' => &$passwordCharacterSet
	]
];
