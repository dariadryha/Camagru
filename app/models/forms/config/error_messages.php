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
//
//$passwordCharacterSet = " * {$this->input->getLabel()} must include a minimum of three of the following mix of character types: letters, numbers, non-alphanumeric symbols, for example !@#$%^&*()-_+={}[]|";
//return [
//    'ValidatorNotEmpty' => "{$this->input->getLabel()} is required field.",
//    'ValidatorStrLength' => "{$this->input->getLabel()} must be between {$this->input->getMinLength()} and {$this->input->getMaxLength()} characters.",
//    'ValidatorPatternHandlers' => [
//        'username' => [
//            'characterSet' => "* {$this->input->getLabel()} must include the following character set: lowercase, numeric, non-alphanumeric symbols ._-",
//            'firstCharacter' => "* {$this->input->getLabel()} must begin with a letter.",
//            'lastCharacter' => "* {$this->input->getLabel()} must end with a letter or number."
//        ],
//        'email' => [
//            'characterSet' => "* {$this->input->getLabel()} must include the following character set: letters, numeric, non-alphanumeric symbols .@-_",
//            'firstPart' => "* Please enter the part before @.",
//            'lastPart' => "* Please enter the part following @.",
//            'domainZone' => "* Please complete email input."
//        ],
//        'password' => [
//            'characterSet' => &$passwordCharacterSet,
//            'letters' => &$passwordCharacterSet,
//            'digits' => &$passwordCharacterSet,
//            'nonAlphanumeric' => &$passwordCharacterSet
//        ]
//    ],
//    'ValidatorNoRecordExists' => "{$this->input->getLabel()} already exists."
//];


//$passwordCharacterSet = " * {$this->input->getLabel()} must include a minimum of three of the following mix of character types: letters, numbers, non-alphanumeric symbols, for example !@#$%^&*()-_+={}[]|";
//return [
//    'ValidatorNotEmpty' => "{$this->input->getLabel()} is required field.",
//    'ValidatorStrLength' => "{$this->input->getLabel()} must be between {$this->input->getMinLength()} and {$this->input->getMaxLength()} characters.",
//    'ValidatorPatternHandlers' => null,
//    'ValidatorNoRecordExists' => "{$this->input->getLabel()} already exists."
//];

//[
//    'username' => [
//        'characterSet' => "* {$this->input->getLabel()} must include the following character set: lowercase, numeric, non-alphanumeric symbols ._-",
//        'firstCharacter' => "* {$this->input->getLabel()} must begin with a letter.",
//        'lastCharacter' => "* {$this->input->getLabel()} must end with a letter or number."
//    ],
//    'email' => [
//        'characterSet' => "* {$this->input->getLabel()} must include the following character set: letters, numeric, non-alphanumeric symbols .@-_",
//        'firstPart' => "* Please enter the part before @.",
//        'lastPart' => "* Please enter the part following @.",
//        'domainZone' => "* Please complete email input."
//    ],
//    'password' => [
//        'characterSet' => &$passwordCharacterSet,
//        'letters' => &$passwordCharacterSet,
//        'digits' => &$passwordCharacterSet,
//        'nonAlphanumeric' => &$passwordCharacterSet
//    ]
//]