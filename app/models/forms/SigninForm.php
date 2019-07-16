<?php
namespace app\models\forms;

use \app\helpers\validators\ValidatorBase;

/**
 * Class SigninForm
 * @package app\models\forms
 */
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
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load('recordExists',
                            [
                                'Users',
                                'username'
                            ]
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
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'passwordVerification',
                            [
                                'Users',
                                [
                                    'column' => 'username',
                                    'value' => $this->getClosureInputValue('username')
                                ]
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