<?php
namespace app\models\forms;

use \app\helpers\validators\ValidatorNotEmpty as NotEmpty;
use \app\helpers\validators\ValidatorRecordExists as RecordExists;
use app\helpers\validators\ValidatorPasswordVerification as PasswordVerification;

class SigninForm extends Form {
	public function __construct() {
		parent::__construct([
		    'action' => '/signin/signin',
            'inputs' => [
                'username' => ($username = new InputField([
                    'attributes' => [
                        'name' => 'username',
                        'type' => 'text',
                        'id' => 'username'
                    ],
                    'validators' => [
                        new NotEmpty(),
                        new RecordExists(
                            'Users',
                            'username'
                        )
                    ],
                    'label' => 'Username'
                ])),
                'password' => new InputField([
                    'attributes' => [
                        'type' => 'password',
                        'id' => 'password',
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        new NotEmpty(),
                        new PasswordVerification(
                            'Users',
                            [
                                'column' => 'username',
                                'row' => function () use ($username) {
                                    return $username->getValue();
                                }
                            ]
                        )
                    ],
                    'label' => 'Password'
                ])
            ],
            'submit' => [
                'type' => 'submit',
                'value' => "'Sign in'"
            ]
        ]);
	}
}