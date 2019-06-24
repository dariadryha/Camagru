<?php
return [
	'elements' => [
		'username' => [
			'type' => 'text',
			'minlength' => 6,
			'maxlength' => 12,
			'id' => 'username'
		],
		'email' => [
			'type' => 'email',
			'id' => 'email'
		],
		'password' => [
			'type' => 'password',
			'id' => 'password',
			'minlength' => 6,
			'maxlength' => 12,
			'autocomplete' => 'off'
		],
		'confirm_password' => [
			'type' => 'password',
			'id' => 'confirm_password',
			'autocomplete' => 'off'
		]
	],
	'submit' => [
		'type' => 'submit',
		'value' => "'Sign up'"
	]
];