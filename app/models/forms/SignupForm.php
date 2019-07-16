<?php
namespace app\models\forms;

use app\helpers\validators\ValidatorBase;
use app\models\UserModel;

/**
 * Class SignupForm
 * @package app\models\forms
 */
class SignupForm extends Form
{
    public function __construct()
    {
        parent::__construct([
            'action' => '/signup/signup',
            'inputs' => [
                'username' => new InputField([
                    'label' => 'Username',
                    'attributes' => [
                        'name' => 'username',
                        'type' => 'text',
                        'minlength' => self::USERNAME_MIN_LENGTH,
                        'maxlength' => self::USERNAME_MAX_LENGTH,
                        'id' => 'username'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'patternHandlers',
                            [$this->getInputPatterns('username')]
                        ),
                        ValidatorBase::load(
                            'strLength',
                            [
                                self::USERNAME_MIN_LENGTH,
                                self::USERNAME_MAX_LENGTH
                            ]
                        ),
                        ValidatorBase::load(
                            'noRecordExists',
                            [
                                'Users',
                                'username'
                            ]
                        )
                    ]
                ]),
                'email' => new InputField([
                    'label' => 'Email',
                    'attributes' => [
                        'name' => 'email',
                        'type' => 'email',
                        'id' => 'email'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load('email')
                    ]
                ]),
                'password' => new InputField([
                    'label' => 'Password',
                    'attributes' => [
                        'name' => 'password',
                        'type' => 'password',
                        'id' => 'password',
                        'minlength' => self::PASSWORD_MIN_LENGTH,
                        'maxlength' => self::PASSWORD_MAX_LENGTH,
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'patternHandlers',
                            [$this->getInputPatterns('password')]
                        ),
                        ValidatorBase::load(
                            'strLength',
                            [
                                self::PASSWORD_MIN_LENGTH,
                                self::PASSWORD_MAX_LENGTH
                            ]
                        )
                    ]
                ]),
                'confirm_password' => new InputField([
                    'label' => 'Confirm password',
                    'attributes' => [
                        'name' => 'confirm_password',
                        'type' => 'password',
                        'id' => 'confirm_password',
                        'autocomplete' => 'off'
                    ],
                    'validators' => [
                        ValidatorBase::load('notEmpty'),
                        ValidatorBase::load(
                            'identical',
                            [$this->getClosureInputValue('password')]
                        )
                    ]
                ])
            ],
            'type' => 'submit',
            'value' => "Sign up"
        ]);
    }

    /**
     * @return bool
     */
    public function signup(): bool
    {
        $user = new UserModel();

        $user
            ->setUsername($this->getInputValue('username'))
            ->setEmail($this->getInputValue('email'))
            ->setPassword($this->getInputValue('password'));
        return $user->save();
    }
}