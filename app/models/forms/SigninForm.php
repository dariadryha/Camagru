<?php
namespace app\models\forms;

use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use \app\helpers\validators\ValidatorRecordExists as RecordExists;
use app\helpers\validators\ValidatorPasswordVerification as PasswordVerification;

class SigninForm extends Form
{
	public function __construct()
    {
		parent::__construct([
		    'action' => '/signin/signin',
            'inputs' => [
                'username' => new InputField([
                    'label' => 'Username',
                    'attributes' => [
                        'name' => 'username',
                        'type' => 'text',
                        'id' => 'username'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new RecordExists(
                            'Users',
                            'username'
                        )
                    ]
                ]),
                'password' => new InputField([
                    'label' => 'Password',
                    'attributes' => [
                        'name' => 'password',
                        'type' => 'password',
                        'id' => 'password',
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        new NotEmpty,
                        new PasswordVerification(
                            'Users',
                            [
                                'column' => 'username',
                                'value' => $this->getClosureInputValue('username')
                            ]
                        )
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "'Sign in'"
        ]);
	}
}