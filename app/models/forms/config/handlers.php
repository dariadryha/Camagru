<?php
return [
	'username' => [
		'characterSet' => '/^[a-z0-9-_.]+$/',
		'firstCharacter' => '/^[a-z]/',
		'lastCharacter' => '/[a-z0-9]$/'
	],
	'email' => [
		'characterSet' => '/^[a-z0-9-_.@]+$/i',
		'firstPart' => '/^[a-z0-9-_.]+\@/i',
		'lastPart' => '/\@([a-z0-9-]+\.)+/',
		'domainZone' => '/\.[a-z]{2,6}$/'
	],
	'password' => [
		'characterSet' => '/^[a-z0-9\!@#\$%\^&\*\(\)\-_\+\=\[\]\{\}\|]+$/i',
		'letters' => '/[a-z]+/i',
		'digits' => '/[0-9]+/',
		'nonAlphanumeric' => '/[\!@#\$%\^&\*\(\)\-_\+\=\[\]\{\}\|]+/'
	]
];